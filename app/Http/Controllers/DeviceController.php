<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceCategory;
use App\Models\Device;

class DeviceController extends Controller
{
    // Index
    public function index() {
        $devices = Device::orderBy('id', 'DESC')->paginate(9);

        return view('device.index', [
            'title' => 'Devices',
            'devices' => $devices
        ]);
    }

    // Create
    public function create() {
        $categories = DeviceCategory::all();

        return view('device.create', [
            'title' => 'Add new device',
            'categories' => $categories
        ]);
    }

    // Store
    public function store(Request $request) {
        $validate = $request->validate([
            'image' => 'image|file|nullable',
            'category' => 'required',
            'phone' => 'numeric|nullable',
            'detail' => 'required'
        ]);

        $file = $validate['image'];
        $file_name = NULL;

        if($request->file('image')) {
            $file_name = $file->getClientOriginalName();
            $file->move('image/device', $file_name);
        }

        $create = Device::create([
            'phone_number' => $validate['phone'],
            'detail' => $validate['detail'],
            'image' => $file_name,
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
