<?php

namespace App\Http\Controllers;

use App\Service;
use App\Project;
use App\Client;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::where('is_active', true)
            ->orderBy('display_order')
            ->get();

      
        $projects = Project::where('is_featured', 1)
            ->orderBy('start_date', 'desc')
            ->get();

  
        $clients = Client::all();

        return view('home', compact('services', 'projects', 'clients'));
    }
}
