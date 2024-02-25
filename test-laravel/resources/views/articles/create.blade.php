<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기페이지</title>
</head>
<body class="bg-blue-300">
    <div class="container p-5">
    <h3 class="text-2xl">글쓰기</h3>
        <form action="{{ route('article.save') }}" method="post">
            <!--CSRF공격방지기능이 있어 요청시 토큰값을 넘겨주어야함-->
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
            <!--OR-->
            <!--@csrf-->
            <input type="text" name="content" class="block w-full mb-2 rounded" value="{{old('content')}}">
            <button class="py-1 px-3 bg-black text-white text-xs rounded">저장하기</button>
        </form>
        <br/>
        <!--dd(die dump) -> Laravel의 기본함수, 컬렉션의 아이템을 덤프하여 표시하고 스크립트를 종료-->
        @if ($errors->any())
            @foreach($errors->all() as $error)
                <li class="text-xs text-red-500 mb-3">{{$error}}</li>
            @endforeach
        @endif
    </div>
</body>
</html>