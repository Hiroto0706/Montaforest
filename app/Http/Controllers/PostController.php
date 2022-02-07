<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use InterventionImage;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return view('welcome')
        ->with(['posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('posts.show')
            ->with(['post' => $post]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'body' => 'required',
            'image' => 'required',
        ],[
            'title.required' => 'タイトルがありません',
            'title.min' => 'min 文字以上入力してください',
            'body.required' => '本文がありません',
            'image.required' => 'アップロードする画像を選択してください',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $request->image;

        $file = $request->file('image');
        $resized = InterventionImage::make($file)->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save();

        //画像の保存
        Storage::put('public/' . $post->image, $resized);

        $post->save();

        return redirect()
            ->route('posts.index');
    }
}
