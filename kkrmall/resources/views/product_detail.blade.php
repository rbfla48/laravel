<x-userBasic-layout>
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">


                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="{{ $product->content }}"/>
                </div>


                <div class="col-md-6">
                    <div class="small mb-1">침실>침대</div>
                    <h1 class="display-5 fw-bolder mb-3">{{ $product->product_name }}</h1>
                    <hr>
                    <div class="fs-4 mt-2">
                        <span class="text-decoration-line-through">&#x20a9; {{ number_format($product->normal) }}</span>
                        <p><span class="text-danger me-3">{{ $product->discount }}%</span>&#x20a9; {{ number_format($product->price) }}</p>
                        <p>
                            <div class="d-flex small text-warning mb-2 mt-2">
                                <div class="bi--star-fill"></div>
                                <div class="bi--star"></div>
                                <div class="bi--star"></div>
                                <div class="bi--star"></div>
                                <div class="bi--star"></div>
                            </div>
                        </p>
                    </div>
                    <hr>
                    <div class="row d-flex mt-2">
                        <p>{{ $product->discription }}</p>
                        <p class="mt-2"><span class="lead me-5">배송비</span>
                            @if($product->delivery == 0)
                                무료배송
                            @else
                                &#x20a9;{{ number_format($product->delivery) }}
                            @endif
                        </p>
                    </div>
                    <div class="d-flex mt-5">
                        <select class="form-select" id="option_no" name="option_no" aria-label="Default select example" data-url="{{ route('getOptionPrice') }}">
                            <option value="">--옵션선택--</option>
                            @foreach($option as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} (+{{ $item->add_price }} )</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fs-3 mt-3">
                        <p><span id='view_total_price'></span></p>
                    </div>
                    <div class="col-4 d-flex mt-3 justify-content-between mt-3">
                        <div class="text-center">
                            <a class="btn btn-light mt-auto" href="#">장바구니</a>
                        </div>
                        <div class="text-center">
                            <input type="button" class="btn btn-light mt-auto" id="btn-payment" value="구매하기">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Fancy Product</h5>
                                <!-- Product price-->
                                $40.00 - $80.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                        </div>
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Special Item</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">$20.00</span>
                                $18.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                        </div>
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Sale Item</h5>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">$50.00</span>
                                $25.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">Popular Item</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                $40.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--결제정보-->
    <form method="POST" id="paymrnt_info" name="payment_info" action="{{ route('paymentReady')}}">
        <input type="hidden" id="product_no" name="product_no" value="{{ $product->id }}">
        <input type="hidden" id="option_id" name="option_id" value="">
        <input type="hidden" id="total_price" name="total_price" value="">
    </form>

    <script>
        $(document).ready(function () {
            $('#option_no').change(function () {
                var product_no = $("#product_no").val();
                var option_no = $("#option_no").val();
                var total_price = 0;

                var formData = new FormData();
                formData.append('product_no', product_no);
                formData.append('option_no', option_no);

                if (product_no == '' || option_no == '') {
                    console.log("빈값있음!");
                    return false;
                }
                //console.log("Ajax 요청");

                var url = $(this).data('url');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: url,
                    dataType: 'json',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log('ajax통신종료');
                        console.log(data.price);
                        console.log(data.add_price);
                        total_price = data.price + data.add_price;
                        $('#view_total_price').text("₩ " + total_price.toLocaleString('ko-KR'));
                        $('#option_id').val(data.option_id);
                        $('#total_price').val(total_price);
                    },
                    error: function (xhr, status, error) {
                        console.log("에러: " + error);
                    }
                });
            });

            //post페이지이동
            $("#btn-payment").click(function(){
                var product_no = $("#product_no").val();
                var option_id = $("#option_id").val();
                var total_price = $("#total_price").val();

                // 새로운 form 엘리먼트 생성
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('paymentReady') }}";

                // CSRF 토큰을 추가
                var csrfTokenInput = document.createElement('input');
                csrfTokenInput.type = 'hidden';
                csrfTokenInput.name = '_token';
                csrfTokenInput.value = "{{ csrf_token() }}";
                form.appendChild(csrfTokenInput);

                // 필요한 input 엘리먼트들 생성하여 form에 추가
                var productNoInput = document.createElement('input');
                productNoInput.type = 'hidden';
                productNoInput.name = 'product_no';
                productNoInput.value = product_no;
                form.appendChild(productNoInput);

                var optionIdInput = document.createElement('input');
                optionIdInput.type = 'hidden';
                optionIdInput.name = 'option_id';
                optionIdInput.value = option_id;
                form.appendChild(optionIdInput);

                var totalPriceInput = document.createElement('input');
                totalPriceInput.type = 'hidden';
                totalPriceInput.name = 'total_price';
                totalPriceInput.value = total_price;
                form.appendChild(totalPriceInput);

                // form을 body에 추가하고 submit
                document.body.appendChild(form);
                form.submit();
            });



        });

    </script>
</x-userBasic-layout>
