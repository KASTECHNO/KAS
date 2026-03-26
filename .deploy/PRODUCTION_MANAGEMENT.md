# Guide de Gestion de la Production KAS

## 📋 Scripts disponibles

Tous les scripts sont dans le dossier `.deploy/` et nécessitent PowerShell 5.1+.

### 1. **fix-production-env.ps1** ✅ APP_KEY (Erreur 500)
**Problème:** `APP_KEY=` vide dans `.env` → Erreur 500  
**Solution:** Génère une APP_KEY locale et la pousse sur le serveur

```powershell
.\.deploy\fix-production-env.ps1 -FtpPassword "votre_mot_de_passe_ovh"
```

**Ce que le script fait:**
- ✅ Génère l'APP_KEY via `php artisan key:generate --show`
- ✅ Se connecte au serveur FTP et télécharge `.env`
- ✅ Remplace `APP_KEY=` par la nouvelle clé
- ✅ Envoie le fichier mis à jour au serveur
- ✅ Crée des sauvegardes locales

**Après l'exécution:**
```
Rechargez: https://kas-technology.com/
L'erreur 500 devrait disparaître
```

---

### 2. **fix-production-permissions.ps1** 🔐 Permissions
**Problème:** Fichiers avec permissions incorrectes → erreurs d'accès  
**Solution:** Corrige les permissions via FTP (755/777)

```powershell
.\.deploy\fix-production-permissions.ps1 -FtpPassword "votre_mot_de_passe_ovh"
```

**Permissions appliquées:**
- `777` (rwxrwxrwx) sur dirs critiques: `storage/`, `bootstrap/cache/`
- `755` (rwxr-xr-x) sur dirs de l'app: `app/`, `config/`, `routes/`

**Note:** ⚠️ Certains serveurs OVH ne supportent pas la commande FTP CHMOD  
→ **Alternative SSH:** Contactez support OVH pour activer SSH, puis:
```bash
chmod -R 777 ~/kas/storage ~/kas/bootstrap/cache
chmod -R 755 ~/kas/app ~/kas/config ~/kas/database
```

---

### 3. **check-production-status.ps1** 📊 Vérification
**Fonction:** Diagnostic complet de la production

```powershell
.\.deploy\check-production-status.ps1 -FtpPassword "votre_mot_de_passe_ovh"
```

**Ce qu'il vérifie:**
- ✅ Site HTTP/HTTPS (HTTP 200?)
- ✅ DNS (résolution du domaine)
- ✅ Connectivité FTP
- ✅ Fichiers critiques présents
- ✅ APP_KEY configurée
- ✅ Diagnostic supplémentaire

**Résultat:** Vous voyez immédiatement les problèmes + les solutions

---

### 4. **clean-production-cache.ps1** 🧹 Nettoyage
**Fonction:** Nettoie cache, logs et fichiers temporaires

```powershell
.\.deploy\clean-production-cache.ps1 -FtpPassword "votre_mot_de_passe_ovh"
```

**Ce qu'il supprime:**
- Cache applicatif: `bootstrap/cache/*`
- Cache framework: `storage/framework/cache/*`
- Vue compilées: `storage/framework/views/*`
- Logs: `storage/logs/*.log`
- Fichiers temporaires: `storage/app/cache/*`

**🔍 Mode test (recommandé d'abord):**
```powershell
.\.deploy\clean-production-cache.ps1 -FtpPassword "xxx" -DryRun
```
Affiche ce qui SERAIT supprimé sans rien faire

**📝 Note:** SSH est beaucoup plus rapide pour cette opération
```bash
rm -rf ~/kas/bootstrap/cache/*
rm -rf ~/kas/storage/framework/cache/*
rm -rf ~/kas/storage/logs/*.log
```

---

### 5. **manage-production.ps1** 🎛️ Menu Maître
**Interface unifiée pour tous les outils**

#### Mode Menu (Interactif)
```powershell
.\.deploy\manage-production.ps1
```
Affiche un menu et demande le mot de passe une seule fois

#### Mode Ligne de Commande
```powershell
.\.deploy\manage-production.ps1 -Action "fix-env" -FtpPassword "xxx"
```

**Actions disponibles:**
- `fix-env` → Corriger APP_KEY
- `fix-permissions` → Corriger permissions
- `check-status` → Vérifier l'état
- `clean-cache` → Nettoyer cache/logs

---

## 🚀 Workflow de Déploiement

### Après votre premier upload à OVH:

```
1. Vérifier l'état
   → .\.deploy\check-production-status.ps1 -FtpPassword "xxx"
   
2. Si erreur 500: Corriger APP_KEY
   → .\.deploy\fix-production-env.ps1 -FtpPassword "xxx"
   
3. Si erreurs d'accès: Corriger permissions
   → .\.deploy\fix-production-permissions.ps1 -FtpPassword "xxx"
   
4. Nettoyer après modifications
   → .\.deploy\clean-production-cache.ps1 -FtpPassword "xxx"
   
5. Vérifier à nouveau
   → .\.deploy\check-production-status.ps1 -FtpPassword "xxx"
```

---

## 🔧 Récupérer le mot de passe FTP OVH

1. Connectez-vous à **OVH Manager**
2. Herbergement → Choisir le domaine
3. Accès FTP-SSH
4. Voir le mot de passe (ou le réinitialiser)

**Dans la photo:** Le mot de passe est visible dans FileZilla

---

## 📱 Cas d'usage courants

### Erreur 500 apparaît
```powershell
1. .\.deploy\check-production-status.ps1 -FtpPassword "xxx"
2. .\.deploy\fix-production-env.ps1 -FtpPassword "xxx"
3. Rechargez le site
```

### Site très lent
```powershell
.\.deploy\clean-production-cache.ps1 -FtpPassword "xxx"
```

### Erreurs d'accès aux fichiers
```powershell
.\.deploy\fix-production-permissions.ps1 -FtpPassword "xxx"
```

### Vérification de santé globale
```powershell
.\.deploy\check-production-status.ps1 -FtpPassword "xxx"
```

---

## ⚠️ Limitations & Recommandations

**FTP a des limitations:**
- ❌ Pas de mkdir directe (répertoires)
- ❌ Pas d'exécution de commandes
- ❌ CHMOD peut ne pas fonctionner

**Solution: Activez SSH chez OVH**
```bash
ssh kastecj@cluster030.hosting.ovh.net
# Puis:
chmod -R 777 ~/kas/storage ~/kas/bootstrap/cache
rm -rf ~/kas/bootstrap/cache/*
php ~/kas/artisan cache:clear
```

---

## 🆘 Dépannage

### "Le script ne s'exécute pas"
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

### "Erreur FTP: 530 User not authorized"
- Vérifiez le mot de passe OVH (copie-collez exactement)
- Réinitialisez le mot de passe dans OVH Manager

### "Erreur 500 persiste"
1. Vérifiez les logs: `~/logs/error.log` (via FileZilla)
2. Vérifiez la base de données (DB_HOST, DB_PASSWORD)
3. Assurez-vous que `vendor/` n'est pas vide

### "Permissions ne changent pas"
- SSH est nécessaire pour CHMOD fiable
- Contactez support OVH pour activer SSH

---

## 📞 Besoin d'aide?

- **Vérifiez d'abord:** `.\.deploy\check-production-status.ps1 -FtpPassword "xxx"`
- **Consultez les logs:** Via FileZilla → ~/logs/error.log
- **Support OVH:** http://support.ovh.com/ (chat en français)

---

**Version:** 1.0  
**Framework:** Laravel 8.75  
**Hosting:** OVH Mutualisé  
**Dernière mise à jour:** Mars 2026
