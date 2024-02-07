@extends('auth.layouts')

@section('content')
<div class="container p-3">
    <h4>Movie List</h4>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{route('likedList', Auth::user()->id)}}" class="btn btn-warning">Liked List</a>
        <button id="search" class="btn btn-primary" type="button">Search</button>
        <a href="{{route('Create')}}" class="btn btn-success">Create</a>
    </div>
    <div class="row justify-content-center mt-5" id="msg-content">
        <div class="col-md-8">
            @if ($message = Session::get('success'))
                <div class="alert alert-success d-flex justify-content-between">
                    <p>{{ $message }}</p>
                    <button class="closeBtn" id="closeBtn">X</button>
                </div>
            @endif             
        </div>    
    </div>
    @php
        $movie_name = isset($_GET['movie_name']) && $_GET['movie_name'] != '' ? $_GET['movie_name'] : '';
    @endphp
    <div class="@if($movie_name != '') pt-3 @else displayNone @endif" id="searchDiv">
        <form action="{{route('search')}}" method="GET">
            <div class="mb-3">
                <label for="">Search Movie Name</label>
                <input type="text" name="movie_name" id="movie_name" value="{{$movie_name}}" required/>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="{{route('index')}}" class="btn btn-warning">Reset</a>
            </div>
        </form>
    </div>
    <div class="p-2">
        <table class="table table-success table-striped text-center">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Movie ID</th>
                <th scope="col">Movie Name</th>
                <th scope="col">Created By</th>
                <th scope="col">View</th>
                <th scope="col">Like/Unlike</th>
                </tr>
            </thead>
            <tbody>
                @if(count($movie_list) == 0)
                    <tr>
                        <td colspan="6" class="text-center">No Record Found (<a href="{{ route('Create') }}">Add Details</a>)</td>
                    </tr>
                @else
                    @foreach($movie_list as $data)
                        <tr>
                            <th scope="row">{{$data->id}}</th>
                            <td>{{$data->movie_id}}</td>
                            <td>{{$data->name}}</td>
                            @php
                                $user = \App\Models\User::where('id', $data->user_id)->first();
                                $user_name = is_object($user) ? $user->name : '---';
                            @endphp
                            <td>{{$user_name}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('viewMovie', $data->id) }}" class="btn btn-danger btn-sm">View</a>
                                </div>
                            </td>
                            <td>
                                @php
                                        $login_id =  Auth::user()->id;
                                        $liked = \App\Models\LikedList::where('user_id', $login_id)->where('movie_id', $data->id)->first();
                                    @endphp
                                    @if(is_object($liked))
                                        <div class="ms-2">
                                            <form action="{{ route('unlikeMovie') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="movie_id" id="movie_id" value="{{$data->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm">Un-Like</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="ms-2">
                                            <form action="{{ route('likeMovie') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="movie_id" id="movie_id" value="{{$data->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm">Like</button>
                                            </form>
                                        </div>
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
