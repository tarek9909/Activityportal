@extends('layouts.app')

@section('content')
<style>
    /* Centering the container in the middle of the page */
    .container {
        height: 120vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    h2{
        font: bold;
        font-size: 70px;
        margin-bottom: 50px;
    }

    /* Style for admin button links inside .btn */
    .btn a {
        color: var(--inv);
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1.1rem;
        display: block;
        width: 100%;
        height: 100%;
        line-height: 1.4;
    }

    .btn a:hover {
        color: var(--def); /* Change on hover */
    }

    /* Adjustments for button hover animations */
    .btn {
        position: relative;
        padding: 1.4rem 4.2rem;
        font-size: 1.4rem;
        transition: all 500ms cubic-bezier(0.77, 0, 0.175, 1);
        cursor: pointer;
        user-select: none;
        display: inline-block; /* Ensures buttons are aligned inline */
    }

    /* Additional styling for the buttons */
    .admin-buttons {
        display: flex;
        flex-direction: column;
        gap: 1.5rem; /* Adds space between buttons */
    }
</style>

<h1>Hello, {{ Auth::user()->name }}!</h1>

<div class="container">
    <h2>Admin Dashboard</h2>
    <div class="admin-buttons mb-4">
        <div class="btn from-top">
            <a href="{{ route('admin.admins.manage') }}" class="center">Manage Admins</a>
        </div>

        <div class="btn from-left">
            <a href="{{ route('admin.guides.index') }}" class="center">Manage Guides</a>
        </div>

        <div class="btn from-right">
            <a href="{{ route('admin.events.index') }}" class="center">Manage Events</a>
        </div>

        <div class="btn from-center">
            <a href="{{ route('admin.members.index') }}" class="center">Manage Members</a>
        </div>

        <div class="btn from-bottom">
            <a href="{{ route('admin.lookups.index') }}" class="center">Manage Lookups</a>
        </div>

        <div class="btn from-bottom">
            <a href="{{ route('admin.users.index') }}" class="center">Manage Users</a>
        </div>

        <!-- Add Manage About Us button -->
        <div class="btn from-bottom">
            <a href="{{ route('admin.about_us.index') }}" class="center">Manage About Us</a>
        </div>
    </div>
</div>
@endsection
