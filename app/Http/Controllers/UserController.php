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
}
