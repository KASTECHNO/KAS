<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Remove these 3 clients (projects get client_id = null via nullOnDelete)
$toDelete = ['Symolia Technologies', 'OUIMIND', 'InfoSquare'];
foreach ($toDelete as $name) {
    $deleted = \App\Models\Client::where('name', $name)->delete();
    echo ($deleted ? 'Deleted: ' : 'Not found: ') . $name . "\n";
}

// Restore logo for Banque de France - BCE (was nulled as duplicate)
\App\Models\Client::where('name', 'Banque de France - BCE')
    ->update(['logo_url' => 'https://kas-technology.com/images/banque.jpg']);
echo "Logo restored: Banque de France - BCE\n";

echo "Done.\n";
