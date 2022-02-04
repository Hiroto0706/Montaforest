<x-layout>
    <x-slot name="title">
        もんたの森
    </x-slot>

    <h1>もんたの森へようこそ！！</h1>
    <ul>
        @forelse ($posts as $post)
            <li>
                <a href="{{route('posts.show', $post)}}">
                    {{$post->title}}
                </a>
            </li>
        @empty
            <li>データありまへんわ！</li>
        @endforelse
    </ul>
</x-layout>
