<!DOCTYPE html>
<<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Activity Club Portal')</title>

        @vite(['resources/css/app.css'])

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        
    </head>

    <body>

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Lato', 'Arial', sans-serif;
            }

            /* HEADINGS */









            /* BASIC SETUP */

            .page-wrapper {
                width: 100%;
                height: auto;
            }

            .nav-wrapper {
                width: 100%;
                position: fixed;
                /* Make the navigation fixed */
                top: 0;
                background-color: #fff;
                z-index: 1000;
                padding-bottom: 15px;
                /* Ensure it stays above other elements */
            }

            .grad-bar {
                width: 100%;
                height: 5px;
                background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
                background-size: 400% 400%;
                -webkit-animation: gradbar 15s ease infinite;
                -moz-animation: gradbar 15s ease infinite;
                animation: gradbar 15s ease infinite;
            }

            /* NAVIGATION */

            .navbar {
                display: grid;
                grid-template-columns: 1fr 3fr;
                align-items: center;
                height: 50px;
                overflow: hidden;
            }

            .navbar img {
                height: 60px;
                width: auto;
                justify-self: start;
                margin-left: 20px;
            }

            .navbar ul {
                display: flex;
                flex-direction: row;
                justify-self: end;
                justify-content: space-between;
                gap: 20px;
                margin-right: 45px;
            }

            .nav-item a {
                color: #000;
                font-size: 0.9rem;
                font-weight: 400;
                text-decoration: none;
                transition: color 0.3s ease-out;
            }

            .nav-item a:hover {
                color: #3498db;
            }

            /* SECTIONS */

            .headline {
                margin-top: 50px;
                /* Add margin to avoid content being hidden under the navbar */
                width: 100%;
                height: 50vh;
                min-height: 350px;
                background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1435224668334-0f82ec57b605?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1yZWxhdGVkfDd8fHxlbnwwfHx8fA%3D%3D&w=1000&q=80');
                background-size: cover;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .features {
                width: 100%;
                height: auto;
                background-color: #f1f1f1;
                display: flex;
                padding: 50px 20px;
                justify-content: space-around;
            }

            .feature-container {
                flex-basis: 30%;
                margin-top: 10px;
            }



            .feature-container img {
                width: 100%;
                margin-bottom: 15px;
            }

            /* SEARCH FUNCTION */

            #search-icon {
                font-size: 0.9rem;
                margin-top: 3px;
                margin-left: 15px;
                transition: color 0.3s ease-out;
            }

            #search-icon:hover {
                color: #3498db;
                cursor: pointer;
            }

            .search {
                transform: translate(-35%);
                -webkit-transform: translate(-35%);
                transition: transform 0.7s ease-in-out;
                color: #3498db;
            }

            .no-search {
                transform: translate(0);
                transition: transform 0.7s ease-in-out;
            }

            .search-input {
                position: absolute;
                top: -4px;
                right: -125px;
                opacity: 0;
                z-index: -1;
                transition: opacity 0.6s ease;
            }

            .search-active {
                opacity: 1;
                z-index: 0;
            }

            input {
                border: 0;
                border-left: 1px solid #ccc;
                border-radius: 0;
                /* FOR SAFARI */
                outline: 0;
                padding: 5px;
            }

            /* MOBILE MENU & ANIMATION */

            .menu-toggle .bar {
                width: 25px;
                height: 3px;
                background-color: #3f3f3f;
                margin: 5px auto;
                -webkit-transition: all 0.3s ease-in-out;
                -o-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }

            .menu-toggle {
                justify-self: end;
                margin-right: 25px;
                display: none;
            }

            .menu-toggle:hover {
                cursor: pointer;
            }

            #mobile-menu.is-active .bar:nth-child(2) {
                opacity: 0;
            }

            #mobile-menu.is-active .bar:nth-child(1) {
                -webkit-transform: translateY(8px) rotate(45deg);
                -ms-transform: translateY(8px) rotate(45deg);
                -o-transform: translateY(8px) rotate(45deg);
                transform: translateY(8px) rotate(45deg);
            }

            #mobile-menu.is-active .bar:nth-child(3) {
                -webkit-transform: translateY(-8px) rotate(-45deg);
                -ms-transform: translateY(-8px) rotate(-45deg);
                -o-transform: translateY(-8px) rotate(-45deg);
                transform: translateY(-8px) rotate(-45deg);
            }

            /* KEYFRAME ANIMATIONS */

            @-webkit-keyframes gradbar {
                0% {
                    background-position: 0% 50%
                }

                50% {
                    background-position: 100% 50%
                }

                100% {
                    background-position: 0% 50%
                }
            }

            @-moz-keyframes gradbar {
                0% {
                    background-position: 0% 50%
                }

                50% {
                    background-position: 100% 50%
                }

                100% {
                    background-position: 0% 50%
                }
            }

            @keyframes gradbar {
                0% {
                    background-position: 0% 50%
                }

                50% {
                    background-position: 100% 50%
                }

                100% {
                    background-position: 0% 50%
                }
            }

            /* Media Queries */

            /* Mobile Devices - Phones/Tablets */

            @media only screen and (max-width: 720px) {
                .features {
                    flex-direction: column;
                    padding: 50px;
                }

                /* MOBILE HEADINGS */







                /* MOBILE NAVIGATION */

                .navbar ul {
                    display: flex;
                    flex-direction: column;
                    position: fixed;
                    justify-content: start;
                    top: 55px;
                    background-color: #fff;
                    width: 100%;
                    height: calc(100vh - 55px);
                    transform: translate(-101%);
                    text-align: center;
                    overflow: hidden;
                }

                .navbar li {
                    padding: 15px;
                }

                .navbar li:first-child {
                    margin-top: 50px;
                }

                .navbar li a {
                    font-size: 1rem;
                }

                .menu-toggle,
                .bar {
                    display: block;
                    cursor: pointer;
                }

                .mobile-nav {
                    transform: translate(0%) !important;
                }

                /* SECTIONS */

                .headline {
                    height: 20vh;
                }






                /* SEARCH DISABLED ON MOBILE */

                #search-icon {
                    display: none;
                }

                .search-input {
                    display: none;
                }

            }
        </style>
        <!-- Navbar -->
        <div class="nav-wrapper">
            <div class="grad-bar"></div>
            <nav class="navbar">
                <img src="{{ asset('1.png') }}" alt="Company Logo">

                <div class="menu-toggle" id="mobile-menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul class="nav no-search">
                <li class="nav-item">
    @if (Request::is('/'))
        <a href="#home">Home</a>
    @else
        <a href="{{ route('landing.index') }}">Home</a>
    @endif
</li>

<li class="nav-item">
    @if (Request::is('/'))
        <a href="#about">About</a>
    @else
        <a href="{{ route('about.us.index') }}">About</a>
    @endif
</li>

                    <li class="nav-item"><a href="#contact-us">Contact Us</a></li>
                    <li class="nav-item">
    @if (Auth::check())
        <!-- Show Profile button when user is authenticated -->
        <a href="{{ route('user.profile') }}" >Profile</a>
        </li>
        <li>
        <!-- Show Logout link when user is authenticated -->
        <a href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        </li>
        <li>
        <!-- Logout form (hidden) -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <!-- Show Login/Signup button when user is not authenticated -->
        <a href="{{ route('login-register') }}" >Login / Sign Up</a>
    @endif
</li>


                </ul>
            </nav>
        </div>

        <!-- Content Section -->
        <div class="content">
            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            $("#search-icon").click(function() {
                $(".nav").toggleClass("search");
                $(".nav").toggleClass("no-search");
                $(".search-input").toggleClass("search-active");
            });

            $('.menu-toggle').click(function() {
                $(".nav").toggleClass("mobile-nav");
                $(this).toggleClass("is-active");
            });
        </script>

    </body>

    </html>