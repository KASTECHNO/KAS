<?php

namespace App\Http\Controllers;

use App\Models\ActivitySector;
use App\Models\Client;
use App\Models\Company;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Services\KpiMetricService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request, KpiMetricService $kpiMetricService)
    {
        $company = Company::query()->first();

        $servicePriority = [
            'architecture-technique-et-modernisation' => 1,
            'back-end-enterprise-et-migration-java' => 2,
            'devops-cicd-cloud' => 3,
            'securite-iam-et-conformite' => 4,
            'migration-angular-et-front-enterprise' => 5,
            'web-app-development' => 6,
            'workflow-bpm-et-integration-camunda' => 7,
            'audit-performance-et-fiabilite' => 8,
            'ia-recrutement-et-ocr' => 9,
            'plateformes-rh-et-paie' => 10,
            'logistique-et-gestion-des-flux' => 11,
            'mobile-app-development' => 12,
        ];

        $projectSectorPriority = [
            'Finance et conformite' => 1,
            'Secteur public et institutionnel' => 2,
            'Aeronautique et securite aeroportuaire' => 3,
            'Workflow et BPM' => 4,
            'Ressources humaines et paie' => 5,
            'Logistique et transport' => 6,
            'Recrutement et IA' => 7,
            'Genie industriel de l air et ventilation' => 8,
            'Construction' => 9,
            'Gestion commerciale et stock' => 10,
            'E-learning' => 11,
            'Gestion hoteliere et reservation' => 12,
        ];

        $clientPriority = [
            'La Banque Postale' => 1,
            'Banque de France - BCE' => 2,
            'BFI GROUP' => 3,
            'InnovATM' => 4,
            'MAS GROUP' => 5,
            'AbrarCom' => 6,
            'KARRAY GROUP' => 7,
            'GLOBAL PAYMENT GATEWAY' => 8,
            'Centre Coaching RH' => 9,
            'Air Filters Engineering' => 10,
            'Apple Store Partner' => 11,
            'IDAF' => 12,
            'Navlion' => 13,
            'AFE' => 14,
            'Tunivisions Foundation' => 15,
            'Diar Lkachaw Immobiliere' => 16,
            'Houria House' => 17,
            'Hotel Partner' => 18,
        ];

        $services = Service::where('is_active', true)
            ->get()
            ->sort(function ($left, $right) use ($servicePriority) {
                $leftPriority = $servicePriority[$left->slug] ?? 999;
                $rightPriority = $servicePriority[$right->slug] ?? 999;

                if ($leftPriority === $rightPriority) {
                    return ($left->display_order ?? 999) <=> ($right->display_order ?? 999);
                }

                return $leftPriority <=> $rightPriority;
            })
            ->values();

        $sectors = ActivitySector::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        $projects = Project::with(['sector', 'client'])
            ->where('is_featured', 1)
            ->orderByRaw('COALESCE(start_date, created_at) DESC')
            ->orderBy('id', 'desc')
            ->get()
            ->sort(function ($left, $right) use ($projectSectorPriority) {
                $leftSector = $left->sector->name ?? '';
                $rightSector = $right->sector->name ?? '';
                $leftPriority = $projectSectorPriority[$leftSector] ?? 999;
                $rightPriority = $projectSectorPriority[$rightSector] ?? 999;

                if ($leftPriority === $rightPriority) {
                    return $right->id <=> $left->id;
                }

                return $leftPriority <=> $rightPriority;
            })
            ->values();

        $singleSectorProjects = [
            'Gestion hoteliere et reservation',
            'Aeronautique et securite aeroportuaire',
        ];

        $seenSectors = [];
        $projects = $projects
            ->filter(function ($project) use (&$seenSectors, $singleSectorProjects) {
                $sectorName = $project->sector->name ?? null;

                if (!$sectorName || !in_array($sectorName, $singleSectorProjects, true)) {
                    return true;
                }

                if (isset($seenSectors[$sectorName])) {
                    return false;
                }

                $seenSectors[$sectorName] = true;

                return true;
            })
            ->values();

        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        $clients = Client::all()
            ->sort(function ($left, $right) use ($clientPriority) {
                $leftPriority = $clientPriority[$left->name] ?? 999;
                $rightPriority = $clientPriority[$right->name] ?? 999;

                if ($leftPriority === $rightPriority) {
                    return strcmp($left->name, $right->name);
                }

                return $leftPriority <=> $rightPriority;
            })
            ->values();

        $kpis = $kpiMetricService->getHomepageKpis();

        return view('home', compact('company', 'services', 'sectors', 'projects', 'testimonials', 'clients', 'kpis'));
    }
}
