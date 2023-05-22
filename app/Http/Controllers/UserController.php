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

    // Edit
    public function edit(User $user) {
        return view('user.edit', [
            'title' => 'Edit user account',
            'user' => $user
        ]);
    }

    // Update user details
    public function update_detail(Request $request, User $user) {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $update = $user->update([
            'name' => ucwords($validate['name']),
            'email' => $validate['email']
        ]);

        if($update) {
            return redirect()->route('user.edit', $user->id)->with('success', 'Account details updated successfully!');
        } else {
            return redirect()->route('user.edit', $user->id)->with('danger', 'Fail to update account details!');
        }
    }

    // Update password
    public function update_password(Request $request, User $user) {
        $validate = $request->validate([
            'password' => 'required|min:5'
        ]);

        $update = $user->update([
            'password' => bcrypt($validate['password'])
        ]);

        if($update) {
            return redirect()->route('user.edit', $user->id)->with('success', 'Password updated successfully!');
        } else {
            return redirect()->route('user.edit', $user->id)->with('danger', 'Fail to update password!');
        }
    }

    // Delete
    public function destroy(User $user) {
        $delete = $user->delete();

        if($delete) {
            return redirect()->route('user.index')->with('success', 'Account deleted successfully!');
        } else {
            return redirect()->back()->with('danger', 'Fail to delete account!');
        }
    }
}
