<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="row justify-content-center">
                <h1 class="text-center mb-4 fs-3">LOGIN</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="이메일 아이디"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <input id="password" class="form-control form-control-lg" type="password" name="password" required autocomplete="current-password" placeholder="비밀번호"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">로그인상태 유지</label>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary btn-lg w-100">로그인</button>
                    </div>

                    <div>
                        @if (Route::has('password.request'))
                            <a class="text-center d-block" href="{{ route('password.request') }}">{{ __('비밀번호 찾기') }}</a>
                        @endif
                    </div>
                </form>
        </div>
    </div>
</x-guest-layout>
