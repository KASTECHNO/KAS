<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StageSeeder extends Seeder
{
    public function run(): void
    {
        $stages = [
            [
                'titre'        => 'Stage PFE — Développement d\'une plateforme RH et paie avec Spring Boot',
                'domaine'      => 'Développement Back-end',
                'type_stage'   => 'PFE',
                'niveau_requis'=> 'Bac+5 (Master / Ingénieur)',
                'description'  => 'Dans le cadre de notre projet RH multi-entreprises, vous interviendrez sur la conception et le développement de modules de paie, de gestion des congés et de suivi des performances. Vous utiliserez Spring Boot, PostgreSQL et Keycloak pour l\'authentification IAM.',
                'technologies' => 'Java, Spring Boot, PostgreSQL, Keycloak, Docker, Git',
                'date_limite'  => now()->addDays(45),
                'is_active'    => true,
            ],
            [
                'titre'        => 'Stage PFE — Intégration CI/CD et containerisation avec Docker & Kubernetes',
                'domaine'      => 'DevOps & Cloud',
                'type_stage'   => 'PFE',
                'niveau_requis'=> 'Bac+5 (Master / Ingénieur)',
                'description'  => 'Vous contribuerez à la mise en place d\'une chaîne CI/CD complète pour nos applications enterprise. Mission : automatiser les pipelines Jenkins/GitLab, orchestrer les déploiements Kubernetes et rédiger les playbooks de monitoring Prometheus/Grafana.',
                'technologies' => 'Docker, Kubernetes, Jenkins, GitLab CI, Prometheus, Grafana, Helm',
                'date_limite'  => now()->addDays(50),
                'is_active'    => true,
            ],
            [
                'titre'        => 'Stage PFE — Développement front-end Angular pour une solution de gestion documentaire',
                'domaine'      => 'Développement Front-end',
                'type_stage'   => 'PFE',
                'niveau_requis'=> 'Bac+4/5 (Licence Pro / Ingénieur)',
                'description'  => 'Vous rejoindrez l\'équipe front-end pour construire une SPA Angular dédiée à la gestion documentaire d\'un client institutionnel. Vous travaillerez sur l\'architecture des modules, les composants réutilisables, et l\'intégration des APIs REST sécurisées.',
                'technologies' => 'Angular 17, TypeScript, RxJS, REST API, Git, NgRx',
                'date_limite'  => now()->addDays(40),
                'is_active'    => true,
            ],
            [
                'titre'        => 'Stage Perfectionnement — Automatisation BPM avec Camunda 7/8',
                'domaine'      => 'BPM & Automatisation',
                'type_stage'   => 'Perfectionnement',
                'niveau_requis'=> 'Bac+4/5 (Ingénieur / Master)',
                'description'  => 'Vous participerez à la modélisation et à l\'implémentation de processus métier complexes via Camunda BPM. La mission inclut la conception des diagrammes BPMN, le développement des workers Java, et l\'intégration avec un système ERP existant.',
                'technologies' => 'Camunda 7, Java, Spring Boot, BPMN 2.0, REST API, PostgreSQL',
                'date_limite'  => now()->addDays(35),
                'is_active'    => true,
            ],
            [
                'titre'        => 'Stage Initiation — Développement d\'une application mobile de suivi logistique',
                'domaine'      => 'Développement Mobile',
                'type_stage'   => 'Initiation',
                'niveau_requis'=> 'Bac+2/3 (Technicien / Licence)',
                'description'  => 'Découvrez le développement mobile en participant à la création d\'une application de suivi de livraisons en temps réel. Vous travaillerez sur les écrans Flutter, l\'intégration des APIs de géolocalisation et la synchronisation offline/online.',
                'technologies' => 'Flutter, Dart, REST API, Firebase, Git',
                'date_limite'  => now()->addDays(30),
                'is_active'    => true,
            ],
            [
                'titre'        => 'Stage PFE — Module IA de reconnaissance de documents et OCR',
                'domaine'      => 'Intelligence Artificielle',
                'type_stage'   => 'PFE',
                'niveau_requis'=> 'Bac+5 (Master IA / Data Science)',
                'description'  => 'Vous développerez un module d\'OCR intelligent pour l\'extraction et la classification automatique de documents administratifs. Le projet utilise Python, Tesseract, et un modèle de deep learning fine-tuné sur un jeu de données métier réel.',
                'technologies' => 'Python, TensorFlow, Tesseract OCR, FastAPI, Docker, PostgreSQL',
                'date_limite'  => now()->addDays(55),
                'is_active'    => true,
            ],
        ];

        foreach ($stages as $data) {
            Stage::updateOrCreate(
                ['slug' => Str::slug($data['titre'])],
                $data
            );
        }
    }
}
