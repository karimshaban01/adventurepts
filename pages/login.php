<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Connection - Login</title>
    <style>
        :root {
            --adventure-yellow: #FFD700;
            --adventure-blue: #1E90FF;
            --adventure-red: #E63946;
            --adventure-black: #222222;
            --adventure-white: #FFFFFF;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(to bottom right, rgba(30, 144, 255, 0.1), rgba(230, 57, 70, 0.1));
        }
        
        .login-container {
            display: flex;
            width: 900px;
            height: 600px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            overflow: hidden;
        }
        
        .login-image {
            flex: 1;
            background-color: var(--adventure-blue);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("/api/placeholder/450/600");
            background-size: cover;
            background-position: center;
            opacity: 0.3;
        }
        
        .login-logo {
            width: 80%;
            max-width: 250px;
            position: relative;
            z-index: 10;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
        }
        
        .slogan {
            color: white;
            font-size: 1.2rem;
            text-align: center;
            margin-top: 20px;
            font-weight: 600;
            position: relative;
            z-index: 10;
        }
        
        .login-form {
            flex: 1;
            background-color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        h1 {
            color: var(--adventure-black);
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .input-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--adventure-black);
            font-weight: 500;
        }
        
        .input-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            border-color: var(--adventure-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 144, 255, 0.2);
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .remember {
            display: flex;
            align-items: center;
        }
        
        .remember input {
            margin-right: 8px;
        }
        
        .forgot-password {
            color: var(--adventure-blue);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: var(--adventure-red);
        }
        
        .btn-login {
            background-color: var(--adventure-blue);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(30, 144, 255, 0.3);
        }
        
        .btn-login:hover {
            background-color: var(--adventure-red);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
            transform: translateY(-2px);
        }
        
        .register-link {
            text-align: center;
            margin-top: 30px;
        }
        
        .register-link a {
            color: var(--adventure-blue);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .register-link a:hover {
            color: var(--adventure-red);
        }
        
        .accent-line {
            height: 5px;
            background: linear-gradient(to right, var(--adventure-yellow), var(--adventure-red));
            width: 50px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .stars {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 5;
        }
        
        .star {
            position: absolute;
            color: white;
            font-size: 20px;
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 95%;
                height: auto;
            }
            
            .login-image {
                height: 200px;
            }
            
            .login-form {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <form action="./red.php" method="POST">
    <div class="login-container">
        <div class="login-image">
            <div class="stars">
                <div class="star" style="top: 20%; left: 20%;">★</div>
                <div class="star" style="top: 30%; left: 70%;">★</div>
                <div class="star" style="top: 60%; left: 30%;">★</div>
                <div class="star" style="top: 75%; left: 75%;">★</div>
                <div class="star" style="top: 85%; left: 15%;">★</div>
                <div class="star" style="top: 15%; left: 85%;">★</div>
            </div>
            
            <p class="slogan">Delivering Adventure, Connecting Dreams</p>
        </div>
        <div class="login-form">
            <div class="accent-line"></div>
            <h1>Welcome Back!</h1>
            <div class="input-group">
                <label for="username">Email</label>
                <input type="text" id="username" placeholder="Enter your username or email" name="email">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your password" name="pass">
            </div>
            <div class="remember-forgot">
                <div class="remember">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="#" class="forgot-password">Forgot password?</a>
            </div>
            <button class="btn-login" name="sign-in">Sign In</button>
            <div class="register-link">
                Don't have an account? Contact admin <a href="mailto:karimxhaban@gmail.com">karimxhaban@gmail.com</a>
            </div>
        </div>
    </div>
    </form>

    