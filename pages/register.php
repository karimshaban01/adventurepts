<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Connection - Registration</title>
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
            min-height: 100vh;
            background-image: linear-gradient(to bottom right, rgba(30, 144, 255, 0.1), rgba(230, 57, 70, 0.1));
            padding: 20px;
        }
        
        .registration-container {
            display: flex;
            width: 1000px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            overflow: hidden;
        }
        
        .registration-image {
            flex: 1;
            background-color: var(--adventure-blue);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 40px;
        }
        
        .registration-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("/api/placeholder/450/800");
            background-size: cover;
            background-position: center;
            opacity: 0.3;
        }
        
        .registration-logo {
            width: 80%;
            max-width: 250px;
            position: relative;
            z-index: 10;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.3));
            margin-bottom: 30px;
        }
        
        .benefits {
            position: relative;
            z-index: 10;
            color: white;
            width: 100%;
        }
        
        .benefits h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            position: relative;
        }
        
        .benefits h2::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background-color: var(--adventure-yellow);
            border-radius: 2px;
        }
        
        .benefit-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .benefit-icon {
            width: 30px;
            height: 30px;
            background-color: var(--adventure-yellow);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .registration-form {
            flex: 1.2;
            background-color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
        }
        
        h1 {
            color: var(--adventure-black);
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .input-group {
            flex: 1;
            margin-bottom: 5px;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--adventure-black);
            font-weight: 500;
        }
        
        .input-group input, .input-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus, .input-group select:focus {
            border-color: var(--adventure-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 144, 255, 0.2);
        }
        
        .terms {
            margin: 20px 0;
            display: flex;
            align-items: flex-start;
        }
        
        .terms input {
            margin-right: 10px;
            margin-top: 5px;
        }
        
        .terms label {
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .terms a {
            color: var(--adventure-blue);
            text-decoration: none;
        }
        
        .btn-register {
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
            margin-top: 10px;
        }
        
        .btn-register:hover {
            background-color: var(--adventure-red);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
            transform: translateY(-2px);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .login-link a {
            color: var(--adventure-blue);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .login-link a:hover {
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
        
        @media (max-width: 900px) {
            .registration-container {
                flex-direction: column;
                width: 95%;
            }
            
            .registration-image {
                padding: 30px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
<form action="" method="POST">
    <div class="registration-container">
        <div class="registration-image">
            <div class="stars">
                <div class="star" style="top: 15%; left: 20%;">★</div>
                <div class="star" style="top: 25%; left: 70%;">★</div>
                <div class="star" style="top: 50%; left: 30%;">★</div>
                <div class="star" style="top: 65%; left: 75%;">★</div>
                <div class="star" style="top: 85%; left: 15%;">★</div>
                <div class="star" style="top: 10%; left: 85%;">★</div>
            </div>
            <!-- <img src="/api/placeholder/250/100" alt="Adventure Connection Logo" class="registration-logo"> -->
            <div class="benefits">
                <h2>Why Choose Us?</h2>
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <div>Fast and reliable adventure gear delivery</div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <div>Specialized handling for delicate equipment</div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <div>Global shipping to remote destinations</div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <div>Real-time tracking and notifications</div>
                </div>
                <div class="benefit-item">
                    <div class="benefit-icon">✓</div>
                    <div>Insurance coverage for high-value items</div>
                </div>
            </div>
        </div>
        
        <div class="registration-form">
            <div class="accent-line"></div>
            <h1>Create Your Account</h1>
            
            <div class="form-row">
                <div class="input-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" placeholder="Enter your first name" name="firstname">
                </div>
                <div class="input-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" placeholder="Enter your last name" name="lastname">
                </div>
            </div>
            
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" placeholder="Enter your email address" name="email">
            </div>
            
            <div class="form-row">
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" placeholder="Enter your phone number" name="phone_number">
                </div>
                <div class="input-group">
                    <label for="userType">Account Type</label>
                    <select id="userType" name="roles">
                        <option value="">Select account type</option>
                        <option value="admin">Admin</option>
                        <option value="driver">Driver</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Create a password" name="password1">
                </div>
                <div class="input-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" placeholder="Confirm your password" name="password2">
                </div>
            </div>
            
            <div class="input-group">
                <label for="address">Address</label>
                <input type="text" id="address" placeholder="Enter your address" name="address">
            </div>
            
            <div class="terms">
                <input type="checkbox" id="terms" name="terms">
                <label for="terms">I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a> of Adventure Connection. I understand that my personal data will be processed as described in the Privacy Policy.</label>
            </div>
            
            <button class="btn-register" name="submit">Create Account</button>
            
            <!-- <div class="login-link" >
                Already have an account? <a href="login.php">Sign in</a>
            </div> -->
        </div>
   
    </div>
    </form>

    <?php
        include '../includes/connection.php';

        if(isset($_POST['submit'])){
            $id = 'STAFF-'.date('YmdHis');
            $created_at = date('Y-m-d H:i:s');
            $created_by ="admin";
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phone = $_POST['phone_number'];
            $roles = $_POST['roles'];
            $pass1 = $_POST['password1'];
            $pass2 = $_POST['password2'];
            $address = $_POST['address'];
            $terms = $_POST['terms'];

            if($pass1 == $pass2){

            $pass1 = md5($pass1);
            
            $sql = "INSERT INTO staff VALUES('$id', '$created_at', '$created_by', '$firstname', '$lastname', '$email', '$phone', '$roles', '$pass1', '$address', '$terms')";
            $conn->query($sql);
            //echo "new record";
        }
    }
    ?>