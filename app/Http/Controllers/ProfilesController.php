<?php

namespace App\Http\Controllers;
use App\User as User;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        //$userData = User::findOrFail($user);
        dd($follows);
        return view('profiles.index',compact('user','follows'));
    }

    public function edit(\App\User $user)
    {
        $this->authorize('update',$user->profile);
        return view('profiles.edit',compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update',$user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description'=> 'required',
            'url' => 'url',
            'image'=>''
        ]);
       // dd($data);
        if(request('image'))
        {
            $imagePath = request('image')->store('profile','public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
        }

        auth()->user()->profile->update(array_merge(
            $data,
            array('image'=>$imagePath)
        ));
        
        return redirect("/profile/{$user->id}");
    }
}
