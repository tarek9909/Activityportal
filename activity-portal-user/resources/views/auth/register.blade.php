<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f8f9fa;">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 400px; border-radius: 10px; background-color: white;">
            <h4 class="text-center mb-3">Sign Up</h4>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registrationForm">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required autofocus>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                </div>

                <!-- Date of Birth -->
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2 text-danger" />
                    <div id="ageError" class="form-text text-danger" style="display: none;">You must be at least 18 years old.</div>
                </div>

                <!-- Gender -->
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2 text-danger" />
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" style="list-style-type: none;" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[@$!%*#?&]).{8,}">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                    <div id="passwordHelp" class="form-text">Must be at least 8 characters, contain 1 letter, 1 number, and 1 special character.</div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                    <div id="passwordMismatchError" class="form-text text-danger" style="display: none;">Passwords do not match.</div>
                </div>

                <!-- Mobile Number -->
                <div class="mb-3">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter mobile number" value="{{ old('mobile_number') }}" required>
                    <x-input-error :messages="$errors->get('mobile_number')" class="mt-2 text-danger" />
                </div>

                <!-- Emergency Number -->
                <div class="mb-3">
                    <label for="emergency_number" class="form-label">Emergency Number</label>
                    <input type="text" class="form-control" id="emergency_number" name="emergency_number" placeholder="Enter emergency number" value="{{ old('emergency_number') }}" required>
                    <x-input-error :messages="$errors->get('emergency_number')" class="mt-2 text-danger" />
                </div>

                <!-- Nationality -->
                <div class="mb-3">
                    <label for="nationality" class="form-label">Nationality</label>
                    <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Enter nationality" value="{{ old('nationality') }}" required>
                    <x-input-error :messages="$errors->get('nationality')" class="mt-2 text-danger" />
                </div>

                <!-- Photo -->
                <div class="mb-3">
                    <label for="photo" class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                    <x-input-error :messages="$errors->get('photo')" class="mt-2 text-danger" />
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>

                <!-- Already registered link -->
                <div class="text-center">
                    <p>Already registered? 
                        <a href="{{ route('login') }}">Sign In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript validation for the password and date of birth -->
    <script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var passwordConfirmation = document.getElementById('password_confirmation').value;
            var dateOfBirth = new Date(document.getElementById('date_of_birth').value);
            var ageError = document.getElementById('ageError');
            var passwordMismatchError = document.getElementById('passwordMismatchError');

            // Reset error displays
            ageError.style.display = 'none';
            passwordMismatchError.style.display = 'none';

            // Validate password confirmation
            if (password !== passwordConfirmation) {
                event.preventDefault();
                passwordMismatchError.style.display = 'block';
            }

            // Validate age (at least 18 years old)
            var today = new Date();
            var age = today.getFullYear() - dateOfBirth.getFullYear();
            var monthDiff = today.getMonth() - dateOfBirth.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dateOfBirth.getDate())) {
                age--;
            }

            if (age < 18) {
                event.preventDefault();
                ageError.style.display = 'block';
            }
        });
    </script>
</body>

</html>
