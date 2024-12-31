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
        max-width: 600px;
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

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
</style>

<h1>Create New Member</h1>

<div class="container">
    <div class="form-container">
        <!-- Error Display Section -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Dropdown to select user -->
            <div class="form-group">
                <label for="user_id">Select User</label>
                <select id="user_id" class="form-control" name="user_id" required>
                    <option value="" disabled selected>Select a user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" 
                                data-name="{{ $user->name }}" 
                                data-email="{{ $user->email }}" 
                                data-dob="{{ $user->date_of_birth }}" 
                                data-gender="{{ $user->gender }}"
                                data-photo="{{ asset('storage/' . $user->photo) }}" 
                                data-mobile="{{ $user->mobile_number }}" 
                                data-emergency="{{ $user->emergency_number }}" 
                                data-nationality="{{ $user->nationality }}">
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Autofilled fields based on selected user (disabled) -->
            <h3>User Information</h3>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name" disabled>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email" disabled>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" id="date_of_birth" class="form-control" name="date_of_birth" disabled>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" id="gender" class="form-control" name="gender" disabled>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <img id="photo-preview" src="" alt="User Photo" style="width:100px; height:100px; display: none;">
            </div>

            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" id="mobile_number" class="form-control" name="mobile_number" disabled>
            </div>

            <div class="form-group">
                <label for="emergency_number">Emergency Number</label>
                <input type="text" id="emergency_number" class="form-control" name="emergency_number" disabled>
            </div>

            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" id="nationality" class="form-control" name="nationality" disabled>
            </div>

            <!-- Member-specific fields -->
            <h3>Member Information</h3>
            <div class="form-group">
                <label for="joining_date">Joining Date</label>
                <input type="date" class="form-control" name="joining_date" required>
            </div>

            <!-- Event Selection -->
            <div class="form-group">
                <label for="event_id">Event</label>
                <select name="event_id" class="form-control" required>
                    <option value="" disabled selected>Select an Event</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn">Create Member</button>
        </form>
    </div>
</div>

<script>
    // JavaScript to autofill the form based on selected user
    document.getElementById('user_id').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        document.getElementById('name').value = selectedOption.getAttribute('data-name');
        document.getElementById('email').value = selectedOption.getAttribute('data-email');
        document.getElementById('date_of_birth').value = selectedOption.getAttribute('data-dob');
        document.getElementById('gender').value = selectedOption.getAttribute('data-gender');
        document.getElementById('mobile_number').value = selectedOption.getAttribute('data-mobile');
        document.getElementById('emergency_number').value = selectedOption.getAttribute('data-emergency');
        document.getElementById('nationality').value = selectedOption.getAttribute('data-nationality');

        var photo = selectedOption.getAttribute('data-photo');
        if (photo) {
            document.getElementById('photo-preview').style.display = 'block';
            document.getElementById('photo-preview').src = photo;
        } else {
            document.getElementById('photo-preview').style.display = 'none';
        }
    });
</script>
@endsection
