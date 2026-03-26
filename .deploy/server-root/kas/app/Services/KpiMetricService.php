<?php

namespace App\Services;

use App\Models\ActivitySector;
use App\Models\Client;
use App\Models\ContactMessage;
use App\Models\KpiMetric;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Collection;

class KpiMetricService
{
    public function getHomepageKpis(): Collection
    {
        $kpis = KpiMetric::query()
            ->where('is_active', true)
            ->orderBy('display_order')
            ->get();

        if ($kpis->isEmpty()) {
            $this->recalculate();

            $kpis = KpiMetric::query()
                ->where('is_active', true)
                ->orderBy('display_order')
                ->get();
        }

        return $kpis;
    }

    public function recalculate(): void
    {
        $strategicSectors = [
            'Finance et conformite',
            'Secteur public et institutionnel',
            'Aeronautique et securite aeroportuaire',
            'Workflow et BPM',
        ];

        $strategicClientNames = [
            'La Banque Postale',
            'Banque de France - BCE',
            'BFI GROUP',
            'InnovATM',
            'MAS GROUP',
            'AbrarCom',
            'KARRAY GROUP',
            'GLOBAL PAYMENT GATEWAY',
        ];

        $featuredProjects = Project::query()->where('is_featured', 1)->count();
        $activeServices = Service::query()->where('is_active', true)->count();
        $activeSectors = ActivitySector::query()->where('is_active', true)->count();
        $clientsTotal = Client::query()->count();
        $testimonialsPublished = Testimonial::query()->where('is_active', true)->count();
        $testimonialsPending = Testimonial::query()->where('is_active', false)->count();
        $contactsTotal = ContactMessage::query()->count();
        $contacts30d = ContactMessage::query()->where('created_at', '>=', now()->subDays(30))->count();
        $projects12m = Project::query()->where('created_at', '>=', now()->subMonths(12))->count();

        $strategicProjects = Project::query()
            ->where('is_featured', 1)
            ->whereHas('sector', function ($query) use ($strategicSectors) {
                $query->whereIn('name', $strategicSectors);
            })
            ->count();

        $strategicClients = Client::query()
            ->whereIn('name', $strategicClientNames)
            ->count();

        $definitions = [
            [
                'key' => 'featured_projects',
                'title' => 'Projets references',
                'value' => $featuredProjects,
                'unit' => null,
                'description' => 'Volume de projets mis en avant sur la vitrine commerciale.',
                'formula_rule' => 'COUNT(projects WHERE is_featured = 1)',
                'data_snapshot' => ['table' => 'projects', 'filters' => ['is_featured' => 1]],
                'display_order' => 1,
            ],
            [
                'key' => 'active_services',
                'title' => 'Expertises proposees',
                'value' => $activeServices,
                'unit' => null,
                'description' => 'Nombre d offres de services actives valorisant le positionnement.',
                'formula_rule' => 'COUNT(services WHERE is_active = 1)',
                'data_snapshot' => ['table' => 'services', 'filters' => ['is_active' => true]],
                'display_order' => 2,
            ],
            [
                'key' => 'covered_sectors',
                'title' => 'Secteurs couverts',
                'value' => $activeSectors,
                'unit' => null,
                'description' => 'Amplitude sectorielle couverte par les references et cas d usage.',
                'formula_rule' => 'COUNT(activity_sectors WHERE is_active = 1)',
                'data_snapshot' => ['table' => 'activity_sectors', 'filters' => ['is_active' => true]],
                'display_order' => 3,
            ],
            [
                'key' => 'critical_references',
                'title' => 'References secteurs critiques',
                'value' => max($strategicProjects, $strategicClients),
                'unit' => null,
                'description' => 'Niveau de references sur les secteurs a forte exigence (finance, public, aero, BPM).',
                'formula_rule' => 'MAX(COUNT(featured projects in strategic sectors), COUNT(clients in strategic list))',
                'data_snapshot' => [
                    'strategic_project_count' => $strategicProjects,
                    'strategic_client_count' => $strategicClients,
                ],
                'display_order' => 4,
                'default_active' => true,
            ],
            [
                'key' => 'clients_total',
                'title' => 'Total clients',
                'value' => $clientsTotal,
                'unit' => null,
                'description' => 'Base clients totale geree dans l application.',
                'formula_rule' => 'COUNT(clients)',
                'data_snapshot' => ['table' => 'clients'],
                'display_order' => 10,
                'default_active' => false,
            ],
            [
                'key' => 'testimonials_published',
                'title' => 'Temoignages publies',
                'value' => $testimonialsPublished,
                'unit' => null,
                'description' => 'Temoignages valides et visibles sur le site.',
                'formula_rule' => 'COUNT(testimonials WHERE is_active = 1)',
                'data_snapshot' => ['table' => 'testimonials', 'filters' => ['is_active' => true]],
                'display_order' => 11,
                'default_active' => false,
            ],
            [
                'key' => 'testimonials_pending',
                'title' => 'Temoignages en attente',
                'value' => $testimonialsPending,
                'unit' => null,
                'description' => 'Temoignages soumis en attente de validation admin.',
                'formula_rule' => 'COUNT(testimonials WHERE is_active = 0)',
                'data_snapshot' => ['table' => 'testimonials', 'filters' => ['is_active' => false]],
                'display_order' => 12,
                'default_active' => false,
            ],
            [
                'key' => 'contact_messages_total',
                'title' => 'Messages contact total',
                'value' => $contactsTotal,
                'unit' => null,
                'description' => 'Volume cumule des demandes entrantes via le formulaire contact.',
                'formula_rule' => 'COUNT(contact_messages)',
                'data_snapshot' => ['table' => 'contact_messages'],
                'display_order' => 13,
                'default_active' => false,
            ],
            [
                'key' => 'contact_messages_30d',
                'title' => 'Messages contact 30 jours',
                'value' => $contacts30d,
                'unit' => null,
                'description' => 'Demandes contact recues sur les 30 derniers jours.',
                'formula_rule' => 'COUNT(contact_messages WHERE created_at >= now()-30d)',
                'data_snapshot' => ['table' => 'contact_messages', 'filters' => ['period_days' => 30]],
                'display_order' => 14,
                'default_active' => false,
            ],
            [
                'key' => 'projects_12m',
                'title' => 'Projets crees 12 mois',
                'value' => $projects12m,
                'unit' => null,
                'description' => 'Nouveaux projets enregistres sur les 12 derniers mois.',
                'formula_rule' => 'COUNT(projects WHERE created_at >= now()-12m)',
                'data_snapshot' => ['table' => 'projects', 'filters' => ['period_months' => 12]],
                'display_order' => 15,
                'default_active' => false,
            ],
        ];

        foreach ($definitions as $definition) {
            $existing = KpiMetric::query()->where('key', $definition['key'])->first();

            KpiMetric::query()->updateOrCreate(
                ['key' => $definition['key']],
                [
                    'title' => $definition['title'],
                    'value' => $definition['value'],
                    'unit' => $definition['unit'],
                    'description' => $definition['description'],
                    'formula_rule' => $definition['formula_rule'],
                    'data_snapshot' => $definition['data_snapshot'],
                    'is_active' => $existing ? (bool) $existing->is_active : (bool) ($definition['default_active'] ?? false),
                    'display_order' => $existing ? (int) $existing->display_order : (int) $definition['display_order'],
                    'last_calculated_at' => now(),
                ]
            );
        }
    }
}
