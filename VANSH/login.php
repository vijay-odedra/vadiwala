<?php
session_start();

// ---------------- DATABASE CONNECTION ----------------
$con = mysqli_connect("localhost", "root", "", "vadiwala");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// ---------------- SIGNUP ----------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $email = trim(mysqli_real_escape_string($con, $_POST['email']));
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    if ($password === $confirm_password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $check = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('⚠️ Email already registered!');</script>";
        } else {
            $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";
            if (mysqli_query($con, $sql)) {
                echo "<script>alert('✅ Signup successful! You can login now.');</script>";
            } else {
                echo "<script>alert('❌ Signup failed: " . mysqli_error($con) . "');</script>";
            }
        }
    } else {
        echo "<script>alert('⚠️ Passwords do not match!');</script>";
    }
}

// ---------------- LOGIN ----------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim(mysqli_real_escape_string($con, $_POST['login_email']));
    $password = mysqli_real_escape_string($con, $_POST['login_password']);

    // Admin login check
    if ($email === "admin" && $password === "admin") {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = "admin";
        header("Location: order.php");
        exit();
    }

    // User login check
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = "user";
            header("Location: order.php");
            exit();
        } else {
            echo "<script>alert('❌ Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('❌ User not found! Please sign up.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #FFF8DC 0%, #F5E6D3 50%, #FFE4E1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(220, 20, 60, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 380px;
            position: relative;
        }

        .form-container {
            padding: 30px 25px;
            position: relative;
        }

        .toggle-container {
            display: flex;
            background: #FFF8DC;
            border-radius: 10px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .toggle-btn {
            flex: 1;
            padding: 12px;
            text-align: center;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            color: #DC143C;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .toggle-btn.active {
            color: white;
        }

        .toggle-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(135deg, #DC143C, #B22222);
            border-radius: 8px;
            transition: transform 0.3s ease;
            z-index: 1;
        }

        .toggle-slider.signup {
            transform: translateX(100%);
        }

        .form {
            display: none;
        }

        .form.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-group {
            margin-bottom: 18px;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #FFF8DC;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #FEFEFE;
        }

        .form-input:focus {
            outline: none;
            border-color: #DC143C;
            box-shadow: 0 0 0 3px rgba(220, 20, 60, 0.1);
        }

        .form-input::placeholder {
            color: #999;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #DC143C, #B22222);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 20, 60, 0.3);
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
            color: #666;
            font-size: 14px;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #E0E0E0;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            font-size: 14px;
        }

        .social-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .social-btn {
            flex: 1;
            padding: 12px 8px;
            border: 2px solid #E0E0E0;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-weight: 500;
            font-size: 13px;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .google-btn:hover {
            border-color: #DB4437;
            color: #DB4437;
        }

        .facebook-btn:hover {
            border-color: #4267B2;
            color: #4267B2;
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #DC143C;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .social-icon {
            width: 18px;
            height: 18px;
        }

        .error-message {
            color: #DC143C;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        @media (max-width: 768px) {
            .container {
                margin: 15px;
                max-width: 350px;
            }
            
            .form-container {
                padding: 25px 20px;
            }

            .form-input {
                padding: 12px 16px;
                font-size: 14px;
            }

            .submit-btn {
                padding: 12px;
                font-size: 14px;
            }

            .toggle-btn {
                padding: 10px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .container {
                margin: 10px;
                max-width: 320px;
            }
            
            .form-container {
                padding: 20px 18px;
            }

            .social-buttons {
                gap: 8px;
            }

            .social-btn {
                padding: 10px 6px;
                font-size: 12px;
            }

            .form-input {
                padding: 10px 14px;
            }

            .submit-btn {
                padding: 11px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="toggle-container">
                <button class="toggle-btn active" onclick="showLogin()">Login</button>
                <button class="toggle-btn" onclick="showSignup()">Sign Up</button>
                <div class="toggle-slider" id="toggleSlider"></div>
            </div>

            <!-- Login Form -->
            <form class="form active" id="loginForm" method="POST" action="">
                <div class="form-group">
                    <input type="email" name="login_email" class="form-input" placeholder="Email address" required>
                    <div class="error-message">Please enter a valid email</div>
                </div>
                <div class="form-group">
                    <input type="password" name="login_password" class="form-input" placeholder="Password" required>
                    <div class="error-message">Password is required</div>
                </div>
                <button type="submit" name="login" class="submit-btn">Login</button>
                
                <div class="divider">
                    <span>or continue with</span>
                </div>
                
                <div class="social-buttons">
                    <button type="button" class="social-btn google-btn" onclick="loginWithGoogle()">
                        <svg class="social-icon" viewBox="0 0 24 24">
                            <path fill="#DB4437" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Google
                    </button>
                    <button type="button" class="social-btn facebook-btn" onclick="loginWithFacebook()">
                        <svg class="social-icon" viewBox="0 0 24 24" fill="#4267B2">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </button>
                </div>
                
                <div class="forgot-password">
                    <a href="#" onclick="showForgotPassword()">Forgot your password?</a>
                </div>
            </form>

            <!-- Signup Form -->
            <form class="form" id="signupForm" method="POST" action="">
            
                <div class="form-group">
        <input type="email" name="email" class="form-input" placeholder="Email address" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-input" placeholder="Password" required>
    </div>
    <div class="form-group">
        <input type="password" name="confirm_password" class="form-input" placeholder="Confirm password" required>
    </div>
    <button type="submit" class="submit-btn" name="signup">Create Account</button>
                
                <div class="divider">
                    <span>or sign up with</span>
                </div>
                
                <div class="social-buttons">
                    <button type="button" class="social-btn google-btn" onclick="signupWithGoogle()">
                        <svg class="social-icon" viewBox="0 0 24 24">
                            <path fill="#DB4437" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Google
                    </button>
                    <button type="button" class="social-btn facebook-btn" onclick="signupWithFacebook()">
                        <svg class="social-icon" viewBox="0 0 24 24" fill="#4267B2">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebook
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showLogin() {
            document.getElementById('loginForm').classList.add('active');
            document.getElementById('signupForm').classList.remove('active');
            document.querySelector('.toggle-btn').classList.add('active');
            document.querySelectorAll('.toggle-btn')[1].classList.remove('active');
            document.getElementById('toggleSlider').classList.remove('signup');
        }

        function showSignup() {
            document.getElementById('signupForm').classList.add('active');
            document.getElementById('loginForm').classList.remove('active');
            document.querySelectorAll('.toggle-btn')[1].classList.add('active');
            document.querySelector('.toggle-btn').classList.remove('active');
            document.getElementById('toggleSlider').classList.add('signup');
        }

        function loginWithGoogle() {
            alert('Google login integration would go here. In a real application, you would integrate with Google OAuth.');
        }

        function loginWithFacebook() {
            alert('Facebook login integration would go here. In a real application, you would integrate with Facebook Login.');
        }

        function signupWithGoogle() {
            alert('Google signup integration would go here. In a real application, you would integrate with Google OAuth.');
        }

        function signupWithFacebook() {
            alert('Facebook signup integration would go here. In a real application, you would integrate with Facebook Login.');
        }

        function showForgotPassword() {
            alert('Forgot password functionality would go here. Typically this would open a modal or redirect to a password reset page.');
        }

        // Form validation


        // Add hover effects and smooth transitions
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>