@extends('layouts.app')

@section('content')
<style>
 /* Center the container and ensure the navbar is visible */
.container {
    display: flex;
    flex-direction: column;
    gap: 40px;
    align-items: center;
    padding-top: 100px; /* Adjust this to add enough space for the navbar */
}

/* About Us container */
.about-us-container {
    width: 90%;
    max-width: 700px;
    padding: 30px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Title styling */
.form-title {
    font-size: 3rem;
    margin-bottom: 30px;
    color: #333;
    text-align: center;
}

/* Larger text for labels and controls */
.form-label {
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
    font-size: 1.5rem;
    display: block;
    text-align: left;
}

.form-control {
    width: 100%;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 1.2rem;
}

/* Submit Button */
.submit-btn {
    width: 100%;
    background-color: #9c9695;
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1.5rem;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.submit-btn:hover {
    background-color: #218838;
}

/* Success Alert */
.alert {
    font-size: 1.5rem;
    color: #28a745;
    margin-bottom: 20px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .form-title {
        font-size: 2.5rem;
    }

    .form-label {
        font-size: 1.2rem;
    }

    .form-control {
        font-size: 1rem;
    }

    .submit-btn {
        font-size: 1.2rem;
        padding: 12px;
    }
}

</style>
<h1 class="form-title">Manage About Us</h1>
<div class="container">
    <div class="about-us-container">
  

        <!-- Display success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display About Us data in a form for editing -->
        <form method="POST" action="{{ route('admin.about_us.update') }}">
            @csrf
            @method('PUT')

            <!-- Brief Field -->
            <div class="form-group">
                <label for="brief" class="form-label">Brief</label>
                <textarea class="form-control" id="brief" name="brief" rows="4" required>{{ old('brief', $aboutUs->brief) }}</textarea>
            </div>

            <!-- Vision Field -->
            <div class="form-group">
                <label for="vision" class="form-label">Vision</label>
                <textarea class="form-control" id="vision" name="vision" rows="4" required>{{ old('vision', $aboutUs->vision) }}</textarea>
            </div>

            <!-- Mission Field -->
            <div class="form-group">
                <label for="mission" class="form-label">Mission</label>
                <textarea class="form-control" id="mission" name="mission" rows="4" required>{{ old('mission', $aboutUs->mission) }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Update About Us</button>
        </form>
    </div>
</div>
@endsection
