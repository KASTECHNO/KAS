<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use Illuminate\Database\Seeder;

class PricingPlanSeeder extends Seeder
{
    public function run(): void
    {
        PricingPlan::truncate();

        $plans = [
            [
                'type'           => 'mensuel',
                'prix'           => 150,
                'nom_application' => null,
                'description'    => 'Accédez à votre application hébergée sur les serveurs sécurisés KAS, sans investissement initial. Idéal pour démarrer rapidement.',
                'fonctionnalites' => implode("\n", [
                    'Hébergement KAS inclus',
                    'Mises à jour automatiques',
                    'Support technique inclus',
                    'Sans engagement de durée',
                    'Accès multi-utilisateurs',
                ]),
                'badge'          => null,
                'is_featured'    => false,
                'is_active'      => true,
                'display_order'  => 1,
            ],
            [
                'type'           => 'annuel',
                'prix'           => 1000,
                'nom_application' => null,
                'description'    => 'Toutes les fonctionnalités en hébergement KAS, avec un engagement sur 3 ans. Bénéficiez d\'un support prioritaire et d\'économies significatives.',
                'fonctionnalites' => implode("\n", [
                    'Hébergement KAS inclus',
                    'Mises à jour automatiques',
                    'Support technique prioritaire',
                    'Engagement 3 ans — meilleur tarif',
                    'Économisez ~44% vs mensuel',
                    'Accès multi-utilisateurs',
                ]),
                'badge'          => 'Meilleure offre',
                'is_featured'    => true,
                'is_active'      => true,
                'display_order'  => 2,
            ],
            [
                'type'           => 'licence',
                'prix'           => 10000,
                'nom_application' => null,
                'description'    => 'Déployez l\'application sur votre propre infrastructure. Propriétaire de la licence, vous gardez une totale maîtrise de vos données et de votre environnement.',
                'fonctionnalites' => implode("\n", [
                    'Hébergement sur vos serveurs',
                    'Livraison et installation incluses',
                    'Mises à jour incluses (1 an)',
                    'Support premium (6 mois)',
                    'Formation des utilisateurs',
                ]),
                'badge'          => null,
                'is_featured'    => false,
                'is_active'      => true,
                'display_order'  => 3,
            ],
        ];

        foreach ($plans as $plan) {
            PricingPlan::create($plan);
        }
    }
}
