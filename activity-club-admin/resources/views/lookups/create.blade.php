@extends('layouts.app')

@section('content')
<style>
    /* Style for the container */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 90vh;
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

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert-danger li {
        font-size: 1.2rem;
    }
</style>

<h1>Create New Lookup</h1>
<div class="container">
    <div class="form-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.lookups.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" class="form-control" name="code" value="{{ old('code') }}" required>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="order">Order</label>
                <input type="number" class="form-control" name="order" value="{{ old('order') }}">
            </div>

            <button type="submit" class="btn">Create Lookup</button>
        </form>
    </div>
</div>
@endsection
