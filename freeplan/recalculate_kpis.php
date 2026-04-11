<?php
require 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle($request = Illuminate\Http\Request::capture());

$service = new \App\Services\KpiMetricService();
$service->recalculate();

echo "✓ KPI Metrics recalculated successfully!\n";
