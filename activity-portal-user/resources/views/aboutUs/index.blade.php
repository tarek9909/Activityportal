@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us Page</title>
    <style>
        /* Overall styling for the page */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Audiowide', sans-serif;
        }

        .container {
          margin-top: 80px;
          display: flex;
          flex-direction: column;
            gap: 50px;
          
        }

        .about-section {
          background-color: #f9f9f9;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 50px;
            border-radius: 10px;
        }

        .about-section h1 {
            margin-top: 50px;
            font-size: 38px;
            color: #333;
        }

        

        .about-content {
            font-size: 22px;
            color: #333;
            line-height: 1.8;
            margin-top: 20px;
            text-align: justify;
        }

        /* Grid style for Vision and Mission */
        .vision-mission-container {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            gap: 20px;
        }
        @media (max-width: 768px) {
    .vision-mission-container {
        flex-direction: column; /* Stack elements vertically */
        align-items: center; /* Center items horizontally */
        gap: 30px; /* Increase the gap for better spacing */
    }
}

/* Small screens (mobile phones) */
@media (max-width: 480px) {
    .vision-mission-container {
        flex-direction: column; /* Keep stacking vertically */
        align-items: center; /* Ensure items are centered */
        gap: 20px; /* Slightly reduce the gap for smaller screens */
    }
}
        .vision-box, .mission-box {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 30px;
            flex: 1;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .vision-box h2, .mission-box h2 {
            font-size: 30px;
            color: #333;
            margin-bottom: 15px;
        }

        .vision-box p, .mission-box p {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
        }

        footer {
            width: 100%;
            background-color: #333;
            color: #17ff8d;
            font-size: 23px;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container"  id="about">
        <div class="cont1">
        <div class="about-section">
            <h1>About Us</h1>

            @if($aboutUs)
            <div class="about-content">
                <p>{{ $aboutUs->brief }}</p>
            </div>
            @else
            <div class="about-content">
                <p>No About Us information available.</p>
            </div>
            @endif
        </div>
        </div>
        <div class="cont2">
        <!-- Vision and Mission Grid -->
        <div class="vision-mission-container">
            <div class="vision-box">
                <h2>Vision</h2>
                <p>{{ $aboutUs->vision }}</p>
            </div>

            <div class="mission-box">
                <h2>Mission</h2>
                <p>{{ $aboutUs->mission }}</p>
            </div>
        </div>
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
</body>
</html>
@endsection
