@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="margin-top: 50px;">
    <div style="width: 400px; border-radius: 10px; background-color: white;">
        <h4 class="text-center mb-3">User Profile</h4>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Display Profile Picture -->
        <div class="text-center mb-3">
            <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile Picture" class="rounded-circle" width="150" height="150">
        </div>

        <!-- User Profile Update Form -->
        <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <!-- Profile Picture -->
            <div class="mb-3">
                <label for="photo" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
            </div>

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <!-- Date of Birth -->
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $user->date_of_birth }}" required>
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" id="gender" name="gender" value="{{ $user->gender }}" required>
            </div>

            <!-- Mobile Number -->
            <div class="mb-3">
                <label for="mobile_number" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ $user->mobile_number }}" required>
            </div>

            <!-- Emergency Number -->
            <div class="mb-3">
                <label for="emergency_number" class="form-label">Emergency Number</label>
                <input type="text" class="form-control" id="emergency_number" name="emergency_number" value="{{ $user->emergency_number }}">
            </div>

            <!-- Nationality -->
            <div class="mb-3">
                <label for="nationality" class="form-label">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $user->nationality }}" required>
            </div>

            <!-- Update Button -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </form>

        <hr>

        <!-- Delete Account Form -->
        <form method="POST" action="{{ route('user.destroy') }}">
            @csrf
            @method('DELETE')
            <div class="d-grid">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">Delete Account</button>
            </div>
        </form>
    </div>
</div>
<div class="footer" id="contact-us">
  <div class="inner-footer">

    <!--  for company name and description -->
    <div class="footer-items">
      <img src="{{ asset('1.png') }}" alt="Company Logo">
    </div>

    <!--  for quick links  -->
    <div class="footer-items">
      <h3>Quick Links</h3>
      <div class="border1"></div> <!--for the underline -->
      <ul>
        <a href="{{ route('landing.index') }}">
          <li>Home</li>
        </a>
        <a href="{{ route('events.index') }}">
          <li>latest events</li>
        </a>
        <a href="{{ route('guides.index') }}">
          <li>Our guides</li>
        </a>
        <a href="{{ route('about.us.index') }}">
          <li>About</li>
        </a>
      </ul>
    </div>

    <!--  for contact us info -->
    <div class="footer-items">
      <h3>Contact us</h3>
      <div class="border1"></div>
      <ul>
        <li><i class="fa fa-map-marker" aria-hidden="true"></i>XYZ, abc</li>
        <li><i class="fa fa-phone" aria-hidden="true"></i>123456789</li>
        <li><i class="fa fa-envelope" aria-hidden="true"></i>xyz@gmail.com</li>
      </ul>

      <div class="social-media">
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
      </div>
    </div>
  </div>

  <!--   Footer Bottom start  -->
  <div class="footer-bottom">
    Copyright &copy; Activity Portal 2024.
  </div>
</div>

@endsection
