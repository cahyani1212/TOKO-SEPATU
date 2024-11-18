<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('data-user', compact('users'));
    }
}