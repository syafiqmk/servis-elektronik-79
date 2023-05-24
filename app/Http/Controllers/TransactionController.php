<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Device;
use Illuminate\Support\Facades\File;

class TransactionController extends Controller
{
    // Create
    public function create(Device $device) {
        return view('transaction.create', [
            'title' => 'New transaction',
            'device' => $device
        ]);
    }

    // Store
    public function store(Request $request, Device $device) {
        $validate = $request->validate([
            'type' => 'required',
            'image' => 'file|image|nullable',
            'detail' => 'nullable'
        ]);

        if(empty($validate['image'])) {
            $file = NULL;
        } else {
            $file = $validate['image'];
        }

        $file_name = NULL;

        if($request->file('image')) {
            $file_name = $file->getClientOriginalName();
            $file->move('image/transaction', $file_name);
        }

        $create = Transaction::create([
            'type' => $validate['type'],
            'detail' => $validate['detail'],
            'image' => $file_name,
            'user_id' => '3'
        ]);

        $update = $device->update([
            'status' => $validate['type']
        ]);

        if($create && $update) {
            return redirect()->route('device.show', $device->id)->with('primary', 'New transaction added!');
        } else {
            return redirect()->route('device.show', $device->id)->with('danger', 'Fail to add new transaction!');
        }
    }
}
