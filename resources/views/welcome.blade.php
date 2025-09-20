<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
            --text-muted: #6c757d;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .login-container {
            min-height: 100vh;
        }
        
        .login-card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-section {
            background-color: white;
            border-right: 1px solid var(--border-color);
        }
        
        .brand-logo {
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 600;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 24px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        
        .btn-outline-secondary {
            border-color: var(--border-color);
            color: var(--secondary-color);
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--light-bg);
            border-color: var(--border-color);
            color: var(--secondary-color);
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }
        
        .divider::before {
            margin-right: .75rem;
        }
        
        .divider::after {
            margin-left: .75rem;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            padding: 8px 0;
            color: var(--text-muted);
            display: flex;
            align-items: center;
        }
        
        .feature-list li::before {
            content: "✓";
            color: #198754;
            font-weight: bold;
            margin-right: 10px;
        }
        
        .text-muted-custom {
            color: var(--text-muted) !important;
        }
        
        @media (max-width: 991.98px) {
            .welcome-section {
                display: none !important;
            }
            
            .login-card {
                border: none;
                box-shadow: none;
            }
        }
        
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
    </style>
</head>
<body>
    
    <div class="container-fluid login-container d-flex align-items-center justify-content-center p-4">
        <div class="row login-card w-100" style="max-width: 1000px;">
            
            <!-- Left Side - Welcome Section -->
            <div class="col-lg-6 welcome-section d-flex align-items-center p-5">
                <div class="w-100">
                    
                    <!-- Brand -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="brand-logo me-3">
                            L
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ config('app.name', 'Laravel') }}</h4>
                            <small class="text-muted-custom">Professional Dashboard</small>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h2 class="fw-bold mb-3">Welcome back</h2>
                        <p class="text-muted-custom mb-0">
                            Please sign in to your account to access the dashboard and manage your data.
                        </p>
                    </div>
                    
                    <!-- Features -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">What you get:</h6>
                        <ul class="feature-list">
                            <li>Secure authentication system</li>
                            <li>Real-time data analytics</li>
                            <li>Professional dashboard interface</li>
                            <li>24/7 technical support</li>
                        </ul>
                    </div>
                    
                    <div class="text-muted-custom">
                        <small>
                            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                        </small>
                    </div>
                    
                </div>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="col-lg-6 d-flex align-items-center p-5">
                <div class="w-100" style="max-width: 400px; margin: 0 auto;">
                    
                    <!-- Header -->
                    <div class="mb-4">
                        <h3 class="fw-bold mb-2">Sign in</h3>
                        <p class="text-muted-custom mb-0">Enter your email and password to continue</p>
                    </div>
                    
                    <!-- Login Form -->
                    <form method="POST" action="{{route('login')}}" id="loginForm">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required 
                                autocomplete="email"
                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="Enter your password"
                                required 
                                autocomplete="current-password"
                            >
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted-custom" for="remember">
                                    Remember me
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 mb-3" id="submitBtn">
                            <span class="btn-text">Sign in</span>
                        </button>
                        
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Simple Form Enhancement -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');
            
            form.addEventListener('submit', function(e) {
                submitBtn.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Signing in...
                `;
                submitBtn.disabled = true;
            });
        });
    </script>
    
</body>
</html>