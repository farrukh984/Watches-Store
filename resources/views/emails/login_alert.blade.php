<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Alert</title>
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
    font-size: 15px; color: #94a3b8; margin-bottom: 25px; line-height: 1.5;
}

/* Details Box */
.details-box {
    background: rgba(6, 182, 212, 0.04);
    border: 1px solid rgba(6, 182, 212, 0.12);
    border-radius: 12px; padding: 25px 20px;
    margin-bottom: 25px; text-align: left;
}
.detail-row {
    display: flex; justify-content: space-between;
    margin-bottom: 12px; font-size: 14px;
}
.detail-row:last-child { margin-bottom: 0; }
.detail-label { color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 12px; }
.detail-value { color: #06b6d4; font-weight: 600; }

/* Note */
.expiry-note {
    font-size: 13px; color: #94a3b8;
    background: rgba(0,0,0,0.2);
    padding: 15px; border-radius: 8px;
    border-left: 3px solid #06b6d4;
    text-align: left; margin-bottom: 25px;
}

/* Button */
.button {
    display: inline-block;
    background: rgba(6, 182, 212, 0.1);
    color: #06b6d4; border: 1px solid rgba(6, 182, 212, 0.4);
    padding: 12px 24px; border-radius: 8px; text-decoration: none;
    font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
}

/* Footer */
.footer {
    border-top: 1px solid rgba(255,255,255,0.05);
    padding-top: 25px; font-size: 13px; color: #64748b; margin-top: 25px;
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
}
    </style>
</head>
<body style="margin:0; padding:0; background:#0b1120;">
    <!-- Preheader text for Gmail mobile preview -->
    <div class="preheader">🔔 Security Alert: New sign-in detected on your {{ config('app.name') }} account at {{ $loginTime }} from IP {{ $ipAddress }}. If this wasn't you, reset your password immediately.&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;</div>

    <div class="email-wrapper">
        <div class="email-container">
            <div class="header">
                <div class="brand-name">{{ config('app.name') }}</div>
            </div>
            <div class="email-content">
                <div class="greeting">Hello, <span>{{ explode(' ', $user->name)[0] }}</span></div>
                <div class="message">This is a security notification. Your account was recently accessed.</div>
                
                <div class="details-box">
                    <div class="detail-row">
                        <span class="detail-label">Date & Time</span>
                        <span class="detail-value">{{ $loginTime }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">IP Address</span>
                        <span class="detail-value">{{ $ipAddress }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Role</span>
                        <span class="detail-value" style="text-transform: capitalize;">{{ $user->role }}</span>
                    </div>
                </div>
                
                <div class="expiry-note">
                    <i>&#9888;</i> If you recognize this activity, you can safely ignore this email. If not, reset your password immediately.
                </div>
                
                <a href="{{ route('password.request') }}" class="button">Reset Password</a>
                
                <div class="footer">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
