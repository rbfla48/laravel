<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--나이스페이-->
    <script src="https://pg-web.nicepay.co.kr/v3/common/js/nicepay-pgweb.js" type="text/javascript"></script>

    @vite(['resources/css/headers.css',
        'resources/css/style.css',
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/common.js',
        'resources/css/owl.carousel.css',
        'resources/css/owl.theme.default.css',
        'resources/js/owl.carousel.js',
        'resources/js/owl.autoplay.js',
        'resources/js/owl.navigation.js'
        ])

</head>

<body class="d-flex flex-column min-vh-100">
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img style="width: 100px; height:50px" src="/images/kkrmall_logo.png">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                    <li>
                        <a href="#" class="nav-link px-2 dropdown-toggle text-secondary" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            상품
                        </a>
                        <ul class="dropdown-menu text-small shadow">
                            <li><a href="#" class="nav-link px-2 text-secondary">침실</a></li>
                            <li><a href="#" class="nav-link px-2 text-secondary">주방</a></li>
                            <li><a href="#" class="nav-link px-2 text-secondary">거실장</a></li>
                            <li><a href="#" class="nav-link px-2 text-secondary">홈데코</a></li>
                        </ul>
                    <li><a href="#" class="nav-link px-2 text-secondary">공지사항</a></li>
                    <li><a href="#" class="nav-link px-2 text-secondary">자주묻는질문</a></li>
                    </li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..."
                        aria-label="Search">
                </form>

                <div class="text-end">
                    @auth
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}님
                        </a>
                        <ul class="dropdown-menu text-large shadow">
                            <li><a href="#" class="nav-link px-2 link-secondary">내정보</a></li>
                            <li><a href="#" class="nav-link px-2 link-secondary">고객문의</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="nav-link px-2 link-secondary" style="cursor:pointer;" onclick="event.preventDefault(); this.closest('form').submit();">로그아웃</div>
                                </form>
                            </li>
                        </ul>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-datk ml-7 font-semibold dark:hover:text-dark focus:outline">로그인</a>
                        <a href="{{ route('register') }}" class="btn btn-datk ml-7 font-semibold dark:hover:text-dark focus:outline">회원가입</a>
                    @endguest
                </div>
            </div>
        </div>
    </header>
    <!--상단네비게이션END-->

    {{ $slot }}

    <!-- 하단 기업 정보 -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p>Copyright © 2024. All Rights Reserved.</p>
            <p>Company Name | Address | Contact Info</p>
        </div>
    </footer>

</body>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous">
</script>
<!-- 부트스트랩 자바스크립트 및 필요한 스크립트들 -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<!-- 부트스트랩 아이콘 CDN -->
<!-- 부트스트랩 아이콘 CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"></script>
<!--다음주소검색API-->
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
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

</script>

</html>
