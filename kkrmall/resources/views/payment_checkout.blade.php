<x-userBasic-layout>

    <div class="container mb-5">
        @auth
            <input type="hidden" id="user_id" value="{{ Auth::User()->id }}">
        @endauth

        <main>
            <form name="payForm" method="post" action="{{ route('paymentResult')}}">
            @csrf
            <div class="py-5 mb-9 text-center">
                <img class="d-block mx-auto mb-4" src="/images/kkrmall_logo.png" width="100" height="70">
                <h2 class="fs-5">ORDER</h2>
            </div>
            <div class="row g-5">
                <!--오른쪽 카트영역-->
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">주문정보</span>
                        <span class="badge bg-primary rounded-pill">1</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div style="width: 3rem;"><img src="/images/product_bed1.jpeg"
                                    class="img-fluid img-thumbnail"></div>
                            <div class="w-50">
                                <h6 class="my-0">{{ $product->name }}</h6>
                                <small class="text-body-secondary">{{ $option->name }}</small>
                            </div>
                            <span class="text-body-secondary">&#x20a9;102,000</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                            <div class="text-success">
                                <h6 class="my-0">할인</h6>
                                <small>기간할인</small>
                            </div>
                            <span class="text-success">−&#x20a9;20,000</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">배송비</h6>
                                <small class="text-body-secondary">무료배송</small>
                            </div>
                            <span class="text-body-secondary">&#x20a9;0</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between pt-3 pb-3">
                            <b>결제예정금액</b>
                            <strong>&#x20a9;82,000</strong>
                        </li>
                    </ul>

                    <div class="card d-grid gap-2 col-12 mx-auto text-center">
                        <input type="button" class="btn btn-dark bg-dark text-white" onclick="serverAuth()" value="결제하기">
                    </div>

                </div>
                <!--오른쪽 카트영역END-->

                <!--주문정보-->
                <div class="col-md-7 col-lg-8 mb-6">
                    <h4 class="mb-3">주문자 정보</h4>
                        <div class="row g-3">
                            <div class="flex justify-content-between col-9">
                                <div class="col-sm-3">
                                    <label for="username" class="form-label">받으시는분 *</label>
                                    <input type="text" class="form-control" id="username" placeholder="" value="">
                                </div>
                                <div>
                                    <input type="checkbox" class="btn-check" id="get_user_btn" autocomplete="off">
                                    <label class="btn btn-secondary" for="get_user_btn">회원정보와 동일</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">주소 *</label>
                                <div class="flex col-sm-3 mb-3">
                                    <input type="text" class="form-control me-3" id="zip_code" name="zip_code"
                                        placeholder="" value="">
                                    <input type="button" class="btn btn-light text-dark" id="btn-address" value="우편번호"
                                        onclick="daumPostcode()">
                                </div>
                                <div class="flex col-sm-9 mb-3">
                                    <input type="text" class="form-control" id="address1" name="address1"
                                        placeholder="기본주소" value="">
                                </div>
                                <div class="flex col-sm-9 mb-3">
                                    <input type="text" class="form-control" id="address2" name="address2"
                                        placeholder="나머지주소" value="">
                                </div>
                            </div>

                            <div class="col-9">
                                <label for="phone" class="form-label">연락처 *</label>
                                <div class="flex col-sm-6 mb-3">
                                    <select class="form-control" id="phone_1" name="phone[]"
                                        fw-filter="isNumber&amp;isFill">
                                        <option value="010">010</option>
                                        <option value="011">011</option>
                                        <option value="016">016</option>
                                        <option value="017">017</option>
                                        <option value="018">018</option>
                                        <option value="019">019</option>
                                    </select>
                                    <span class="mx-2 align-middle">-</span>
                                    <input class="form-control" id="phone_2" name="phone[]" maxlength="4"
                                        fw-filter="isNumber&amp;isFill" size="4" value="" type="text">
                                    <span class="mx-2 align-middle">-</span>
                                    <input class="form-control" id="phone_3" name="phone[]" maxlength="4"
                                        fw-filter="isNumber&amp;isFill" size="4" value="" type="text">
                                </div>
                            </div>

                            <div class="col-12">
                              <label for="email" class="form-label">이메일</label>
                              <div class="flex mb-3 col-sm-9">
                                <input type="text" class="form-control" id="email_1">
                                <span class="mx-2 align-middle">@</span>
                                <input type="text" class="form-control" id="email_2">
                              </div>
                            </div>
     
                            <div class="col-12">
                                <label for="meno" class="form-label">배송요청사항</label>
                                <input type="text" class="form-control" id="meno" value="">
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="use_agree">
                            <label class="form-check-label" for="use_agree">이용약관에 대하여 동의합니다.</label>
                        </div>
                        <div class="col-12 mt-3">
                          <textarea class="w-100">이용약관입니다.</textarea>
                        </div>

                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="privacy_agree">
                            <label class="form-check-label" for="privacy_agree">개인정보취급방침에 대하여 동의합니다.</label>
                        </div>
                        <div class="col-12 mt-3">
                          <textarea class="w-100">개인정보취급방침</textarea>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">결제수단</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="PayMethod" name="PayMethod" type="radio" class="form-check-input">
                                <label class="form-check-label" for="credit">신용카드</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input">
                                <label class="form-check-label" for="debit">무통장입금</label>
                            </div>
                            <div class="form-check">
                                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input">
                                <label class="form-check-label" for="naverPay">네이버페이</label>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                    </div>
                </div>
            </form>
        </main>
    </div>

    <script src="https://pay.nicepay.co.kr/v1/js/"></script> <!-- 나이스페이 결제창 JS SDK -->
    <script type="text/javascript">
    
    function serverAuth() {
        if($("#use_agree").is(":checked") == false){
            alert("이용약관에 동의해주세요.");
            return false;
        }
        if($("#privacy_agree").is(":checked") == false){
            alert("개인정보 취급방침에 동의해주세요.");
            return false;
        }

        AUTHNICE.requestPay({
            clientId: 'S2_958cdcbe24a84a13a59c0edb91263dd6',
            method: 'card',
            orderId: 'kkr'+Math.floor(Math.random()*10+1),
            amount: '{{ $product->price }}',
            goodsName: '{{ $product->name }}',
            mallReserved: 'pno:{{$product->id}},ono:{{$option->option_no}}',
            returnUrl: "{{ route('paymentResult') }}", //API를 호출할 Endpoint 입력
            fnError: function (result) {
                location.replace();
            }
        });
    }

    $(document).ready(function(){
        $("#get_user_btn").change(function(){
            if($("#get_user_btn").is(":checked")){

                var user_id = $("#user_id").val();

                if(user_id != ''){
                
                    $.ajax({
                        //아래 headers에 반드시 token을 추가해줘야 한다.!!!!! 
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'post',
                        data: {user_id:user_id},
                        url: "{{ route('getUserInfo') }}",
                        success: function(data) {
                                console.log(data);
                                $('#username').val(data.name);
                                $('#zip_code').val(data.zip_code);
                                $('#address1').val(data.address);
                                $('#address2').val(data.address_detail);
                                $('#phone_2').val(data.phone.substr(3, 4));
                                $('#phone_3').val(data.phone.substr(7, 4));
                                $('#email_1').val(data.email.substr(0, data.email.indexOf('@')));
                                $('#email_2').val(data.email.substr(data.email.indexOf('@')+1));
                        },
                        error: function(data) {
                                console.log("error" +data);
                        }
                    });

                }else{
                    alert("로그인후 가능합니다!");
                    return false;
                }
            }else{
                $('#username').val('');
                $('#zip_code').val('');
                $('#address1').val('');
                $('#address2').val('');
                $('#phone_2').val('');
                $('#phone_3').val('');
                $('#email_1').val('');
                $('#email_2').val('');
            }

        });
    });

    </script>
</x-userBasic-layout>
