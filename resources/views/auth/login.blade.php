@section('title', 'Login')
<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form id="formAuthentication" method="POST" action="{{ route('login') }}" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email or Username</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email"
                autofocus value="{{ old('email') }}">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-dark">
                        <small>Forgot Password?</small>
                    </a>
                @endif

            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />

            </div>
        </div>
        <div class="mb-3">
            <div class="form-check form-check-dark">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">
                    Remember Me
                </label>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-dark d-grid w-100" type="submit">Sign in</button>
        </div>
    </form>
</x-guest-layout>
