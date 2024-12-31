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
        max-width: 600px; /* Slightly larger for events */
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

<h1>Edit Event</h1>
<div class="container">
    <div class="form-container">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $event->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" required>{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" class="form-control" name="destination" value="{{ old('destination', $event->destination) }}" required>
            </div>

            <div class="form-group">
                <label for="date_from">Date From</label>
                <input type="date" class="form-control" name="date_from" value="{{ old('date_from', $event->date_from) }}" required>
            </div>

            <div class="form-group">
                <label for="date_to">Date To</label>
                <input type="date" class="form-control" name="date_to" value="{{ old('date_to', $event->date_to) }}" required>
            </div>

            <div class="form-group">
                <label for="cost">Cost</label>
                <input type="number" class="form-control" name="cost" value="{{ old('cost', $event->cost) }}" required>
            </div>

            <!-- New Fields: Max Seats, Enrolled Users, and Publish Status -->
            <div class="form-group">
                <label for="max_seats">Max Seats</label>
                <input type="number" class="form-control" name="max_seats" value="{{ old('max_seats', $event->max_seats) }}" required>
            </div>

            <div class="form-group">
                <label for="is_published">Publish Status</label>
                <select class="form-control" name="is_published" required>
                    <option value="1" {{ $event->is_published ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ !$event->is_published ? 'selected' : '' }}>Unpublished</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" required>
                    <option value="planned" {{ old('status', $event->status) == 'planned' ? 'selected' : '' }}>Planned</option>
                    <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="canceled" {{ old('status', $event->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
            </div>

            <button type="submit" class="btn">Update Event</button>
        </form>
    </div>
</div>
@endsection
