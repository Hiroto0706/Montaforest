<x-layout>
    <x-slot name="title">
        もんたの森
    </x-slot>
    <h1>
        <span>もんたの森へようこそ！！</span>
        <a href="{{route('posts.create')}}">[追加]</a>
    </h1>
    <div class="kensaku-div">
        <form action="{{url('/kensaku')}}" method="GET">
            <label for="">
                タグで検索
                <input type="text"  name="kensaku" class="kensaku-form">
                <input type="submit" value="検索" class="kensaku-btn">
            </label>
        </form>
    </div>
    <div class="show-all-div">
        <form action="{{url('/showall')}}" method="GET">
            <input class="all-show" type="submit" value="全て表示">
        </form>
    </div>
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
