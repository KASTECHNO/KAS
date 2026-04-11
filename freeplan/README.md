# KAS - Website + Admin Platform (CRM)

Plateforme Laravel comprenant:
- un site public orienté vitrine commerciale,
- un back-office admin moderne pour la gestion de contenu,
- un module KPI dynamique,
- un workflow de temoignages avec validation admin,
- une gestion des medias (upload local + URL legacy),
- un module CRM complet (Leads, Opportunites, Activites) avec pipeline.

## Stack technique

- Backend: Laravel (PHP)
- Front: Blade + CSS custom
- Build assets: Laravel Mix
- Base de donnees: MySQL

## Fonctionnalites principales

### Site public
- Homepage unique responsive.
- Sections dynamiques: Services, Projets, Clients, KPI, Temoignages.
- Formulaire Contact.
- Formulaire Temoignage (soumis par les visiteurs).

### Back-office admin
- CRUD actifs: Entreprise, Services, Secteurs, Clients, Projets, Temoignages, KPI, Messages Contact.
- Dashboard KPI dynamique (cartes + tendances).
- Dashboard CRM: KPI commerciaux, pipeline par etape et activites a suivre.
- Synchronisation de donnees website + localisation d images via action admin.

### CRM
- Entites CRM: `leads`, `opportunities`, `crm_activities`.
- CRUD admin complets pour Leads, Opportunites et Activites.
- Pipeline opportunites avec changement rapide d etape (kanban + table).
- Capture automatique des leads depuis le formulaire de contact public.
- Journalisation d activites CRM reliees aux leads/opportunites.

### Seeder CRM Workflow
- Seeder dedie: `CrmWorkflowSeeder`.
- Genere un jeu de donnees de workflow commercial (clients, leads, opportunites, activites).
- Enregistre dans `DatabaseSeeder` pour execution standard via `php artisan db:seed`.

### Workflow Temoignages
- Soumission depuis le site public via formulaire.
- Insertion en base en statut non publie (`is_active = 0`).
- Publication uniquement apres validation en admin (`is_active = 1`).

### KPI
- Calcul automatique via service applicatif.
- Insertion/MAJ idempotente des KPI dans `kpi_metrics`.
- Edition admin (titre, unite, ordre, actif, description).
- Recalcul manuel via bouton admin.

## Installation rapide

1. Configurer la base MySQL dans `.env`.
2. Installer les dependances:

```bash
composer install
npm install
```

3. Generer la cle d'application:

```bash
php artisan key:generate
```

4. Migrer la base:

```bash
php artisan migrate --force
```

5. Seeder minimal (admin uniquement):

```bash
php artisan db:seed
```

6. Lier le storage public (obligatoire pour les uploads):

```bash
php artisan storage:link
```

7. Compiler les assets:

```bash
npm run dev
```

8. Lancer l'application:

```bash
php artisan serve
```

## Comptes et acces

Compte administrateur par defaut (via `AdminUserSeeder`):
- Email: admin@kas.local
- Mot de passe: Admin@123456
- Role: ADMIN

## Flux de donnees recommande

- Par defaut, le seeding statique website n est pas lance automatiquement.
- Le contenu est pilote via les CRUD admin.
- Si vous voulez importer/copy des donnees historiques + images distantes:
	- utiliser l action `Importer donnees + images` depuis le dashboard admin.

## Commandes utiles

Recalcul KPI:

```bash
php artisan tinker --execute="app(App\\Services\\KpiMetricService::class)->recalculate();"
```

Nettoyage caches:

```bash
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

## Positionnement produit

Le projet est actuellement une plateforme CRM exploitable:
- gestion de contenu et presence web,
- suivi commercial structure (leads, opportunites, activites),
- dashboard KPI metier + CRM,
- moderation des temoignages,
- collecte et qualification initiale des contacts.

Ameliorations possibles ensuite: ownership multi-utilisateur plus fin, reporting conversion avance, automatisations supplementaires.
