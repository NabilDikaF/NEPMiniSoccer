<!DOCTYPE html>
<html>
<head>
    <title>Kode OTP Anda</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { text-align: center; margin-bottom: 20px; }
        .otp-code { font-size: 32px; font-weight: bold; color: #2e7d32; text-align: center; letter-spacing: 5px; margin: 20px 0; background: #e8f5e9; padding: 15px; border-radius: 5px;}
        .footer { text-align: center; font-size: 12px; color: #777; mt-30; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>NEP Mini Soccer</h2>
        </div>
        <p>Halo,</p>
        <p>Anda sedang mencoba mendaftar akun baru di NEP Mini Soccer. Gunakan kode OTP 5-digit di bawah ini untuk memverifikasi alamat email Anda:</p>
        
        <div class="otp-code">
            {{ $otp }}
        </div>
        
        <p>Kode ini hanya berlaku selama <strong>5 menit</strong>. Jangan berikan kode ini kepada siapapun.</p>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} NEP Mini Soccer. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
