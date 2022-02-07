<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use InterventionImage;

class MontaController extends Controller
{
    public function mondex()
    {
        $posts = Post::latest()->get();

        return view('monta.m_welcome')
        ->with(['posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('monta.posts.show')
            ->with(['post' => $post]);
    }

    public function create(){
        return view('monta.posts.create');
    }

    public function store(PostRequest $request)
    {
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
            ->route('monta.mondex');
    }

    public function edit(Post $post)
    {
        return view('monta.posts.edit')
            ->with(['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|min:3',
            'body' => 'required',
        ],[
            'title.required' => 'タイトルがありません',
            'title.min' => ':min 文字以上入力してください',
            'body.required' => '本文がありません',
        ]);

        $post->title = $request->title;
        $post->body = $request->body;

        if($request->image != null)
        {
        $post->image = $request->image;
        $file = $request->file('image');
        $resized = InterventionImage::make($file)->resize(1920, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save();

        //画像の保存
        Storage::put('public/' . $post->image, $resized);
    }

        $post->save();

        return redirect()
            ->route('monta.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('monta.mondex');
    }
}
