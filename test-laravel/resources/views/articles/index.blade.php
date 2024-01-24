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
            <p>{{ $data->content }}</p>
            <!--<p>{{ $data->created_at }}</p>-->
            <p>{{ $data->created_at->diffForHumans() }}</p>
            <p>{{ $data->user->name }}
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