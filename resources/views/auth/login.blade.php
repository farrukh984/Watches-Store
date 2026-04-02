@extends('layouts.auth')

@section('title', 'Sign In')
@section('showcase-badge', 'PREMIUM COLLECTION')
@section('showcase-title')
Discover <span>Timeless</span> Elegance
@endsection
@section('showcase-desc', 'Explore our curated collection of luxury timepieces crafted with precision and passion.')

@section('content')
<div class="auth-card">
    <!-- Branding -->
    <div class="auth-brand">
        <span class="auth-brand-icon"><i class="fa-solid fa-gem"></i></span>
        <div class="auth-brand-name">{{ config('app.name') }}</div>
    </div>

    <!-- Header -->
    <div class="form-header">
        <div class="form-header-label gs-reveal">WELCOME BACK</div>
        <h3 class="gs-reveal">Sign In to Your Account</h3>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('login.store') }}" id="login-form">
        @csrf
        <div class="form-group gs-reveal">
            <div class="input-wrapper">
                <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                <input type="email" name="email" id="email" placeholder=" " required value="{{ old('email') }}">
                <label for="email">Email Address</label>
            </div>
        </div>

        <div class="form-group gs-reveal">
            <div class="input-wrapper">
                <span class="icon"><i class="fa-solid fa-lock"></i></span>
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Password</label>
                <i class="fa-regular fa-eye toggle-password" onclick="togglePass('password', this)"></i>
            </div>
        </div>

        <div class="form-actions gs-reveal">
            <label class="custom-checkbox">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
                <span>Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
        </div>

        <button type="submit" class="btn-submit gs-reveal">
            <span>SIGN IN</span>
            <i class="fa-solid fa-arrow-right"></i>
        </button>

        <div class="divider gs-reveal"><span>OR</span></div>

        <div class="social-buttons gs-reveal">
            <a href="{{ route('google.redirect') }}" class="btn-social">
                <img src="https://www.gstatic.com/images/branding/product/2x/googleg_48dp.png" alt="Google"> 
                <span>Google</span>
            </a>
            <a href="{{ route('facebook.redirect') }}" class="btn-social">
                <i class="fa-brands fa-facebook" style="color: #1877f2;"></i> 
                <span>Facebook</span>
            </a>
        </div>
    </form>

    <div class="bottom-text gs-reveal">
        Don't have an account? <a href="{{ route('register') }}" class="flip-trigger">Create Account</a>
    </div>

    <div class="security-badge gs-reveal">
        <i class="fa-solid fa-shield-halved"></i>
        <span>Protected by 256-bit SSL encryption</span>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePass(id, el) {
        const i = document.getElementById(id);
        if (i.type === 'password') { i.type = 'text'; el.classList.replace('fa-eye', 'fa-eye-slash'); }
        else { i.type = 'password'; el.classList.replace('fa-eye-slash', 'fa-eye'); }
    }

    document.addEventListener('DOMContentLoaded', () => {
        @if(session('success'))
            PremiumToast.success("{{ session('success') }}");
        @endif
        @if($errors->any())
            PremiumToast.error("{{ $errors->first() }}");
        @endif
    });
</script>
@endsection
