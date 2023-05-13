<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevController extends Controller
{
    // Dashboard View
    public function dashboard() {
        return view("dev.page.dashboard", [
            'title' => "Dashboard Development View"
        ]);
    }
}
