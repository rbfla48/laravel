<x-admin-layout>
    <body class="sb-nav-fixed">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-4">주문관리</h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">주문관리>주문내역</li>
                </ol>
                <div class="card mb-4">
                    <form method="GET" action="{{ route('admin.orderList')}}">
                    <div class="card-header d-flex justify-content-around">
                        <div>
                            <label for="order_no" class="form-label">주문번호</label>
                            <input class="form-control" type="text" name="order_no" id="order_no" value={{ $order_no }}>
                        </div>
                        <div>
                            <label for="user_name" class="form-label">구매자명</label>
                            <input class="form-control" type="text" name="user_name" id="user_name" value={{ $user_name }}>
                        </div>
                        <div>
                            <label for="order_sdate" class="form-label">구매일자</label>
                            <div class="d-flex flex-row mb-3 justify-content-between">
                                <input class="form-control datepicker" type="text" name="order_sdate" id="order_sdate" value={{ $order_sdate }}>
                                <span>~</span>
                                <input class="form-control datepicker" type="text" name="order_edate" id="order_edate" value={{ $order_edate }}>

                                <input class="btn btn-warning form-control" type="submit" name="search_btn" id="search_btn" value="조회">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>주문번호</th>
                                    <th>구매자</th>
                                    <th>상품명</th>
                                    <th>수량</th>
                                    <th>주문일시</th>
                                    <th>상태</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>no</th>
                                    <th>주문번호</th>
                                    <th>구매자</th>
                                    <th>상품명</th>
                                    <th>수량</th>
                                    <th>주문일시</th>
                                    <th>상태</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <blade>
                                    @foreach($data as $list)
                                    <tr>
                                        <td>{{ $list->id }}</td>
                                        <td>{{ $list->order_no }}</td>
                                        <td>{{ $list->username }}</td>
                                        <td>{{ $list->product_name }}</td>
                                        <td>{{ $list->pcount }}</td>
                                        <td>{{ $list->order_date }}</td>
                                        <td>
                                            @switch($list->code)
                                            @case(0) 
                                                <button type="button" class="btn btn-primary">{{ $list->status }}</button>
                                                @break
                                            @case(10) 
                                                <button type="button" class="btn btn-primary">{{ $list->status }}</button>
                                                @break
                                            @case(11) 
                                                <button type="button" class="btn btn-success">{{ $list->status }}</button>
                                                @break
                                            @case(30) 
                                                <button type="button" class="btn btn-warning">{{ $list->status }}</button>
                                                @break
                                            @case(31) 
                                                <button type="button" class="btn btn-danger">{{ $list->status }}</button>
                                                @break
                                            @case(40) 
                                                <button type="button" class="btn btn-warning">{{ $list->status }}</button>
                                                @break
                                            @case(41) 
                                                <button type="button" class="btn btn-danger">{{ $list->status }}</button>
                                                @break
                                            @default
                                                <button type="button" class="btn btnprimary">오류상태</button>
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
