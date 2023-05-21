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

    // Store
    public function store(Request $request) {
        $validate = $request->validate([
            'category' => 'required'
        ]);

        $create = DeviceCategory::create([
            'category' => ucwords($validate['category'])
        ]);

        if($create) {
            return redirect()->route('category.index')->with('success', 'New category added successfully!');
        } else {
            return redirect()->route('category.index')->with('danger', 'Fail to add new category!');
        }
    }
}
