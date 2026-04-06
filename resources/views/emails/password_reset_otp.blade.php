<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
/* Base styles */
body {
    margin: 0; padding: 0;
    background-color: #0b1120;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    line-height: 1.6; color: #e2e8f0;
}

.email-wrapper {
    width: 100%; table-layout: fixed;
    background-color: #0b1120; padding: 50px 0;
}

.email-container {
    max-width: 500px; margin: 0 auto;
    background-color: #0f172a;
    border-radius: 16px;
    border: 1px solid rgba(6, 182, 212, 0.15);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    overflow: hidden;
}

/* Header */
.header {
    text-align: center; padding: 35px 20px 20px;
    border-bottom: 1px solid rgba(6, 182, 212, 0.08);
}
.brand-name {
    font-size: 28px; font-weight: 700;
    letter-spacing: 2px; text-transform: uppercase;
    color: #06b6d4;
}

/* Content */
.email-content {
    padding: 10px 40px 40px; text-align: center;
}
.greeting {
    font-size: 18px; font-weight: 500;
    color: #f8fafc; margin-bottom: 8px;
}
.greeting span { color: #06b6d4; }
.message {
    font-size: 15px; color: #94a3b8; margin-bottom: 30px;
}

/* OTP Box */
.otp-box {
    background: rgba(6, 182, 212, 0.04);
    border: 1px dashed rgba(6, 182, 212, 0.3);
    border-radius: 12px; padding: 25px 20px;
    margin-bottom: 25px;
}
.otp-label {
    font-size: 12px; text-transform: uppercase; letter-spacing: 1px;
    color: #64748b; margin-bottom: 12px;
}
.otp-code {
    font-size: 40px; font-weight: 700;
    letter-spacing: 10px; color: #06b6d4;
    font-family: 'Courier New', monospace; margin: 0;
}

/* Note */
.expiry-note {
    font-size: 13px; color: #94a3b8;
    background: rgba(0,0,0,0.2);
    padding: 15px; border-radius: 8px;
    border-left: 3px solid #06b6d4;
    text-align: left; margin-bottom: 25px;
}

/* Footer */
.footer {
    border-top: 1px solid rgba(255,255,255,0.05);
    padding-top: 25px; font-size: 13px; color: #64748b;
}
.footer a { color: #06b6d4; text-decoration: none; }
.footer a:hover { text-decoration: underline; }

/* Preheader hack — hidden text Gmail picks up as preview */
.preheader {
    display: none !important;
    visibility: hidden;
    mso-hide: all;
    font-size: 1px;
    line-height: 1px;
    max-height: 0;
    max-width: 0;
    opacity: 0;
    overflow: hidden;
    color: #0b1120;
}

@media only screen and (max-width: 600px) {
    .email-container { margin: 0 15px; }
    .email-content { padding: 10px 25px 30px; }
    .otp-code { font-size: 32px; letter-spacing: 6px; }
}
    </style>
</head>
<body style="margin:0; padding:0; background:#0b1120;">
    <!-- Preheader text for Gmail mobile preview -->
    <div class="preheader">🔑 Your Password Reset Code: {{ $otp }} — Use this code to reset your password. Expires in 10 minutes.&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;</div>

    <div class="email-wrapper">
        <div class="email-container">
            <div class="header">
                <div class="brand-name">{{ config('app.name') }}</div>
            </div>
            <div class="email-content">
                <div class="greeting">Hello <span>{{ $user->name }}</span>,</div>
                <div class="message">You requested to reset your password. Use the following code to proceed:</div>
                
                <div class="otp-box">
                    <div class="otp-label">Security Code</div>
                    <div class="otp-code">{{ $otp }}</div>
                </div>
                
                <div class="expiry-note">
                    <i>&#9888;</i> This code expires in 10 minutes. If you did not request a password reset, please ignore this email or update your password if you feel your account is at risk.
                </div>
                
                <div class="footer">
                    &copy; {{ date('Y') }} {{ config('app.name') }} Inc. All rights reserved.<br>
                    <a href="mailto:support@watchesstore.com">support@watchesstore.com</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>