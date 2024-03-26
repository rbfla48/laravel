<x-admin-layout>

    <body class="sb-nav-fixed">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-4">상품관리</h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">상품관리>상품등록</li>
                </ol>
                <div class="row g-5">
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">상품등록</h4>
                        <form class="product-form" novalidate>
                            <div class="row g-3">
                                <div class="col-sm-8">
                                    <label for="product_name" class="form-label">상품명</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name" value="">
                                </div>

                                <div class="col-md-4">
                                    <label for="category" class="form-label">카테고리</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="">--선택--</option>
                                        <option value="bed_room">침실</option>
                                        <option value="kitchen">주방</option>
                                        <option value="living_room">거실장</option>
                                        <option value="home_deco">홈데코</option>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label for="start_date" class="form-label">판매시작일</label>
                                    <input type="text" class="form-control" name="start_date" id="start_date" value="">
                                </div>
                                <div class="col-sm-4">
                                    <label for="end_date" class="form-label">판매종료일</label>
                                    <input type="text" class="form-control" name="end_date" id="end_date" value="">
                                </div>
                                <div class="col-md-4">
                                    <label for="active" class="form-label">노출여부</label>
                                    <select class="form-select" id="activev" name="active" required>
                                        <option value="">--선택--</option>
                                        <option value="Y">노출</option>
                                        <option value="N">비노출</option>
                                    </select>
                                </div>

                                <div class="col-sm-12">
                                    <label for="product_info" class="form-label">상품설명</label>
                                    <input type="text" class="form-control" name="product_info" id="product_info" value="">
                                </div>

                                <hr class="mt-5">
                                <h4 class="mb-3">금액설정</h4>

                                <div class="col-sm-6">
                                    <label for="product_normal" class="form-label">정상가</label>
                                    <input type="text" class="form-control" name="product_normal" id="product_normal" value="">
                                </div>

                                <div class="col-sm-6">
                                    <label for="product_price" class="form-label">판매가</label>
                                    <input type="text" class="form-control" name="product_price" id="product_price" value="">
                                </div>

                                <div class="col-md-4">
                                    <label for="delivery" class="form-label">배송비 설정</label>
                                    <select class="form-select" id="delivery" name="delivery" required>
                                        <option value="">--선택--</option>
                                        <option value="0">배송비 무료</option>
                                        <option value="3000">3000원</option>
                                    </select>
                                </div>

                            </div>

                            <hr class="mt-5">
                            <h4 class="mb-3">상품옵션</h4>
                            
                            <table class="table">
                                <thead>
                                    <th class="col"></th>
                                    <th class="col">no.</th>
                                    <th class="col">옵션명</th>
                                    <th class="col">추가금액</th>
                                    <th class="col">재고</th>
                                    <th class="col">노출여부</th>
                                    <th class="col"></th>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>

                            


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
