<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts = [
        'ニーナのPC用壁紙',
        'ニーナのスマホ用壁紙',
        'ニーナのアイコン用壁紙',
        'ニーナのロック画面用壁紙',
    ];

    public function index()
    {
        return view('welcome')
        ->with(['posts' => $this->posts]);
    }

    public function show($id)
    {
        return view('posts.show')
            ->with(['post' => $this->posts[$id]]);
    }
}
