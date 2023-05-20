<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceCategory;

class CategoryController extends Controller
{
    // Index
    public function index() {
        $categories = DeviceCategory::paginate(5);
    }
}
