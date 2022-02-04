<x-layout>
    <x-slot name="title">
        もんたの森 - 新しい投稿 -
    </x-slot>

    <div>
        &laquo;<a href="{{route('posts.index')}}">back</a>
    </div>
    <h1>新しく画像をアップロードする</h1>

    <form method="post" enctype="multipart/form-data" action="">
        <label>
            画像のタイトル
            <input type="text" name="title">
        </label>
        <label>
            画像ファイル
            <input type="file" name="imgpath">
        </label>
        <label>
            画像の詳細
            <textarea name="body"></textarea>
        </label>
        <button>アップロードする</button>
    </form>
</x-layout>
