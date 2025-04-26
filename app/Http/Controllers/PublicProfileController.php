<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PublicProfileController extends Controller
{
    public function show(Request $request, User $user)
    {
        return view("profile.show", [
            'user' => $user,
            'posts' => $user->posts()->orderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
