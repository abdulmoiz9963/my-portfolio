<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <span class="logo-bracket">&lt;</span>AM<span class="logo-bracket">/&gt;</span>
            </div>
            <h2 class="login-title">Admin Login</h2>
            <p class="login-sub">Enter your credentials to access the dashboard</p>

            @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            <a href="{{ route('portfolio') }}" class="back-to-portfolio">
                <i class="fas fa-arrow-left"></i> Back to Portfolio
            </a>
        </div>
    </div>
</body>
</html>
