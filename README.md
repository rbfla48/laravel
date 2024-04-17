
# kkrmall
![kkrmall_logo](https://github.com/rbfla48/laravel/assets/59451205/a5bf0642-f5dd-4b46-8b27-56316d4c0ef2)

이 프로젝트는 온라인 가구 전문 쇼핑몰을 기반으로, 판매자와 구매자의 관점에서 B2C 온라인 상거래 플랫폼을 구현했습니다.
- PHP를 사용하여 웹 애플리케이션을 개발함으로써, 사용자들이 쇼핑몰을 효과적으로 탐색하고 제품을 검색하며 구매할 수 있는 기능을 구현하였습니다.  
- 또한, 관리자가 제품을 추가, 수정, 삭제할 수 있는 백오피스 기능을 개발하여 쇼핑몰을 운영하는 데 필요한 기능을 제공하였습니다.  

# 프로젝트 기술 스택

- ![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php)
- ![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?logo=laravel)
- ![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql)
- ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript)
- ![jQuery](https://img.shields.io/badge/jQuery-3.6-0769AD?logo=jquery)
- ![Docker](https://img.shields.io/badge/Docker-20.10.0-2496ED?logo=docker)

# 메인 화면
![메인 편집 - Clipchamp로 제작](https://github.com/rbfla48/laravel/assets/59451205/0d2bee51-7b87-4738-9415-be47ca4f780f)

- 동적으로 DB에서 조회한 배너 이미지를 슬라이드 형식으로 표시합니다.
- 상품 데이터를 동적으로 로드하여 슬라이드로 노출합니다.
- 할인 상품은 판매 기간 동안 "sale" 뱃지가 추가됩니다.

<br>

# 회원가입 및 로그인
![회원가입및로그인편집](https://github.com/rbfla48/laravel/assets/59451205/caa32396-0485-4c25-81ad-c6c360d25953)

- 회원 가입 페이지에서는 Daum 주소 검색 API를 활용하여 사용자가 정확하고 효율적으로 주소를 입력할 수 있습니다.
- 회원 가입 과정에서는 Google SMTP를 이용하여 안전하고 빠르게 이메일 인증번호를 전송하며, 사용자는 이를 통해 인증을 완료할 수 있습니다.


# 상품구매 및 결제
![상품구매및결제편집](https://github.com/rbfla48/laravel/assets/59451205/27a3b9d4-2e92-4e55-961d-c4544a55098a)

- Nice Pay 결제 모듈을 적용하여 실제 Payment 로직을 구현했습니다.
- 상품 상세 페이지에서 옵션 선택 시 동적으로 주문 가격이 변동되도록 하였습니다.
- 관리자페이지에서 설정한 상품별 배송비 주문 페이지에 자동으로 표시됩니다.
- 주문 페이지에서 "회원 정보와 동일" 버튼 클릭하면 회원 정보가 불러와져 배송 정보에 자동으로 반영됩니다.

