<x-layout>
    <x-slot name="title">
        もんたの森 -{{$post->title}}-
    </x-slot>

    <div>
        &laquo;<a href="{{route('posts.index')}}">back</a>
    </div>
    <h1>{{$post->title}}</h1>
    <div>
        <img src="{{ asset('storage/' . $post->image) }}">
    </div>
    <p>{{$post->body}}</p>
</x-layout>
