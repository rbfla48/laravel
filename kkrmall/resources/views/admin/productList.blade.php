<x-admin-layout>
    <body class="sb-nav-fixed">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-4">상품관리</h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">상품관리>상품내역</li>
                </ol>
                <div class="card mb-4">
                    <form method="GET" action="{{ route('admin.productList')}}">
                    <div class="card-header d-flex justify-content-around">
                        <div>
                            <label for="product_id" class="form-label">상품번호</label>
                            <input class="form-control" type="text" name="product_id" id="product_id" value={{ $product_id }}>
                        </div>
                        <div>
                            <label for="product_name" class="form-label">상품명</label>
                            <input class="form-control" type="text" name="product_name" id="product_name" value={{ $product_name }}>
                        </div>
                        <div>
                            <label for="start_date" class="form-label">판매기간</label>
                            <div class="d-flex flex-row mb-3 justify-content-between">
                                <input class="form-control datepicker" type="text" name="start_date" id="start_date" value={{ $start_date }}>
                                <span>~</span>
                                <input class="form-control datepicker" type="text" name="end_date" id="end_date" value={{ $end_date }}>

                                <input class="btn btn-warning form-control" type="submit" name="search_btn" id="search_btn" value="조회">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>상품명</th>
                                    <th>판매기간</th>
                                    <th>정상가</th>
                                    <th>판매가</th>
                                    <th>판매상태</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>no</th>
                                    <th>상품명</th>
                                    <th>판매기간</th>
                                    <th>정상가</th>
                                    <th>판매가</th>
                                    <th>판매상태</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <blade>
                                    @foreach($data as $list)
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->sdate }} ~ {{ $list->edate }}</td>
                                        <td>{{ $list->normal }}</td>
                                        <td>{{ $list->price }}</td>
                                        <td>
                                            @switch($list->active)
                                            @case('Y') 
                                                <a class="btn btn-primary" href="{{ route('admin.productManage',['id'=>$list->id]) }}">판매중</a>
                                                @break
                                            @case('N') 
                                                <a class="btn btn-danger" href="{{ route('admin.productManage',['id'=>$list->id]) }}">판매종료</a>
                                                @break
                                            @default
                                                <a class="btn btnprimary" href="{{ route('admin.productManage',['id'=>$list->id]) }}">확인필요</a>
                                                @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $data->onEachSide(3)->links() }}
                    </div>
                </div>
            </div>
        </main>
    </body>
</x-admin-layout>
