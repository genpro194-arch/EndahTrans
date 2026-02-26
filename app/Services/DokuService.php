<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DokuService
{
    protected string $clientId;
    protected string $secretKey;
    protected string $baseUrl;
    protected int $paymentDueMinutes;

    public function __construct()
    {
        $this->clientId          = config('doku.client_id');
        $this->secretKey         = config('doku.secret_key');
        $this->baseUrl           = config('doku.base_url');
        $this->paymentDueMinutes = config('doku.payment_due_minutes', 60);
    }

    /**
     * Buat payment request ke DOKU Snap API
     */
    public function createPayment(array $data): array
    {
        $requestTarget = '/checkout/v1/payment';
        $requestId     = (string) Str::uuid();
        $timestamp     = now()->toIso8601String();

        $body = [
            'order' => [
                'invoice_number' => $data['invoice_number'],
                'line_items'     => [
                    [
                        'name'      => $data['item_name'],
                        'price'     => (int) $data['amount'],
                        'quantity'  => 1,
                    ],
                ],
                'amount'         => (int) $data['amount'],
            ],
            'payment' => [
                'payment_due_date' => $this->paymentDueMinutes,
            ],
            'customer' => [
                'id'    => 'CUST-' . $data['invoice_number'],
                'name'  => $data['customer_name'],
                'email' => $data['customer_email'],
                'phone' => $this->formatPhone($data['customer_phone']),
            ],
        ];

        $signature = $this->generateSignature($requestId, $timestamp, $requestTarget, $body);

        $response = Http::withHeaders([
            'Content-Type'      => 'application/json',
            'Client-Id'         => $this->clientId,
            'Request-Id'        => $requestId,
            'Request-Timestamp' => $timestamp,
            'Signature'         => 'HMACSHA256=' . $signature,
        ])->post($this->baseUrl . $requestTarget, $body);

        return $response->json();
    }

    /**
     * Verifikasi notifikasi webhook dari DOKU
     */
    public function verifyNotification(array $headers, string $body): bool
    {
        $clientId         = $headers['client-id']         ?? $headers['Client-Id']         ?? '';
        $requestId        = $headers['request-id']        ?? $headers['Request-Id']        ?? '';
        $requestTimestamp = $headers['request-timestamp'] ?? $headers['Request-Timestamp'] ?? '';
        $signature        = $headers['signature']         ?? $headers['Signature']         ?? '';

        // Hapus prefix HMACSHA256=
        $signature = str_replace('HMACSHA256=', '', $signature);

        $expectedSignature = $this->generateSignatureFromBody(
            $requestId, $requestTimestamp, '/v1/payment-notification', $body
        );

        return hash_equals($expectedSignature, $signature);
    }

    /**
     * Generate DOKU Snap Signature
     */
    protected function generateSignature(string $requestId, string $timestamp, string $target, array $body): string
    {
        $bodyJson = json_encode($body);
        return $this->generateSignatureFromBody($requestId, $timestamp, $target, $bodyJson);
    }

    protected function generateSignatureFromBody(string $requestId, string $timestamp, string $target, string $bodyJson): string
    {
        $digest       = base64_encode(hash('sha256', $bodyJson, true));
        $stringToSign = "Client-Id:{$this->clientId}\nRequest-Id:{$requestId}\nRequest-Timestamp:{$timestamp}\nRequest-Target:{$target}\n{$digest}";
        $hmac         = hash_hmac('sha256', $stringToSign, $this->secretKey, true);
        return base64_encode($hmac);
    }

    /**
     * Format nomor HP ke format internasional
     */
    protected function formatPhone(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone);
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }
        return $phone;
    }
}
