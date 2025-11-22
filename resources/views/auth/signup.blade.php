<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #d9d9d9;
            font-family: 'Poppins', sans-serif;
        }

        .container-box {
            width: 900px;
            background: #fff;
            margin: 40px auto;
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
        }

        .left-form {
            width: 50%;
            padding: 50px 40px;
        }

        .left-form h2 {
            font-weight: 600;
            margin-bottom: 25px;
        }

        .left-form input {
            border-radius: 8px;
            height: 45px;
        }

        .left-form button {
            width: 100%;
            height: 45px;
            border-radius: 8px;
            background: #00966b;
            border: none;
            color: #fff;
            font-size: 16px;
            margin-top: 15px;
        }

        .right-box {
            width: 50%;
            background: linear-gradient(135deg, #00c6a7, #00966b);
            padding: 60px 40px;
            color: #fff;
        }

        .right-box h2 {
            font-weight: 600;
        }

        .right-box button {
            padding: 10px 25px;
            border-radius: 20px;
            background: #00b48b;
            border: none;
            margin-top: 20px;
            color: #fff;
        }

        .social-icons img {
            width: 35px;
            margin-right: 10px;
            cursor: pointer;
        }
        
        .error {
            color: red;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>

</head>
<body>

<div class="container-box">

    <!-- LEFT FORM -->
    <div class="left-form">
        <h2>Signup</h2>

        <form method="POST" action="{{ route('signup') }}">
            @csrf
            
            <div class="mb-3">
                <input type="text" name="name" class="form-control mb-3" placeholder="Full Name" value="{{ old('name') }}">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" value="{{ old('email') }}">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <input type="password" name="password" class="form-control mb-3" placeholder="Password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirm Password">
            </div>

            <button type="submit">Signup</button>
        </form>
        
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
        </div>

        <div class="text-center mt-3">or signup with</div>

        <div class="social-icons text-center mt-3">
            <img src="https://img.icons8.com/color/48/facebook.png">
            <img src="https://img.icons8.com/color/48/google-logo.png">
            <img src="https://img.icons8.com/color/48/linkedin.png">
        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="right-box d-flex flex-column justify-content-center">
        <h2>Welcome!</h2>
        <p>Create your account and join our community.  
            We're excited to have you onboard.</p>

        <button onclick="window.location.href='{{ route('login') }}'">Already have an account? Login</button>
    </div>

</div>

</body>
</html>