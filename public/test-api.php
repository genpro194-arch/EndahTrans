<?php
// Test route untuk debug popular packages
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(new \Illuminate\Http\Request());

$packages = \App\Models\Package::where('is_active', true)
    ->where('is_featured', true)
    ->orderBy('name', 'asc')
    ->get();

header('Content-Type: application/json');
echo json_encode([
    'total_featured' => $packages->count(),
    'packages' => $packages->map(fn($p) => [
        'id' => $p->id,
        'name' => $p->name,
        'is_featured' => $p->is_featured,
        'is_active' => $p->is_active,
    ])->toArray()
]);
