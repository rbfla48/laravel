<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글내용</title>
</head>
<body class="bg-blue-300">
    <div class="container p-5">
    <h3 class="text-2xl mb-5">글 수정하기</h3>
    <form action="{{ route('article.update', ['id' => $data->id] ) }}" method="post">
        @csrf
        @method('patch')
        <input type="text" name="content" class="block w-full mb-2 rounded" value="{{old('content') ?? $data->content}}">
        <button class="py-1 px-3 bg-black text-white text-xs rounded">수정하기</button>
    </form>
    </div>
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <li class="text-xs text-red-500 mb-3">{{$error}}</li>
        @endforeach
    @endif
</body>
</html>