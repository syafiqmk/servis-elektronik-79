<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Index
    public function index() {
        $users = User::all()->where('role', '!=', 'admin');

        return view('user.index', [
            'title' => 'User Account',
            'users' => $users
        ]);
    }
}
