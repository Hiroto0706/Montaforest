<x-layout>
    <x-slot name="title">
        もんたの森 -{{$post->title}}-
    </x-slot>

    <div>
        &laquo;<a href="{{route('posts.index')}}">back</a>
    </div>
    <h1>
        <span>{{$post->title}}</span>
        <a href="{{route('posts.edit', $post)}}">[編集する]</a>
    </h1>
    <div class="show_picture">
        <img src="{{asset('storage/' . $post->image)}}">
    </div>
    <p>{!! nl2br(e($post->body)) !!}</p>
</x-layout>
