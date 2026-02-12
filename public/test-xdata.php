<?php
require '../vendor/autoload.php';
$app = require_once '../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$package = \App\Models\Package::where('slug', 'big-bus-tour-dalam-kota')->with('packageFacilities')->first();

if (!$package) {
    die('Package not found');
}

$old_bus_id = $package->packageFacilities->first()->id ?? '0';
$facilities_json = json_encode($package->packageFacilities->mapWithKeys(function($f) { 
    return [$f->id => (int)($f->discount_price ?? $f->price)]; 
}));
?>
<!DOCTYPE html>
<html>
<head>
    <title>x-data Debug</title>
    <style>
        body { font-family: monospace; margin: 20px; }
        .box { border: 1px solid #ccc; padding: 10px; margin: 10px 0; background: #f5f5f5; }
        h3 { margin-top: 20px; }
    </style>
</head>
<body>

<h1>x-data Rendered Output</h1>

<h3>Individual Variables:</h3>
<div class="box">
<strong>old('bus_facility_id'):</strong> {{ old('bus_facility_id', $old_bus_id) }}<br>
<strong>$old_bus_id result:</strong> <?php echo htmlspecialchars("'$old_bus_id'"); ?><br>
<strong>$package->packageFacilities->first()->id:</strong> <?php echo $package->packageFacilities->first()->id; ?><br>
<strong>$package->duration_days:</strong> <?php echo $package->duration_days ?? 1; ?><br>
<strong>$package->capacity:</strong> <?php echo $package->capacity ?? 35; ?>
</div>

<h3>Facilities JSON:</h3>
<div class="box">
<?php echo htmlspecialchars($facilities_json); ?>
</div>

<h3>Complete x-data string:</h3>
<div class="box" style="word-break: break-all;">
<?php 
$xdata_str = "{\n    buses: 1,\n    selectedFacility: '$old_bus_id',\n    facilities: " . $facilities_json . ",\n    durationDays: 1,\n    capacity: 40,\n    get pricePerBus() {\n        let price = this.facilities[this.selectedFacility];\n        return price ? price : 0;\n    },\n    get total() {\n        return this.buses * this.pricePerBus * this.durationDays;\n    },\n    get totalCapacity() {\n        return this.buses * this.capacity;\n    },\n    increase() {\n        if (this.buses < 10) this.buses++;\n    },\n    decrease() {\n        if (this.buses > 1) this.buses--;\n    },\n    format(num) {\n        return new Intl.NumberFormat('id-ID').format(num);\n    }\n}";
echo htmlspecialchars($xdata_str);
?>
</div>

<h3>Is it valid JavaScript?</h3>
<div class="box">
<pre id="result"></pre>
<script>
try {
    const testObj = <?php echo $facilities_json; ?>;
    document.getElementById('result').textContent = '✓ Facilities JSON Valid\n' + JSON.stringify(testObj, null, 2);
} catch(e) {
    document.getElementById('result').textContent = '✗ Invalid JSON: ' + e.message;
}
</script>

</body>
</html>
