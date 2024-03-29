<x-userBasic-layout>

<body>
    <!--
    <div class="container">
        <div class="row border p-2 gap-3">
            <div class="col-md-2">
                <img src="{{ $data->content }}" alt="Product Image" class="product-img">
            </div>
            <div class="col-md-6">
                <h2>{{ $data->product_name }}</h2>
                <p class="text-muted">{{ $data->option_name }}</p>
                <h3 class="text-muted">수량 : 1</h3>
                <h3 class="text-muted">
                    <span class="text-decoration-line-through">&#x20a9; {{ number_format($data->normal) }}</span>
                    <span class="text-danger me-3">{{ $data->discount }}%</span>&#x20a9; {{ number_format($data->price) }}
                </h3>
                <h3 class="text-success">배송정보: 예상 배송일 : {{ $service_date->format('Y-m-d') }}</h3>
            </div>
        </div>
    -->
        <div class="order-summary mt-5">
            <h2 class="mb-4 fs-5 text-center">CART</h2>
            <table class="table fs-8 mt-3">
                <thead>
                    <tr>
                        <th scope="col 25%"></th>
                        <th scope="col" colspan="3">상품정보</th>
                        <th scope="col" class="text-center">금액</th>
                        <th scope="col" class="text-center">적립금</th>
                        <th scope="col" class="text-center">배송</th>
                        <th scope="col" class="text-center">주문</th>
                    </tr>
                </thead>
                <tbody tbody class="table-group-divider align-middle table-layout:fixed">
                    <tr>
                        <td class="text-center"><input type="checkbox"></td>
                        <td colspan="2">{{ $data->product_name }}<br/>{{ $data->option_name }}</td>
                        <td style="width: 6rem;"><img src="{{ $data->content }}" class="img-fluid img-thumbnail"></td>
                        <td class="text-center">&#x20a9;{{ number_format($data->total_price) }}<br/>1</td>
                        <td class="text-center">&#x20a9;{{ number_format(round($data->price / 100) * 2) }}</td>
                        <td class="text-center">무료배송</td>
                        <td class="text-center">
                            <input type="button" class="btn btn-light" value="주문하기"><br/>
                            <input type="button" class="btn btn-light mt-2" value="삭제하기">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="order-summary mt-5">
            <table class="table col-sm-6 fs-6 mt-3 text-center" style="min-height:150px">
                <thead>
                    <tr>
                        <th scope="col">총 주문금액</th>
                        <th></th>
                        <th scope="col">총 배송비</th>
                        <th></th>
                        <th scope="col">총 결제금액</th>
                    </tr>
                </thead>
                <tbody tbody class="table-group-divider align-middle table-layout:fixed">
                    <tr>
                        <td>&#x20a9;{{ number_format($data->total_price) }}</td>
                        <td>+</td>
                        <td>&#x20a9;0</td>
                        <td>=</td>
                        <td>&#x20a9;{{ number_format($data->total_price) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-grid gap-2 col-4 mx-auto text-center mt-5">
            <form action="{{ route('paymentCheckout') }}"  method="post">
                @csrf
                <input type="hidden" name="id" value="{{$data->id}}">
                <input type="submit" class="btn btn-dark bg-dark text-white" value="주문하기">
            </form>
        </div>
    </div>
</x-userBasic-layout>