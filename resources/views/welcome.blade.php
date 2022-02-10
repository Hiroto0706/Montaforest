<x-layout>
    <x-slot name="title">
        もんたの森
    </x-slot>
    <h1>
        <span>もんたの森へようこそ！！</span>
        <a href="{{route('posts.create')}}">[追加]</a>
    </h1>
    <ul>
        @forelse ($posts as $post)
            <li>
                No.{{$post->id}}
                <a href="{{route('posts.show', $post)}}">
                    {{$post->title}}
                </a>
                <div class="tags">
                    tag：
                    @foreach ($post->tags as $tag)
                    <a href="">#{{$tag->tag_name}}</a>
                @endforeach
                </div>
                <div class="welcome_pic">
                    <img src="{{asset('storage/' . $post->image)}}">
                </div>
            </li>
        @empty
            <li>データありまへんわ！</li>
        @endforelse
    </ul>
</x-layout>
