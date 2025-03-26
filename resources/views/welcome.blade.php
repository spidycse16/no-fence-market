<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="NoFenceMarket - A Direct-to-Consumer Marketplace with No Boundaries">
    
    <title>NoFenceMarket | Direct-to-Consumer Marketplace</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-dark: #4338CA;
            --secondary-color: #10B981;
            --text-dark: #1F2937;
            --text-light: #6B7280;
            --bg-light: #F9FAFB;
            --white: #FFFFFF;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        .container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1.25rem 2rem;
            position: fixed;
            width: 100%;
            z-index: 10;
        }
        
        .header-content {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logo-icon {
            font-size: 2rem;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
            border: 1px solid var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        
        .btn-outline {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background-color: transparent;
        }
        
        .btn-outline:hover {
            background-color: rgba(79, 70, 229, 0.05);
        }
        
        .hero {
            padding: 9rem 2rem 5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, rgba(249,250,251,1) 0%, rgba(243,244,246,1) 100%);
        }
        
        .hero::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234f46e5' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.8;
            z-index: 0;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--text-light);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
        }
        
        .btn-cta {
            padding: 0.75rem 2rem;
            font-size: 1rem;
        }
        
        .features {
            padding: 5rem 2rem;
            background-color: var(--white);
        }
        
        .features-content {
            max-width: 1280px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2rem;
            color: var(--text-dark);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background-color: var(--bg-light);
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            background-color: rgba(79, 70, 229, 0.1);
            height: 3rem;
            width: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: var(--primary-color);
            font-size: 1.25rem;
        }
        
        .feature-title {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            color: var(--text-dark);
        }
        
        .feature-desc {
            color: var(--text-light);
            line-height: 1.5;
        }
        
        footer {
            background-color: var(--text-dark);
            color: var(--bg-light);
            padding: 3rem 2rem;
            margin-top: auto;
        }
        
        .footer-content {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer-logo {
            color: var(--white);
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        .footer-links {
            display: flex;
            gap: 2rem;
        }
        
        .footer-link {
            color: var(--bg-light);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-link:hover {
            color: var(--secondary-color);
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                width: 100%;
                max-width: 300px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 2rem;
                text-align: center;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <a href="{{ url('/') }}" class="logo">
                    <span class="logo-icon">🚀</span>
                    NoFenceMarket
                </a>
                <div class="nav-links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/user/dashboard') }}" class="btn btn-outline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>
        
        <section class="hero">
            <div class="hero-content">
                <h1>Break Down The Barriers Between Creators & Consumers</h1>
                <p class="hero-subtitle">NoFenceMarket is a revolutionary direct-to-consumer marketplace where innovative products meet their perfect customers—without the middleman.</p>
                <div class="cta-buttons">
                    @auth
                        <a href="{{ url('/user/dashboard') }}" class="btn btn-primary btn-cta">Go to Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-cta">Join NoFenceMarket</a>
                        <a href="{{ route('login') }}" class="btn btn-outline btn-cta">Sign In</a>
                    @endauth
                </div>
            </div>
        </section>
        
        <section class="features">
            <div class="features-content">
                <h2 class="section-title">Why Choose NoFenceMarket?</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">💸</div>
                        <h3 class="feature-title">No Middlemen, More Profit</h3>
                        <p class="feature-desc">Connect directly with your customers and keep more of your revenue without third-party commissions.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <h3 class="feature-title">Find Your Perfect Audience</h3>
                        <p class="feature-desc">Our intelligent matching system connects your products with the people most likely to love them.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🔒</div>
                        <h3 class="feature-title">Secure & Seamless</h3>
                        <p class="feature-desc">Enjoy state-of-the-art security and a frictionless experience from registration to sales.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <footer>
            <div class="footer-content">
                <div class="footer-logo">NoFenceMarket © {{ date('Y') }}</div>
                <div class="footer-links">
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Privacy Policy</a>
                    <a href="#" class="footer-link">Terms of Service</a>
                    <a href="#" class="footer-link">Contact</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>