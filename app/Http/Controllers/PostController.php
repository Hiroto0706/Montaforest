<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
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

        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->body, $match);
        $tags = [];

        foreach($match[1] as $tag){
            $found = Tag::firstOrCreate(['tag_name' => $tag]);

            array_push($tags, $found);
        }

        $tag_ids = [];
        foreach($tags as $tag){
            $found = Tag::firstOrCreate(['tag_name' => $tag]);

            array_push($tag_ids, $tag['id']);
        }

        $post->save();
        $post->tags()->attach($tag_ids);

        return redirect()
            ->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit')
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

        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->body, $match);
        $tags = [];

        foreach($match[1] as $tag){
            $found = Tag::firstOrCreate(['tag_name' => $tag]);

            array_push($tags, $found);
        }

        $tag_ids = [];
        foreach($tags as $tag){
            $found = Tag::firstOrCreate(['tag_name' => $tag]);

            array_push($tag_ids, $tag['id']);
        }


        $post->save();
        $post->tags()->sync($tag_ids);


        return redirect()
            ->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('posts.index');
    }

    public function kensaku(Request $request)
    {
        $keyword = $request->kensaku;
        $query = Post::query();
        $posts = Post::whereHas('tags', function ($query) use ($keyword) {
            $query->where('tag_name', 'LIKE', "%{$keyword}%");
        })->latest()->get();
        return view("welcome", ["posts" => $posts]);
    }

}
