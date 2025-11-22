<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Signin — Styled</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root{
      --card-width: 900px;
      --card-height: 560px;
      --accent-1: #06c28a; /* lighter green */
      --accent-2: #0e8c5f; /* darker green */
      --muted: #6c757d;
      --input-bg: #f2f2f2;
    }

    body {
      background: #e6e6e6;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
      font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .auth-card {
      width: min(var(--card-width), 96%);
      max-width: 1100px;
      height: var(--card-height);
      background: white;
      display: grid;
      grid-template-columns: 1fr 1fr;
      border-radius: 6px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
      overflow: hidden;
    }

    /* left column (form) */
    .auth-left {
      padding: 48px 48px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .auth-left h1 {
      font-weight: 800;
      margin-bottom: 28px;
      font-size: 36px;
    }

    .form-control.custom {
      background: var(--input-bg);
      border: 0;
      height: 48px;
      box-shadow: none;
      border-radius: 6px;
    }
    .form-control.custom:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(6,194,138,0.12);
    }

    .btn-signin {
      height: 48px;
      border-radius: 6px;
      background: linear-gradient(180deg,var(--accent-2),var(--accent-1));
      border: none;
      color: #fff;
      font-weight: 600;
      box-shadow: 0 6px 18px rgba(6,194,138,0.18);
    }

    .social-row .btn {
      width: 40px;
      height: 40px;
      padding: 0;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    .or-line {
      text-align: center;
      color: var(--muted);
      margin: 18px 0;
      font-size: 14px;
    }

    /* right column (green area) */
    .auth-right {
      color: #fff;
      padding: 56px 48px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: linear-gradient(180deg, #18d08c 0%, #0ea36a 100%);
      position: relative;
    }

    .auth-right h2 {
      font-weight: 700;
      margin-bottom: 12px;
      font-size: 28px;
    }

    .auth-right p {
      color: rgba(255,255,255,0.95);
      line-height: 1.6;
      margin-bottom: 22px;
    }

    .cta-pill {
      display: inline-block;
      padding: 10px 22px;
      background: rgba(255,255,255,0.12);
      color: #fff;
      border-radius: 30px;
      font-weight: 600;
      text-decoration: none;
      box-shadow: inset 0 -4px 0 rgba(0,0,0,0.06);
    }

    /* Smaller screens — stack columns */
    @media (max-width: 767px) {
      .auth-card {
        grid-template-columns: 1fr;
        height: auto;
      }
      .auth-right {
        order: -1;
        padding: 28px 20px;
      }
      .auth-left {
        padding: 28px 20px 40px;
      }
    }

    /* subtle image accent (uses your uploaded image) */
    .right-decor {
      position: absolute;
      right: 18px;
      bottom: 18px;
      width: 120px;
      height: 120px;
      opacity: 0.12;
      background-size: cover;
      background-position: center;
      border-radius: 12px;
    }
    
    .error {
      color: #ff6b6b;
      font-size: 0.875em;
      margin-top: 0.25rem;
    }
  </style>
</head>
<body>

  <div class="auth-card">
    <!-- LEFT: form -->
    <div class="auth-left">
      <h1>Signin</h1>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-3">
          <input type="email" name="email" class="form-control custom" placeholder="Email Address" value="{{ old('email') }}" aria-label="email">
          @error('email')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <input type="password" name="password" class="form-control custom" placeholder="Password" aria-label="password">
          @error('password')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3 form-check">
          <input type="checkbox" name="remember" class="form-check-input" id="remember">
          <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <div class="mb-3 d-grid">
          <button type="submit" class="btn btn-signin">Signin</button>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </form>
      
      <div class="text-center mt-3">
        <a href="{{ route('signup') }}" class="btn btn-success">Sign Up</a>
      </div>

      <div class="text-center or-line">or signin with</div>

      <div class="social-icons text-center mt-3">
          <img src="https://img.icons8.com/color/48/facebook.png">
          <img src="https://img.icons8.com/color/48/google-logo.png">
          <img src="https://img.icons8.com/color/48/linkedin.png">
      </div>

    </div>

    <!-- RIGHT: green gradient with message -->
    <div class="auth-right">
      <h2>Welcome back!</h2>
      <p>Welcome back! We are so happy to have you here. It's great to see you again. We hope you had a safe and enjoyable time away.</p>

      <a href="{{ route('signup') }}" class="cta-pill">No account yet? Signup.</a>

      <!-- decorative faint image using your uploaded file -->
      <div class="right-decor" style="background-image: url('/mnt/data/a6151505-1739-400a-9367-29420252da47.png');"></div>
    </div>
  </div>

  <!-- FontAwesome for icons -->
  <script src="https://kit.fontawesome.com/a2d9d8f7d1.js" crossorigin="anonymous"></script>

  <!-- Bootstrap JS (optional for dropdowns etc.) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>