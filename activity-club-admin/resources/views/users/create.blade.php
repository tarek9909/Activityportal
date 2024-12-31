@extends('layouts.app')

@section('content')
<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
        margin-top: 50px;
    }

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
        font-size: 1.4rem;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 1.3rem;
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
        padding: 12px 25px;
        font-size: 1.4rem;
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
</style>

<h1>Create New User</h1>

<div class="container">
    <div class="form-container">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" name="date_of_birth" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" class="form-control" name="mobile_number" required>
            </div>

            <div class="form-group">
                <label for="emergency_number">Emergency Number</label>
                <input type="text" class="form-control" name="emergency_number" required>
            </div>

            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" class="form-control" name="nationality" required>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control" name="photo">
            </div>

            <button type="submit" class="btn">Create User</button>
        </form>
    </div>
</div>
@endsection
