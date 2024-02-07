@extends('auth.layouts')

@section('content')
<div class="container p-3">
    <div class="d-flex justify-content-between">
        <h4>Liked Movie List</h4>
        <a href="{{route('index')}}" class="btn btn-warning">Back</a>
    </div>
    <div class="p-2">
        <table class="table table-success table-striped text-center">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Movie ID</th>
                <th scope="col">Movie Name</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($list) == 0)
                    <tr>
                        <td colspan="4" class="text-center">No Record Found</td>
                    </tr>
                @else
                    @foreach($list as $key => $data)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$data->movie_id}}</td>
                            <td>{{$data->name}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <div class="ms-2">
                                        <form action="{{ route('unlikeMovie') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" id="user_id" value="{{$data->user_id}}">
                                            <input type="hidden" name="movie_id" id="movie_id" value="{{$data->id}}">
                                            <button type="submit" class="btn btn-danger btn-sm">Un-Like</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
