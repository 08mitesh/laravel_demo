@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row">
         <div class="col-3 p-5">
         <image src ="{{$user->profile->profileImage()}}" class="rounded-circle w-100" > 
         </div>
         <div class="col-9 pt-5">
            <div>
                <div class='d-flex justify-content-between align-items-baseline'>
                    <div class="d-flex align-center">
                        <h4>
                            {{ $user->username}}
                        </h4>
                    <follow-button user-id="{{$user->id}}" fololows="{{$follows}}"></follow-button>
                    </div>
                    @can('update', $user->profile)
                        <a href="/p/create">Add New Post</a>
                    @endcan
                    
                </div>
                @can('update', $user->profile)
                    <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
                @endcan

            </div>
            <div class='d-flex'>
            <div class="pr-4"> <strong>{{$postsCount}}</strong> Posts</div>
            <div class="pr-4"> <strong>{{$followersCount}}</strong> Follower</div>
            <div  class="pr-4"> <strong>{{$followingsCount}}</strong> Following</div>
            
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
