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

.form-description {
    margin-bottom: 20px;
    color: #6c757d;
    text-align: center;
    font-size: 14px;
}

.form-group {
    display: flex;
    flex-direction: column;
    justify-content: center;
   
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 14px;
}

.form-input {
    width: 90%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    margin: 10px;
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
            <div class="form-description">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" class="form-label" style="padding-left: 8px;" />
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="error-message" />
                </div>

                <div class="form-action">
                    <x-primary-button class="form-button">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
