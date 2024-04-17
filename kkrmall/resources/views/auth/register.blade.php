<x-guest-layout>
    <main>
    <form id="register_form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="w-50 mx-auto p-5 container shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="w-100">
            <h4 class="mb-3">가입정보 입력</h4>
                <div class="row g-3">
                    <div class="col-sm-3">
                        <label for="name" class="form-label">성함 *</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="">
                    </div>

                    <div class="col-12">
                        <label for="zip_code" class="form-label">주소 *</label>
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

                    <div class="col-sm-3">
                        <label for="password" class="form-label">비밀번호 *</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="" value="">
                    </div>

                    <div class="col-sm-3">
                        <label for="password_check" class="form-label">비밀번호확인</label>
                        <input type="password" class="form-control" id="password_check" name="password" placeholder="" value="">
                    </div>

                    <div class="col-9">
                        <label for="phone" class="form-label">연락처 *</label>
                        <div class="flex col-sm-9 mb-3">
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
                            <input class="form-control" id="ophone3" name="phone[]" maxlength="4"
                                fw-filter="isNumber&amp;isFill" size="4" value="" type="text">
                        </div>
                    </div>

                    <label for="email" class="form-label">이메일</label>
                    <div>
                        <div class="row mb-3" id="email_area">
                            <div class="flex col-12">
                                <div class="flex mb-3 col-sm-9">
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="ms-3">
                                    <input type="button" class="btn btn-light text-dark" id="btn-address" value="인증번호발송"
                                            onclick="verificationCodeSend()">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <h4 class="mb-3">약관동의</h4> --}}
                    <div>
                        <div class="form-check mt-5">
                            <input type="checkbox" class="form-check-input" id="same-address">
                            <label class="form-check-label" for="same-address">이용약관에 대하여 동의합니다.</label>
                        </div>
                        <div class="col-12 mt-3">
                            <textarea class="w-100">이용약관입니다.</textarea>
                        </div>

                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="save-info">
                            <label class="form-check-label" for="save-info">개인정보취급방침에 대하여 동의합니다.</label>
                        </div>
                        <div class="col-12 mt-3">
                            <textarea class="w-100">개인정보취급방침</textarea>
                        </div>
                    </div>
                </div>
                
            </div>
            <hr class="my-4">
            
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">회원가입</x-primary-button>
            </div>
        </div>

        </div>
    </form>
    </main>
    <script>
        function daumPostcode() {
            new daum.Postcode({
              oncomplete: function (data) {
                  // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                  // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                  var addr = ''; // 주소 변수
                  var extraAddr = ''; // 참고항목 변수
    
                  //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                  if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                      addr = data.roadAddress;
                  } else { // 사용자가 지번 주소를 선택했을 경우(J)
                      addr = data.jibunAddress;
                  }
    
                  // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                  if (data.userSelectedType === 'R') {
                      // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                      // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                      if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                          extraAddr += data.bname;
                      }
                      // 건물명이 있고, 공동주택일 경우 추가한다.
                      if (data.buildingName !== '' && data.apartment === 'Y') {
                          extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                      }
                      // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                      if (extraAddr !== '') {
                          extraAddr = ' (' + extraAddr + ')';
                      }
                      // 조합된 참고항목을 해당 필드에 넣는다.
                      document.getElementById("address1").value = extraAddr;
    
                  } else {
                      document.getElementById("address1").value = '';
                  }
    
                  // 우편번호와 주소 정보를 해당 필드에 넣는다.
                  document.getElementById('zip_code').value = data.zonecode;
                  document.getElementById("address1").value = addr;
                  // 커서를 상세주소 필드로 이동한다.
                  document.getElementById("address2").focus();
              }
            }).open();
        }


        function verificationCodeSend() {
            var formData = $('#register_form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('verificationCodeSend') }}",
                data: formData,
                success: function(response) {
                    // 성공적으로 인증번호를 발송한 경우의 처리
                    alert('인증번호가 이메일로 발송되었습니다.');
                    var verificationHtml = '<div><input type="text" id="verification_code" name="verification_code" placeholder="인증번호를 입력하세요">';
                    verificationHtml += '<input type="button" class="btn btn-light text-dark" id="btn-address" value="인증번호확인" onclick="verificationCodeCheck()"></div>';
                    $('#email_area').append(verificationHtml);

                },
                error: function(xhr, status, error) {
                    // 오류 발생 시의 처리
                    alert('인증번호 발송에 실패하였습니다. 다시 시도해 주세요.');
                }
            });
        }

        function verificationCodeCheck() {
            var formData = $('#register_form').serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('verificationCodeCheck') }}",
                data: formData,
                success: function(response) {
                    // 성공적으로 인증번호를 발송한 경우의 처리
                    alert('이메일 인증되었습니다.');
                },
                error: function(xhr, status, error) {
                    // 오류 발생 시의 처리
                    alert('인증에 실패하였습니다. 다시 시도해 주세요.');
                }
            });
        }
    
    </script>
</x-guest-layout>

