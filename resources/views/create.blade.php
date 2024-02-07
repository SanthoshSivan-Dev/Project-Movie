@extends('auth.layouts')

@section('content')
<div class="container p-5">
    <div class="d-flex justify-content-between">
        <h4>Create Movie</h4>
        <a href="{{route('index')}}" class="btn btn-warning">Back</a>
    </div>
    <form id="formSubmit">
        @csrf
        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
        <div class="mb-3">
            <label for="movie_id" class="form-label">Movie ID</label>
            <input type="text" class="form-control" id="movie_id" name="movie_id" value="">
            <span class="error" id="movieidError"></span>
        </div>
        <div class="mb-3">
            <label for="movie_name" class="form-label">Movie Name</label>
            <input type="text" class="form-control" id="movie_name" name="name" value="">
            <div class="pt-2">
                <button onclick="searchMovie()" class="btn btn-secondary" type="button">Search</button>
            </div>
            <span class="error" id="movienameError"></span>
        </div>
        <div class="mb-3">
            <label for="movie_name" class="form-label">Movie Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection