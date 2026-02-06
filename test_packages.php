<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Package;

echo "=== Featured Packages ===\n";
$packages = Package::where('is_featured', 1)->where('is_active', 1)->get();
echo "Total: " . count($packages) . "\n\n";

foreach($packages as $p) {
    echo "ID: " . $p->id . "\n";
    echo "Name: " . $p->name . "\n";
    echo "Slug: " . $p->slug . "\n";
    echo "Featured: " . ($p->is_featured ? 'Yes' : 'No') . "\n";
    echo "Active: " . ($p->is_active ? 'Yes' : 'No') . "\n";
    echo "---\n";
}

echo "\n=== All Packages ===\n";
$allPackages = Package::where('is_active', 1)->take(5)->get();
echo "Sample (first 5):\n";
foreach($allPackages as $p) {
    echo "- " . $p->name . " (featured: " . ($p->is_featured ? 'Yes' : 'No') . ")\n";
}
