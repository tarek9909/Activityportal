<x-guest-layout>
    <style>
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .form-card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
        }

        .error-message {
            margin-top: 5px;
            color: #dc3545;
            font-size: 13px;
        }

        .form-action {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .form-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="form-container">
        <div class="form-card">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" class="form-label" />
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" :value="__('Password')" class="form-label" />
                    <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="error-message" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />
                    <x-text-input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
                </div>

                <div class="form-action">
                    <x-primary-button class="form-button">
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
