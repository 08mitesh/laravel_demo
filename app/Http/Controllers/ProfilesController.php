<?php

namespace App\Http\Controllers;
use App\User as User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        //$userData = User::findOrFail($user);
        // dd($follows);
        $postsCount = Cache::remember(
            'count_posts_'.$user->id,
            now()->addSeconds(30),
            function() use ($user){
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count_followings_'.$user->id,
            now()->addSeconds(30),
            function() use ($user){
                return $user->profile->followers->count();
            });

        $followingsCount = Cache::remember(
            'count_followers_'.$user->id,
            now()->addSeconds(30),
            function() use ($user){
                return $user->following()->count();
            });

        return view('profiles.index',compact('user','follows','postsCount','followingsCount','followersCount'));
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
