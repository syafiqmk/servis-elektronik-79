<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    // Device to DeviceCategory Relations
    // Many Device belongs to One Device Category
    public function category() {
        return $this->belongsTo(DeviceCategory::class, 'category_id');
    }

    // Device to Transaction Relation
    // Device can have many Transaction
    public function transaction() {
        return $this->hasMany(Transaction::class);
    }
}
