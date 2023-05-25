<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceCategory;
use App\Models\Device;
use App\Models\Transaction;
use Illuminate\Support\Facades\File;

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

        if(empty($validate['image'])) {
            $file = NULL;
        } else {
            $file = $validate['image'];
        }
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
            return redirect()->route('device.show', $create->id)->with('success', 'Device added succesfully!');
        } else {
            return redirect()->route('device.show', $create->id)->with('danger', 'Fail to add new device!');
        }
    }

    // Detail
    public function show(Device $device) {
        return view('device.show', [
            'title' => 'Device detail',
            'device' => $device,
            'transactions' => Transaction::where('device_id', '=', $device->id)->orderBy('id', 'DESC')->paginate(5)
        ]);
    }

    // Update price
    public function price_update(Request $request, Device $device) {
        $validate = $request->validate([
            'price' => 'required|numeric'
        ]);

        $update = $device->update([
            'price' => $validate['price']
        ]);

        if($update) {
            return redirect()->route('device.show', $device->id)->with('success', 'Price updated successfully!');
        } else {
            return redirect()->route('device.show', $device->id)->with('danger', 'Fail to update price!');
        }
    }

    // Update phone number
    public function phone_update(Request $request, Device $device) {
        $validate = $request->validate([
            'phone' => 'required|numeric'
        ]);

        $update = $device->update([
            'phone_number' => $validate['phone']
        ]);

        if($update) {
            return redirect()->route('device.show', $device->id)->with('success', 'Phone number updated successfully!');
        } else {
            return redirect()->route('device.show', $device->id)->with('danger', 'Fail to update phone number!');
        }
    }

    // Delete
    public function destroy(Device $device) {
        $transactions = Transaction::where('device_id', '=', $device->id)->get();

        if($transactions->count() != 0) {
            foreach ($transactions as $item) {
                if($item->image != NULL) {
                    File::delete(public_path('image/transaction/'.$item->image));
                }
                $item->delete();
            }
        }

        if(!empty($device->image)) {
            if(File::delete(public_path('image/device/'.$device->image)) && $device->delete()) {
                return redirect()->route('device.index')->with('success', 'Device deleted successfully!');
            } else {
                return redirect()->route('device.show', $device->id)->with('danger', 'Fail to delete device!');
            }
        } else {
            $delete = $device->delete();
            
            if($delete) {
                return redirect()->route('device.index')->with('success', 'Device deleted successfully!');
            } else {
                return redirect()->route('device.show', $device->id)->with('danger', 'Fail to delete device!');
            }
        }
    }
}
