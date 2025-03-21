document.addEventListener('DOMContentLoaded', () => {
  "use strict";

  window.onpageshow = function(event) {
    if (event.persisted) {
      location.reload(); // Reload the page when navigated back to
    }
  };

  // Header carousel
$(".header-carousel").owlCarousel({
  autoplay: true,
  smartSpeed: 1500,
  items: 1,
  dots: false,
  loop: true,
  nav : true,
  navText : [
      '<i class="bi bi-chevron-left"></i>',
      '<i class="bi bi-chevron-right"></i>'
  ]
});

// Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1000,
    center: true,
    dots: false,
    loop: true,
    nav : true,
    navText : [
        '<i class="bi bi-chevron-left"></i>',
        '<i class="bi bi-chevron-right"></i>'
    ],
    responsive: {
        0:{
            items:1
        },
        576:{
            items:1
        },
        768:{
            items:2
        },
        992:{
            items:3
        }
    }
});


// Latest-news-carousel
$(".latest-news-carousel").owlCarousel({
  autoplay: true,
  smartSpeed: 1000,
  center: false,
  dots: true,
  loop: true,
  margin: 25,
  nav : true,
  navText : [
      '<i class="bi bi-arrow-left"></i>',
      '<i class="bi bi-arrow-right"></i>'
  ],
  responsiveClass: true,
  responsive: {
      0:{
          items:1
      },
      576:{
          items:1
      },
      768:{
          items:2
      },
      992:{
          items:3
      },
      1200:{
          items:4
      }
  }
});

function pageSlider() {
    $('.page-slider').slick({
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000, // Set autoplay speed to 1 second
        dots: false,
        speed: 1000, // Transition speed (2 seconds for a slower transition)
        arrows: true,
        prevArrow: '<button type="button" class="carousel-control left" aria-label="carousel-control"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="carousel-control right" aria-label="carousel-control"><i class="fas fa-chevron-right"></i></button>'
    });
}
pageSlider();


});