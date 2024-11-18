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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0 10px;
            color: #4a4a4a;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: url(https://i.pinimg.com/736x/7d/cd/a6/7dcda6e747d490bff6a0b0a6eb5b1ce6.jpg), #000;
            background-position: center;
            background-size: contain;
            z-index: -1;
        }

        .wrapper {
            width: 490px;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            border: 1px solid #f0f2f5;
            backdrop-filter: blur(8px);
            background-color: rgba(0, 0, 0, 0.7);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #f9f9f9;
        }

        .input-field {
            position: relative;
            border-bottom: 2px solid #f0f2f5;
            margin: 15px 0;
        }

        .input-field label {
            position: absolute;
            color: #ddd;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-size: 16px;
            pointer-events: none;
            transition: 0.15s ease;
        }

        .input-field input {
            width: 100%;
            height: 40px;
            color: #f0f2f5;
            background: transparent;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .input-field input:focus ~ label,
        .input-field input:valid ~ label {
            font-size: 0.8rem;
            top: 10px;
            transform: translateY(-120%);
        }

        .input-field .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #ddd;
        }

        .forget {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 25px 0 35px 0;
            color: #f0f2f5;
        }

        #remember {
            accent-color: #f0f2f5;
        }

        .forget label {
            display: flex;
            align-items: center;
        }

        .forget label p {
            margin-left: 8px;
        }

        .wrapper a {
            color: #f0f2f5;
            text-decoration: underline;
        }

        button {
            background: #f0f2f5;
            color: #000;
            font-weight: 600;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
            border: 2px solid transparent;
            transition: 0.3s ease;
        }

        button:hover {
            background: #e0e0e0;
        }

        .register {
            text-align: center;
            margin-top: 30px;
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <h2>Welcome To<br>
        Upik Cabon Store</h2>
        <div class="input-field">
            <input type="text" name="email" id="email" required>
            <label>Enter your email</label>
        </div>
        <div class="input-field">
            <input type="password" name="password" id="password" required>
            <label>Enter your password</label>
            <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility()"></i>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <button type="submit">Log In</button>
    </form>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.toggle-password');
        
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
