<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{url('css/index.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}">
</head>
<body>
    <img src="{{asset('img/frontmonta.png')}}" class="front_pic">
    <div class="container">
       {{$slot}}
    </div>
    <footer>
        <div class="fotter_p">
            <p>もんたの森</p>
        </div>
    </footer>
</body>
</html>
