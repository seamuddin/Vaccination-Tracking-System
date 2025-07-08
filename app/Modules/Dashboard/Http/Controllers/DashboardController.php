<?php

namespace App\Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $roleSlug = $user->role->slug ?? null;
        if (!$user) {
            return redirect()->route('login');
        }
        if (in_array($roleSlug, ['admin', 'health-worker'])) 
        {
            return view("Dashboard::index");
        } elseif ($roleSlug === 'parent') 
        {
            return redirect()->intended('guardian_portfolio');
        }
    }
}
