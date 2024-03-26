<x-admin-layout>

    <body class="sb-nav-fixed">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-4">주문관리</h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">주문관리>주문상세</li>
                </ol>
                <div class="row g-5">
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">[주문번호]주문내역</h4>
                        <form class="needs-validation" novalidate>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">구매자</label>
                                    <input type="text" class="form-control" name="user_name" id="user_name" value="{{ $data[0]->user_name }}">
                                </div>
                                <div class="col-sm-6">
                                    @switch($data[0]->order_status)
                                    @case(0) 
                                        <button type="button" class="btn btn-primary">{{ $data[0]->status }}</button>
                                        @break
                                    @case(10) 
                                        <button type="button" class="btn btn-primary">{{ $data[0]->status }}</button>
                                        @break
                                    @case(11) 
                                        <button type="button" class="btn btn-success">{{ $data[0]->status }}</button>
                                        @break
                                    @case(30) 
                                        <button type="button" class="btn btn-warning">{{ $data[0]->status }}</button>
                                        @break
                                    @case(31) 
                                        <button type="button" class="btn btn-danger">{{ $data[0]->status }}</button>
                                        @break
                                    @case(40) 
                                        <button type="button" class="btn btn-warning">{{ $data[0]->status }}</button>
                                        @break
                                    @case(41) 
                                        <button type="button" class="btn btn-danger">{{ $data[0]->status }}</button>
                                        @break
                                    @default
                                        <button type="button" class="btn btnprimary">오류상태</button>
                                        @break
                                    @endswitch
                                </div>

                                <div class="col-sm-6">
                                    <label for="phone" class="form-label">연락처1</label>
                                    <input type="text" class="form-control" id="user_phone" name="user_phone"  value="{{ $data[0]->user_phone }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="user_email" class="form-label">이메일(ID)</label>
                                    <input type="text" class="form-control" id="user_email" name="user_email" value="{{ $data[0]->user_email }}">
                                </div>

                                <div class="col-sm-3">
                                    <label for="zip_code" class="form-label">우편번호</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $data[0]->zip_code }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="address" class="form-label">기본주소</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $data[0]->address }}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="address_detail" class="form-label">상세주소</label>
                                    <input type="text" class="form-control" id="address_detail" name="address_detail" value="{{ $data[0]->address_detail }}">
                                </div>

                                <div class="col-12">
                                    <label for="product_name" class="form-label">구매상품</label>
                                    @foreach($data as $item)
                                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $item->product_name }}">
                                        <input type="text" class="form-control" id="product_normal" name="product_normal" value="{{ $item->product_normal }} 원">
                                    @endforeach
                                    <pre>상품금액, 선택옵션, 구매일, 가격</pre>
                                </div>

                                <div class="col-12">
                                    <label for="address2" class="form-label">결제정보</label>
                                    <input type="text" class="form-control" id="address2" placeholder="">
                                    <pre>결제정보(카드번호, 결제시각, 결젝수단, 결제여부, 등등)</pre>
                                </div>

                                <div class="col-md-5">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country" required>
                                        <option value="">Choose...</option>
                                        <option>United States</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" id="state" required>
                                        <option value="">Choose...</option>
                                        <option>California</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zip" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="same-address">
                                <label class="form-check-label" for="same-address">Shipping address is the same as my
                                    billing address</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="save-info">
                                <label class="form-check-label" for="save-info">Save this information for next
                                    time</label>
                            </div>

                            <hr class="my-4">

                            <h4 class="mb-3">Payment</h4>

                            <div class="my-3">
                                <div class="form-check">
                                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input"
                                        checked required>
                                    <label class="form-check-label" for="credit">Credit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="debit" name="paymentMethod" type="radio" class="form-check-input"
                                        required>
                                    <label class="form-check-label" for="debit">Debit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="paypal" name="paymentMethod" type="radio" class="form-check-input"
                                        required>
                                    <label class="form-check-label" for="paypal">PayPal</label>
                                </div>
                            </div>

                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label for="cc-name" class="form-label">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                    <small class="text-body-secondary">Full name as displayed on card</small>
                                    <div class="invalid-feedback">
                                        Name on card is required
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="cc-number" class="form-label">Credit card number</label>
                                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Credit card number is required
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-expiration" class="form-label">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Expiration date required
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Security code required
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                        </form>
                    </div>
                </div>
        </main>
    </body>

</x-admin-layout>
