<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Dyacom</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>body{background:#172A5A;min-height:100vh;display:flex;align-items:center;justify-content:center;font-family:'Inter',sans-serif;}.forgot-container{background:#fff;border-radius:12px;box-shadow:0 4px 24px rgba(0,0,0,0.08);padding:2.5rem 2rem;width:100%;max-width:370px;text-align:center;}.forgot-title{font-size:2rem;font-weight:700;color:#fff;margin-bottom:2rem;letter-spacing:2px;}.forgot-container h2{font-size:1.25rem;font-weight:600;margin-bottom:1.5rem;color:#222;}.form-group{text-align:left;margin-bottom:1.25rem;}.form-label{font-size:0.95rem;color:#222;margin-bottom:0.25rem;display:block;}.form-input{width:100%;padding:0.75rem 1rem;border:1px solid #e3e3e3;border-radius:6px;font-size:1rem;outline:none;margin-bottom:0.5rem;}.form-input:focus{border-color:#2563eb;}.forgot-btn{width:100%;background:#2563eb;color:#fff;border:none;border-radius:6px;padding:0.75rem;font-size:1rem;font-weight:600;cursor:pointer;margin-top:0.5rem;transition:background 0.2s;}.forgot-btn:hover{background:#174ea6;}.login-link{margin-top:1.5rem;font-size:0.95rem;color:#222;}.login-link a{color:#2563eb;text-decoration:none;font-weight:600;}</style>
</head>
<body>
    <div style="position: absolute; top: 60px; left: 0; right: 0; text-align: center;">
        <span class="forgot-title">DYACOM</span>
    </div>
    <div class="forgot-container">
        <h2>Forgot your password?</h2>
        <form method="POST" action="#">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" id="email" name="email" required autofocus>
            </div>
            <button class="forgot-btn" type="submit">Send Password Reset Link</button>
        </form>
        <div class="login-link">
            Remember your password? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</body>
</html>
