<?php

/**
 * OVH public_html bridge
 *
 * Sur OVH mutualisé, le dossier servi est public_html/ (ou www/).
 * Ce fichier doit etre copie a la RACINE de public_html/ et renomme index.php.
 *
 * Structure attendue sur le serveur OVH :
 *
 *   public_html/               <- racine web OVH
 *   ├── index.php              <- CE fichier (renomme depuis public_html_index.php)
 *   ├── .htaccess              <- copie de public/.htaccess
 *   ├── css/                   <- copie de public/css/
 *   ├── js/                    <- copie de public/js/
 *   ├── images/                <- copie de public/images/
 *   ├── storage/               <- lien vers storage/app/public/
 *   └── robots.txt
 *
 *   kas/                       <- tout le reste du projet (hors public_html)
 *   ├── app/
 *   ├── bootstrap/
 *   ├── config/
 *   ├── database/
 *   ├── resources/
 *   ├── routes/
 *   ├── storage/
 *   ├── vendor/
 *   └── ...
 *
 * Adapter __DIR__ en fonction de votre arborescence reelle sur OVH.
 */

define('LARAVEL_START', microtime(true));

// Chemin vers vendor/autoload.php (un niveau au-dessus de public_html)
require __DIR__.'/../kas/vendor/autoload.php';

// Chemin vers bootstrap/app.php
$app = require_once __DIR__.'/../kas/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);
