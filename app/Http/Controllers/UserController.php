<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Index
    public function index() {
        $users = User::where('role', '!=', 'admin')->paginate(10);

        return view('user.index', [
            'title' => 'User Account',
            'users' => $users
        ]);
    }

    // Create
    public function create() {
        return view('user.create', [
            'title' => 'Create new user'
        ]);
    }

    // Store
    public function store(Request $request) {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        $create = User::create([
            'name' => ucwords($validate['name']),
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'role' => 'user'
        ]);

        if($create) {
            return redirect()->route('user.index')->with('success', 'Account created successfully!');
        } else {
            return redirect()->route('user.index')->with('danger', 'Account fail to create!');
        }
    }
}
