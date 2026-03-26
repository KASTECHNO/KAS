<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Dashboard User/Home
    public function home(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            // Redirige vers login si personne n'est connecté
            return redirect()->route('login');
        }

        // Si admin, redirige vers admin dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.projects.index');
        }

        // Sinon affiche le dashboard normal
        return view('dashboard');
    }

    // Dashboard Admin
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user || $user->role !== 'admin') {
            return redirect()->route('dashboard');
        }

        return view('admin.dashboard');
    }
}
