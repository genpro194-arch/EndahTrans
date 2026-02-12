<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$pkg = \App\Models\Package::with('packageFacilities')->where('slug', 'big-bus-tour-dalam-kota')->first();
if($pkg) {
    echo "Package: " . $pkg->name . "\n";
    echo "Total Facilities: " . $pkg->packageFacilities->count() . "\n\n";
    
    foreach($pkg->packageFacilities as $pf) {
        echo "ID: " . $pf->id . ", Bus Facility: " . $pf->busFacility->name . ", Price: " . $pf->price . ", Discount: " . $pf->discount_price . "\n";
    }
    
    echo "\n\nJSON Map:\n";
    echo json_encode($pkg->packageFacilities->mapWithKeys(function($f) { 
        return [$f->id => (int)($f->discount_price ?? $f->price)]; 
    }), JSON_PRETTY_PRINT);
} else {
    echo "Package not found\n";
}
