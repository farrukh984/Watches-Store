<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Security Alert</title>
    <style>
/* Base styles */
body {
    margin: 0; padding: 0;
    background-color: #0f0f11;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    line-height: 1.6; color: #e2e8f0;
}

.email-wrapper {
    width: 100%; table-layout: fixed;
    background-color: #0f0f11; padding: 50px 0;
}

.email-container {
    max-width: 500px; margin: 0 auto;
    background-color: #1a1a1e;
    border-radius: 16px;
    border: 1px solid rgba(212, 175, 55, 0.2);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    overflow: hidden;
}

/* Header */
.header {
    text-align: center; padding: 35px 20px 20px;
}
.brand-name {
    font-size: 28px; font-weight: 700;
    letter-spacing: 2px; text-transform: uppercase;
    color: #d4af37; /* Gold accent */
}

/* Content */
.email-content {
    padding: 10px 40px 40px; text-align: center;
}
.greeting {
    font-size: 18px; font-weight: 500;
    color: #f8fafc; margin-bottom: 8px;
}
.greeting span { color: #d4af37; }
.message {
    font-size: 15px; color: #94a3b8; margin-bottom: 25px; line-height: 1.5;
}

/* Details Box */
.details-box {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px; padding: 25px 20px;
    margin-bottom: 25px; text-align: left;
}
.detail-row {
    display: flex; justify-content: space-between;
    margin-bottom: 12px; font-size: 14px;
}
.detail-row:last-child { margin-bottom: 0; }
.detail-label { color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 12px; }
.detail-value { color: #d4af37; font-weight: 600; }

/* Note */
.expiry-note {
    font-size: 13px; color: #94a3b8;
    background: rgba(0,0,0,0.2);
    padding: 15px; border-radius: 8px;
    border-left: 3px solid #d4af37;
    text-align: left; margin-bottom: 25px;
}

/* Button */
.button {
    display: inline-block;
    background: rgba(212, 175, 55, 0.1);
    color: #d4af37; border: 1px solid rgba(212, 175, 55, 0.5);
    padding: 12px 24px; border-radius: 8px; text-decoration: none;
    font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
}

/* Footer */
.footer {
    border-top: 1px solid rgba(255,255,255,0.05);
    padding-top: 25px; font-size: 13px; color: #64748b; margin-top: 25px;
}
.footer a { color: #d4af37; text-decoration: none; }
.footer a:hover { text-decoration: underline; }

@media only screen and (max-width: 600px) {
    .email-container { margin: 0 15px; }
    .email-content { padding: 10px 25px 30px; }
}
    </style>
</head>
<body style="margin:0; padding:0; background:#0f0f11;">
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
