<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f8f9fa;">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 400px; border-radius: 10px; background-color: white;">
            <h4 class="text-center mb-3">Sign In</h4>

            <!-- Display error message for incorrect credentials -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }} <!-- Show error message -->
                </div>
            @endif

            <!-- Laravel Breeze Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" :value="old('email')" required autofocus>
                  
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" style="list-style-type: none;"/>
                <!-- Forgot Password -->
                <div class="mb-3 text-end">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>

                <!-- Go to Signup Button -->
                <div class="text-center">
                    <p>Don't have an account? 
                        <a href="{{ route('register') }}">Sign Up</a>
                    </p>
                </div>
            </form>

        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
