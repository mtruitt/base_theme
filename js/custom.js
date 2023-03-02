// Off canvas navigation
$(function () {
    'use strict'
  
    $('[data-toggle="offcanvas"]').on('click', function () {
      $('.offcanvas-collapse').toggleClass('open');
      $('.navbar-toggler .navbar-toggler-icon').toggleClass('d-none');
      $('.navbar-toggler .close').toggleClass('d-none');
      
      if ($('.site-alert').length) {
        $('.site-alert').toggleClass('d-none');
      }
    });
  
  })