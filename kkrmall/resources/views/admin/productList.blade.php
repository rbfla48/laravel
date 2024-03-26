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
                                                <button type="button" class="btn btn-primary">판매중</button>
                                                @break
                                            @case('N') 
                                                <button type="button" class="btn btn-danger">판매종료</button>
                                                @break
                                            @default
                                                <button type="button" class="btn btnprimary">Error</button>
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
    <script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "ko",
            prevText: '이전 달',
            nextText: '다음 달',
            monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
            dayNames: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
            showMonthAfterYear: true,
            yearSuffix: '년',
            autoclose: true,
            templates: {
                leftArrow: '&laquo;',
                rightArrow: '&raquo;',
            }, //다음달 이전달로 넘어가는 화살표 모양 커스텀 마이징
         todayHighlight: true, //오늘 날짜에 하이라이팅 기능 기본값 :false
        })
    });
    </script>
</x-admin-layout>
