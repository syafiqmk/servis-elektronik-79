<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Transaction to Device Relation
    // Many Transactions belongs to One Device
    public function device() {
        return $this->belongsTo(Device::class, 'device_id');
    }

    // Transaction to User Relation
    // Many Transactions belongs to One User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
