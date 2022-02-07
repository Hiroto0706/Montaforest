<x-layout>
    <x-slot name="title">
        もんたの森 - {{$post->title}}の編集 -
    </x-slot>

    <div>
        &laquo;<a href="{{route('posts.show' ,$post)}}">back</a>
    </div>
    <h1>{{$post->title}}を編集する</h1>

    <form method="post" enctype="multipart/form-data" action="{{route('posts.update', $post)}}">
        @method('PATCH')
        @csrf

        <div class="form-group">
            <label>
                画像のタイトル
                <input type="text" name="title" value="{{old('title', $post->title)}}">
            </label>
            @error('title')
                <div class="error">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>
                現在の画像
                <div class="show_picture">
                    <img src="{{asset('storage/' . $post->image)}}">
                </div>
                画像ファイル
                <input type="file" name="image" accept="image/png, image/jgep, image/jpg">
            </label>
        </div>
        <div class="form-group">
            <label>
                画像の詳細
                <textarea name="body">{{old('body',$post->body)}}</textarea>
            </label>
            @error('body')
                <div class="error">{{$message}}</div>
            @enderror
        </div>
        <div class="form-button">
            <button>アップデートする</button>
        </div>
    </form>
</x-layout>
