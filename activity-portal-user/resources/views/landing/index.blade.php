@extends('layouts.app')

@section('title', 'Activity Club Portal')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div id="parallax-world-of-ugg">

  <section id="home">
    <div class="parallax-one">
      <h2>Unleash Your Adventure – Join the Journey, Explore New Horizons!</h2>
    </div>
  </section>

  <section id="about">
    <div class="block">
      @if($aboutUs)
      @php
      $firstCharacter = substr($aboutUs->brief, 0, 1);
      $remainingText = substr($aboutUs->brief, 1);
      @endphp
      <p>
        <span class="first-character sc">{{ $firstCharacter }}</span>
        {{ $remainingText }}
      </p>
      @else
      <p>About Us information is not available at the moment.</p>
      @endif
      <p class="line-break margin-top-10"></p>
      <p class="margin-top-10">Every journey with the Activity Portal Club unlocks new adventures, friendships, and unforgettable moments across Lebanon's stunning landscapes.</p>
      <a href="{{ route('about.us.index') }}" class="btn default" style="font-family: 'Oswald', sans-serif; font-weight:100; font-size:30px;">Read More</a>


    </div>
  </section>

  <section id="events">
    <div class="parallax-two">
      <h2>Latest events</h2>

    </div>

  </section>

  <section class="events">
    <section class="section" id="guides">
      @if($events->isEmpty())
      <p>No events available at the moment.</p>
      @else
      @foreach($events as $event)
      <div class="card rounded" id="superman">
        <div class="card__overlay"></div>
        <div class="card__heading">
          <a href="{{ route('events.show', $event->id) }}" style="list-style-type: none; text-decoration: none;">
            <h3>{{ $event->name }}</h3> <!-- Event title from database -->
          </a>
          <p>{{ Str::limit($event->description, 100, '...') }}</p> <!-- First sentence or limited description -->
        </div>
      </div>
      @endforeach
      @endif
    </section>


    <form action="{{ route('events.index') }}" method="GET">
      <button type="submit" class="btn default" style="font-family: 'Oswald', sans-serif; font-weight:100; font-size:30px;">
        Explore events
      </button>
    </form>


  </section>

  <section>
    <div class="parallax-three">
      <h2>Our Guides</h2>
    </div>
  </section>

  <section >
    <div class="cont">
  <div class="container">
    @foreach($guides as $guide)
        <a href="{{ route('guides.show', $guide->id) }}" style="text-decoration: none; color: inherit;">
            <figure class="snip1344">
                <!-- Background image -->
                <img src="{{ asset('storage/' . $guide->member->user->photo) }}" alt="{{ $guide->member->user->name }}" class="background" />
                <!-- Profile picture -->
                <img src="{{ asset('storage/' . $guide->member->user->photo) }}" alt="{{ $guide->member->user->name }}" class="profile" />
                <figcaption>
                    <h3>{{ $guide->member->user->name }}<span>{{ $guide->profession ?? 'Guide' }}</span></h3>
                </figcaption>
            </figure>
        </a>
    @endforeach
</div>
<form action="{{ route('guides.index') }}" method="GET">
      <button type="submit" class="btn default" style="font-family: 'Oswald', sans-serif; font-weight:100; font-size:30px; text-align:center;">
        Explore guides
      </button>
    </form>

    </div>
  </section>
  <section>
    <div class="parallax-one">
      <h2>Unleash Your Adventure – Join the Journey, Explore New Horizons!</h2>
    </div>
  </section>
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
        <a href="#home">
          <li>Home</li>
        </a>
        <a href="#events">
          <li>latest events</li>
        </a>
        <a href="#guides">
          <li>Our guides</li>
        </a>
        <a href="#about">
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