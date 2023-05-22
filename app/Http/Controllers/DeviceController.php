<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceCategory;
use App\Models\Device;

class DeviceController extends Controller
{
    // Create
    public function create() {
        $categories = DeviceCategory::all();

        return view('device.create', [
            'title' => 'Add new device',
            'categories' => $categories
        ]);
    }

    // Submit
    public function submit(Request $request) {
        $validate = $request->validate([
            'image' => 'image|file',
            'category' => 'required',
            'phone' => 'numeric',
            'detail' => 'required'
        ]);

        if($request->file('image')) {
            $validate['image'] = $request->file('image')->store('images/device');
        } else {
            $validate['image'] = NULL;
        }

        $create = Device::create([
            'phone_number' => $validate['phone'],
            'detail' => $validate['detail'],
            'image' => $validate['image'],
            'status' => 'Baru',
            'category_id' => $validate['category'],
        ]);

        if($create) {
            return redirect()->route('device.index')->with('success', 'Device added succesfully!');
        } else {
            return redirect()->route('device.index')->with('danger', 'Fail to add new device!');
        }
    }
}
