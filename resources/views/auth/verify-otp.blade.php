@extends('layouts.auth')

@section('title', 'Verify OTP')
@section('showcase-badge', 'VERIFICATION')
@section('showcase-title')
Almost <span>There!</span>
@endsection
@section('showcase-desc', 'Enter the verification code we sent to your email to complete the password reset process.')

@section('content')
<div class="auth-card">
    <!-- Branding -->
    <div class="auth-brand">
        <span class="auth-brand-icon"><i class="fa-solid fa-gem"></i></span>
        <div class="auth-brand-name">{{ config('app.name') }}</div>
    </div>

    <!-- Header -->
    <div class="form-header">
        <div class="form-header-label gs-reveal">VERIFICATION</div>
        <h3 class="gs-reveal">Enter OTP Code</h3>
        <p class="gs-reveal">We've sent a 6‑digit code to {{ session('reset_email') }}</p>
    </div>

    <form method="POST" action="{{ route('password.otp.verify') }}">
        @csrf
        <div class="form-group gs-reveal">
            <div class="input-wrapper">
                <span class="icon"><i class="fa-solid fa-shield-halved"></i></span>
                <input type="text" name="otp" id="otp" placeholder=" " required maxlength="6" inputmode="numeric" pattern="\d*" autofocus>
                <label for="otp">6‑digit OTP Code</label>
            </div>
        </div>

        <button type="submit" class="btn-submit gs-reveal" style="margin-top: 6px;">
            <span>VERIFY CODE</span>
            <i class="fa-solid fa-check-circle"></i>
        </button>
    </form>

    <div class="bottom-text gs-reveal" style="margin-top: 24px;">
        <a href="{{ route('password.request') }}"><i class="fa-solid fa-arrow-left"></i> Try another email</a>
    </div>

    <div class="security-badge gs-reveal">
        <i class="fa-solid fa-shield-halved"></i>
        <span>Secure verification</span>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        @if(session('success'))
            PremiumToast.success("{{ session('success') }}");
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                PremiumToast.error("{{ $error }}");
            @endforeach
        @endif
    });
</script>
@endsection
