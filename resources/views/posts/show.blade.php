<x-layout>
    <x-slot name="title">
        もんたの森 -{{$post->title}}-
    </x-slot>

    <div>
        &laquo;<a href="{{route('posts.index')}}">back</a>
    </div>
    <h1>
        <span>No.{{$post->id}} {{$post->title}}</span>
        <a href="{{route('posts.edit', $post)}}">[編集]</a>
        <form method="post" action="{{route('posts.destroy', $post)}}" id="delete_post">
            @method('DELETE')
            @csrf
            <button class="button">[削除]</button>
        </form>
    </h1>
    <div class="show_picture">
        <img src="{{asset('storage/' . $post->image)}}">
    </div>
    <div class="show-text-div"><p class="show-text">{!! nl2br(e($post->body)) !!}</p></div>
</x-layout>

<script>
    'use strict';

    {
        document.getElementById('delete_post').addEventListener('submit' , e => {
            e.preventDefault();

            if(!confirm('本当に削除しますか？')){
                return;
            }

            e.target.submit();
        });
    }
</script>
