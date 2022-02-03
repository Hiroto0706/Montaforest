<x-layout>
    <x-slot name="title">
        もんたの森 -{{$post}}-
    </x-slot>

    <div>
        &laquo;<a href="{{route('posts.index')}}">back</a>
    </div>
    <h1>{{$post}}</h1>
</x-layout>
