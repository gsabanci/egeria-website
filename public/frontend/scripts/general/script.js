AOS.init({
  duration: 1200,
  disable: 'mobile',
  startEvent: 'load',
});

$(document).ready(function () {
  // go to top bytton
  $('.c-go-top').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 700);
    return false;
  });

  // hamburger icon
  $('.c-hamburger').click(function () {
    $(this).toggleClass('c-hamburger--isActive');
    $('body').toggleClass('menu-isOpen');
  });

  // mask phone
  $('#phone').usPhoneFormat({
    format: 'xxx-xxx-xxxx',
  });

  // projects slider
  $('.c-slider--projects').owlCarousel({
    loop: true,
    margin: 40,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 5000,
    smartSpeed: 450,
    lazyLoad: true,
    lazyLoadEager: 1,
    responsive: {
      0: {
        items: 2,
      },
      600: {
        items: 3,
      },

      1200: {
        items: 5,
      },

      1400: {
        items: 6,
      },
    },
  });

  // services slider
  $('.c-slider--services').owlCarousel({
    loop: true,
    margin: 0,
    nav: false,
    dots: false,
    center: true,
    margin: 20,
    lazyLoad: true,
    lazyLoadEager: 1,
    responsive: {
      0: {
        items: 1,
        autoHeight: true,
        dots: true,
      },
      576: {
        items: 1,
      },
      992: {
        items: 3,
        margin: 0,
      },
    },
  });

  // services slider custom nav buttons
  var owl = $('.c-slider--services');
  owl.owlCarousel();
  $('.c-slider--services__nextBtn').click(function () {
    owl.trigger('next.owl.carousel');
  });
  $('.c-slider--services__prevBtn').click(function () {
    owl.trigger('prev.owl.carousel', [300]);
  });

  // country select2
  $('.js-state-select').select2({
    minimumResultsForSearch: Infinity,
    dropdownCssClass: 'c-select2--outline__dropdown',
  });

  // mobile menu
  var item = $('.c-mobile-menu__list-item').find('ul');
  if (item.length !== 0) {
    item.parent().addClass('has-sub');
  }
  $('.c-mobile-menu__list-item').click(function () {
    $(this).toggleClass('active').find('.c-mobile-menu__list-item-sub').slideToggle();
    $('.c-mobile-menu__list-item').not(this).removeClass('active').find('.c-mobile-menu__list-item-sub').slideUp();
  });

  //filter slider
  $('.c-slider--filter').owlCarousel({
    loop: false,
    margin: 10,
    mouseDrag: false,
    nav: true,
    dots: false,
    navText: [
      "<svg class='c-icon__svg c-icon--xs'><use xlink:href='../frontend/assets/images/sprite.svg#chevron-left'></use></svg>",
      "<svg class='c-icon__svg c-icon--xs'><use xlink:href='../frontend/assets/images/sprite.svg#chevron-right'></use></svg>",
    ],
    responsive: {
      0: {
        items: 2,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 4,
      },
    },
  });

  var filterButtonsItem = $('.c-filter__buttons .owl-carousel .owl-item');
  var filterButtonsNav = $('.c-filter__buttons .owl-carousel');

  if (filterButtonsItem.length <= 5) {
    filterButtonsNav.remove('no-nav');
  } else {
    filterButtonsNav.addClass('no-nav');
    filterButtonsNav.trigger('refresh.owl.carousel');
  }

  //accordion
  $('.js-accordion-btn > a').on('click', function () {
    if ($(this).hasClass('is-active')) {
      $(this).removeClass('is-active');
      $(this).parent('.js-accordion-btn').removeClass('is-active');
      $(this).siblings('.js-accordion-content').slideUp(200);
      $(this).parent('.js-accordion-btn').prev().removeClass('c-accordion__row--no-border');
    } else {
      $('.js-accordion-btn > a').removeClass('is-active');
      $('.js-accordion-btn').removeClass('is-active');
      $(this).addClass('is-active');
      $(this).parent('.js-accordion-btn').addClass('is-active');
      $('.js-accordion-btn').prev().removeClass('c-accordion__row--no-border');
      $(this).parent('.js-accordion-btn').prev().addClass('c-accordion__row--no-border');

      $('.js-accordion-content').slideUp(200);
      $(this).siblings('.js-accordion-content').slideDown(200);
    }
  });

  $('.phone').on('keyup ', function () {
    var phn = $(this).val();
    if (phn.length < 4) {
      phn = '+90' + phn;
    }
    phn = phn.replace(/\D/g, '');
    phn = phn.replace(/(\d{0})(\d)/, '$1+$2');
    phn = phn.replace(/(\d{2})(\d)/, '$1 ($2');
    phn = phn.replace(/(\d{3})(\d)/, '$1) $2');
    phn = phn.replace(/(\d{5})(\d)/, '$1 $2');
    phn = phn.replace(/(\d{3})(\d)/, '$1 $2');
    phn = phn.replace(/(\d{3})(\d)/, '$1 $2');

    /*if(phn.length == 19) {
            phn = phn.replace(/\D/g, '');
            phn = phn.replace(/(\d{0})(\d)/, '$1+$2');
            phn = phn.replace(/(\d{2})(\d)/, '$1 ($2');
            phn = phn.replace(/(\d{3})(\d)/, '$1) $2');
            phn = phn.replace(/(\d{5})(\d)/, '$1 $2');
            phn = phn.replace(/(\d{3})(\d)/, '$1 $2');
            phn = phn.replace(/(\d{3})(\d)/, '$1 $2');
        } else {
            phn = phn.replace(/\D/g, '');
            phn = phn.replace(/(\d{0})(\d)/, '$1+$2');
            phn = phn.replace(/(\d{1})(\d)/, '$1 ($2');
            phn = phn.replace(/(\d{3})(\d)/, '$1) $2');
            phn = phn.replace(/(\d{5})(\d)/, '$1 $2');
            phn = phn.replace(/(\d{3})(\d)/, '$1 $2');
            phn = phn.replace(/(\d{3})(\d)/, '$1 $2');
        }*/

    $(this).val(phn);
  });

  // $(document).ready(function () {
  //   const modalShownKey = 'modalShown';
  //   const startTimeKey = 'startTime';
  //   const duration = 10000; // 10 saniye

  //   // Modal kapandığında çalışacak fonksiyon
  //   $('#timeUpModal').on('hidden.bs.modal', function () {
  //     // Kullanıcı modalı kapattığında, bunu localStorage'a kaydet
  //     localStorage.setItem(modalShownKey, 'true');
  //   });

  //   function checkTimeAndShowModal() {
  //     // Modal daha önce gösterilmişse, işlemi durdur
  //     if (localStorage.getItem(modalShownKey) === 'true') {
  //       clearInterval(intervalId); // Sürekli kontrolü durdur
  //       return;
  //     }

  //     const startTime = localStorage.getItem(startTimeKey);
  //     const currentTime = new Date().getTime();

  //     if (startTime) {
  //       const elapsedTime = currentTime - parseInt(startTime, 10);
  //       if (elapsedTime >= duration) {
  //         $('#timeUpModal').modal('show');
  //         clearInterval(intervalId); // Modal gösterildikten sonra sürekli kontrolü durdur
  //       }
  //     } else {
  //       // startTime localStorage'da yoksa, şu anki zamanı kaydet
  //       localStorage.setItem(startTimeKey, currentTime.toString());
  //     }
  //   }

  //   // Sürekli zaman kontrolü için setInterval kullan
  //   const intervalId = setInterval(checkTimeAndShowModal, 1000); // Her 1 saniyede bir kontrol et
  // });

  $(document).ready(function () {
    const modalShownKey = 'modalShown';
    const startTimeKey = 'startTime';
    const firstVisitKey = 'firstVisit'; // Kullanıcı siteye ilk giriş yaptığı zamanı tutar.
    const duration = 20000; // 10 saniye
    const ttl = 86400000; // 24 saat

    function cleanLocalStorageAfter24Hours() {
      const firstVisitTime = localStorage.getItem(firstVisitKey);
      const currentTime = new Date().getTime();

      if (firstVisitTime && currentTime - parseInt(firstVisitTime, 10) > ttl) {
        localStorage.clear();
        localStorage.setItem(firstVisitKey, currentTime.toString());
      }
    }

    $('#timeUpModal').on('hidden.bs.modal', function () {
      localStorage.setItem(modalShownKey, 'true');
    });

    function checkTimeAndShowModal() {
      if (localStorage.getItem(modalShownKey) === 'true') {
        clearInterval(intervalId);
        return;
      }

      const startTime = localStorage.getItem(startTimeKey);
      const currentTime = new Date().getTime();

      if (startTime) {
        const elapsedTime = currentTime - parseInt(startTime, 10);
        if (elapsedTime >= duration) {
          $('#timeUpModal').modal('show');
          clearInterval(intervalId);
        }
      } else {
        localStorage.setItem(startTimeKey, currentTime.toString());
      }
    }

    if (!localStorage.getItem(firstVisitKey)) {
      localStorage.setItem(firstVisitKey, new Date().getTime().toString());
    }

    cleanLocalStorageAfter24Hours();

    const intervalId = setInterval(checkTimeAndShowModal, 1000);
  });

  // // Haritayı başlat
  // $(document).ready(function () {
  //   // Haritayı başlat
  //   var map;
  //   function initMap() {
  //     var center = { lat: 38.45453, lng: 27.1768 };
  //     map = new google.maps.Map(document.getElementById('map'), {
  //       zoom: 14,
  //       center: center,
  //       streetViewControl: false,
  //       mapTypeControl: false,
  //       clickableIcons: false,
  //     });
  //   }

  //   initMap();

  //   // Kartlara tıklama olayı
  //   $('.c-office-card').click(function () {
  //     var lat = parseFloat($(this).data('lat'));
  //     var lng = parseFloat($(this).data('lng'));

  //     var newCenter = new google.maps.LatLng(lat, lng);
  //     map.panTo(newCenter);

  //     new google.maps.Marker({
  //       position: newCenter,
  //       map: map,
  //     });

  //     $('.c-office-card').removeClass('active');
  //     $(this).addClass('active');
  //   });

  //   // Sayfa yüklenince ilk kartı otomatik olarak "tıklanmış" olarak işaretle
  //   $('.c-office-card').first().trigger('click');
  // });
});

// //google maps
// function initMap() {
//   var center = { lat: 38.45453, lng: 27.1768 };
//   map = new google.maps.Map(document.getElementById('map'), {
//     zoom: 14,
//     center: center,
//     streetViewControl: false,
//     mapTypeControl: false,
//     clickableIcons: false,
//     // disableDefaultUI: true,
//   });
// }

// $(document).ready(function () {
//   var marker = new google.maps.Marker({
//     position: { lat: 38.45453, lng: 27.1768 },
//     map: map,
//     title: 'Merhaba Dünya!',
//   });

//   $('.c-office-card').click(function () {
//     var lat = parseFloat($(this).data('lat'));
//     var lng = parseFloat($(this).data('lng'));

//     var newCenter = new google.maps.LatLng(lat, lng);
//     map.panTo(newCenter);

//     new google.maps.Marker({
//       position: newCenter,
//       map: map,
//     });

//     $('.c-office-card').removeClass('active');
//     $(this).addClass('active');
//   });

//   $('.c-office-card').first().trigger('click');
// });

// var map;
// function initMap() {
//   var center = { lat: 38.45453, lng: 27.1768 };
//   map = new google.maps.Map(document.getElementById('map'), {
//     zoom: 14,
//     center: center,
//     streetViewControl: false,
//     mapTypeControl: false,
//     clickableIcons: false,
//   });
// }

// $(document).ready(function () {
//   var marker = new google.maps.Marker({
//     position: { lat: 38.45453, lng: 27.1768 },
//     map: map,
//     title: 'Merhaba Dünya!',
//   });

//   $('.c-office-card').click(function () {
//     var lat = parseFloat($(this).data('lat'));
//     var lng = parseFloat($(this).data('lng'));

//     var newCenter = new google.maps.LatLng(lat, lng);
//     map.panTo(newCenter);

//     new google.maps.Marker({
//       position: newCenter,
//       map: map,
//     });

//     $('.c-office-card').removeClass('active');
//     $(this).addClass('active');
//   });

//   // Sayfa yüklenince ilk kartı otomatik olarak "tıklanmış" olarak işaretle
//   $('.c-office-card').first().trigger('click');
// });
