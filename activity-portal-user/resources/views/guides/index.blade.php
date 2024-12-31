@extends('layouts.app')

@section('title', 'Guides')

@section('content')
<div class="container">
    @if($guides->isEmpty())
        <p>No guides available at the moment.</p>
    @else
        @foreach($guides as $guide)
        <a href="{{ route('guides.show', $guide->id) }}" style="text-decoration: none;">
            <figure class="snip1344">
                <img src="{{ asset('storage/' . $guide->member->user->photo) }}" alt="{{ $guide->member->user->name }}" class="background" />
                <img src="{{ asset('storage/' . $guide->member->user->photo) }}" alt="{{ $guide->member->user->name }}" class="profile" />
                <figcaption>
                    <h3>{{ $guide->member->user->name }}<span>{{ $guide->profession ?? 'Guide' }}</span></h3>
                </figcaption>
            </figure>
        </a>
        @endforeach
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
