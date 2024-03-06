<x-app-layout>
    <div class="container p-5">
    <h3 class="text-2xl mb-5">글목록</h3>
    @foreach($articles->all() as $data)
        <div class="background-white border rounded mb-3 p-3">
            <p>no.{{ $loop->iteration }}</p>
            <p><a href="{{ route('article.show', ['id'=>$data->id]) }}">{{$data->content }}</a></p>
            <!--<p>{{ $data->created_at }}</p>-->
            <p>{{ $data->created_at->diffForHumans() }}</p>
            <p>{{ $data->user->name }}
            <div class="flex flex-row">
                @can('update',$data)
                <p>
                    <a href="{{ route('article.edit', ['id'=>$data->id]) }}" class="button rounded bg-blue-500 px-2 py-1 text-xs text-white">수정하기</a>
                </p>
                @endcan
                @can('delete',$data)
                <form action="{{ route('article.delete', ['id' => $data->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="py-1 px-2 bg-black text-white text-xs rounded">삭제하기</button>
                </form>
                @endcan
            </div>
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
</x-app-layout>