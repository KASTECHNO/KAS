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

---

## 🚀 Déploiement

### Option 1: Déploiement Manuel (OVH)

**Structure de répertoires requise:**
```
root/
├── www/                    ← Webroot Apache (index.php bridge uniquement)
└── kas/                    ← Application Laravel complète
```

#### Étape 1: Préparer les fichiers
1. Compressez le projet complet (sans `node_modules`)
2. Téléchargez via FileZilla:
   - Contenu du projet → dossier `kas/` (level-1 du root OVH)
   - Fichier `public/index.php` modifié → dossier `www/index.php`

#### Étape 2: Structure correcte sur le serveur
```
/root
├── /www                          ← Serveur Apache pointe ici
│   ├── index.php                 ← Bridge qui require ../kas/
│   ├── .htaccess                 ← Règles rewrite
│   ├── css/, js/, images/        ← Assets statiques
│   └── robots.txt
└── /kas                          ← Application Laravel
    ├── app/, bootstrap/, config/, database/, routes/, resources/
    ├── vendor/                   ← Dépendances Composer
    ├── storage/, bootstrap/cache/← Répertoires écriture
    ├── .env                      ← Configuration production
    ├── composer.json, package.json
    └── artisan
```

#### Étape 3: Configuration OVH
1. **Nom de domaine – Multisite:**
   - OVH Manager → Domaine → Multisite
   - Racine: `/www`
   - Certificat SSL: Activé ✅

2. **Base de données:**
   - Créer une BDD MySQL et utilisateur
   - Noter les identifiants

3. **Compte FTP:**
   - OVH Manager → Accés FTP-SSH
   - Copier protocole, host, port

#### Étape 4: Fichiers à adapter sur le serveur

**`www/index.php` (Bridge Laravel):**
```php
<?php
require __DIR__.'/../kas/vendor/autoload.php';
$app = require_once __DIR__.'/../kas/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);
```

**`kas/.env` (Copie depuis `.env.example`):**
```bash
APP_NAME="KAS"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://kas-technology.com
APP_KEY=base64:xxxxx...  # Générer avec: php artisan key:generate --show

DB_CONNECTION=mysql
DB_HOST=kastecj997.mysql.db    # De OVH
DB_DATABASE=kastecj997          # De OVH
DB_USERNAME=kastecj997          # De OVH
DB_PASSWORD=votre_mot_de_passe  # De OVH

CACHE_DRIVER=file
SESSION_DRIVER=cookie
```

#### Étape 5: Permissions & Nettoyage
Via SSH (si disponible) ou fichier manager OVH:
```bash
chmod -R 777 kas/storage kas/bootstrap/cache
rm -rf kas/bootstrap/cache/*
php kas/artisan migrate --force
php kas/artisan db:seed
```

#### Étape 6: Test
- Visitez: `https://kas-technology.com`
- Admin: `https://kas-technology.com/admin`
- Identifiants: `admin@kas.local` / `Admin@123456`

---

### Option 2: Déploiement Automatisé (with PowerShell Scripts) ⚡

**Plus rapide et fiable** - Les scripts gèrent tout automatiquement.

#### Pré-requis
- PowerShell 5.1+
- Mot de passe FTP OVH
- PHP local pour génération APP_KEY

#### Installation
1. Vérifiez les scripts dans `.deploy/`:
```powershell
ls .\.deploy\*.ps1
```

#### Utilisation - Mode Menu interactif (recommandé)
```powershell
.\.deploy\manage-production.ps1
```
Affiche un menu avec toutes les opérations disponibles

#### Utilisation - Mode Commande directe

**1️⃣ Vérifier l'état (diagnostic complet):**
```powershell
.\.deploy\check-production-status.ps1 -FtpPassword "votre_mot_de_passe_ftp"
```
✅ Teste: DNS, FTP, HTTP, fichiers critiques, APP_KEY

**2️⃣ Fixer l'erreur 500 (APP_KEY vide):**
```powershell
.\.deploy\fix-production-env.ps1 -FtpPassword "votre_mot_de_passe_ftp"
```
✅ Génère APP_KEY → Envoie au serveur → Crée backup

**3️⃣ Corriger les permissions (755/777):**
```powershell
.\.deploy\fix-production-permissions.ps1 -FtpPassword "votre_mot_de_passe_ftp"
```
✅ Applique permissions correctes sur storage/ et app/

**4️⃣ Nettoyer cache et logs:**
```powershell
.\.deploy\clean-production-cache.ps1 -FtpPassword "votre_mot_de_passe_ftp"
```
✅ Supprime cache, logs, fichiers temp
💡 Utilisez `-DryRun` pour simuler d'abord

#### Workflow typique (après un upload initial)
```powershell
# 1. Diagnostic de santé
.\.deploy\check-production-status.ps1 -FtpPassword "xxx"

# 2. Corriger problèmes si erreur 500
.\.deploy\fix-production-env.ps1 -FtpPassword "xxx"

# 3. Corriger permissions si besoin
.\.deploy\fix-production-permissions.ps1 -FtpPassword "xxx"

# 4. Nettoyer cache
.\.deploy\clean-production-cache.ps1 -FtpPassword "xxx"

# 5. Vérifier à nouveau
.\.deploy\check-production-status.ps1 -FtpPassword "xxx"
```

#### Scripts disponibles

| Script | Fonction |
|--------|----------|
| `manage-production.ps1` | Menu maître (pointeur d'entrée) |
| `fix-production-env.ps1` | Génère + envoie APP_KEY |
| `fix-production-permissions.ps1` | Corrige permissions 755/777 |
| `check-production-status.ps1` | Diagnostic complet (6 tests) |
| `clean-production-cache.ps1` | Nettoyage cache/logs |

📖 **Documentation détaillée:** `.deploy/PRODUCTION_MANAGEMENT.md`

#### Troubleshooting

**"Erreur 500 après déploiement"**
```powershell
# 1. Vérifier état
.\.deploy\check-production-status.ps1 -FtpPassword "xxx"

# 2. Fixer APP_KEY
.\.deploy\fix-production-env.ps1 -FtpPassword "xxx"

# 3. Recharger site
```

**"Erreurs d'accès aux fichiers"**
```powershell
.\.deploy\fix-production-permissions.ps1 -FtpPassword "xxx"
```

**"Site très lent"**
```powershell
.\.deploy\clean-production-cache.ps1 -FtpPassword "xxx"
```

**"Le script ne s'exécute pas"**
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

---

## Comparaison: Manuel vs Automatisé

| Aspect | Manuel | Script PowerShell |
|--------|--------|------------------|
| Temps | 30-45 min | 5-10 min |
| Complexité | Élevée | Faible |
| Erreurs possibles | Nombreuses | Minimales |
| APP_KEY | ⚠️ À faire manuellement | ✅ Automatique |
| Permissions | ⚠️ Peut être compliqué | ✅ Automatique |
| Maintenance | ⚠️ Manuel pour chaque déploiement | ✅ Réutilisable |
| **Recommandé pour** | Premiers déploiements (comprendre) | Production + itérations |

---

## Conseils finaux

✅ **À faire avant le déploiement:**
- Configurer le `.env` localement
- Tester en local: `php artisan serve`
- Compiler assets: `npm run dev`

✅ **À faire après le déploiement:**
- Vérifier: `https://kas-technology.com`
- Accéder panel admin
- Modifier contenu de test pour valider

✅ **Maintenance régulière:**
```bash
php artisan log:clear           # Nettoyer logs
php artisan cache:clear         # Nettoyer cache
php artisan optimize:clear      # Optimiser
```

💡 **SSH recommandé (plus rapide que FTP)**
- Demandez à support OVH d'activer SSH
- Exécutez commandes directement sans scripts
