<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    // HomePage
    public function home() {
        return view('welcome');
    }

    // Dashboard
    public function dashboard() {
        return view('dashboard', [
            'title' => 'Dashboard',
        ]);
    }

    // 403
    public function forbidden() {
        return view('403', [
            'title' => '403 Forbidden'
        ]);
    }
}
