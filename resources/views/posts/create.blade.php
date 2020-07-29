@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <h2>Add New Post</h2>
                    <div class="form-group row">
                        <label for="caption" class="col-md-4 col-form-label">
                            Caption
                        </label>
                        <input id="caption" 
                                type="text" 
                                class="form-control 
                                @error('caption') is-invalid 
                                @enderror" name="caption" 
                                value="{{ old('caption') }}"  
                                autocomplete="caption" 
                                autofocus>
                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label">
                            Post Image
                        </label>
                        <input id="image" 
                                type="file" 
                                class="form-control-file" 
                                name="image">
                        @error('image')
                            
                                <strong>{{ $message }}</strong>
                            
                        @enderror
                    </div>
                    <div class="row pt-3">
                        <button class="btn btn-primary"> Create Post</button>
                    </div>
             
            </div>
        </div>
    </form>
    
</div>
@endsection
