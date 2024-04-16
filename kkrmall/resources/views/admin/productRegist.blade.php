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
                        <form class="product-form" method="POST" action="{{ route('admin.productStore') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-8">
                                    <label for="product_name" class="form-label">상품명</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name"
                                        value="{{ old('product_name') }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="category" class="form-label">카테고리</label>
                                    <select class="form-select" id="category" name="category"  value="{{ old('category') }}">
                                        <option value="">--선택--</option>
                                        <option value="bed_room">침실</option>
                                        <option value="kitchen">주방</option>
                                        <option value="living_room">거실장</option>
                                        <option value="home_deco">홈데코</option>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label for="start_date" class="form-label">판매시작일</label>
                                    <input type="text" class="datepicker form-control" name="start_date" id="start_date" value="{{ old('start_date') }}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="end_date" class="form-label">판매종료일</label>
                                    <input type="text" class="datepicker form-control" name="end_date" id="end_date" value="{{ old('end_date') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="active" class="form-label">노출여부</label>
                                    <select class="form-select" id="active" name="active" value="{{ old('active') }}">
                                        <option value="">--선택--</option>
                                        <option value="Y">노출</option>
                                        <option value="N">비노출</option>
                                    </select>
                                </div>

                                <div class="col-sm-12">
                                    <label for="product_info" class="form-label">상품설명</label>
                                    <input type="text" class="form-control" name="product_info" id="product_info"
                                        value="{{ old('product_info') }}">
                                </div>

                                <hr class="mt-5">
                                <h4 class="mb-3">금액설정</h4>

                                <div class="col-sm-6">
                                    <label for="product_normal" class="form-label">정상가</label>
                                    <input type="text" class="form-control" name="product_normal" id="product_normal"
                                        value="{{ old('product_normal') }}">
                                </div>

                                <div class="col-sm-6">
                                    <label for="product_price" class="form-label">판매가</label>
                                    <input type="text" class="form-control" name="product_price" id="product_price"
                                        value="{{ old('product_price') }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="delivery" class="form-label">배송비 설정</label>
                                    <select class="form-select" id="delivery" name="delivery" value="{{ old('delivery') }}">
                                        <option value="">--선택--</option>
                                        <option value="0">배송비 무료</option>
                                        <option value="3000">3000원</option>
                                    </select>
                                </div>



                                <hr class="mt-5">
                                <h4 class="mb-3">상품옵션</h4>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <input type="button" class="btn btn-primary mb-3" id="btn-add-row" onclick="add_option_row()" value="+옵션추가">
                                </div>
                                <table class="table" id="option_table">
                                    <thead>
                                        <th class="col">no.</th>
                                        <th class="col-6">옵션명</th>
                                        <th class="col-2">추가금액</th>
                                        <th class="col">재고</th>
                                        <th class="col">노출여부</th>
                                        <th class="col"></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td><input type="text" class="form-control" name="option[name][]" value=""></td>
                                            <td><input type="text" class="form-control" name="option[price][]" value=""></td>
                                            <td><input type="text" class="form-control" name="option[stock][]" value=""></td>
                                            <td>
                                                <select class="form-select" name="option[active][]">
                                                    <option value="">--선택--</option>
                                                    <option value="Y">노출</option>
                                                    <option value="N">비노출</option>
                                                </select>
                                            </td>
                                            <td><input type="button" class="btn btn-danger" id="btn-delete-row" onclick="delete_option_row(this)" value="X"></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr class="my-4">
                                <h4 class="mb-3">상품이미지</h4>

                                <div class="col-sm-6">
                                    <input type="file" class="form-control" id="imageInput" name="image"
                                        accept=".jpg, .png">
                                </div>
                                <div class="col-sm-6">
                                    <div id="preview"></div>
                                </div>

                            </div>


                            <hr class="my-4">

                            <button class="w-100 btn btn-success btn-lg" type="submit">저장하기</button>
                        </form>
                    </div>
                </div>
        </main>
    </body>

    <script>
        $(document).ready(function() {
            
            //이미지업로드
            $('#imageInput').change(function () {
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "jpg" || ext == "png" || ext == "jpeg")) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#preview').html('<img src="' + e.target.result +
                        '" style="width: 300px; height: 300px;" /><br>' + input.files[0].name);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#preview').html('');
                    alert("jpg 또는 png 형식의 이미지 파일을 선택하세요.");
                }
            });
        });
        
        //옵션추가버튼
        function add_option_row(){
            $('#option_table > tbody:last').append(
                                            '<tr>'+
                                                '<td></td>'+
                                                '<td><input type="text" class="form-control" name="option[name][]" value=""></td>'+
                                                '<td><input type="text" class="form-control" name="option[price][]" value=""></td>'+
                                                '<td><input type="text" class="form-control" name="option[stock][]" value=""></td>'+
                                                '<td><select class="form-select" name="option[active][]">'+
                                                        '<option value="">--선택--</option>'+
                                                        '<option value="Y">노출</option>'+
                                                        '<option value="N">비노출</option>'+
                                                '</select></td>'+
                                                '<td><input type="button" class="btn btn-danger" id="btn-delete-row" onclick="delete_option_row(this)" value="X"></td>'+
                                            '</tr>'
                                                );
        };
        
        //옵션삭제버튼
        function delete_option_row(obj){
            var tr = $(obj).parent().parent();
            tr.remove();
        }
        </script>

</x-admin-layout>
