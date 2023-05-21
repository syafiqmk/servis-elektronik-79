<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceCategory;

class CategoryController extends Controller
{
    // Index
    public function index() {
        $categories = DeviceCategory::paginate(5);

        return view('category.index', [
            'title' => 'Device Category',
            'categories' => $categories
        ]);
    }

    // Create
    public function create() {
        return view('category.create', [
            'title' => 'Add new category'
        ]);
    }
}
