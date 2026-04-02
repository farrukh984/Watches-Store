@extends('layouts.auth')

@section('title', 'Forgot Password')
@section('showcase-badge', 'SECURE RECOVERY')
@section('showcase-title')
We've Got <span>You</span> Covered
@endsection
@section('showcase-desc', 'Don\'t worry! Our secure password recovery process will get you back into your account in no time.')
@section('showcase-stats')
<div class="showcase-stat">
    <div class="showcase-stat-value">256<span>-bit</span></div>
    <div class="showcase-stat-label">Encryption</div>
</div>
<div class="showcase-stat">
    <div class="showcase-stat-value">2<span>FA</span></div>
    <div class="showcase-stat-label">Security</div>
</div> 
<div class="showcase-stat">
    <div class="showcase-stat-value">24<span>/7</span></div>
    <div class="showcase-stat-label">Protection</div>
</div>
@endsection

@section('content')
<div class="auth-card">
    <!-- Branding -->
    <div class="auth-brand">
        <span class="auth-brand-icon"><i class="fa-solid fa-gem"></i></span>
        <div class="auth-brand-name">{{ config('app.name') }}</div>
    </div>

    <!-- Header -->
    <div class="form-header">
        <div class="form-header-label gs-reveal">ACCOUNT RECOVERY</div>
        <h3 class="gs-reveal">Forgot Password?</h3>
        <p class="gs-reveal">Enter your email and we'll send you a secure reset link</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group gs-reveal">
            <div class="input-wrapper">
                <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                <input type="email" name="email" id="email" placeholder=" " required value="{{ old('email') }}" autofocus>
                <label for="email">Email Address</label>
            </div>
        </div>

        <button type="submit" class="btn-submit gs-reveal" style="margin-top: 6px;">
            <span>SEND RESET LINK</span>
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </form>

    <div class="bottom-text gs-reveal" style="margin-top: 24px;">
        <a href="{{ route('login') }}"><i class="fa-solid fa-arrow-left"></i> Back to Sign In</a>
    </div>

    <div class="security-badge gs-reveal">
        <i class="fa-solid fa-shield-halved"></i>
        <span>Secure account recovery</span>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        @if(session('status') || session('success'))
            PremiumToast.success("{{ session('status') ?? session('success') }}");
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                PremiumToast.error("{{ $error }}");
            @endforeach
        @endif
    });
</script>
@endsection