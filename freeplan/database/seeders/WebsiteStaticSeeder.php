<?php

namespace Database\Seeders;

use App\Models\ActivitySector;
use App\Models\Client;
use App\Models\Company;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class WebsiteStaticSeeder extends Seeder
{
    /**
     * Injecte le contenu statique du site en version francaise.
     */
    public function run(): void
    {
        Company::query()->updateOrCreate(
            ['name' => 'KAS INNOVATION Technology'],
            [
                'slogan' => 'Votre vision, notre code...',
                'description' => 'Donnez une presence digitale a votre entreprise avec KAS Innovation Technology. Nous mettons la creativite au service de votre marque via le web, le mobile et le marketing digital.',
                'address' => 'Rue De Tunis Km 5, Sfax, Tunisie | Ile De France, Paris, France',
                'email' => 'contact@kas-technology.com',
                'phone' => '+33623778845',
                'website_url' => 'https://kas-technology.com/',
                'logo_url' => 'https://kas-technology.com/images/logo.png',
            ]
        );

        $services = [
            [
                'slug' => 'architecture-technique-et-modernisation',
                'title' => 'Architecture et modernisation du SI',
                'short_desc' => 'Cadrage d architecture, refonte applicative et modernisation de socles critiques.',
                'description' => 'Nous definissons des architectures logiques et techniques robustes, puis pilotons la modernisation applicative pour securiser la croissance et la maintenabilite du systeme d information.',
                'icon_class' => 'fas fa-sitemap',
            ],
            [
                'slug' => 'web-app-development',
                'title' => 'Developpement d applications sur mesure',
                'short_desc' => 'Applications web metier, APIs et plateformes back-office adaptees a vos processus.',
                'description' => 'Nous concevons des applications web metier et des APIs robustes, avec une approche orientee performance, evolutivite et qualite de code.',
                'icon_class' => 'fas fa-code',
            ],
            [
                'slug' => 'devops-cicd-cloud',
                'title' => 'DevOps et industrialisation CI/CD',
                'short_desc' => 'Pipelines, conteneurisation et automatisation des mises en production.',
                'description' => 'Nous industrialisons les livraisons avec GitLab, Jenkins, Docker et Kubernetes afin d accelerer les deploiements et de fiabiliser les environnements.',
                'icon_class' => 'fas fa-infinity',
            ],
            [
                'slug' => 'mobile-app-development',
                'title' => 'Applications mobiles professionnelles',
                'short_desc' => 'Applications mobiles hybrides ou multi-plateformes connectees a votre SI.',
                'description' => 'Nous realisons des applications mobiles professionnelles pour les usages terrain, le suivi d operations et l extension de services digitaux sur smartphone et tablette.',
                'icon_class' => 'fas fa-mobile-screen-button',
            ],
            [
                'slug' => 'migration-angular-et-front-enterprise',
                'title' => 'Front-end enterprise et migration Angular',
                'short_desc' => 'Migration Angular, optimisation UX et standardisation des composants.',
                'description' => 'Nous accompagnons les evolutions Angular, la rationalisation du front-end et la mise en place de composants reutilisables pour des interfaces plus stables et maintenables.',
                'icon_class' => 'fas fa-display',
            ],
            [
                'slug' => 'back-end-enterprise-et-migration-java',
                'title' => 'Back-end enterprise et migration Java',
                'short_desc' => 'Services Java/JEE, refonte de socles back-end et migration d applications critiques.',
                'description' => 'Nous concevons et faisons evoluer des back-ends enterprise en Java, en accompagnant les migrations techniques, la modernisation de composants historiques et la stabilisation des applications metier.',
                'icon_class' => 'fas fa-server',
            ],
            [
                'slug' => 'securite-iam-et-conformite',
                'title' => 'Securite IAM et conformite',
                'short_desc' => 'SSO, gestion des roles, controles d acces et exigences de conformite.',
                'description' => 'Nous renforcons la securite des applications avec des mecanismes IAM, SSO et RBAC, tout en integrant les exigences de conformite et de tracabilite.',
                'icon_class' => 'fas fa-shield-halved',
            ],
            [
                'slug' => 'workflow-bpm-et-integration-camunda',
                'title' => 'Workflow BPM et automatisation des processus',
                'short_desc' => 'Digitalisation des parcours metier, orchestration BPMN et automatisation.',
                'description' => 'Nous transformons les processus metier en workflows digitaux pilotables, avec orchestration BPMN, microservices et supervision de bout en bout.',
                'icon_class' => 'fas fa-diagram-project',
            ],
            [
                'slug' => 'plateformes-rh-et-paie',
                'title' => 'Solutions RH, paie et gestion collaborateur',
                'short_desc' => 'Digitalisation RH, pointage, paie et workflows collaborateurs.',
                'description' => 'Nous concevons des plateformes RH integrees pour structurer les processus collaborateurs, le pointage, la paie et les parcours administratifs.',
                'icon_class' => 'fas fa-users-gear',
            ],
            [
                'slug' => 'logistique-et-gestion-des-flux',
                'title' => 'Logistique, transport et gestion des flux',
                'short_desc' => 'Suivi des flux operationnels, transport, stock et activites terrain.',
                'description' => 'Nous implementons des solutions de supervision logistique pour fluidifier les flux, ameliorer la tracabilite et mieux piloter les operations terrain.',
                'icon_class' => 'fas fa-truck-fast',
            ],
            [
                'slug' => 'ia-recrutement-et-ocr',
                'title' => 'IA appliquee au recrutement et a l analyse documentaire',
                'short_desc' => 'OCR, extraction de donnees et automatisation de l analyse de candidatures.',
                'description' => 'Nous integrons des briques d IA pour automatiser l exploitation documentaire, accelerer la preselection et structurer l analyse des candidatures.',
                'icon_class' => 'fas fa-brain',
            ],
            [
                'slug' => 'audit-performance-et-fiabilite',
                'title' => 'Audit, performance et fiabilisation',
                'short_desc' => 'Diagnostic technique, optimisation SQL et stabilisation des plateformes.',
                'description' => 'Nous auditons les applications et les bases de donnees afin d identifier les points de fragilite, corriger les goulots d etranglement et renforcer la fiabilite globale.',
                'icon_class' => 'fas fa-gauge-high',
            ],
        ];

        $serviceSlugs = [];
        foreach ($services as $index => $item) {
            $serviceSlugs[] = $item['slug'];
            Service::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'short_desc' => $item['short_desc'],
                    'description' => $item['description'],
                    'icon_class' => $item['icon_class'],
                    'display_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        Service::query()
            ->whereNotIn('slug', $serviceSlugs)
            ->delete();

        $sectorNames = [
            ['old' => 'Hotel Management & Booking System', 'new' => 'Gestion hoteliere et reservation'],
            ['old' => 'Construction', 'new' => 'Construction'],
            ['old' => 'E-Learning', 'new' => 'E-learning'],
            ['old' => 'Industrial Air Engineering And Ventilation Systems', 'new' => 'Genie industriel de l air et ventilation'],
            ['old' => 'Finance And Compliance', 'new' => 'Finance et conformite'],
            ['old' => 'Sales And Inventory System', 'new' => 'Gestion commerciale et stock'],
            ['old' => 'Public And Institutional Platforms', 'new' => 'Secteur public et institutionnel'],
            ['old' => 'Human Resources And Payroll', 'new' => 'Ressources humaines et paie'],
            ['old' => 'Logistics And Transportation', 'new' => 'Logistique et transport'],
            ['old' => 'Recruitment And AI', 'new' => 'Recrutement et IA'],
            ['old' => 'Aeronautics And Airport Security', 'new' => 'Aeronautique et securite aeroportuaire'],
            ['old' => 'Workflow And BPM', 'new' => 'Workflow et BPM'],
            ['old' => 'Industrial Performance And TQM', 'new' => 'Performance industrielle et TQM'],
        ];

        $sectors = [];
        foreach ($sectorNames as $index => $pair) {
            $sector = ActivitySector::query()
                ->whereIn('name', [$pair['old'], $pair['new']])
                ->first();

            if (!$sector) {
                $sector = new ActivitySector();
            }

            $sector->name = $pair['new'];
            $sector->description = 'Solution digitale adaptee au secteur ' . $pair['new'] . '.';
            $sector->icon_class = 'fas fa-briefcase';
            $sector->display_order = $index + 1;
            $sector->is_active = true;
            $sector->save();

            $sectors[$pair['new']] = $sector;
        }

        $clients = [
            ['name' => 'Expert', 'logo' => 'https://kas-technology.com/images/expert.png', 'sector' => 'Finance et conformite'],
            ['name' => 'Banque', 'logo' => 'https://kas-technology.com/images/banque.jpg', 'sector' => 'Finance et conformite'],
            ['name' => 'IDAF', 'logo' => 'https://kas-technology.com/images/idaf.png', 'sector' => 'Construction'],
            ['name' => 'Chaaben', 'logo' => 'https://kas-technology.com/images/chaaben.png', 'sector' => 'Construction'],
            ['name' => 'Navlion', 'logo' => 'https://kas-technology.com/images/navlion.png', 'sector' => 'Genie industriel de l air et ventilation'],
            ['name' => 'Apple Store Partner', 'logo' => 'https://kas-technology.com/images/Apple_Store.png', 'sector' => 'Gestion commerciale et stock'],
            ['name' => 'AFE', 'logo' => 'https://kas-technology.com/images/afe.png', 'sector' => 'E-learning'],
            ['name' => 'Hotel Partner', 'logo' => 'https://kas-technology.com/images/hotel.jpeg', 'sector' => 'Gestion hoteliere et reservation'],
            ['name' => 'La Banque Postale', 'logo' => 'https://kas-technology.com/images/banque.jpg', 'sector' => 'Finance et conformite'],
            ['name' => 'Banque de France - BCE', 'logo' => 'https://kas-technology.com/images/banque.jpg', 'sector' => 'Secteur public et institutionnel'],
            ['name' => 'Symolia Technologies', 'logo' => 'https://kas-technology.com/images/expert.png', 'sector' => 'Finance et conformite'],
            ['name' => 'MAS GROUP', 'logo' => 'https://kas-technology.com/images/chaaben.png', 'sector' => 'Ressources humaines et paie'],
            ['name' => 'OUIMIND', 'logo' => 'https://kas-technology.com/images/navlion.png', 'sector' => 'Workflow et BPM'],
            ['name' => 'Tunivisions Foundation', 'logo' => 'https://kas-technology.com/images/afe.png', 'sector' => 'E-learning'],
            ['name' => 'KARRAY GROUP', 'logo' => 'https://kas-technology.com/images/idaf.png', 'sector' => 'Performance industrielle et TQM'],
            ['name' => 'BFI GROUP', 'logo' => 'https://kas-technology.com/images/banque.jpg', 'sector' => 'Finance et conformite'],
            ['name' => 'InnovATM', 'logo' => 'https://kas-technology.com/images/expert.png', 'sector' => 'Aeronautique et securite aeroportuaire'],
            ['name' => 'AbrarCom', 'logo' => 'https://kas-technology.com/images/expert.png', 'sector' => 'Workflow et BPM'],
            ['name' => 'GLOBAL PAYMENT GATEWAY', 'logo' => 'https://kas-technology.com/images/banque.jpg', 'sector' => 'Finance et conformite'],
            ['name' => 'InfoSquare', 'logo' => 'https://kas-technology.com/images/afe.png', 'sector' => 'Recrutement et IA'],
            ['name' => 'Centre Coaching RH', 'logo' => 'https://kas-technology.com/images/afe.png', 'sector' => 'Recrutement et IA'],
            ['name' => 'Diar Lkachaw Immobiliere', 'logo' => 'https://kas-technology.com/images/chaaben.png', 'sector' => 'Construction'],
            ['name' => 'Houria House', 'logo' => 'https://kas-technology.com/images/hotel.jpeg', 'sector' => 'Gestion hoteliere et reservation'],
            ['name' => 'Air Filters Engineering', 'logo' => 'https://kas-technology.com/images/afe.png', 'sector' => 'Genie industriel de l air et ventilation'],
        ];

        $clientMap = [];
        foreach ($clients as $row) {
            $client = Client::query()->updateOrCreate(
                ['name' => $row['name']],
                [
                    'sector_id' => $sectors[$row['sector']]->id ?? null,
                    'logo_url' => $row['logo'],
                    'website_url' => 'https://kas-technology.com/',
                    'description' => 'Client reference sur le site KAS Technology.',
                ]
            );

            $clientMap[$row['name']] = $client;
        }

        $projects = [
            [
                'slug' => 'construction-ecommerce-website',
                'title' => 'Plateforme e-commerce construction',
                'short_desc' => 'Site e-commerce pour des entreprises de construction.',
                'description' => 'Site e-commerce dedie a un groupe d entreprises du secteur construction.',
                'sector' => 'Construction',
                'client' => 'IDAF',
            ],
            [
                'slug' => 'comprehensive-e-learning-platform',
                'title' => 'Plateforme e-learning complete',
                'short_desc' => 'Plateforme de formation et d education en ligne.',
                'description' => 'Solution e-learning complete pour l enseignement et la formation a distance.',
                'sector' => 'E-learning',
                'client' => 'AFE',
            ],
            [
                'slug' => 'industrial-air-engineering-crm',
                'title' => 'CRM genie industriel de l air',
                'short_desc' => 'Site web et application CRM metier.',
                'description' => 'Site web avec application CRM pour les activites de genie industriel de l air et ventilation.',
                'sector' => 'Genie industriel de l air et ventilation',
                'client' => 'Navlion',
            ],
            [
                'slug' => 'finance-credit-assessment-platform',
                'title' => 'Plateforme d evaluation de credit',
                'short_desc' => 'Solution d evaluation de solvabilite client.',
                'description' => 'Site web et application pour evaluer le potentiel de credit des clients.',
                'sector' => 'Finance et conformite',
                'client' => 'Expert',
            ],
            [
                'slug' => 'sales-and-inventory-management-system',
                'title' => 'Systeme de gestion commerciale et stock',
                'short_desc' => 'Gestion commerciale et inventaire avec facturation.',
                'description' => 'Solution de gestion commerciale et de stock, incluant la facturation.',
                'sector' => 'Gestion commerciale et stock',
                'client' => 'Apple Store Partner',
            ],
            [
                'slug' => 'modernisation-applicative-lbp',
                'title' => 'Modernisation applicative bancaire et migration Angular 17',
                'short_desc' => 'Refonte technique, migration Angular 13->17 et architecture cible en environnement bancaire.',
                'description' => 'Pilotage technique d une modernisation bancaire avec architecture applicative, migration front Angular 17, optimisation des performances et fiabilite de production.',
                'sector' => 'Finance et conformite',
                'client' => 'La Banque Postale',
            ],
            [
                'slug' => 'plateforme-cicd-bancaire-gitlab-jenkins',
                'title' => 'Usine CI/CD bancaire GitLab Jenkins Kubernetes',
                'short_desc' => 'Automatisation des livraisons et gouvernance DevOps pour applications critiques.',
                'description' => 'Conception de pipelines CI/CD GitLab et Jenkins, industrialisation des deploiements Docker/Kubernetes/XL Deploy et securisation des mises en production.',
                'sector' => 'Finance et conformite',
                'client' => 'La Banque Postale',
            ],
            [
                'slug' => 'plateforme-bdf-bce-architecture-applicative',
                'title' => 'Plateforme BDF-BCE back JEE et front Angular',
                'short_desc' => 'Conception et implementation de fonctionnalites metier pour un contexte institutionnel.',
                'description' => 'Developpement de nouvelles fonctionnalites back-end JEE et front-end Angular, organisation Gitflow, chiffrage des evolutions et supervision de la qualite logicielle.',
                'sector' => 'Secteur public et institutionnel',
                'client' => 'Banque de France - BCE',
            ],
            [
                'slug' => 'securisation-keycloak-ejb-et-sso',
                'title' => 'Securisation SSO Keycloak et correction EJB',
                'short_desc' => 'Renforcement de l authentification et de l autorisation en environnement enterprise.',
                'description' => 'Correction de la configuration EJB autour de Keycloak pour garantir une integration fiable des mecanismes d authentification et d autorisation.',
                'sector' => 'Secteur public et institutionnel',
                'client' => 'Banque de France - BCE',
            ],
            [
                'slug' => 'optimisation-bdd-et-performances-bdf',
                'title' => 'Optimisation base de donnees et performances applicatives',
                'short_desc' => 'Indexation SQL, optimisation des requetes Java et stabilite front-end.',
                'description' => 'Optimisation des index et requetes, ajout de composants reutilisables, gestion des erreurs et couverture de tests pour ameliorer la robustesse globale.',
                'sector' => 'Finance et conformite',
                'client' => 'Symolia Technologies',
            ],
            [
                'slug' => 'plateforme-rh-prets-pointage-paie',
                'title' => 'Plateforme RH prets pointage et paie',
                'short_desc' => 'Digitalisation des processus RH avec workflows metier.',
                'description' => 'Conception et developpement d une plateforme RH couvrant gestion des prets, pointage, paie et pilotage administratif des ressources humaines.',
                'sector' => 'Ressources humaines et paie',
                'client' => 'MAS GROUP',
            ],
            [
                'slug' => 'plateforme-logistique-flux-usine',
                'title' => 'Plateforme logistique de flux usine',
                'short_desc' => 'Suivi de production et orchestration des flux logistiques.',
                'description' => 'Solution de gestion logistique pour suivre les flux de production, piloter les mouvements et ameliorer la visibilite operationnelle.',
                'sector' => 'Logistique et transport',
                'client' => 'MAS GROUP',
            ],
            [
                'slug' => 'mock-server-microservices-http',
                'title' => 'Mock Server multi-environnements et microservices',
                'short_desc' => 'Simulation HTTP/HTTPS configurable avec administration web.',
                'description' => 'Plateforme de simulation de reponses API avec front Angular, microservices Spring Boot, securite Keycloak, proxy NGINX et base PostgreSQL.',
                'sector' => 'Workflow et BPM',
                'client' => 'OUIMIND',
            ],
            [
                'slug' => 'kynops-gestion-colis-web-mobile',
                'title' => 'Systeme hybride web mobile pour gestion de colis',
                'short_desc' => 'Gestion des tournees, interventions, alertes et maintenance.',
                'description' => 'Application logistique hybride pour le pilotage des operations terrain, des vehicules, des contrats et des interventions avec reporting centralise.',
                'sector' => 'Logistique et transport',
                'client' => 'OUIMIND',
            ],
            [
                'slug' => 'workflow-camunda-microservices',
                'title' => 'Orchestrateur workflow BPMN base sur Camunda',
                'short_desc' => 'Microservices pour simplifier la creation de workflows metier.',
                'description' => 'Conception UML et developpement d une application de gestion workflow avec Spring Boot, Angular, Camunda, Keycloak, Docker et tests unitaires.',
                'sector' => 'Workflow et BPM',
                'client' => 'OUIMIND',
            ],
            [
                'slug' => 'plateforme-tlink-reseau-associatif',
                'title' => 'Plateforme TLINK reseau social et gestion competitions',
                'short_desc' => 'Reseau social associatif avec gestion de projets et scoring.',
                'description' => 'Creation d une plateforme communautaire avec modules de competitions, score, challenge, invitation, messagerie et administration des clubs.',
                'sector' => 'E-learning',
                'client' => 'Tunivisions Foundation',
            ],
            [
                'slug' => 'plateforme-transit-et-evaluation-personnel',
                'title' => 'Plateforme transit et evaluation du personnel',
                'short_desc' => 'Gestion des operations et performance des equipes en contexte industriel.',
                'description' => 'Developpement d une solution web Laravel pour transit, suivi de performance et evaluation du personnel, avec modeles Lean et pratiques TQM.',
                'sector' => 'Performance industrielle et TQM',
                'client' => 'KARRAY GROUP',
            ],
            [
                'slug' => 'ged-iso9001-et-tests-en-ligne',
                'title' => 'Solution GED ISO 9001 et test en ligne',
                'short_desc' => 'Outils documentaires qualite et evaluation en ligne.',
                'description' => 'Implementation d une GED conforme ISO 9001 v2015 et d une plateforme de test en ligne pour standardiser les pratiques et les audits internes.',
                'sector' => 'Performance industrielle et TQM',
                'client' => 'KARRAY GROUP',
            ],
            [
                'slug' => 'carthago-global-plateforme-bancaire',
                'title' => 'Evolution de plateforme bancaire multi-pays',
                'short_desc' => 'Parametrage reglementaire bancaire et accompagnement fonctionnel.',
                'description' => 'Contribution a l evolution d une plateforme bancaire multi-pays, parametrage des modules caisse et reglementaire, et accompagnement des equipes metier.',
                'sector' => 'Finance et conformite',
                'client' => 'BFI GROUP',
            ],
            [
                'slug' => 'hologarde-monitoring-aeroport',
                'title' => 'Systeme aeroportuaire de monitoring et detection drones',
                'short_desc' => 'Monitoring aeroport, decodeur Asterix et simulateur radar.',
                'description' => 'Developpement Java d un systeme de supervision aeroportuaire avec interfaces JavaFX, decodeur Asterix et composant de simulation radar sous Tomcat.',
                'sector' => 'Aeronautique et securite aeroportuaire',
                'client' => 'InnovATM',
            ],
            [
                'slug' => 'timesheet-collaboratif-laravel-angular',
                'title' => 'Plateforme Timesheet collaborative',
                'short_desc' => 'Suivi des taches, chat projet et gestion du temps.',
                'description' => 'Developpement d une solution web de suivi du temps et des taches avec back Laravel, front Angular, APIs REST et modules de collaboration.',
                'sector' => 'Workflow et BPM',
                'client' => 'AbrarCom',
            ],
            [
                'slug' => 'gestion-conges-php-pdo',
                'title' => 'Systeme de gestion des conges',
                'short_desc' => 'Application RH PHP PDO pour la gestion des absences.',
                'description' => 'Conception d un systeme de gestion des conges avec collecte des besoins, cahier des charges et implementation PHP PDO.',
                'sector' => 'Ressources humaines et paie',
                'client' => 'GLOBAL PAYMENT GATEWAY',
            ],
            [
                'slug' => 'recrutement-ocr-cv-et-extraction',
                'title' => 'Module recrutement OCR CV et extraction de donnees',
                'short_desc' => 'Automatisation de tri CV et extraction intelligente.',
                'description' => 'Developpement d un module de recrutement avec OCR PDF vers texte et extraction automatisee des donnees candidats pour accelerer la preselection.',
                'sector' => 'Recrutement et IA',
                'client' => 'InfoSquare',
            ],
            [
                'slug' => 'recrutement-soft-skills-yolo',
                'title' => 'Plateforme recrutement et evaluation soft skills IA',
                'short_desc' => 'Evaluation emotionnelle video/image et gestion des candidatures.',
                'description' => 'Creation d une plateforme de recrutement et formation avec modules offres, evaluation soft skills et moteur IA base sur YOLO v3.',
                'sector' => 'Recrutement et IA',
                'client' => 'Centre Coaching RH',
            ],
            [
                'slug' => 'site-corporate-back-office-afe',
                'title' => 'Site corporate et back office industriel',
                'short_desc' => 'Site web dynamique avec administration de contenu.',
                'description' => 'Conception des maquettes, developpement Laravel du site corporate et du back office d administration, puis mise en hebergement.',
                'sector' => 'Genie industriel de l air et ventilation',
                'client' => 'Air Filters Engineering',
            ],
            [
                'slug' => 'site-immobilier-et-modules-gestion',
                'title' => 'Site immobilier et modules de gestion',
                'short_desc' => 'Site vitrine immobilier avec outils de gestion interne.',
                'description' => 'Mise en place d un site immobilier et de modules de gestion, avec support utilisateurs, formation et maintenance evolutive.',
                'sector' => 'Construction',
                'client' => 'Diar Lkachaw Immobiliere',
            ],
            [
                'slug' => 'plateforme-hoteliere-reservations-paiement',
                'title' => 'Plateforme hoteliere reservations paiements dashboard',
                'short_desc' => 'Gestion interne hotel: reservations, paiements et pilotage.',
                'description' => 'Developpement d une plateforme hoteliere interne avec modules reservations, paiement et tableau de bord operationnel.',
                'sector' => 'Gestion hoteliere et reservation',
                'client' => 'Houria House',
            ],
            [
                'slug' => 'plateforme-commerciale-achats-ventes-stock',
                'title' => 'Plateforme commerciale achats ventes et stock',
                'short_desc' => 'Gestion commerciale centralisee avec inventaire et flux achat/vente.',
                'description' => 'Realisation d une plateforme de gestion commerciale avec modules achats, ventes et stock pour fluidifier les operations quotidiennes.',
                'sector' => 'Gestion commerciale et stock',
                'client' => 'Apple Store Partner',
            ],
        ];

        $projectMap = [];
        $projectSlugs = [];
        $projectCount = count($projects);
        foreach ($projects as $index => $item) {
            $monthsAgo = ($projectCount - $index - 1) * 2;
            $projectSlugs[] = $item['slug'];
            $project = Project::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'short_desc' => $item['short_desc'],
                    'description' => $item['description'],
                    'sector_id' => $sectors[$item['sector']]->id ?? null,
                    'client_id' => $clientMap[$item['client']]->id ?? null,
                    'start_date' => now()->subMonths($monthsAgo)->toDateString(),
                    'end_date' => null,
                    'main_image_url' => null,
                    'is_featured' => true,
                ]
            );

            $projectMap[$item['title']] = $project;
        }

        Project::query()
            ->whereNotIn('slug', $projectSlugs)
            ->delete();

        // Nettoyage: conserve uniquement les clients rattaches a au moins un projet.
        $usedClientIds = Project::query()
            ->whereNotNull('client_id')
            ->distinct()
            ->pluck('client_id');

        Client::query()
            ->whereNotIn('id', $usedClientIds)
            ->delete();

        $projectImages = [
            ['title' => 'Plateforme e-commerce construction', 'url' => 'https://kas-technology.com/images/chaaben.png', 'caption' => 'E-commerce construction'],
            ['title' => 'Plateforme e-learning complete', 'url' => 'https://kas-technology.com/images/afe.png', 'caption' => 'Experience e-learning'],
            ['title' => 'CRM genie industriel de l air', 'url' => 'https://kas-technology.com/images/navlion.png', 'caption' => 'CRM industriel'],
            ['title' => 'Plateforme d evaluation de credit', 'url' => 'https://kas-technology.com/images/banque.jpg', 'caption' => 'Finance et conformite'],
            ['title' => 'Systeme de gestion commerciale et stock', 'url' => 'https://kas-technology.com/images/Apple_Store.png', 'caption' => 'Gestion commerciale et stock'],
            ['title' => 'Modernisation applicative bancaire et migration Angular 17', 'url' => 'https://kas-technology.com/images/banque.jpg', 'caption' => 'Transformation bancaire'],
            ['title' => 'Usine CI/CD bancaire GitLab Jenkins Kubernetes', 'url' => 'https://kas-technology.com/images/expert.png', 'caption' => 'Pipeline et industrialisation'],
            ['title' => 'Plateforme RH prets pointage et paie', 'url' => 'https://kas-technology.com/images/chaaben.png', 'caption' => 'Digitalisation RH'],
            ['title' => 'Plateforme logistique de flux usine', 'url' => 'https://kas-technology.com/images/idaf.png', 'caption' => 'Flux logistiques'],
            ['title' => 'Mock Server multi-environnements et microservices', 'url' => 'https://kas-technology.com/images/navlion.png', 'caption' => 'Simulation API'],
            ['title' => 'Systeme hybride web mobile pour gestion de colis', 'url' => 'https://kas-technology.com/images/hotel.jpeg', 'caption' => 'Logistique web mobile'],
            ['title' => 'Orchestrateur workflow BPMN base sur Camunda', 'url' => 'https://kas-technology.com/images/afe.png', 'caption' => 'Workflow et BPM'],
            ['title' => 'Systeme aeroportuaire de monitoring et detection drones', 'url' => 'https://kas-technology.com/images/expert.png', 'caption' => 'Securite aeroportuaire'],
            ['title' => 'Plateforme Timesheet collaborative', 'url' => 'https://kas-technology.com/images/expert.png', 'caption' => 'Gestion des taches et du temps'],
            ['title' => 'Plateforme recrutement et evaluation soft skills IA', 'url' => 'https://kas-technology.com/images/afe.png', 'caption' => 'Recrutement intelligent'],
        ];

        foreach ($projectImages as $index => $img) {
            if (!isset($projectMap[$img['title']])) {
                continue;
            }

            ProjectImage::query()->updateOrCreate(
                [
                    'project_id' => $projectMap[$img['title']]->id,
                    'image_url' => $img['url'],
                ],
                [
                    'caption' => $img['caption'],
                    'display_order' => $index + 1,
                ]
            );
        }

        $products = [
            [
                'slug' => 'hotel-booking-suite',
                'name' => 'Suite de reservation hoteliere',
                'sector' => 'Gestion hoteliere et reservation',
                'short_desc' => 'Inventaire des chambres, reservations, check-in et facturation.',
                'description' => 'Suite digitale complete pour la gestion hoteliere et l experience client.',
            ],
            [
                'slug' => 'construction-commerce-portal',
                'name' => 'Portail commerce construction',
                'sector' => 'Construction',
                'short_desc' => 'E-commerce B2B/B2C pour entreprises de construction.',
                'description' => 'Catalogues produits, flux de devis et commandes en ligne pour groupes de construction.',
            ],
            [
                'slug' => 'smart-learning-platform',
                'name' => 'Plateforme d apprentissage intelligente',
                'sector' => 'E-learning',
                'short_desc' => 'Cours, devoirs et statistiques apprenants.',
                'description' => 'Plateforme LMS moderne pour les programmes de formation et d education digitale.',
            ],
            [
                'slug' => 'industrial-crm-core',
                'name' => 'Noyau CRM industriel',
                'sector' => 'Genie industriel de l air et ventilation',
                'short_desc' => 'Prospects, operations et suivi de service.',
                'description' => 'CRM et suivi de projets adaptes aux besoins des activites industrielles de ventilation.',
            ],
            [
                'slug' => 'credit-assessment-app',
                'name' => 'Application d evaluation de credit',
                'sector' => 'Finance et conformite',
                'short_desc' => 'Scoring client et indicateurs de conformite.',
                'description' => 'Flux d evaluation de solvabilite client et analyse des risques.',
            ],
            [
                'slug' => 'inventory-pro-manager',
                'name' => 'Gestionnaire pro de stock',
                'sector' => 'Gestion commerciale et stock',
                'short_desc' => 'Automatisation du stock, des ventes et de la facturation.',
                'description' => 'Logiciel de gestion commerciale avec fonctions inventaire et facturation.',
            ],
        ];

        foreach ($products as $index => $item) {
            Product::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'sector_id' => $sectors[$item['sector']]->id ?? null,
                    'name' => $item['name'],
                    'short_desc' => $item['short_desc'],
                    'description' => $item['description'],
                    'display_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }

        $testimonials = [
            [
                'client_name' => 'Client KAS',
                'client_role' => 'Chef d entreprise',
                'company' => 'Entreprise partenaire',
                'message' => 'KAS ne construit pas seulement des logiciels, KAS construit votre business. La solution livree est fiable et professionnelle.',
            ],
            [
                'client_name' => 'Sponsor de projet',
                'client_role' => 'Responsable operations',
                'company' => 'Partenaire entreprise',
                'message' => 'KAS nous a aides a moderniser nos operations avec une execution technique solide et une communication claire.',
            ],
        ];

        foreach ($testimonials as $index => $item) {
            Testimonial::query()->updateOrCreate(
                ['client_name' => $item['client_name'], 'company' => $item['company']],
                [
                    'client_role' => $item['client_role'],
                    'message' => $item['message'],
                    'avatar_url' => null,
                    'display_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
