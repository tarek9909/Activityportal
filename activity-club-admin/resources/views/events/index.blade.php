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
        color: black;
        font-size: 3rem;
        margin-bottom: 20px;
        text-align: center;
    }

    /* Style for the buttons */
    .btn-success, .btn-warning {
        color: black !important;
        font-size: 1.5rem;
    }

    /* Add outer border, border-radius, and responsive width */
    .table {
        border: 3px solid black;
        border-radius: 15px;
        width: 90%;
        max-width: 1000px;
        overflow: hidden;
        margin: 0 auto;
    }

    /* Add inner border and padding to table cells */
    .table td, .table th {
        text-align: center;
        border: 1px solid black;
        padding: 15px;
        font-size: 1.2rem;
    }

    /* Style the table header */
    .table thead th {
        background-color: #f0f0f0;
        font-size: 1.3rem;
    }

    /* Hover effect for table rows */
    .table tbody tr:hover {
        background-color: #e0e0e0;
    }

    /* Responsive adjustments for mobile screens */
    @media (max-width: 768px) {
        h1 {
            font-size: 2.5rem;
        }

        .table td, .table th {
            font-size: 1.4rem;
            padding: 10px;
        }

        .btn-success, .btn-warning {
            font-size: 1.2rem;
        }
    }

    .btn-success {
        color: white !important;
        padding: 12px 24px;
        font-size: 1.6rem;
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

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-3px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-warning, .btn-danger {
        color: white !important;
        padding: 6px 12px;
        font-size: 1.2rem;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        display: inline-block;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-right: 10px;
    }

    .btn-warning {
        background-color: #9c9695;
    }

    .btn-danger {
        background-color: #9c9695;
    }

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
        padding: 10px 25px;
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

<h1>Manage Events</h1>

<!-- Search Form -->
<div class="container">
    <form action="{{ route('admin.events.index') }}" method="GET" class="search-container">
        <select name="column" class="search-select">
            <option value="name">Name</option>
            <option value="category_id">Category</option>
            <option value="destination">Destination</option>
            <option value="status">Status</option>
        </select>

        <input type="text" name="search" class="search-input" placeholder="Search events..." required>

        <button type="submit" class="search-btn">Search</button>
    </form>

    <a href="{{ route('admin.events.create') }}" class="btn btn-success mb-3">Create New Event</a>

    <!-- Table displaying the events -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Destination</th>
                <th>Dates</th>
                <th>Cost</th>
                <th>Max Seats</th>
                <th>Enrolled Users</th>
                <th>Status</th>
                <th>Publish Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($events->isEmpty())
                <tr>
                    <td colspan="10">No events found.</td>
                </tr>
            @else
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->category->name }}</td>
                        <td>{{ $event->destination }}</td>
                        <td>{{ $event->date_from }} to {{ $event->date_to }}</td>
                        <td>{{ $event->cost }}</td>
                        <td>{{ $event->max_seats }}</td>
                        <td>{{ $event->enrolled_users }}</td>
                        <td>{{ ucfirst($event->status) }}</td>
                        <td>{{ $event->is_published ? 'Published' : 'Unpublished' }}</td>
                        <td style="border: 1px solid black; padding: 15px; text-align: center;">
                            <div style="display: flex; gap: 10px; justify-content: center; align-items: center;">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning" style="border: none; box-shadow: none;">Edit</a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;">
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
        {{ $events->links() }}
    </div>
</div>
@endsection
