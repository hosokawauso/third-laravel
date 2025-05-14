<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use App\Http\Requests\TodoRequest;

class AuthController extends Controller
{
    public function index(User $user)
    {
        $user = auth()->user();
        return view('todos.index', compact('user'));
    }
}
