@component('mail::message')
# kkrmall 회원가입 인증

안녕하세요, kkrmall에 가입해 주셔서 감사합니다. 아래의 인증 코드를 입력하여 회원가입을 완료해 주세요.

인증 코드: {{ $code }}

이 인증 코드는 30분간 유효합니다.

이메일 인증이 완료되면 아래의 버튼을 클릭하여 kkrmall에 로그인하세요.

@component('mail::button', ['url' => 'https://kkrmall.com/login'])
로그인 하기
@endcomponent

이메일이 잘못 전달된 경우 무시하셔도 됩니다.

감사합니다,<br>
kkrmall 팀
@endcomponent