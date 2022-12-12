<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('name')</title>

    <!--== Favicon ==-->
    <link rel="shortcut icon" href="https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png" type="image/x-icon" />

    <!--== Google Fonts ==-->
    <link href="https://fonts.googleapis.com/css?family=Exo:300,400,400i,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Shippori+Mincho:400,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">

    <!--== Bootstrap CSS ==-->
    <link href="{{asset('doc/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!--== Headroom CSS ==-->
    <link href="{{asset('doc/assets/css/headroom.css')}}" rel="stylesheet" />
    <!--== jQuery Ui Min CSS ==-->
    <link href="{{asset('doc/assets/css/jquery-ui.min.css')}}" rel="stylesheet" />
    <!--== Animate CSS ==-->
    <link href="{{asset('doc/assets/css/animate.css')}}" rel="stylesheet" />
    <!--== Font Awesome Icon CSS ==-->
    <link href="{{asset('doc/assets/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!--== Swiper CSS ==-->
    <link href="{{asset('doc/assets/css/swiper.min.css')}}" rel="stylesheet" />
    <!--== Fancybox Min CSS ==-->
    <link href="{{asset('doc/assets/css/fancybox.min.css')}}" rel="stylesheet" />
    <!--== Slicknav Min CSS ==-->
    <link href="{{asset('doc/assets/css/slicknav.css')}}" rel="stylesheet" />
    <!--== Aos Min CSS ==-->
    <link href="{{asset('doc/assets/css/aos.min.css')}}" rel="stylesheet" />

    <!--== Main Style CSS ==-->
    <link href="{{asset('doc/assets/css/style.css')}}" rel="stylesheet" />

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!--wrapper start-->
<div class="wrapper">

  <!--== Start Preloader Content ==-->
  <div class="preloader-wrap">
    <div class="preloader">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!--== End Preloader Content ==-->

  <!--== Start Header Wrapper ==-->
  <header class="header-wrapper">
    <div class="header-top-area">
      <div class="header-top-align">
        <div class="header-top-align-left">
          <div class="header-logo-area">
            <a href="{{route('dashboard')}}">
              <img class="logo-main" src="https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png" alt="Logo" />
              <img class="logo-light" src="https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png" alt="Logo" />
            </a>
          </div>
        </div>
        <div class="header-top-align-right">
          <div class="header-info-items">
            <div class="info-items">
              <div class="inner-content">
                <div class="icon">
                  <img src="{{asset('doc/assets/img/icons/map.png')}}" alt="Image-HasTech">
                </div>
                <div class="content">
                  <p>@yield('address')</p>
                </div>
              </div>
            </div>
          </div>
          <div class="header-appointment-button">
            <a class="appointment-btn" href="{{route('user_login')}}">Login</a>
          </div>
        </div>
      </div>
    </div>
    <div class="responsive-header-appointment-button">
      <a class="appointment-btn" href="{{route('user_register')}}">Register</a>
    </div>
    <div class="header-area sticky-header header-default">
      <div class="container">
        <div class="row no-gutter align-items-center position-relative">
          <div class="col-12">
            <div class="header-align">
              <div class="header-align-left">
                <button class="btn-menu" type="button"><i class="fa fa-align-left"></i></button>
                <div class="header-navigation-area">
                  <ul class="main-menu nav">
                    <li><a href="#"><span>Home</span></a></li>
                    <li class="has-submenu"><a href="{{route('dashboard')}}"><span>DentaVibe</span></a>
                      <ul class="submenu-nav">
                        <li><a href="{{route('providers_frontend')}}">All Doctors</a></li>
                        <li><a href="{{route('clinics_frontend')}}">All Clinics</a></li>
                      </ul>
                    </li>
                    <li><a href="{{route('contact_frontend')}}"><span>Contact</span></a></li>
                  </ul>
                </div>
              </div>
              <div class="header-align-right">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!--== End Header Wrapper ==-->
 @yield('content')

  <!--== Start Footer Area Wrapper ==-->
  <footer class="footer-area">
    <!--== Start Footer Main ==-->
    <div class="footer-main">
      <div class="container pt--0 pb--0">
        <div class="row no-gutter">
          <div class="col-sm-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item">
              <div class="about-widget-wrap">
                <div class="widget-logo-area">
                  <a href="{{route('dashboard')}}">
                    <img class="logo-main" src="https://i0.wp.com/dentavibe.com/wp-content/uploads/2022/07/Horizontal-Logo-DentaVIBE.png" alt="Logo" />
                  </a>
                </div>
                <p class="desc">Dental care is maintenance of healthy teeth and cleaning mouth for beautiful smile</p>
                <div class="social-icons">
                  <a href="#/"><i class="fa fa-facebook"></i></a>
                  <a href="#/"><i class="fa fa-instagram"></i></a>
                  <a href="#/"><i class="fa fa-twitter"></i></a>
                </div>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start widget Item ==-->
          @yield('services')
            <!--== End widget Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item widget-menu2">
              <h4 class="widget-title">Importance</h4>
              <div class="widget-menu-wrap">
                <ul class="nav-menu">
                  <li><a href="{{route('dashboard')}}">DentaVibe</a></li>
                  <li><a href="{{route('contact_frontend')}}">Contact</a></li>
                  {{-- <li><a href="about-us.html">Terms & Conditions</a></li>
                  <li><a href="contact.html">24/7 Advance Care</a></li>
                  <li><a href="services.html">Emergency Centre</a></li>
                  <li><a href="contact.html">Payment System</a></li> --}}
                </ul>
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
          <div class="col-sm-6 col-lg-3">
            <!--== Start widget Item ==-->
            <div class="widget-item widget-contact">
              <h4 class="widget-title">Contact us</h4>
              <div class="widget-contact-wrap">
                @yield('footer')
              </div>
            </div>
            <!--== End widget Item ==-->
          </div>
        </div>
      </div>
    </div>
    <!--== End Footer Main ==-->

    <!--== Start Footer Bottom ==-->
    <div class="footer-bottom">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-12">
            <p class="copyright">© 2022 Made with <i class="fa fa-heart"></i> by <a target="_blank" href="https://www.dentavibe.com"> DentaVibe</a></p>
          </div>
        </div>
      </div>
    </div>
    <!--== End Footer Bottom ==-->
  </footer>
  <!--== End Footer Area Wrapper ==-->

  <!--== Scroll Top Button ==-->
  <div id="scroll-to-top" class="scroll-to-top"><span class="fa fa-angle-up"></span></div>

  <!--== Start Side Menu ==-->
  <aside class="off-canvas-wrapper">
    <div class="off-canvas-inner">
      <div class="off-canvas-overlay"></div>
      <!-- Start Off Canvas Content Wrapper -->
      <div class="off-canvas-content">
        <!-- Off Canvas Header -->
        <div class="off-canvas-header">
          <div class="close-action">
            <button class="btn-menu-close">menu <i class="fa fa-chevron-left"></i></button>
          </div>
        </div>

        <div class="off-canvas-item">
          <!-- Start Mobile Menu Wrapper -->
          <div class="res-mobile-menu menu-active-one">
            <!-- Note Content Auto Generate By Jquery From Main Menu -->
          </div>
          <!-- End Mobile Menu Wrapper -->
        </div>
      </div>
      <!-- End Off Canvas Content Wrapper -->
    </div>
  </aside>
  <!--== End Side Menu ==-->
</div>

<!--=======================Javascript============================-->

<!--=== jQuery Modernizr Min Js ===-->
<script src="{{asset('doc/assets/js/modernizr.js')}}"></script>
<!--=== jQuery Min Js ===-->
<script src="{{asset('doc/assets/js/jquery-main.js')}}"></script>
<!--=== jQuery Migration Min Js ===-->
<script src="{{asset('doc/assets/js/jquery-migrate.js')}}"></script>
<!--=== jQuery Popper Min Js ===-->
<script src="{{asset('doc/assets/js/popper.min.js')}}"></script>
<!--=== jQuery Bootstrap Min Js ===-->
<script src="{{asset('doc/assets/js/bootstrap.min.js')}}"></script>
<!--=== jQuery Appear Js ===-->
<script src="{{asset('doc/assets/js/jquery.appear.js')}}"></script>
<!--=== jQuery Headroom Min Js ===-->
<script src="{{asset('doc/assets/js/headroom.min.js')}}"></script>
<!--=== jQuery Ui Min Js ===-->
<script src="{{asset('doc/assets/js/jquery-ui.min.js')}}"></script>
<!--=== jQuery Some Custom Js ===-->
<script src="{{asset('doc/assets/js/some-custom.js')}}"></script>
<!--=== jQuery Swiper Min Js ===-->
<script src="{{asset('doc/assets/js/swiper.min.js')}}"></script>
<!--=== jQuery Fancybox Min Js ===-->
<script src="{{asset('doc/assets/js/fancybox.min.js')}}"></script>
<!--=== jQuery Slick Nav Js ===-->
<script src="{{asset('doc/assets/js/slicknav.js')}}"></script>
<!--=== jQuery Waypoint Js ===-->
<script src="{{asset('doc/assets/js/waypoint.js')}}"></script>
<!--=== jQuery Parallax Min Js ===-->
<script src="{{asset('doc/assets/js/parallax.min.js')}}"></script>
<!--=== jQuery Aos Min Js ===-->
<script src="{{asset('doc/assets/js/aos.min.js')}}"></script>
<!--=== jQuery Counterup Min Js ===-->
<script src="{{asset('doc/assets/js/counterup.js')}}"></script>
<!--=== jQuery Isotope Min Js ===-->
<script src="{{asset('doc/assets/js/isotope.pkgd.min.js')}}"></script>

<!--=== jQuery Custom Js ===-->
<script src="{{asset('doc/assets/js/custom.js')}}"></script>

</body>

</html>