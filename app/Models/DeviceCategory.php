<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceCategory extends Model
{
    use HasFactory;

    // DeviceCategory to Device Relation
    // DeviceCategory can have many Device
    public function device() {
        return $this->hasMany(Device::class);
    }
}
