<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieList extends Model
{
    use HasFactory;
    protected $fillable = [
      'movie_id',
      'name',
      'description',
      'user_id'
    ];
}
