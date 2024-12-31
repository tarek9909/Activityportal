@extends('layouts.app')

@section('content')
<style>
    .container {
        display: flex;
        flex-direction: column;
        gap: 70px;
        align-items: center;
        min-height: 80vh;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    /* Style for the H1 */
    h1 {
        color: black; /* Make the text black */
        font-size: 3rem; /* Increase font size */
        margin-bottom: 20px;
        text-align: center;
    }

    /* Style for the buttons */
    .btn-success, .btn-warning {
        color: black !important; /* Make the button text black */
        font-size: 1.5rem; /* Increase button font size */
    }

    /* Add outer border, border-radius, and responsive width */
    .table {
        border: 3px solid black; /* Outer border */
        border-radius: 15px; /* Add outer border-radius */
        width: 90%; /* Responsive width for small devices */
        max-width: 1000px; /* Max width for large screens */
        overflow: hidden; /* Ensure rounded corners affect inner elements */
        margin: 0 auto; /* Center table horizontally */
    }

    /* Add inner border and padding to table cells */
    .table td, .table th {
        text-align: center;
        border: 1px solid black; /* Inner borders for cells */
        padding: 15px; /* Increased padding for better spacing */
        font-size: 1.2rem; /* Increase cell text size */
    }

    /* Style the table header */
    .table thead th {
        background-color: #f0f0f0; /* Light background for headers */
        font-size: 1.3rem; /* Larger font size for headers */
    }

    /* Hover effect for table rows */
    .table tbody tr:hover {
        background-color: #e0e0e0; /* Change background color on hover */
    }

    /* Responsive adjustments for mobile screens */
    @media (max-width: 768px) {
        h1 {
            font-size: 2.5rem; /* Slightly smaller for mobile */
        }

        .table td, .table th {
            font-size: 1.4rem; /* Adjust font size for mobile */
            padding: 10px; /* Reduce padding for mobile */
        }

        .btn-success, .btn-warning {
            font-size: 1.2rem; /* Adjust button size for mobile */
        }
    }
    .btn-success {
        color: white !important;
        padding: 12px 24px; /* Larger padding */
        font-size: 1.6rem; /* Larger font size */
        border: none;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-block;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-right: 10px;
        background-color: #9c9695;
    }

    /* Hover effect for Add New Admin button */
    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-3px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }
    .btn-warning, .btn-danger {
        color: white !important;
        padding: 6px 12px; /* Smaller padding */
        font-size: 1.2rem; /* Smaller font size */
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-right: 10px;
    }

    /* Specific color styles for buttons */
    .btn-warning {
        background-color: #9c9695;
    }
    .btn-danger {
        background-color: #9c9695;
    }

    /* Hover effect for Edit and Delete buttons */
    .btn-warning:hover, .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Focus effect for accessibility */
    .btn-success:focus, .btn-warning:focus, .btn-danger:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .btn-success {
            font-size: 1.4rem;
            padding: 10px 20px;
        }

        .btn-warning, .btn-danger {
            font-size: 1rem;
            padding: 5px 10px; /* Adjust padding for mobile */
        }
    }
    .search-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-input {
        padding: 10px;
        font-size: 1.2rem;
        border: 2px solid black;
        border-radius: 5px;
    }

    .search-select {
        padding: 10px 25px 10px 25px;
        font-size: 1.2rem;
        border: 2px solid black;
        border-radius: 5px;
    }

    .search-btn {
        padding: 10px 20px;
        font-size: 1.2rem;
        background-color: #9c9695;
        border: none;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    .search-btn:hover {
        background-color: #218838;
    }
</style>
<h1>Manage Guides</h1>

<!-- Search Form -->
<div class="container">
    <form action="{{ route('admin.guides.index') }}" method="GET" class="search-container">
        <select name="column" class="search-select" required>
            <option value="name">Name</option>
            <option value="email">Email</option>
            <option value="event_id">Event</option>
            <option value="nationality">Nationality</option>
        </select>

        <input type="text" name="search" class="search-input" placeholder="Search guides..." required>

        <button type="submit" class="search-btn">Search</button>
    </form>
    <a href="{{ route('admin.guides.create') }}" class="btn btn-success mb-3">Create New Guide</a>
    <!-- Table displaying the guides -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Mobile Number</th>
                <th>Emergency Number</th>
                <th>Nationality</th>
                <th>Event</th>
                <th>Profession</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($guides->isEmpty())
                <tr>
                    <td colspan="11">No guides found</td>
                </tr>
            @else
                @foreach ($guides as $guide)
                    <tr>
                        <td>{{ optional($guide->member->user)->name }}</td>
                        <td>{{ optional($guide->member->user)->email }}</td>
                        <td>{{ optional($guide->member->user)->date_of_birth }}</td>
                        <td>{{ optional($guide->member->user)->gender }}</td>
                        <td>{{ optional($guide->member->user)->mobile_number }}</td>
                        <td>{{ optional($guide->member->user)->emergency_number }}</td>
                        <td>{{ optional($guide->member->user)->nationality }}</td>
                        <td>{{ optional($guide->event)->name }}</td>
                        <td>{{ $guide->profession }}</td>
                        <td>
                            @if(optional($guide->member->user)->photo)
                                <img src="{{ asset('storage/' . $guide->member->user->photo) }}" class="member-photo" alt="Member Photo">
                            @else
                                No Photo
                            @endif
                        </td>
                        <td style="border: 1px solid black; padding: 15px; text-align: center;">
    <div style="display: flex; gap: 10px; justify-content: center; align-items: center;">
        <a href="{{ route('admin.guides.edit', $guide->id) }}" class="btn btn-warning" style="border: none; box-shadow: none;">Edit</a>
        <form action="{{ route('admin.guides.destroy', $guide->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" style="border: none; box-shadow: none;">Delete</button>
        </form>
    </div>
</td>


                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="pagination-links">
        {{ $guides->links() }}
    </div>
  
</div>
@endsection
