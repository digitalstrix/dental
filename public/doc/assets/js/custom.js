(function($) {
  
  "use strict";

  // Preloader
    function stylePreloader() {
      $('body').addClass('preloader-deactive');
    }

  // Off Canvas JS
    var canvasWrapper = $(".off-canvas-wrapper");
    $(".btn-menu").on('click', function() {
      canvasWrapper.addClass('active');
      $("body").addClass('fix');
    });

    $(".close-action > .btn-menu-close, .off-canvas-overlay").on('click', function() {
      canvasWrapper.removeClass('active');
      $("body").removeClass('fix');
    });

  // Sticky Header Js
    var headroom = $(".sticky-header");
    headroom.headroom({
      offset: 280,
      tolerance: 5,
      classes: {
        initial: "headroom",
        pinned: "slideDown",
        unpinned: "slideUp",
        notTop: "sticky"
      }
    });

  //Responsive Slicknav JS
    $('.main-menu').slicknav({
      appendTo: '.res-mobile-menu',
      closeOnClick: false,
      removeClasses: true,
      closedSymbol: '<i class="fa fa-angle-down"></i>',
      openedSymbol: '<i class="fa fa-angle-up"></i>'
    });

  // Menu Activeion Js
    var cururl = window.location.pathname;
    var curpage = cururl.substr(cururl.lastIndexOf('/') + 1);
    var hash = window.location.hash.substr(1);
    if((curpage === "" || curpage === "/" || curpage === "admin") && hash === "")
      {
      } else {
        $(".header-navigation-area li").each(function()
      {
        $(this).removeClass("active");
      });
      if(hash != "")
        $(".header-navigation-area li a[href='"+hash+"']").parents("li").addClass("active");
      else
      $(".header-navigation-area li a[href='"+curpage+"']").parents("li").addClass("active");
    }

  // Swiper Default Slider Js
    var carouselSlider = new Swiper('.default-slider-container', {
      slidesPerView : 1,
      slidesPerGroup: 1,
      loop: true,
      speed: 500,
      spaceBetween: 0,
      effect: 'fade',
      fadeEffect: {
          crossFade: true,
      },
    });

  // Swiper Feature Default Slider Js
    var carouselSlider = new Swiper('.feature-slider-container', {
      slidesPerView : 1,
      slidesPerGroup: 1,
      loop: true,
      speed: 500,
      spaceBetween: 0,
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      navigation: {
        nextEl: '.feature-slider-container .swiper-btn-next',
        prevEl: '.feature-slider-container .swiper-btn-prev',
      },
    });

  // Brand Logo Slider Js
    var testimonialThumbs = new Swiper(".testimonial-thumbs", {
      spaceBetween: 0,
      speed: 900,
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
    });

    var testimonialTop = new Swiper(".testimonial-top", {
      spaceBetween: 0,
      speed: 400,
      navigation: {
        nextEl: '.testimonial-top .swiper-btn-next',
        prevEl: '.testimonial-top .swiper-btn-prev',
      },
      effect: 'fade',
        fadeEffect: {
        crossFade: true
      },
      thumbs: {
        swiper: testimonialThumbs
      }
    });
    testimonialTop.on('slideChangeTransitionStart', function() {
      testimonialThumbs.slideTo(testimonialTop.activeIndex);
    });
    testimonialThumbs.on('transitionStart', function(){
      testimonialTop.slideTo(testimonialThumbs.activeIndex);
    });

  // Brand Logo Slider Js
    var swiper = new Swiper('.brand-logo-slider-container', {
      autoplay: false,
      slidesPerView : 5,
      slidesPerGroup: 1,
      spaceBetween: 171,
      speed: 500,
      breakpoints: {
        1200: {
          slidesPerView : 5,
        },
        768: {
          slidesPerView : 4,
          spaceBetween: 120,
        },
        576: {
          slidesPerView : 3,
        },
        480: {
          slidesPerView : 2,
        },
        0: {
          slidesPerView : 1,
        },
      }
    });

  // Benifits Slider Js
    var swiper = new Swiper('.benifits-slider-container', {
      slidesPerGroup: 1,
      spaceBetween: 25,
      speed: 500,
      breakpoints: {
        1200: {
          slidesPerView : 3,
        },
        992: {
          slidesPerView : 3,
        },
        576: {
          slidesPerView : 3,
        },
        480: {
          slidesPerView : 3,
        },
        0: {
          slidesPerView : 2,
        },
      }
    });

  // Counter Up Js
  var counterId = $('.counter');
  if (counterId.length) {
    counterId.counterUp({
      delay: 10,
      time: 3000
    });
  }

  // Fancybox Js
  $('.image-popup').fancybox();
  $('.video-popup').fancybox();

  // Parallax Js
  $('.parallax').jarallax({
      // Element jarallax Parallax
  });

  // Aos Js
  AOS.init({
    once: true,
    duration: 1200,
  });

  // Date Picker
  $( "#datepicker" ).datepicker();

  // Time Picker
  $('input.timepicker').timepicker({});

  // Ajax Contact Form JS
  var form = $('#contact-form');
  var formMessages = $('.form-message');

  $(form).submit(function(e) {
    e.preventDefault();
    var formData = form.serialize();
    $.ajax({
      type: 'POST',
      url: form.attr('action'),
      data: formData
    }).done(function(response) {
      // Make sure that the formMessages div has the 'success' class.
      $(formMessages).removeClass('alert alert-danger');
      $(formMessages).addClass('alert alert-success fade show');

      // Set the message text.
      formMessages.html("<button type='button' class='btn-close' data-bs-dismiss='alert'>&times;</button>");
      formMessages.append(response);

      // Clear the form.
      $('#contact-form input,#contact-form textarea').val('');
    }).fail(function(data) {
      // Make sure that the formMessages div has the 'error' class.
      $(formMessages).removeClass('alert alert-success');
      $(formMessages).addClass('alert alert-danger fade show');

      // Set the message text.
      if (data.responseText === '') {
        formMessages.html("<button type='button' class='btn-close' data-bs-dismiss='alert'>&times;</button>");
        formMessages.append(data.responseText);
      } else {
        $(formMessages).text('Oops! An error occurred and your message could not be sent.');
      }
    });
  });

  function scrollToTop() {
    var $scrollUp = $('#scroll-to-top'),
      $lastScrollTop = 0,
      $window = $(window);
      $window.on('scroll', function () {
      var st = $(this).scrollTop();
        if (st > $lastScrollTop) {
            $scrollUp.removeClass('show');
        } else {
          if ($window.scrollTop() > 120) {
            $scrollUp.addClass('show');
          } else {
            $scrollUp.removeClass('show');
          }
        }
        $lastScrollTop = st;
    });
    $scrollUp.on('click', function (evt) {
      $('html, body').animate({scrollTop: 0}, 50);
      evt.preventDefault();
    });
  }
  scrollToTop();
  
/* ==========================================================================
   When document is loading, do
   ========================================================================== */
  var varWindow = $(window);
  varWindow.on('load', function() {
    stylePreloader();
    
    // Masonry Grid Js
    $(".masonry-grid").isotope();

    // Portfolio Filter Js
    const activeId = $(".portfolio-filter-menu li");
    $(".portfolio-filter-content").isotope();
      activeId.on('click', function () {
      const $this = $(this),
      filterValue = $this.data('filter');
      $(".portfolio-filter-content").isotope({
        filter: filterValue
      });
      activeId.removeClass('active');
      $this.addClass('active');
    });
  });

})(window.jQuery);