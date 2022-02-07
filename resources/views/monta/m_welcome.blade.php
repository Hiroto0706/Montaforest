<x-layout>
    <x-slot name="title">
        もんたの森  - もんた様ページ -
    </x-slot>
    <h1>
        <span>もんた専用ページ</span>
        <a href="{{route('monta.create')}}">[Add]</a>
    </h1>
    <ul>
        @forelse ($posts as $post)
            <li>
                <a href="{{route('monta.show', $post)}}">
                    {{$post->title}}
                </a>
                <div class="welcome_pic">
                    <img src="{{asset('storage/' . $post->image)}}">
                </div>
            </li>
        @empty
            <li>データありまへんわ！</li>
        @endforelse
    </ul>
</x-layout>
