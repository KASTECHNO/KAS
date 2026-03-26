# Deploiement OVH - KAS

Ce projet est prepare pour un hebergement OVH mutualise Apache avec un dossier web `www` et l'application Laravel placee a cote dans un dossier `kas`.

## Fichiers prepares

- `public/.htaccess` : configuration Apache adaptee a OVH.
- `public_html_index.php` : front controller a copier dans `www/index.php`.
- `.env.production.example` : modele de configuration production sans secrets.
- `deploy-ovh.ps1` : script PowerShell pour generer un zip de deploiement.

## Configuration OVH retenue

- Domaine : `kas-technology.com`
- Hote MySQL : `kastecj997.mysql.db`
- Base de donnees : `kastecj997`
- Utilisateur MySQL : `kastecj997`

Le mot de passe MySQL a ete renseigne uniquement dans le fichier local `.env.production`, qui est ignore par Git.

## 1. Preparation locale

1. Completer `.env.production` avec les secrets manquants.
2. Renseigner `MAIL_PASSWORD`.
3. Generer `APP_KEY` sur le serveur ou localement avec la meme version de PHP :

```bash
php artisan key:generate --show
```

4. Reporter la valeur dans `.env.production`.

## 2. Generer le package OVH

Depuis la racine du projet :

```powershell
.\deploy-ovh.ps1
```

Le script genere :

- `.deploy/server-root/www/`
- `.deploy/server-root/kas/`
- `kas-technology-server-root.zip`

## 3. Upload via gestionnaire de fichiers OVH

1. Ouvrir l'espace d'hebergement OVH.
2. Aller dans le gestionnaire de fichiers.
3. Uploader le contenu de `www/` dans le dossier web OVH.
4. Uploader le dossier `kas/` a cote du dossier `www`, pas a l'interieur.
5. Verifier que cette structure existe :

```text
www/
  index.php
  .htaccess
  css/
  js/
  images/
  storage/

kas/
  app/
  bootstrap/
  config/
  database/
  resources/
  routes/
  storage/
  vendor/
  .env
```

## 4. Upload via FileZilla

1. Se connecter avec les identifiants FTP OVH.
2. Envoyer le contenu de `.deploy/server-root/www/` dans le dossier web distant `www`.
3. Envoyer le dossier `.deploy/server-root/kas/` au meme niveau que le dossier `www` distant.
4. Verifier que `www/index.php` pointe bien vers `../kas/vendor/autoload.php` et `../kas/bootstrap/app.php`.

## 5. Finalisation serveur

1. Renommer le fichier de configuration final en `kas/.env` si besoin.
2. Verifier les permissions d'ecriture sur :
   - `kas/storage`
   - `kas/bootstrap/cache`
3. Creer le lien de storage si SSH disponible :

```bash
php artisan storage:link
```

Si SSH n'est pas disponible, copier manuellement le contenu public necessaire dans `www/storage`.

4. Lancer les migrations si SSH est disponible :

```bash
php artisan migrate --force
php artisan db:seed --force
```

## 6. Variables encore a renseigner

- `MAIL_PASSWORD`
- `APP_KEY`

## 7. Point d'attention

Ne pas commit ni pousser `.env.production` avec des secrets reels. Seul `.env.production.example` doit etre versionne.
