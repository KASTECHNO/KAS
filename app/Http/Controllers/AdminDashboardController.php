<?php

namespace App\Http\Controllers;

use App\Models\ActivitySector;
use App\Models\Client;
use App\Models\ContactMessage;
use App\Models\KpiMetric;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Services\KpiMetricService;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AdminDashboardController extends Controller
{
    public function index(KpiMetricService $kpiMetricService)
    {
        $kpiMetricService->recalculate();

        $businessKpis = KpiMetric::query()
            ->orderBy('display_order')
            ->get();

        $operational = [
            'services_active' => Service::query()->where('is_active', true)->count(),
            'sectors_active' => ActivitySector::query()->where('is_active', true)->count(),
            'clients_total' => Client::query()->count(),
            'projects_featured' => Project::query()->where('is_featured', 1)->count(),
            'testimonials_active' => Testimonial::query()->where('is_active', true)->count(),
            'contact_messages_total' => ContactMessage::query()->count(),
            'contact_messages_30d' => ContactMessage::query()->where('created_at', '>=', now()->subDays(30))->count(),
        ];

        $trendMonths = $this->buildTrendMonths(6);
        $trendData = [
            'labels' => $trendMonths->pluck('label')->values(),
            'contacts' => $trendMonths->pluck('contacts')->values(),
            'clients' => $trendMonths->pluck('clients')->values(),
            'projects' => $trendMonths->pluck('projects')->values(),
        ];

        return view('admin.dashboard', compact('businessKpis', 'operational', 'trendData'));
    }

    private function buildTrendMonths(int $count): Collection
    {
        $months = collect();

        for ($i = $count - 1; $i >= 0; $i--) {
            $start = now()->startOfMonth()->subMonths($i);
            $end = (clone $start)->endOfMonth();

            $months->push([
                'label' => Carbon::parse($start)->locale('fr')->translatedFormat('M Y'),
                'contacts' => ContactMessage::query()->whereBetween('created_at', [$start, $end])->count(),
                'clients' => Client::query()->whereBetween('created_at', [$start, $end])->count(),
                'projects' => Project::query()->whereBetween('created_at', [$start, $end])->count(),
            ]);
        }

        return $months;
    }
}
