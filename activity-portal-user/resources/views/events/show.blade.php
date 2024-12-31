@extends('layouts.app')

@section('title', $event->name)

@section('content')
<style>

/* Centering container */
.event-container {
    background-color: rgba(255, 255, 255, 0.9); /* Slight transparency for the content background */
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
   max-width: 900px;
    margin: 100px auto; /* Adds space from top */
    text-align: left; /* Centering the text */
    z-index: 2;
    position: relative;
}

/* Event Title Styling */
.event-container h1 {
    font-family: 'Oswald', sans-serif;
    font-size: 36px;
    color: #333;
    text-transform: uppercase;
    margin-bottom: 20px;
    text-align: center;
}

/* Event Details Styling */
.event-details p {
    font-size: 18px;
    color: #555;
    line-height: 1.6;
    width: 350px;
}

.event-details p strong {
    font-weight: bold;
    color: #333;
}

/* Section Title Styling */
.event-container h1,
.event-details strong {
    border-bottom: 2px solid #007bff;
    padding-bottom: 5px;
}

/* Status Badge */
.status-badge {
    display: inline-block;
    padding: 5px 10px;
    font-size: 14px;
    color: white;
    background-color: #28a745;
    border-radius: 4px;
    text-transform: uppercase;
    font-weight: bold;
}

.status-badge.inactive {
    background-color: #dc3545;
}

/* Enroll Button */
.enroll-btn {
    display: block;
    margin: 30px auto;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-transform: uppercase;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.enroll-btn:hover {
    background-color: #0056b3;
}
.container{
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}
</style>

<div class="event-container">
  <div class="container">
    <h1>{{ $event->name }}</h1>
    <div class="event-details">
        <p><strong>Description:</strong> {{ $event->description }}</p>
        <p><strong>Destination:</strong> {{ $event->destination }}</p>
        <p><strong>Date From:</strong> {{ $event->date_from }}</p>
        <p><strong>Date To:</strong> {{ $event->date_to }}</p>
        <p>
            <strong>Status:</strong> 
            <span class="status-badge {{ $event->status == 'active' ? '' : 'inactive' }}">
                {{ ucfirst($event->status) }}
            </span>
        </p>
        </div>
        </div>
        <!-- Error Display Section -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($event->status == 'active' || $event->status == 'Planned')
            @auth
                @php
                    // Check if the user is already enrolled in this event
                    $isEnrolled = DB::table('event_user')
                        ->where('user_id', Auth::id())
                        ->where('event_id', $event->id)
                        ->exists();
                @endphp

                @if($isEnrolled)
                    <p class="text-center text-success">You are already enrolled in this event.</p>
                @else
                    <form action="{{ route('events.enroll', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="enroll-btn">Enroll Now</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="enroll-btn">Login to Enroll</a>
            @endauth
        @endif
    
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
