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
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        margin-bottom: 20px;
        font-size: 1.2rem;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    .btn {
        padding: 12px 25px;
        font-size: 1.4rem;
        text-transform: uppercase;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #218838;
    }

    .member-info {
        display: none;
        margin-top: 20px;
    }

    .member-info h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .member-info p {
        font-size: 1.2rem;
    }

    .member-info img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 10px;
    }
</style>

<h1>Create New Guide</h1>

<div class="container">
    <div class="form-container">
        <form action="{{ route('admin.guides.store') }}" method="POST">
            @csrf

            <!-- Event Selection -->
            <div class="form-group">
                <label for="event">Select Event:</label>
                <select name="event_id" id="event" class="form-control" required>
                    <option value="">-- Select Event --</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Member Selection -->
            <div class="form-group">
                <label for="member">Select Member:</label>
                <select name="member_id" id="member" class="form-control" required>
                    <option value="">-- Select Member --</option>
                    <!-- Members will be loaded here via AJAX -->
                </select>
            </div>

            <!-- Display selected member information -->
            <div class="member-info" id="member-info">
                <h3>Member Information</h3>
                <img id="member-photo" src="" alt="Member Photo" />
                <p><strong>Name:</strong> <span id="member-name"></span></p>
                <p><strong>Email:</strong> <span id="member-email"></span></p>
                <p><strong>Date of Birth:</strong> <span id="member-dob"></span></p>
                <p><strong>Gender:</strong> <span id="member-gender"></span></p>
                <p><strong>Mobile Number:</strong> <span id="member-mobile"></span></p>
                <p><strong>Emergency Number:</strong> <span id="member-emergency"></span></p>
                <p><strong>Nationality:</strong> <span id="member-nationality"></span></p>
            </div>

            <div class="form-group">
                <label for="joining_date">Joining Date:</label>
                <input type="date" name="joining_date" class="form-control" required>
            </div>

            <!-- Profession Input -->
            <div class="form-group">
                <label for="profession">Profession:</label>
                <input type="text" name="profession" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Create Guide</button>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
    // Handle event change to load members via AJAX
    document.getElementById('event').addEventListener('change', function () {
        var eventId = this.value;
        var memberSelect = document.getElementById('member');
        var memberInfo = document.getElementById('member-info');

        memberSelect.innerHTML = '<option value="">-- Select Member --</option>'; // Reset members dropdown
        memberInfo.style.display = 'none'; // Hide member info by default

        if (eventId) {
            fetch(`/admin/guides/members/${eventId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(member => {
                        var option = document.createElement('option');
                        option.value = member.id;
                        option.text = member.user.name;
                        memberSelect.appendChild(option);
                    });
                });
        }
    });

    // Handle member selection to display their data
    document.getElementById('member').addEventListener('change', function () {
        var memberId = this.value;
        var memberInfo = document.getElementById('member-info');
        
        if (memberId) {
            fetch(`/admin/guides/member-info/${memberId}`)
                .then(response => response.json())
                .then(member => {
                    // Populate member info
                    document.getElementById('member-name').innerText = member.user.name;
                    document.getElementById('member-email').innerText = member.user.email;
                    document.getElementById('member-dob').innerText = member.user.date_of_birth;
                    document.getElementById('member-gender').innerText = member.user.gender;
                    document.getElementById('member-mobile').innerText = member.user.mobile_number;
                    document.getElementById('member-emergency').innerText = member.user.emergency_number;
                    document.getElementById('member-nationality').innerText = member.user.nationality;
                    if (member.user.photo) {
                        document.getElementById('member-photo').src = `/storage/${member.user.photo}`;
                    } else {
                        document.getElementById('member-photo').src = ''; // Clear the image if no photo
                    }

                    // Show member info section
                    memberInfo.style.display = 'block';
                });
        } else {
            memberInfo.style.display = 'none'; // Hide if no member is selected
        }
    });
</script>

@endsection
