<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Device;

class TransactionController extends Controller
{
    // Create
    public function create(Device $device) {
        return view('transaction.create', [
            'title' => 'New transaction',
            'device' => $device
        ]);
    }
}
