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

    /* Search form styles */
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

    /* Row count display */
    .row-count {
        font-size: 1.5rem;
        margin-top: 10px;
    }
</style>

<h1>Manage Members</h1>

<!-- Search Form -->
<div class="container">
    <form action="{{ route('admin.members.index') }}" method="GET" class="search-container">
        <select name="column" class="search-select">
            <option value="name">Name</option>
            <option value="email">Email</option>
            <option value="event">Event</option>
        </select>

        <input type="text" name="search" class="search-input" placeholder="Search members..." required>

        <button type="submit" class="search-btn">Search</button>
    </form>

    <a href="{{ route('admin.members.create') }}" class="btn btn-success mb-3">Create New Member</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Event</th>
                <th>Joining Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($members->isEmpty())
                <tr>
                    <td colspan="7">No members found.</td>
                </tr>
            @else
                @foreach ($members as $member)
                    <tr>
                        <td>{{ optional($member->user)->name ?? 'N/A' }}</td>
                        <td>{{ optional($member->user)->email ?? 'N/A' }}</td>
                        <td>{{ optional($member->user)->date_of_birth ?? 'N/A' }}</td>
                        <td>{{ optional($member->user)->gender ?? 'N/A' }}</td>
                        <td>{{ optional($member->event)->name ?? 'N/A' }}</td>
                        <td>{{ $member->joining_date }}</td>
                        <td style="border: 1px solid black; padding: 15px; text-align: center;">
                            <div style="display: flex; gap: 10px; justify-content: center; align-items: center;">
                                <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-warning" style="border: none; box-shadow: none;">Edit</a>
                                <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" style="display:inline;">
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
    <div class="row-count">
        Total Members: {{ $members->count() }}
    </div>
    <div class="pagination-links">
        {{ $members->links() }}
    </div>
    
</div>
@endsection
