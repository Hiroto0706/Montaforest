<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Post -> postsテーブルに紐づいている
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image'
    ];
}
