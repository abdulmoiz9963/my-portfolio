<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Abdul Moiz - DevOps Engineer') }}</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Outfit:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Nav -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#home" class="nav-logo">
      <span class="logo-bracket">&lt;/</span>AM<span class="logo-bracket">&gt;</span>
</a>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <a href="{{ route('cv.download') }}" class="btn-cv">
                    <i class="fas fa-download"></i> Download CV
                </a>
                <button class="hamburger" id="hamburger">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <p class="footer-text">Built with  by Abdul Moiz</p>
            <div class="footer-links">
                <a href="https://www.linkedin.com/in/abdulmoiz-ashraf-b2997a206" target="_blank"><i class="fab fa-linkedin"></i></a>
                <a href="https://github.com/abdulmoiz9963" target="_blank"><i class="fab fa-github"></i></a>
                <a href="mailto:moiz9963@gmail.com"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/portfolio.js') }}"></script>
    @stack('scripts')
</body>
</html>
