<x-layout>
    <x-slot name="title">
        もんたの森 - 画像のアップロード -
    </x-slot>

    <div>
        &laquo;<a href="{{route('posts.index')}}">back</a>
    </div>
    <h1>新しく画像をアップロードする</h1>

    <form method="post" enctype="multipart/form-data" action="{{route('posts.store')}}">
        @csrf
        <div class="form-group">
            <label>
                画像のタイトル
                <input type="text" name="title" value="{{old('title')}}">
            </label>
            @error('title')
                <div class="error">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>
                画像ファイル
                <input type="file" name="image" accept="image/png, image/jgep, image/jpg">
            </label>
            @error('image')
                <div class="error">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>
                画像の詳細
                <textarea name="body">{{old('body')}}</textarea>
            </label>
            @error('body')
                <div class="error">{{$message}}</div>
            @enderror
        </div>
        <div class="form-button">
            <button>アップロードする</button>
        </div>
    </form>
</x-layout>
