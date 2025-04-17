<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - HirayaFit</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #111111;
            --secondary: #0071c5;
            --accent: #e5e5e5;
            --light: #ffffff;
            --dark: #111111;
            --grey: #767676;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light);
        }
        
        .top-bar {
            background-color: var(--primary);
            color: white;
            padding: 8px 0;
            text-align: center;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        
        .top-bar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .top-bar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }
        
        .header {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        
        .logo span {
            color: var(--secondary);
        }
        
        .nav-icons {
            display: flex;
            align-items: center;
        }
        
        .nav-icons a {
            margin-left: 20px;
            font-size: 18px;
            color: var(--dark);
            text-decoration: none;
            position: relative;
        }
        
        .cart-count {
            position: absolute;
            top: -6px;
            right: -6px;
            background-color: var(--secondary);
            color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            font-size: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        /* Account dropdown styling */
        .account-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .account-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            z-index: 1;
            border-radius: 4px;
            margin-top: 10px;
        }
        
        .account-dropdown-content:before {
            content: '';
            position: absolute;
            top: -8px;
            right: 10px;
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 8px solid white;
        }
        
        .account-dropdown-content a {
            color: var(--dark);
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            font-size: 14px;
            font-weight: 400;
            margin: 0;
            border-bottom: 1px solid #f5f5f5;
        }
        
        .account-dropdown-content a:last-child {
            border-bottom: none;
        }
        
        .account-dropdown-content a:hover {
            background-color: #f8f9fa;
            color: var(--secondary);
        }
        
        .account-dropdown-content h3 {
            padding: 12px 20px;
            margin: 0;
            font-size: 14px;
            color: var(--grey);
            background-color: #f8f9fa;
            border-bottom: 1px solid #f0f0f0;
            border-radius: 4px 4px 0 0;
            font-weight: 500;
        }
        
        .account-dropdown.active .account-dropdown-content {
            display: block;
        }
        
        /* Updated Navigation Styles */
        .main-nav {
            display: flex;
            justify-content: center;
            background-color: var(--light);
            border-bottom: 1px solid #f0f0f0;
        }
        
        .main-nav a {
            padding: 15px 20px;
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
            position: relative;
        }
        
        .main-nav a:hover, .main-nav a.active {
            color: var(--secondary);
        }
        
        /* Hover underline effect */
        .main-nav a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--secondary);
            left: 50%;
            bottom: 10px;
            transition: all 0.2s ease;
            transform: translateX(-50%);
        }
        
        .main-nav a:hover:after, .main-nav a.active:after {
            width: 60%;
        }
        
        /* Menu toggle button */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--primary);
            font-size: 22px;
            cursor: pointer;
        }
        
        /* Sign Up Page Specific Styles */
        .page-title {
            text-align: center;
            padding: 40px 0 20px;
            font-size: 28px;
            font-weight: 600;
            color: var(--primary);
        }
        
        .signup-container {
            max-width: 600px;
            margin: 0 auto 60px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
            font-size: 15px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--secondary);
        }
        
        .terms-group {
            margin-bottom: 25px;
        }
        
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .checkbox-group input {
            margin-right: 10px;
            margin-top: 3px;
        }
        
        .checkbox-group label {
            font-size: 14px;
            line-height: 1.4;
            color: var(--dark);
        }
        
        .checkbox-group a {
            color: var(--secondary);
            text-decoration: none;
        }
        
        .checkbox-group a:hover {
            text-decoration: underline;
        }
        
        .btn-signup {
            display: block;
            width: 100%;
            padding: 14px;
            background-color: var(--secondary);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .btn-signup:hover {
            background-color: #005fa8;
        }
        
        .social-signup {
            margin-top: 30px;
            text-align: center;
        }
        
        .social-signup p {
            position: relative;
            margin-bottom: 20px;
            color: var(--grey);
            font-size: 14px;
        }
        
        .social-signup p:before,
        .social-signup p:after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background-color: #ddd;
        }
        
        .social-signup p:before {
            left: 0;
        }
        
        .social-signup p:after {
            right: 0;
        }
        
        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 1px solid #ddd;
            color: var(--dark);
            font-size: 18px;
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            background-color: #f8f9fa;
            border-color: #ccc;
            color: var(--secondary);
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 15px;
            color: var(--dark);
        }
        
        .login-link a {
            color: var(--secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .login-link a:hover {
            text-decoration: underline;
            color: #005fa8;
        }
        
        .password-requirements {
            margin-top: 5px;
            font-size: 12px;
            color: var(--grey);
        }
        
        /* Media queries */
        @media (max-width: 768px) {
            .top-bar .container {
                flex-direction: column;
                gap: 5px;
            }
            
            .navbar {
                flex-wrap: wrap;
            }
            
            .menu-toggle {
                display: block;
                order: 1;
            }
            
            .logo {
                order: 2;
                margin: 0 auto;
            }
            
            .nav-icons {
                order: 3;
            }
            
            .main-nav {
                display: none;
                flex-direction: column;
                align-items: center;
            }
            
            .main-nav.active {
                display: flex;
            }
            
            .signup-container {
                padding: 20px;
                margin: 0 15px 40px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div>FREE SHIPPING ON ORDERS OVER ₱4,000!</div>
            <div>
                <a href="#">Help</a>
                <a href="#">Order Tracker</a>
                <a href="#">Become a Member</a>
            </div>
        </div>
    </div>
    
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="navbar">
                <a href="index.html" class="logo">Hiraya<span>Fit</span></a>
                
                <div class="nav-icons">
                    <div class="account-dropdown" id="accountDropdown">
                        <a href="#" id="accountBtn"><i class="fas fa-user"></i></a>
                        <div class="account-dropdown-content" id="accountDropdownContent">
                            <h3>My Account</h3>
                            <a href="sign-in.html"><i class="fas fa-sign-in-alt"></i> Sign In</a>
                            <a href="sign-up.html"><i class="fas fa-user-plus"></i> Sign Up</a>
                            <a href="#orders"><i class="fas fa-box"></i> Track Orders</a>
                            <a href="#wishlist"><i class="fas fa-heart"></i> My Wishlist</a>
                        </div>
                    </div>
                    <a href="#"><i class="fas fa-heart"></i></a>
                    <a href="#" id="cartBtn">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count" id="cartCount">0</span>
                    </a>
                </div>
                
                <button class="menu-toggle" id="mobileMenuToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>
    
    <!-- Simplified Navigation -->
    <nav class="main-nav" id="mainNav">
        <a href="index.html">HOME</a>
        <a href="shop.html">SHOP</a>
        <a href="men.html">MEN</a>
        <a href="women.html">WOMEN</a>
        <a href="foot.html">FOOTWEAR</a>
        <a href="acces.html">ACCESSORIES</a>
        <a href="#about">ABOUT</a>
        <a href="#contact">CONTACT</a>
    </nav>
    
    <!-- Sign Up Section -->
    <section>
        <h1 class="page-title">Create Account</h1>
        
        <div class="signup-container">
            <form id="signupForm">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" class="form-control" placeholder="Enter your first name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" class="form-control" placeholder="Enter your last name" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number (Optional)</label>
                    <input type="tel" id="phone" class="form-control" placeholder="Enter your phone number">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Create a password" required>
                    <p class="password-requirements">Password must be at least 8 characters with uppercase, lowercase, number and special character</p>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm your password" required>
                </div>
                
                <div class="terms-group">
                    <div class="checkbox-group">
                        <input type="checkbox" id="termsAccept" required>
                        <label for="termsAccept">I agree to the <a href="#terms">Terms of Service</a> and <a href="#privacy">Privacy Policy</a></label>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="newsletter">
                        <label for="newsletter">Subscribe to our newsletter to receive updates on new arrivals and special promotions</label>
                    </div>
                </div>
                
                <button type="submit" class="btn-signup">CREATE ACCOUNT</button>
                
                <div class="social-signup">
                    <p>Or sign up with</p>
                    <div class="social-buttons">
                        <a href="#" class="social-btn"><i class="fab fa-google"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-apple"></i></a>
                    </div>
                </div>
                
                <div class="login-link">
                    Already have an account? <a href="sign-in.html">Sign in</a>
                </div>
            </form>
        </div>
    </section>
    
    <!-- Scripts -->
    <script>
        // JavaScript for mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mainNav = document.getElementById('mainNav');
            const accountBtn = document.getElementById('accountBtn');
            const accountDropdown = document.getElementById('accountDropdown');
            
            mobileMenuToggle.addEventListener('click', function() {
                mainNav.classList.toggle('active');
            });
            
            accountBtn.addEventListener('click', function(e) {
                e.preventDefault();
                accountDropdown.classList.toggle('active');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!accountBtn.contains(e.target) && !accountDropdown.contains(e.target)) {
                    accountDropdown.classList.remove('active');
                }
            });
            
            // Form validation
            const signupForm = document.getElementById('signupForm');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            
            signupForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Check if passwords match
                if (password.value !== confirmPassword.value) {
                    alert('Passwords do not match');
                    return;
                }
                
                // Password validation
                const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                if (!passwordRegex.test(password.value)) {
                    alert('Password must be at least 8 characters with uppercase, lowercase, number and special character');
                    return;
                }
                
                // If all validations pass
                alert('Account created successfully! You would be redirected to sign in page.');
                // Redirect to sign in page
                // window.location.href = 'sign-in.html';
            });
        });
    </script>
    <!-- Script for mobile menu and account dropdown functionality -->
   <script src="/js/home.js"></script>
   <script src="/js/search.js"></script>
   <script src="/js/details.js"></script>
   <script src="/js/cart.js"></script>
  
</body>
</html>