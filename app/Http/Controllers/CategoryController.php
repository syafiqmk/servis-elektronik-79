<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceCategory;

class CategoryController extends Controller
{
    // Index
    public function index() {

        if(request()->search) {
            $search = request()->search;
        } else {
            $search = '';
        }

        $categories = DeviceCategory::where('category', 'LIKE', '%'.$search.'%')->paginate(5);

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

    // Edit
    public function edit(DeviceCategory $category) {
        return view('category.edit', [
            'title' => 'Edit device category',
            'category' => $category
        ]);
    }

    // Update
    public function update(Request $request, DeviceCategory $category) {
        $validate = $request->validate([
            'category' => 'required'
        ]);

        $update = $category->update([
            'category' => ucwords($validate['category'])
        ]);

        if ($update) {
            return redirect()->route('category.index')->with('success', 'Category updated successfully!');
        } else {
            return redirect()->route('category.index')->with('danger', 'Fail to update category!');
        }
    }

    // Delete
    public function destroy(DeviceCategory $category) {
        $delete = $category->delete();

        if($delete) {
            return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
        } else {
            return redirect()->route('category.index')->with('danger', "Fail to delete category!");
        }
    }
}
