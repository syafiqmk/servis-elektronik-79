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

        if(request()->search) {
            $search = request()->search;
        } else {
            $search = '';
        }

        if(request()->date) {
            $date = request()->date;
        } else {
            $date = '';
        }

        if(request()->category) {
            // $category = DeviceCategory::firstWhere('category', '=', request()->category)->id;
            $category = request()->category;
        } else {
            $category = '';
        }

        if(request()->status) {
            $status = request()->status;
        } else {
            $status = '';
        }

        if(request()->sort) {
            $sort = request()->sort;
        } else {
            $sort = 'DESC';
        }


        $devices = Device::where('created_at', '>=', $date)->
            where(
                function($query) use ($category) {
                    if($category != '') {
                        return $query->where('category_id', '=', $category);
                    }
                }
            )->
            where('status', 'LIKE', '%'.$status.'%')->
            where(
                function($query) use ($search) {
                    return $query->where('phone_number', 'LIKE', '%'.$search.'%')->
                    orWhere('detail', 'LIKE', '%'.$search.'%');
                }
            )->orderBy('id', $sort)->paginate(9);
        $categories = DeviceCategory::all();

        return view('device.index', [
            'title' => 'Devices',
            'devices' => $devices,
            'categories' => $categories
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

    // Edit
    public function edit(Device $device) {
        $categories = DeviceCategory::all();

        return view('device.edit', [
            'title' => 'Edit Device',
            'device' => $device,
            'categories' => $categories
        ]);
    }

    // Update
    public function update(Request $request, Device $device) {
        $validate = $request->validate([
            'image' => 'image|file|nullable',
            'category' => 'required',
            'phone' => 'numeric|nullable',
            'detail' => 'required'
        ]);

        if (empty($validate['image'])) {
            $file = NULL;
        } else {
            $file = $validate['image'];
        }
        $file_name = $device->image;

        if ($request->file('image')) {
            if(!empty($device->image)) {
                File::delete(public_path('image/device/'.$device->image));
            }

            $file_name = $file->getClientOriginalName();
            $file->move('image/device', $file_name);
        }

        $update = $device->update([
            'phone_number' => $validate['phone'],
            'detail' => $validate['detail'],
            'image' => $file_name,
            'status' => 'Baru',
            'category_id' => $validate['category'],
        ]);

        if ($update) {
            return redirect()->route('device.show', $device->id)->with('success', 'Device edited succesfully!');
        } else {
            return redirect()->route('device.show', $device->id)->with('danger', 'Fail to edit device!');
        }
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
