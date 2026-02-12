<?php
require '../vendor/autoload.php';
$app = require_once '../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$pkg = \App\Models\Package::with('packageFacilities')->where('slug', 'big-bus-tour-dalam-kota')->first();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alpine Test Data</title>
</head>
<body>
<h1>Package Facilities Data</h1>
<pre>
<?php
echo "First Facility ID: " . ($pkg->packageFacilities->first()->id ?? 'null') . "\n";
echo "JSON Map: " . json_encode($pkg->packageFacilities->mapWithKeys(function($f) { 
    return [$f->id => (int)($f->discount_price ?? $f->price)]; 
}), JSON_PRETTY_PRINT) . "\n\n";
echo "All Facilities:\n";
foreach($pkg->packageFacilities as $pf) {
    echo "  ID: " . $pf->id . ", Price: " . $pf->price . ", Discount: " . $pf->discount_price . "\n";
}
?>
</pre>
<hr>
<h2>Alpine.js x-data would be:</h2>
<pre>
x-data="{
    selectedFacility: <?php echo $pkg->packageFacilities->first()->id ?? '0'; ?>,
    facilities: <?php echo json_encode($pkg->packageFacilities->mapWithKeys(function($f) { return [$f->id => (int)($f->discount_price ?? $f->price)]; })); ?>,
    ...
}"
</pre>
</body>
</html>
