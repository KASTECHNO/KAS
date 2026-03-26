<?php

namespace App\Http\Controllers;

use App\Models\ActivitySector;
use App\Models\Client;
use App\Models\ContactMessage;
use App\Models\CrmActivity;
use App\Models\KpiMetric;
use App\Models\Lead;
use App\Models\Opportunity;
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

        $crmKpis = $this->buildCrmKpis();
        $pipelineStages = $this->buildPipelineStages();
        $activityFocus = $this->buildActivityFocus();

        return view('admin.dashboard', compact('businessKpis', 'operational', 'trendData', 'crmKpis', 'pipelineStages', 'activityFocus'));
    }

    private function buildCrmKpis(): array
    {
        $totalLeads = Lead::query()->count();
        $convertedLeads = Lead::query()->where('status', 'CONVERTED')->count();
        $openOpportunities = Opportunity::query()->where('status', 'OPEN')->get();
        $wonThisMonth = Opportunity::query()
            ->where('status', 'WON')
            ->whereBetween('expected_close_date', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount');
        $overdueActivities = CrmActivity::query()
            ->where('status', 'PENDING')
            ->whereNotNull('due_at')
            ->where('due_at', '<', now())
            ->count();

        return [
            'leads_total' => $totalLeads,
            'conversion_rate' => $totalLeads > 0 ? round(($convertedLeads / $totalLeads) * 100, 1) : 0,
            'pipeline_open' => (float) $openOpportunities->sum('amount'),
            'pipeline_weighted' => (float) $openOpportunities->sum(function ($opportunity) {
                return ((float) $opportunity->amount * (int) $opportunity->probability) / 100;
            }),
            'won_this_month' => (float) $wonThisMonth,
            'overdue_activities' => $overdueActivities,
        ];
    }

    private function buildPipelineStages(): Collection
    {
        return collect(Opportunity::STAGES)->map(function ($stage) {
            $count = Opportunity::query()->where('stage', $stage)->count();
            $amount = (float) Opportunity::query()->where('stage', $stage)->sum('amount');

            return [
                'stage' => $stage,
                'count' => $count,
                'amount' => $amount,
            ];
        });
    }

    private function buildActivityFocus(): array
    {
        return [
            'pending_today' => CrmActivity::query()
                ->where('status', 'PENDING')
                ->whereDate('due_at', '<=', now()->toDateString())
                ->count(),
            'upcoming' => CrmActivity::query()
                ->with(['lead', 'opportunity'])
                ->where('status', 'PENDING')
                ->whereNotNull('due_at')
                ->orderBy('due_at')
                ->limit(5)
                ->get(),
            'recent_wins' => Opportunity::query()
                ->with(['lead', 'client'])
                ->where('status', 'WON')
                ->orderByDesc('updated_at')
                ->limit(4)
                ->get(),
        ];
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
