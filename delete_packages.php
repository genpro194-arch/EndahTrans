<?php
require 'bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Package;

// Delete specific packages
$deleted = Package::whereIn('slug', [
    'pesona-bali-4d3n',
    'honeymoon-romantic-bali-5d4n',
    'explore-jogja-heritage-3d2n',
    'raja-ampat-diving-paradise-5d4n',
    'lombok-adventure-4d3n',
    'komodo-explorer-4d3n',
    'bandung-city-nature-3d2n'
])->delete();

echo "✓ $deleted paket wisata berhasil dihapus\n";
