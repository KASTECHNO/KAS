<?php

namespace App\Http\Controllers;

use App\Services\WebsiteDataSyncService;

class AdminDataSyncController extends Controller
{
    public function syncWebsiteStatic(WebsiteDataSyncService $syncService)
    {
        $stats = $syncService->importAndLocalize();

        $message = sprintf(
            'Import termine. Images localisees -> company:%d, clients:%d, projects:%d, project_images:%d, products:%d, testimonials:%d',
            $stats['company'],
            $stats['clients'],
            $stats['projects'],
            $stats['project_images'],
            $stats['products'],
            $stats['testimonials']
        );

        return redirect()->route('admin.dashboard')->with('success', $message);
    }
}
