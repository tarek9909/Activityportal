@extends('layouts.app')

@section('content')
<style>
    /* Style for the container */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        margin-top: 50px;
    }

    /* Form styling */
    .form-container {
        background-color: #f8f9fa;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 500px;
    }

    h1 {
        text-align: center;
        margin-bottom: -10px;
        font-size: 2.5rem;
        padding-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        font-size: 1.4rem; /* Larger font size for labels */
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 1.3rem; /* Larger font size for inputs */
        background-color: #fff;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: #80bdff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    .btn {
        display: inline-block;
        background-color: #9c9695;
        color: #fff;
        padding: 12px 25px; /* Increased button padding */
        font-size: 1.4rem; /* Larger font size for button */
        border: none;
        border-radius: 5px;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #218838;
    }

    /* Adjust image styling for user photo */
    .user-photo {
        display: block;
        margin-top: 10px;
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }
</style>

<h1>Edit User</h1>
<div class="container">
    <div class="form-container">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender" required>
                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password (Leave blank to keep current)</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}">
            </div>

            <div class="form-group">
                <label for="emergency_number">Emergency Number</label>
                <input type="text" class="form-control" name="emergency_number" value="{{ old('emergency_number', $user->emergency_number) }}">
            </div>

            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" class="form-control" name="nationality" value="{{ old('nationality', $user->nationality) }}">
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control" name="photo">
                @if ($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="User Photo" class="user-photo">
                @endif
            </div>

            <button type="submit" class="btn">Update User</button>
        </form>
    </div>
</div>
@endsection
