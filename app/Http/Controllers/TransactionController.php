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
            'device_id' => $device->id,
            'user_id' => '1'
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

    // Destroy
    public function destroy(Transaction $transaction, Device $device) {
        $delete = $transaction->delete();

        if(!empty($transaction->image)) {
            $del_img = File::delete(public_path('image/transaction/'.$transaction->image));
        } else {
            $del_img = true;
        }

        if($delete && $del_img) {
            $new_transaction = Transaction::where('device_id', '=', $device->id)->latest()->first();
            
            if(empty($new_transaction)) {
                $type = "Baru";
            } else {
                $type = $new_transaction->type;
            }

            $update = $device->update([
                'status' => $type
            ]);

            if($update) {
                return redirect()->route('device.show', $device->id)->with('success', 'Transaction deleted successfully!');
            } else {
                return redirect()->route('device.show', $device->id)->with('danger', 'Fail to delete transaction!');
            }
        } else {
            return redirect()->route('device.show', $device->id)->with('danger', 'Fail to delete transaction!');
        }
    }
}
