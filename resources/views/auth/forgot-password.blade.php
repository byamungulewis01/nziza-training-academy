@section('title', 'Forget Password')

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-success class="mb-4" :status="session('status')" />

    <h4 class="mb-1 pt-2">Forgot Password? 🔒</h4>

    <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
    <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('password.email') }}">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Enter your email" autofocus>
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
    </div>
      <button class="btn btn-dark d-grid w-100"  type="submit">Send Reset Link</button>
    </form>
    <div class="text-center">
      <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center text-dark">
        <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
        Back to login
      </a>
    </div>
</x-guest-layout>
