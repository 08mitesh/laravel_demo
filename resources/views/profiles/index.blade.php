@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row">
         <div class="col-3 p-5">
            <image src ="/svg/instagram.svg" class="rounded-circle" > 
         </div>
         <div class="col-9 pt-5">
            <div>
                <div class='d-flex justify-content-between align-items-baseline'>
                    <h1>
                        {{ $user->username}}
                    </h1>
                    <a href="/p/create">Add New Post</a>
                </div>
                <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
            </div>
            <div class='d-flex'>
            <div class="pr-4"> <strong>{{$user->posts->count()}}</strong> Posts</div>
                <div class="pr-4"> <strong>12k</strong> Follower</div>
                <div  class="pr-4"> <strong>12k</strong> Following</div>
            
            </div>
            <div class="pt-4 font-weight-bold">
            {{ $user->profile->title}}
            </div>
            <div>
            {{ $user->profile->description}}
            </div>
            <div> <a href="{{$user->profile->url}}" target= "_blank">
            {{ $user->profile->url  ?? "N/A"}} </a>
            </div>
         </div>
         <div class="row ">
             @foreach ($user->posts as $post)
                <div class="col-4 pb-4">
                <a href="/p/{{$post->id}}">
                    <img src="/storage/{{$post->image}}" class="w-100">
                </a>
                </div>
             @endforeach
         </div>
     </div>
</div>
@endsection
