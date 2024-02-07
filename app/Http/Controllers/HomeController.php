<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovieList;
use App\Models\LikedList;

class HomeController extends Controller
{
    public function index(Request $request){
        $input = $request->all();
        $movie_list = MovieList::get();
        return view('index', compact('movie_list'));
    }

    public function search(Request $request){
        $input = $request->all();
        $query = $input['movie_name'];
        $movie_list = MovieList::where('name', 'like', "%$query%")->get();
        return view('index', compact('movie_list'));
    }

    public function viewMovie($id){
        $movie = MovieList::where('id', $id)->first();
        return view('view_movie', compact('movie'));
    }

    public function likedList($id){
        $list = LikedList::join('movie_lists', 'liked_lists.movie_id', '=', 'movie_lists.id')->where('liked_lists.user_id', $id)->get();
        return view('listed_like', compact('list'));
    }

    public function likeMovie(Request $request){
        $input = $request->all();
        LikedList::create($input);
        return redirect()->route('index')->withSuccess('Liked Successfully');
    }

    public function unlikeMovie(Request $request){
        $input = $request->all();
        LikedList::where('user_id', $input['user_id'])->where('movie_id', $input['movie_id'])->delete();
        return redirect()->route('index')->withSuccess('Unlike Successfully');
    }

    public function create(Request $request){
        return view('create');
    }

    public function save(Request $request){
        $input = $request->all();
        MovieList::create($input);
        return response()->json(['message' => 'Data saved successfully']);
    }
}
