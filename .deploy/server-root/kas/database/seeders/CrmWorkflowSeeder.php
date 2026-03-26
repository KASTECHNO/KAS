<?php

namespace Database\Seeders;

use App\Models\ActivitySector;
use App\Models\Client;
use App\Models\CrmActivity;
use App\Models\Lead;
use App\Models\Opportunity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CrmWorkflowSeeder extends Seeder
{
    public function run(): void
    {
        $owners = $this->seedOwners();
        $sectors = $this->seedSectors();
        $clients = $this->seedClients($sectors);

        $leadRows = [
            [
                'source' => 'WEBSITE_CONTACT',
                'fullname' => 'Rami Ben Salah',
                'email' => 'rami.bensalah@afg-industrie.tn',
                'phone' => '+21650111222',
                'company' => 'AFG Industrie',
                'sector' => 'Industrie',
                'status' => 'QUALIFIED',
                'score' => 72,
                'owner' => 'crm.owner1@kas.local',
                'last_contact_at' => now()->subDays(4),
                'notes' => 'Interesse par un portail fournisseur et une API de synchronisation ERP.',
                'converted_client' => null,
            ],
            [
                'source' => 'REFERRAL',
                'fullname' => 'Sara Kharrat',
                'email' => 'sara.kharrat@blueharbor.tn',
                'phone' => '+21652123456',
                'company' => 'Blue Harbor Logistics',
                'sector' => 'Logistique',
                'status' => 'NURTURING',
                'score' => 58,
                'owner' => 'crm.owner2@kas.local',
                'last_contact_at' => now()->subDays(9),
                'notes' => 'Besoin exprime: suivi en temps reel des operations et dashboard transport.',
                'converted_client' => null,
            ],
            [
                'source' => 'WEBSITE_CONTACT',
                'fullname' => 'Noura Trabelsi',
                'email' => 'noura.trabelsi@medcare-group.tn',
                'phone' => '+21655099887',
                'company' => 'MedCare Group',
                'sector' => 'Sante',
                'status' => 'CONVERTED',
                'score' => 91,
                'owner' => 'crm.owner1@kas.local',
                'last_contact_at' => now()->subDays(2),
                'notes' => 'Lead converti suite a validation du POC et signature du lot 1.',
                'converted_client' => 'MedCare Group',
            ],
            [
                'source' => 'EVENT',
                'fullname' => 'Yassine Gharbi',
                'email' => 'y.gharbi@fintrust.tn',
                'phone' => '+21658666444',
                'company' => 'FinTrust',
                'sector' => 'Finance',
                'status' => 'LOST',
                'score' => 33,
                'owner' => 'crm.owner2@kas.local',
                'last_contact_at' => now()->subDays(26),
                'notes' => 'Budget reporte sur exercice suivant. A relancer au prochain trimestre.',
                'converted_client' => null,
            ],
            [
                'source' => 'WEBSITE_CONTACT',
                'fullname' => 'Amel Jaziri',
                'email' => 'amel.jaziri@edusmart.tn',
                'phone' => '+21654777888',
                'company' => 'EduSmart',
                'sector' => 'Education',
                'status' => 'NEW',
                'score' => 44,
                'owner' => 'crm.owner1@kas.local',
                'last_contact_at' => now()->subDays(1),
                'notes' => 'Premier contact recu via formulaire. Qualification en attente.',
                'converted_client' => null,
            ],
        ];

        $leadMap = [];

        foreach ($leadRows as $row) {
            $convertedClientId = null;
            if (!empty($row['converted_client'])) {
                $convertedClient = Client::query()->updateOrCreate(
                    ['name' => $row['converted_client']],
                    [
                        'sector_id' => $sectors[$row['sector']]->id ?? null,
                        'website_url' => 'https://'.strtolower(str_replace(' ', '', $row['converted_client'])).'.tn',
                        'description' => 'Client converti depuis le workflow CRM.',
                    ]
                );
                $clients[$row['converted_client']] = $convertedClient;
                $convertedClientId = $convertedClient->id;
            }

            $lead = Lead::query()->updateOrCreate(
                ['email' => $row['email']],
                [
                    'source' => $row['source'],
                    'fullname' => $row['fullname'],
                    'phone' => $row['phone'],
                    'company' => $row['company'],
                    'sector_id' => $sectors[$row['sector']]->id ?? null,
                    'status' => $row['status'],
                    'score' => $row['score'],
                    'notes' => $row['notes'],
                    'owner_id' => $owners[$row['owner']]->id ?? null,
                    'converted_client_id' => $convertedClientId,
                    'last_contact_at' => $row['last_contact_at'],
                ]
            );

            $leadMap[$row['email']] = $lead;
        }

        $opportunityRows = [
            [
                'lead_email' => 'rami.bensalah@afg-industrie.tn',
                'client_name' => null,
                'name' => 'Portail fournisseurs AFG',
                'amount' => 42000,
                'currency' => 'EUR',
                'stage' => 'PROPOSAL',
                'probability' => 65,
                'expected_close_date' => now()->addDays(21)->toDateString(),
                'status' => 'OPEN',
                'owner' => 'crm.owner1@kas.local',
                'notes' => 'Proposition envoyee. Attente retour sur planning d integration.',
            ],
            [
                'lead_email' => 'sara.kharrat@blueharbor.tn',
                'client_name' => null,
                'name' => 'Dashboard transport Blue Harbor',
                'amount' => 28000,
                'currency' => 'EUR',
                'stage' => 'QUALIFICATION',
                'probability' => 40,
                'expected_close_date' => now()->addDays(45)->toDateString(),
                'status' => 'OPEN',
                'owner' => 'crm.owner2@kas.local',
                'notes' => 'Cadrage en cours avec equipe operations et IT interne.',
            ],
            [
                'lead_email' => 'noura.trabelsi@medcare-group.tn',
                'client_name' => 'MedCare Group',
                'name' => 'Plateforme patient MedCare - Lot 1',
                'amount' => 76000,
                'currency' => 'EUR',
                'stage' => 'WON',
                'probability' => 100,
                'expected_close_date' => now()->subDays(3)->toDateString(),
                'status' => 'WON',
                'owner' => 'crm.owner1@kas.local',
                'notes' => 'Contrat signe. Kickoff planifie.',
            ],
            [
                'lead_email' => 'y.gharbi@fintrust.tn',
                'client_name' => null,
                'name' => 'Refonte parcours KYC FinTrust',
                'amount' => 35000,
                'currency' => 'EUR',
                'stage' => 'LOST',
                'probability' => 0,
                'expected_close_date' => now()->subDays(18)->toDateString(),
                'status' => 'LOST',
                'owner' => 'crm.owner2@kas.local',
                'notes' => 'Perdu sur contrainte budget, mais relation maintenue.',
            ],
        ];

        $opportunityMap = [];

        foreach ($opportunityRows as $row) {
            $lead = $leadMap[$row['lead_email']] ?? null;
            if (!$lead) {
                continue;
            }

            $clientId = null;
            if (!empty($row['client_name']) && isset($clients[$row['client_name']])) {
                $clientId = $clients[$row['client_name']]->id;
            }

            $opportunity = Opportunity::query()->updateOrCreate(
                [
                    'lead_id' => $lead->id,
                    'name' => $row['name'],
                ],
                [
                    'client_id' => $clientId,
                    'amount' => $row['amount'],
                    'currency' => $row['currency'],
                    'stage' => $row['stage'],
                    'probability' => $row['probability'],
                    'expected_close_date' => $row['expected_close_date'],
                    'status' => $row['status'],
                    'owner_id' => $owners[$row['owner']]->id ?? null,
                    'notes' => $row['notes'],
                ]
            );

            $opportunityMap[$row['name']] = $opportunity;
        }

        $activityRows = [
            [
                'lead_email' => 'rami.bensalah@afg-industrie.tn',
                'opportunity_name' => 'Portail fournisseurs AFG',
                'type' => 'CALL',
                'subject' => 'Call de qualification fonctionnelle',
                'description' => 'Validation des priorites metier et des connecteurs ERP cibles.',
                'due_at' => Carbon::now()->subDays(6),
                'completed_at' => Carbon::now()->subDays(6),
                'status' => 'DONE',
                'owner' => 'crm.owner1@kas.local',
            ],
            [
                'lead_email' => 'rami.bensalah@afg-industrie.tn',
                'opportunity_name' => 'Portail fournisseurs AFG',
                'type' => 'EMAIL',
                'subject' => 'Envoi proposition commerciale',
                'description' => 'Proposition et macro-planning envoyes au sponsor.',
                'due_at' => Carbon::now()->subDays(2),
                'completed_at' => Carbon::now()->subDays(2),
                'status' => 'DONE',
                'owner' => 'crm.owner1@kas.local',
            ],
            [
                'lead_email' => 'sara.kharrat@blueharbor.tn',
                'opportunity_name' => 'Dashboard transport Blue Harbor',
                'type' => 'MEETING',
                'subject' => 'Atelier process transport',
                'description' => 'Atelier de cadrage avec operations et data manager.',
                'due_at' => Carbon::now()->addDays(3),
                'completed_at' => null,
                'status' => 'PENDING',
                'owner' => 'crm.owner2@kas.local',
            ],
            [
                'lead_email' => 'noura.trabelsi@medcare-group.tn',
                'opportunity_name' => 'Plateforme patient MedCare - Lot 1',
                'type' => 'TASK',
                'subject' => 'Preparation kickoff projet',
                'description' => 'Verifier backlog initial, planning sprint 0 et gouvernance.',
                'due_at' => Carbon::now()->addDays(5),
                'completed_at' => null,
                'status' => 'PENDING',
                'owner' => 'crm.owner1@kas.local',
            ],
            [
                'lead_email' => 'y.gharbi@fintrust.tn',
                'opportunity_name' => 'Refonte parcours KYC FinTrust',
                'type' => 'NOTE',
                'subject' => 'Motif de perte et plan de relance',
                'description' => 'Opportunity perdue pour budget. Relance prevue debut prochain trimestre.',
                'due_at' => Carbon::now()->subDays(14),
                'completed_at' => Carbon::now()->subDays(14),
                'status' => 'DONE',
                'owner' => 'crm.owner2@kas.local',
            ],
            [
                'lead_email' => 'amel.jaziri@edusmart.tn',
                'opportunity_name' => null,
                'type' => 'TASK',
                'subject' => 'Qualification initiale du lead',
                'description' => 'Premier appel a planifier pour comprendre le besoin EdTech.',
                'due_at' => Carbon::now()->addDays(1),
                'completed_at' => null,
                'status' => 'PENDING',
                'owner' => 'crm.owner1@kas.local',
            ],
        ];

        foreach ($activityRows as $row) {
            $lead = $leadMap[$row['lead_email']] ?? null;
            if (!$lead) {
                continue;
            }

            $opportunity = $row['opportunity_name'] ? ($opportunityMap[$row['opportunity_name']] ?? null) : null;

            CrmActivity::query()->updateOrCreate(
                [
                    'lead_id' => $lead->id,
                    'subject' => $row['subject'],
                    'type' => $row['type'],
                ],
                [
                    'client_id' => $lead->converted_client_id,
                    'opportunity_id' => $opportunity ? $opportunity->id : null,
                    'description' => $row['description'],
                    'due_at' => $row['due_at'],
                    'completed_at' => $row['completed_at'],
                    'status' => $row['status'],
                    'owner_id' => $owners[$row['owner']]->id ?? null,
                ]
            );
        }
    }

    /**
     * @return array<string, User>
     */
    private function seedOwners(): array
    {
        $rows = [
            [
                'email' => 'crm.owner1@kas.local',
                'name' => 'Nadia Sales',
                'fullname' => 'Nadia Sales Manager',
            ],
            [
                'email' => 'crm.owner2@kas.local',
                'name' => 'Karim BizDev',
                'fullname' => 'Karim Business Developer',
            ],
        ];

        $owners = [];

        foreach ($rows as $row) {
            $owners[$row['email']] = User::query()->updateOrCreate(
                ['email' => $row['email']],
                [
                    'name' => $row['name'],
                    'fullname' => $row['fullname'],
                    'password' => Hash::make('Owner@123456'),
                    'role' => 'ADMIN',
                    'email_verified_at' => now(),
                ]
            );
        }

        return $owners;
    }

    /**
     * @return array<string, ActivitySector>
     */
    private function seedSectors(): array
    {
        $rows = [
            ['name' => 'Industrie', 'description' => 'Automatisation et optimisation de processus industriels.'],
            ['name' => 'Logistique', 'description' => 'Pilotage transport, stock et operations supply chain.'],
            ['name' => 'Sante', 'description' => 'Digitalisation des parcours patients et outils medicaux.'],
            ['name' => 'Finance', 'description' => 'Solutions de conformite, KYC et pilotage de risque.'],
            ['name' => 'Education', 'description' => 'Plateformes d apprentissage et gestion academique.'],
        ];

        $sectors = [];

        foreach ($rows as $index => $row) {
            $sectors[$row['name']] = ActivitySector::query()->updateOrCreate(
                ['name' => $row['name']],
                [
                    'description' => $row['description'],
                    'icon_class' => 'fas fa-briefcase',
                    'display_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        return $sectors;
    }

    /**
     * @param array<string, ActivitySector> $sectors
     * @return array<string, Client>
     */
    private function seedClients(array $sectors): array
    {
        $rows = [
            ['name' => 'AFG Industrie', 'sector' => 'Industrie'],
            ['name' => 'Blue Harbor Logistics', 'sector' => 'Logistique'],
            ['name' => 'MedCare Group', 'sector' => 'Sante'],
            ['name' => 'FinTrust', 'sector' => 'Finance'],
            ['name' => 'EduSmart', 'sector' => 'Education'],
        ];

        $clients = [];

        foreach ($rows as $row) {
            $clients[$row['name']] = Client::query()->updateOrCreate(
                ['name' => $row['name']],
                [
                    'sector_id' => $sectors[$row['sector']]->id ?? null,
                    'website_url' => 'https://'.strtolower(str_replace(' ', '', $row['name'])).'.tn',
                    'description' => 'Compte client alimente par le seeder CRM workflow.',
                ]
            );
        }

        return $clients;
    }
}
