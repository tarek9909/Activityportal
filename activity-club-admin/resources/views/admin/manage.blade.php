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
    }

    h1 {
        color: black;
        font-size: 3rem;
        margin-bottom: 20px;
        text-align: center;
    }

    .btn-success, .btn-warning {
        color: black !important;
        font-size: 1.5rem;
    }

    .table {
        border: 3px solid black;
        border-radius: 15px;
        width: 90%;
        max-width: 1000px;
        overflow: hidden;
        margin: 0 auto;
    }

    .table td, .table th {
        text-align: center;
        border: 1px solid black;
        padding: 15px;
        font-size: 1.6rem;
    }

    .table thead th {
        background-color: #f0f0f0;
        font-size: 1.8rem;
    }

    .table tbody tr:hover {
        background-color: #e0e0e0;
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
        text-transform: uppercase;
        letter-spacing: 0.5px;
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

    .btn-success:focus, .btn-warning:focus, .btn-danger:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2);
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

<h1>Manage Admins</h1>

<!-- Search Form -->
<div class="container">
    <form action="{{ route('admin.admins.manage') }}" method="GET" class="search-container">
        <!-- Dropdown to choose which column to search by -->
        <select name="column" class="search-select" required>
            <option value="name">Name</option>
            <option value="email">Email</option>
        </select>

        <!-- Search Input -->
        <input type="text" name="search" class="search-input" placeholder="Search..." required>

        <!-- Submit Button -->
        <button type="submit" class="search-btn">Search</button>
    </form>

  <!-- Button to add a new admin -->
  <a href="{{ route('admin.admins.create') }}" class="btn btn-success mb-3">Add New Admin</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($admins->isEmpty())
                <tr>
                    <td colspan="3">No admins found</td>
                </tr>
            @else
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>
                            <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination-links">
        {{ $admins->links() }}
    </div>

   
</div>
@endsection
