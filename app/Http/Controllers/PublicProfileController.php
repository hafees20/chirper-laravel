<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        $chirps = $user->chirps()->latest()->get();

        return view('user.user-profile', compact('user', 'chirps'));
    }
}
