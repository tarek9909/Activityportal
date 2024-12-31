@extends('layouts.app')

@section('content')
<style>
    /* Style for the container */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
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

<h1>{{ isset($event) ? 'Edit Event' : 'Create New Event' }}</h1>
<div class="container">
    <div class="form-container">
        <form id="event-form" action="{{ isset($event) ? route('admin.events.update', $event->id) : route('admin.events.store') }}" method="POST">
            @csrf
            @if(isset($event))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', isset($event) ? $event->name : '') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" required>{{ old('description', isset($event) ? $event->description : '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($event) && $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" class="form-control" name="destination" value="{{ old('destination', isset($event) ? $event->destination : '') }}" required>
            </div>

            <div class="form-group">
                <label for="date_from">Date From</label>
                <input type="date" class="form-control" name="date_from" value="{{ old('date_from', isset($event) ? $event->date_from : '') }}" required>
            </div>

            <div class="form-group">
                <label for="date_to">Date To</label>
                <input type="date" class="form-control" name="date_to" value="{{ old('date_to', isset($event) ? $event->date_to : '') }}" required>
            </div>

            <div class="form-group">
                <label for="cost">Cost</label>
                <input type="number" class="form-control" name="cost" value="{{ old('cost', isset($event) ? $event->cost : '') }}" required>
            </div>

            <!-- New Fields for Max Seats, Enrolled Users, and Publish Status -->
            <div class="form-group">
                <label for="max_seats">Max Seats</label>
                <input type="number" class="form-control" name="max_seats" value="{{ old('max_seats', isset($event) ? $event->max_seats : '') }}" required>
            </div>

            <div class="form-group">
                <label for="is_published">Publish Status</label>
                <select class="form-control" name="is_published" required>
                    <option value="1" {{ isset($event) && $event->is_published ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ isset($event) && !$event->is_published ? 'selected' : '' }}>Unpublished</option>
                </select>
            </div>

            <input type="hidden" name="status" id="status" value="planned">

            <button type="submit" class="btn">{{ isset($event) ? 'Update Event' : 'Create Event' }}</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('event-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form from submitting

            var dateFromElement = document.getElementById('date_from');
            var dateToElement = document.getElementById('date_to');
            var statusField = document.getElementById('status');
            var currentDate = new Date();

            // Check if date elements exist and have values
            if (dateFromElement && dateFromElement.value && dateToElement && dateToElement.value) {
                var dateFrom = new Date(dateFromElement.value);
                var dateTo = new Date(dateToElement.value);

                // Determine the event status based on dates
                if (currentDate < dateFrom) {
                    statusField.value = 'planned'; // Event hasn't started yet
                } else if (currentDate >= dateFrom && currentDate <= dateTo) {
                    statusField.value = 'ongoing'; // Event is ongoing
                } else if (currentDate > dateTo) {
                    statusField.value = 'completed'; // Event is completed
                }
            } else {
                console.error('Date fields are not properly populated.');
            }

            // Submit the form
            this.submit();
        });
    });
</script>
@endsection
