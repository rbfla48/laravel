<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글목록</title>
</head>
<body class="bg-blue-300">
    <div class="container p-5">
    <h3 class="text-2xl mb-5">글목록</h3>
    @foreach($articles->all() as $data)
        <div class="background-white border rounded mb-3 p-3">
            <p>no.{{ $loop->iteration }}</p>
            <p><a href="{{ route('article.show', ['id'=>$data->id]) }}">{{$data->content }}</a></p>
            <!--<p>{{ $data->created_at }}</p>-->
            <p>{{ $data->created_at->diffForHumans() }}</p>
            <p>{{ $data->user->name }}
            <p class="mt-2">
                <a href="{{ route('article.edit', ['id'=>$data->id]) }}" class="button rounded bg-blue-500 px-2 py-1 text-xs text-white">수정하기</a>
            </p>
        </div>
    @endforeach
    </div>

    <!--<ul>
        @for($i=0 ; $i < $totalCount/$perPage ; $i++)
            <li><a href="/articles?page={{$i+1}}&perPage={{$perPage}}">{{$i+1}}</a></li>
        @endfor
    </ul>-->
    <div class="container p-5">
        {{ $articles->links() }}
    </div>
</body>
</html>