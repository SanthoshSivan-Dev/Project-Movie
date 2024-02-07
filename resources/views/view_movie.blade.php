@extends('auth.layouts')

@section('content')
<div class="container text-center p-3">
    <div class="d-flex justify-content-between">
        <h4>Movie Details</h4>
        <a href="{{route('index')}}" class="btn btn-warning">Back</a>
    </div>
    <div class="container pt-4">
        <div class="border pt-2">
            @if(is_object($movie))
                <p>Movie ID : {{$movie->movie_id}}</p>
                <p>Movie Name : {{$movie->name}}</p>
                <p>Movie Description : {{$movie->description}}</p>
            @else
                <h1>Something Went Wrong</h1>
            @endif
        </div>
    </div>
</div>
@endsection