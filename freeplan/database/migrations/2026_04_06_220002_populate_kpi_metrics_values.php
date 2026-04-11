<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $prefix = DB::getTablePrefix();

        // Update KPI values with actual data

        // Featured projects
        $featured = DB::table('projects')->where('is_featured', 1)->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'Projets references'",
            [$featured]
        );

        // Active services
        $services = DB::table('services')->where('is_active', 1)->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'Expertises proposees'",
            [$services]
        );

        // Covered sectors
        $sectors = DB::table('activity_sectors')->where('is_active', 1)->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'Secteurs couverts'",
            [$sectors]
        );

        // Critical references (featured projects in critical sectors)
        $critical = DB::table('projects')
            ->join('activity_sectors', 'projects.sector_id', '=', 'activity_sectors.id')
            ->where('projects.is_featured', 1)
            ->where('activity_sectors.is_critical', 1)
            ->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'References secteurs critiques'",
            [$critical]
        );

        // Total clients
        $clients = DB::table('clients')->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'Total clients'",
            [$clients]
        );

        // Published testimonials
        $testimonials = DB::table('testimonials')->where('is_active', 1)->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'Temoignages publies'",
            [$testimonials]
        );

        // Pending testimonials
        $pending = DB::table('testimonials')->where('is_active', 0)->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'Temoignages en attente'",
            [$pending]
        );

        // Contact messages total
        $messages = DB::table('contact_messages')->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'Messages contact total'",
            [$messages]
        );

        // Contact messages last 30 days
        $messages30 = DB::table('contact_messages')
            ->where('created_at', '>=', DB::raw("DATE_SUB(NOW(), INTERVAL 30 DAY)"))
            ->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'Messages contact 30 jours'",
            [$messages30]
        );

        // Projects created in last 12 months
        $projects12m = DB::table('projects')
            ->where('created_at', '>=', DB::raw("DATE_SUB(NOW(), INTERVAL 12 MONTH)"))
            ->count();
        DB::statement(
            "UPDATE {$prefix}kpi_metrics SET value = ? WHERE title = 'Projets crees 12 mois'",
            [$projects12m]
        );
    }

    public function down(): void
    {
        // Reset KPI values to 0
        $prefix = DB::getTablePrefix();
        DB::statement("UPDATE {$prefix}kpi_metrics SET value = 0");
    }
};
