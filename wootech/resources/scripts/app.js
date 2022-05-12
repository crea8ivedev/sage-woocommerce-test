import {domReady} from '@roots/sage/client';
import 'jquery';
import 'alpinejs/dist/cdn';
// import 'jquery-validation';
import 'slick-carousel';
import AOS from 'aos';

/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }
  // application code

  (function ($) {
    $(document).ready(function(){
      "use strict";

      AOS.init({once: true});
      $(window).on("scroll", function () {
        AOS.init({once: true});
      });

      $('.js-carousel').slick();
		
      var btnBackToTop = $('.btn-back-top');

      $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
        btnBackToTop.removeClass('hidden');
        } else {
        btnBackToTop.addClass('hidden');
        }
      });

      btnBackToTop.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
      });

      $('.menu-toggler').on('click', function(){
        $('body').toggleClass('overflow-hidden md:overflow-visible');
      });

    });

    if ($('div#images-by-api').length) {
      $('div#images-by-api').ready(function() {
        var keyWord = $('.product_splash_key').val();
        var str ='keyword=' + keyWord + '&action=unspalsh_prod_img_api';
        let clientID = '7oLwbCKQ9j3J85pVJKOrqQonqghwNaQhRtCzwya-oW0';
        let endpoint = 'https://api.unsplash.com/photos/?client_id=${clientID}';
        
        $.ajax({
          type: 'POST',
          dataType: 'html',
          url: ajax_object.ajaxurl,
          data: str,
          success: function (data) {
            var $data = JSON.parse(data);
            if ($data['result'] != '') {
              $('div#images-by-api').append($data['result']);
              $('.woocommerce-product-gallery').css('display', 'none');
            }
          },
        });
      });
    }
  })(jQuery);
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
