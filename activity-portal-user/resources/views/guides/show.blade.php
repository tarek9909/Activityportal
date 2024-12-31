@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div  style="width: 400px; border-radius: 10px; background-color: white;">
        <h4 class="text-center mb-3">{{ $guide->member->user->name }}</h4>

        <!-- Display Guide's Profile Picture -->
        <div class="text-center mb-3">
            <img src="{{ asset('storage/' . $guide->member->user->photo) }}" alt="{{ $guide->member->user->name }}" class="rounded-circle" width="150" height="150">
        </div>

        <!-- Guide Details -->
        <div class="mb-3">
            <label for="profession" class="form-label">Profession</label>
            <input type="text" class="form-control" id="profession" value="{{ $guide->profession ?? 'Guide' }}" disabled>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="{{ $guide->member->user->email }}" disabled>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" value="{{ $guide->member->user->mobile_number }}" disabled>
        </div>

        <div class="mb-3">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" class="form-control" id="nationality" value="{{ $guide->member->user->nationality }}" disabled>
        </div>

        <div class="mb-3">
            <label for="joining_date" class="form-label">Joined</label>
            <input type="text" class="form-control" id="joining_date" value="{{ $guide->joining_date }}" disabled>
        </div>

        <!-- Add more guide-related details here -->
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
<script>
  ;
  (function($) {
    //Make your content a heroe
    $.fn.transformHeroes = function() {
      //Variables
      var perspective = '500px',
        delta = 20,
        width = this.width(),
        height = this.height(),
        midWidth = width / 2,
        midHeight = height / 2;
      //Events
      this.on({
        mousemove: function(e) {
          var pos = $(this).offset(),
            cursPosX = e.pageX - pos.left,
            cursPosY = e.pageY - pos.top,
            cursCenterX = midWidth - cursPosX,
            cursCenterY = midHeight - cursPosY;

          $(this).css('transform', 'perspective(' + perspective + ') rotateX(' + (cursCenterY / delta) + 'deg) rotateY(' + -(cursCenterX / delta) + 'deg)');
          $(this).removeClass('is-out');
        },
        mouseleave: function() {
          $(this).addClass('is-out');
        }
      });
      //Return
      return this;
    };
  }(jQuery));

  //Set plugin on cards
  $('.card').transformHeroes();
</script>
@endsection
