<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class GeneralController extends Controller
{
    // HomePage
    public function home() {
        return view('welcome');
    }

    // Dashboard
    public function dashboard() {

        $today = date('Y-m-d');
        $devices = Device::all();
        $device_today = Device::whereDate('created_at', '=', $today);
        
        return view('dashboard', [
            'title' => 'Dashboard',
            'devices' => $devices,
            'device_today'=> $device_today
        ]);
    }

    // 403
    public function forbidden() {
        return view('403', [
            'title' => '403 Forbidden'
        ]);
    }
}
