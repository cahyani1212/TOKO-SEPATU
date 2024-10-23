<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f0f2f5, #d9e3e5);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            width: 200%;
            max-width: 800px;
            height: 80%;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: all 0.4s ease;
            animation: fadeIn 1.2s ease-out;
        }

        .login-form {
            flex: 1;
            padding: 20px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
        }

        img.logo {
            max-width: 30%;
            height: auto;
            margin: 0 auto 0px; 
            display: block;
        }

        h2 {
            font-size: 28px;
            margin: 25px 0;
            color: #333;
            font-weight: 600;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a4a4a;
            font-size: 15px;
        }

        .form-group input {
            width: 85%; /* Use full width */
            padding: 14px;
            padding-left: 40px; /* Space for the icon */
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #f9f9f9;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
        }

        .form-group .icon {
            position: relative;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 20px; /* Adjust size as needed */
            pointer-events: none; /* Prevents icon from interfering with input */
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #007bff;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: #0056b3;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 10px; /* Increased font size */
            width: 100%; /* Full width */
            font-weight: 600; /* Increased font weight for better visibility */
            transition: all 0.3s ease;
            margin-top: 10px; /* Space above button */
        }

        .btn:hover {
            background-color: #0056b3;
            box-shadow: 0 5px 20px rgba(0, 123, 255, 0.3);
        }

        .right-side {
            flex: 1;
            background-image: url('https://i.pinimg.com/564x/e3/07/29/e307290dde2dd0abe00293fd18e57369.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
        }


        .right-side .text-overlay {
            position: absolute;
            z-index: 2;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-weight: 600;
            letter-spacing: 1px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
                height: auto;
            }

            .right-side {
                height: 250px;
            }

            .btn {
                font-size: 14px;
                padding: 10px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-form">
        <img class="logo" src="https://i.pinimg.com/736x/f1/ba/8a/f1ba8ab603a311e2cdbefedec4fa6c18.jpg" alt="Upik Cabon Store Logo">
        <h2>Welcome Back To <br> Upik Cabon Store!</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Username</label>
                <input type="email" name="email" id="email" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
                <i class="fas fa-eye toggle-password" id="togglePassword" aria-label="Show/Hide Password" onclick="togglePasswordVisibility()"></i>
            </div>
            <button type="submit" class="btn">LOGIN</button>
        </form>
    </div>
    <div class="right-side">
        <div class="text-overlay">
            <!-- Any additional content can go here -->
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePassword');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>