<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Lamadora</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .auth-card {
            width: 100%;
            max-width: 450px; /* Slightly wider for longer names */
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        .brand-logo {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -1px;
            color: #000000;
            text-transform: uppercase;
            margin-bottom: 5px;
            display: block;
            text-align: center;
        }

        .auth-card h5 {
            color: #6c757d;
            font-weight: 400;
            font-size: 0.9rem;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1.5px solid #e0e0e0;
            padding: 12px 15px;
            font-size: 0.95rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #000000;
            box-shadow: none;
            background-color: #fff;
        }

        .btn-business {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 6px;
            margin-top: 10px;
        }

        .btn-business:hover {
            background-color: #222222;
            color: #ffffff;
        }

        .footer-link {
            font-size: 0.85rem;
            color: #6c757d;
            text-decoration: none;
        }

        .footer-link:hover {
            color: #000000;
            text-decoration: underline;
        }

        .divider {
            height: 1px;
            background: #eeeeee;
            margin: 25px 0;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <span class="brand-logo">Registration</span>
    

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control"  value="{{ old('name') }}" required>
            @error('name') 
                <small class="text-danger mt-1 d-block">{{ $message }}</small> 
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') 
                <small class="text-danger mt-1 d-block">{{ $message }}</small> 
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control"  required>
            @error('password') 
                <small class="text-danger mt-1 d-block">{{ $message }}</small> 
            @enderror
        </div>
        <div class="mb-3">
        <label class="form-label">Admin Key (optional)</label>
        <input type="text" name="admin_key" class="form-control" placeholder="Enter key for admin access">
        </div>
        <button type="submit" class="btn btn-business w-100">
            Create Account
        </button>

        <div class="divider"></div>

        <div class="text-center">
            <span class="text-muted small">Already have an account?</span> <br>
            <a href="{{ route('login') }}" class="footer-link fw-bold">Sign In </a>
        </div>
    </form>
</div>

</body>
</html>