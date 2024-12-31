@extends('layouts.app')

@section('content')
<style>
    /* Same styling as before */
</style>

<h1>Edit Guide</h1>
<div class="container">
    <div class="form-container">
        <form action="{{ route('admin.guides.update', $guide->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- User Dropdown -->
            <div class="form-group">
                <label for="user_id">Select User</label>
                <select id="user_id" class="form-control" name="user_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $guide->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Event Dropdown -->
            <div class="form-group">
                <label for="event_id">Select Event</label>
                <select id="event_id" class="form-control" name="event_id" required>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ $guide->event_id == $event->id ? 'selected' : '' }}>
                            {{ $event->name }} ({{ $event->destination }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Joining Date -->
            <div class="form-group">
                <label for="joining_date">Joining Date</label>
                <input type="date" class="form-control" name="joining_date" value="{{ $guide->joining_date }}" required>
            </div>

            <button type="submit" class="btn">Update Guide</button>
        </form>
    </div>
</div>
@endsection
