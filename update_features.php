<?php

use App\Models\PackageBusFacility;

require __DIR__ . '/bootstrap/app.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$pbf = PackageBusFacility::all();
foreach ($pbf as $p) {
    if (!$p->features) {
        $p->features = $p->busFacility->features;
        $p->save();
        echo "Updated PBF ID {$p->id}\n";
    }
}
echo "Done!\n";
