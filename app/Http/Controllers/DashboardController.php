<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        if ($request->user()->isAdmin()) {
            return redirect()->route('agents.dashboard');
        }

        return view('tickets.index');
    }
}
