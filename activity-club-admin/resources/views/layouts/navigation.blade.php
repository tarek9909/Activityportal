<link rel="stylesheet" href="../../css/nav.css">
<style>
    @import url("https://fonts.googleapis.com/css2?family=Nunito&display=swap");

/***********************/
/* RESET CSS */
/***********************/



html {

  font-size: 62.5%;
  overflow-x: hidden;
  scroll-behavior: smooth;
}

a:link,
a:visited {
  color: #fff;
  text-decoration: none;
  text-transform: uppercase;
  transition: all 0.3s;
}

/* HELPER CLASSES */
.center {
  display: flex;
  align-items: center;
  justify-content: center;
}

/***********************/
/* NAVIGATION MENU */
/***********************/

/* OVERLAY */
.overlay {
  z-index: 9;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  height: 100svh;
 
  
}

.overlay-slide-right {
  transition: all 0.4s ease-in-out;
  transform: translateX(0);
}

.overlay-slide-left {
  transition: all 0.8s ease-in-out;
  transform: translateX(-100%);
}

/* NAV MENU ITEMS */
nav ul {
  height: 100vh;
  height: 100svh;
  list-style: none;
}

nav ul li {
  height: 20%;
}

nav li:nth-of-type(1) {
  background-color: #626059;
}

nav li:nth-of-type(2) {
  background-color: #626059;
}



nav li a {
  letter-spacing: 0.4rem;
  font-size: 2rem;
}

nav li a:hover,
nav li a:active {
  transform: scale(1.2);
}



.slide-in-1 {
  animation: slide-in 0.4s linear 0.2s both;
}

.slide-in-2 {
  animation: slide-in 0.4s linear 0.4s both;
}

.slide-in-3 {
  animation: slide-in 0.4s linear 0.6s both;
}

.slide-in-4 {
  animation: slide-in 0.4s linear 0.8s both;
}

.slide-in-5 {
  animation: slide-in 0.4s linear 1s both;
}

@keyframes slide-in {
  from {
    transform: translateX(-100%);
  }
  to {
    transform: translateX(0);
  }
}


.slide-out-1 {
  animation: slide-out 0.3s linear 0.5s both;
}

.slide-out-2 {
  animation: slide-out 0.3s linear 0.4s both;
}

.slide-out-3 {
  animation: slide-out 0.3s linear 0.3s both;
}

.slide-out-4 {
  animation: slide-out 0.3s linear 0.2s both;
}

.slide-out-5 {
  animation: slide-out 0.3s linear 0.1s both;
}

@keyframes slide-out {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-100%);
  }
}

/***********************/
/* HAMBURGER MENU ANIMATION */
/***********************/

.hamburger-menu {
  position: fixed;
  top: 1rem;
  right: 2rem;
  z-index: 10;
  cursor: pointer;
}

.menu-bar1,
.menu-bar2,
.menu-bar3 {
  width: 3.5rem;
  height: 0.2rem;
  background-color: #fff;
  margin: 0.8rem 0;
  transition: 0.4s;
}

.menu-bar2 {
  width: 2rem;
  margin-left: auto;
}

/* ROTATE FIRST BAR */
.active .menu-bar1 {
  transform: rotate(-45deg) translate(-0.7rem, 0.8rem);
}

/* FADE OUT SECOND BAR */
.active .menu-bar2 {
  opacity: 0;
}

/* ROTATE LAST BAR */
.active .menu-bar3 {
  transform: rotate(45deg) translate(-0.6rem, -0.8rem);
}

/***********************/
/* SECTION */
/***********************/



.logo {
  position: fixed;
  z-index: 2;
  top: 1.5rem;
  left: 1.5rem;
  font-size: 1.4rem;
  letter-spacing: 0.3rem;
}

h1 {
  font-size: 3rem;
  background-color: rgb(0, 0, 0, 0.6);
  padding: 0.5rem 1rem;
}


/**************************/
/* MEDIA QUERY */
/**************************/

/* BELOW 832px (Tablets) */
@media (max-width: 52em) {
  html {
    /* 8px / 16px = 0.5 = 50% */
    font-size: 50%;
  }
}

/* BELOW 600px (Phones) */
@media (max-width: 37em) {
  .hamburger-menu {
    top: 0.5rem;
    right: 1rem;
  }
  .logo {
    top: 1rem;
    left: 1rem;
  }
  h1 {
    font-size: 2rem;
  }
}

</style>
<div class="overlay overlay-slide-left" id="overlay">
  <!-- MENU ITEMS -->
  <nav>
  <ul>
      <li id="nav-1" class="slide-out-1 center">
        <a href="{{ route('admin.admins.index') }}" class="center">Home</a> <!-- Home Button -->
      </li>
      <li id="nav-2" class="slide-out-2 center">
        <!-- Logout Button -->
        <a href="#" class="center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>
        <!-- Logout Form (hidden) -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
    </ul>
  </nav>
</div>
<!-- HAMBURGER MENU -->
<div class="hamburger-menu" id="hamburger-menu">
  <div class="menu-bar1"></div>
  <div class="menu-bar2"></div>
  <div class="menu-bar3"></div>
</div>

<script>
    const hamburgerMenu = document.querySelector("#hamburger-menu");
const overlay = document.querySelector("#overlay");
const nav1 = document.querySelector("#nav-1");
const nav2 = document.querySelector("#nav-2");
const nav3 = document.querySelector("#nav-3");
const nav4 = document.querySelector("#nav-4");
const nav5 = document.querySelector("#nav-5");
const navItems = [nav1, nav2, nav3, nav4, nav5];

// Control Navigation Animation
function navAnimation(val1, val2) {
  navItems.forEach((nav, i) => {
    nav.classList.replace(`slide-${val1}-${i + 1}`, `slide-${val2}-${i + 1}`);
  });
}

function toggleNav() {
  // Toggle: Hamburger Open/Close
  hamburgerMenu.classList.toggle("active");

  //   Toggle: Menu Active
  overlay.classList.toggle("overlay-active");

  if (overlay.classList.contains("overlay-active")) {
    // Animate In - Overlay
    overlay.classList.replace("overlay-slide-left", "overlay-slide-right");

    // Animate In - Nav Items
    navAnimation("out", "in");
  } else {
    // Animate Out - Overlay
    overlay.classList.replace("overlay-slide-right", "overlay-slide-left");

    // Animate Out - Nav Items
    navAnimation("in", "out");
  }
}

// Events Listeners
hamburgerMenu.addEventListener("click", toggleNav);
navItems.forEach((nav) => {
  nav.addEventListener("click", toggleNav);
});

</script>