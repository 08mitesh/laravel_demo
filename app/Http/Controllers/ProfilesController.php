<?php

namespace App\Http\Controllers;
use App\User as user;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $userData = User::findOrFail($user);
      
        return view('profiles.index',['user'=>$userData]);
    }

    public function edit(\App\User $user)
    {
        return view('profiles.edit',compact('user'));
    }
}
