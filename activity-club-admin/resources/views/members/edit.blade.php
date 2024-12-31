@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Member</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- User-specific fields -->
            <h3>User Information</h3>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $member->user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $member->user->email }}" required>
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" class="form-control" name="date_of_birth" value="{{ $member->user->date_of_birth }}" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender" required>
                    <option value="male" {{ $member->user->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $member->user->gender == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <!-- Member-specific fields -->
            <h3>Member Information</h3>
            <div class="form-group">
                <label for="joining_date">Joining Date</label>
                <input type="date" class="form-control" name="joining_date" value="{{ $member->joining_date }}" required>
            </div>

            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" class="form-control" name="mobile_number" value="{{ $member->mobile_number }}" required>
            </div>

            <div class="form-group">
                <label for="emergency_number">Emergency Number</label>
                <input type="text" class="form-control" name="emergency_number" value="{{ $member->emergency_number }}" required>
            </div>

            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" class="form-control" name="photo">
            </div>

            <div class="form-group">
                <label for="profession">Profession</label>
                <input type="text" class="form-control" name="profession" value="{{ $member->profession }}">
            </div>

            <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" class="form-control" name="nationality" value="{{ $member->nationality }}">
            </div>

            <button type="submit" class="btn btn-success">Update Member</button>
        </form>
    </div>
@endsection
