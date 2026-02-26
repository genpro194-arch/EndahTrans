<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\DokuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DokuController extends Controller
{
    protected DokuService $doku;

    public function __construct(DokuService $doku)
    {
        $this->doku = $doku;
    }

    /**
     * Buat payment request ke DOKU & redirect ke halaman bayar
     */
    public function pay(string $bookingCode)
    {
        $booking = Booking::with('package')
            ->where('booking_code', $bookingCode)
            ->where('payment_status', 'unpaid')
            ->firstOrFail();

        // Jika sudah ada payment_url tersimpan, langsung redirect
        if ($booking->doku_payment_url) {
            return redirect($booking->doku_payment_url);
        }

        $result = $this->doku->createPayment([
            'invoice_number'  => $booking->booking_code,
            'amount'          => (int) $booking->total_price,
            'item_name'       => 'Booking ' . ($booking->package->name ?? 'Endah Trans') . ' - ' . $booking->booking_code,
            'customer_name'   => $booking->customer_name,
            'customer_email'  => $booking->customer_email,
            'customer_phone'  => $booking->customer_phone,
        ]);

        // Cek response DOKU
        if (!isset($result['payment_url'])) {
            Log::error('DOKU create payment failed', ['booking' => $bookingCode, 'response' => $result]);
            return redirect()->route('booking.confirmation', $bookingCode)
                ->with('error', 'Gagal membuat sesi pembayaran. Silakan coba lagi atau hubungi admin.');
        }

        // Simpan order ID & payment URL ke booking
        $booking->update([
            'doku_order_id'   => $result['order']['invoice_number'] ?? $bookingCode,
            'doku_payment_url' => $result['payment_url'],
        ]);

        return redirect($result['payment_url']);
    }

    /**
     * Halaman sukses setelah bayar (redirect dari DOKU)
     */
    public function success(Request $request)
    {
        $invoiceNumber = $request->get('invoice_number') ?? $request->get('order_id');

        if ($invoiceNumber) {
            $booking = Booking::where('booking_code', $invoiceNumber)->first();
            if ($booking && $booking->payment_status === 'paid') {
                return view('payment.success', compact('booking'));
            }
        }

        return view('payment.success', ['booking' => null]);
    }

    /**
     * Halaman gagal bayar
     */
    public function failed(Request $request)
    {
        $invoiceNumber = $request->get('invoice_number') ?? $request->get('order_id');
        $booking = null;
        $bookingCode = $invoiceNumber;

        if ($invoiceNumber) {
            $booking = Booking::where('booking_code', $invoiceNumber)->first();
        }

        return view('payment.failed', compact('booking', 'bookingCode'));
    }

    /**
     * Webhook notifikasi dari DOKU (server-to-server)
     */
    public function notify(Request $request)
    {
        $headers  = $request->headers->all();
        $bodyRaw  = $request->getContent();
        $payload  = $request->json()->all();

        // Verifikasi signature
        if (!$this->doku->verifyNotification($headers, $bodyRaw)) {
            Log::warning('DOKU notification: signature invalid', ['payload' => $payload]);
            return response()->json(['status' => 'invalid signature'], 403);
        }

        $invoiceNumber = $payload['order']['invoice_number'] ?? null;
        $transactionStatus = $payload['transaction']['status'] ?? null;

        Log::info('DOKU notification received', [
            'invoice' => $invoiceNumber,
            'status'  => $transactionStatus,
        ]);

        if (!$invoiceNumber) {
            return response()->json(['status' => 'ignored'], 200);
        }

        $booking = Booking::where('booking_code', $invoiceNumber)->first();

        if (!$booking) {
            Log::warning('DOKU notify: booking not found', ['invoice' => $invoiceNumber]);
            return response()->json(['status' => 'booking not found'], 404);
        }

        // Update status berdasarkan respons DOKU
        match ($transactionStatus) {
            'SUCCESS' => $booking->update([
                'payment_status' => 'paid',
                'status'         => 'confirmed',
                'payment_method' => 'doku_' . strtolower($payload['payment']['channel'] ?? 'online'),
                'paid_at'        => now(),
            ]),
            'FAILED', 'EXPIRED' => $booking->update([
                'payment_status' => 'failed',
            ]),
            default => null,
        };

        return response()->json(['status' => 'ok']);
    }
}
