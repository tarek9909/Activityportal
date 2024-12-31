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
</style>

<h1>Edit Lookup</h1>
<div class="container">
    <div class="form-container">
    
        <form action="{{ route('admin.lookups.update', $lookup->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="code">Code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code', $lookup->code) }}" required>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $lookup->name) }}" required>
            </div>

            <div class="form-group">
                <label for="order">Order</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $lookup->order) }}">
            </div>

            <button type="submit" class="btn">Update Lookup</button>
        </form>
    </div>
</div>
@endsection
