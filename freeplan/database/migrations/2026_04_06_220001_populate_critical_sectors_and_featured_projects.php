<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $prefix = DB::getTablePrefix();

        // Mark critical sectors
        $criticalSectors = [
            'Finance et conformite',
            'Secteur public et institutionnel',
            'Aeronautique et securite aeroportuaire',
            'Workflow et BPM'
        ];

        foreach ($criticalSectors as $sector) {
            DB::statement(
                "UPDATE {$prefix}activity_sectors SET is_critical = 1 WHERE name = ?",
                [$sector]
            );
        }

        // Mark some projects as featured in critical sectors
        DB::statement(
            "UPDATE {$prefix}projects SET is_featured = 1
             WHERE sector_id IN (
                SELECT id FROM {$prefix}activity_sectors WHERE is_critical = 1
             ) LIMIT 5"
        );
    }

    public function down(): void
    {
        $prefix = DB::getTablePrefix();

        DB::statement(
            "UPDATE {$prefix}activity_sectors SET is_critical = 0"
        );

        DB::statement(
            "UPDATE {$prefix}projects SET is_featured = 0"
        );
    }
};
