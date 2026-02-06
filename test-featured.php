<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Http\Kernel')->handle(
    $request = new \Illuminate\Http\Request()
);

$packages = \App\Models\Package::where('is_active', true)
    ->where('is_featured', true)
    ->orderBy('name', 'asc')
    ->get();

echo "Total Featured Packages: " . $packages->count() . "\n\n";

foreach ($packages as $package) {
    echo $package->id . ". " . $package->name . " (is_featured: " . ($package->is_featured ? 'true' : 'false') . ")\n";
}
