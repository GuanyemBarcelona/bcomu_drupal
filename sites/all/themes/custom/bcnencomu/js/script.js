var locale = {
  CLOSE: {
    ca: "Tanca",
    es: "Cerrar",
    en: "Close"
  },
  COOKIES_MESSAGE: {
    ca: "El nostre portal web web utilitza cookies amb la finalitat de millorar l'experiència de l'usuari. Al fer servir els nostres serveis acceptes l'ús que fem de les 'cookies'.",
    es: "Nuestro sitio web utiliza cookies con el fin de mejorar la experiencia del usuario. Al utilizar nuestros servicios aceptas el uso que hacemos de las 'cookies'.",
    en: "Our web site uses cookies to improve the user experience. Using our services you agree to the use of the 'cookies'."
  },
  COOKIES_MORE_INFO: {
  	ca: "Més informació",
    es: "Más información",
    en: "More information"
  },
  VIDEO_VIEWS: {
    ca: "visualitzacions",
    es: "visualizaciones",
    en: "views"
  },
  VIDEO_HD_AVAILABLE: {
    ca: "Vídeo disponible en HD",
    es: "Video disponible en HD",
    en: "Video available in HD"
  },
  VIDEO_CC_AVAILABLE: {
    ca: "Amb subtítols",
    es: "Con subtítulos",
    en: "Closed captioning"
  },
  LOADING: {
    ca: "Carregant...",
    es: "Cargando...",
    en: "Loading..."
  },
  DISTRICT_VERIFICATIONS_TITLE: {
    ca: "Propers punts de verificació",
    es: "Próximos puntos de verificación",
    en: "Next verification points"
  }
}
var config = {
  LANGUAGE: 'ca',
  THEME_URL: '/sites/all/themes/bcnencomu/',
  DISTRICT_VERIFICATIONS_URI: '/async/verifications/',
  YOUTUBE_API_KEY: 'AIzaSyC_oxmNRn9OI3_SaRbHfFWJtTyeaiD24bY',
  CACHED_DATA_TTL: 24*60*60*1000 // 24h
};

(function($){
  Drupal.behaviors.views = {
    attach: function(context, settings) {
      if ($(context).is('.view-event-calendar')){
        scrollCalendarToFirstEvent();
      }
    }
  };

	// ON READY
	$(window).ready(function(){
		config.LANGUAGE = $('html').attr('lang');

    moment.locale(config.LANGUAGE);

    // main menu
    var $main_menu = $('#block-system-main-menu');
    if ($main_menu.length){
      // responsive menu
      $('#page').prepend('<div class="mobile-menu"><button data-action="open-mobile-menu">Menu</button></div>');
      var $home_link = $('#site-logo a');
      var home_link_html = '';
      if ($home_link.length) home_link_html = '<a href="' + $home_link.attr('href') + '" class="home-link">'+$home_link.attr('title')+'</a>';
      var $mobile_menu = $('.mobile-menu');
      var $main_menu_content = $main_menu.find('> .content');
      var $secondary_menu_content = $('#block-menu-menu-secondary-menu > .content');
      $mobile_menu.append('<div class="menus-wrapper">' + home_link_html + $main_menu_content.html() + $secondary_menu_content.html() + '</div>');
      $('button[data-action="open-mobile-menu"]').click(function(e){
        $mobile_menu.toggleClass('opened');
      });
    }

    // simple bar graph
    // [graph value=34]
    $('article.node .body p').each(function(i) {
      // just works for first appearance of the graph
      var text = $(this).text();
      var graph_code_start = '[graph ';
      var ind = text.indexOf(graph_code_start);
      if (ind != -1){
        var ind2 = text.indexOf(']', ind);
        var attribs = text.substring(ind + graph_code_start.length, ind2);
        attribs = attribs.split(' ');
        var attribs_obj = {};
        for (var i in attribs){
          var attrib = attribs[i].split('=');
          attribs_obj[attrib[0]] = attrib[1];
        }
        $(this).html('<span class="graph bar horizontal"><span class="value"></span><span class="info">'+attribs_obj.value+'%</span></span>');
        var $graph = $(this).find('.graph');
        var $value = $graph.find('.value');
        var $info = $graph.find('.info');
        $value.css({'width':0});
        $value.animate({
          width: attribs_obj.value + '%'
        }, 2000);
        $info.css({'opacity':0, 'right': '-20px'});
        $info.animate({
          opacity: 1,
          right: '4px'
        }, 1000);
      }
    });

    // some menu links must open in new window: will show an icon and mark them as rel external
    var $external_menu_links = $('#block-system-main-menu nav > ul.menu > li.mid-750 a, #block-menu-menu-secondary-menu nav > ul.menu > li.mid-900 a, #block-menu-menu-secondary-menu nav > ul.menu > li.mid-945 a, .region-sidebar-first .menu-block-wrapper li.mid-927 a, .region-sidebar-first .menu-block-wrapper li.mid-923 a, .region-sidebar-first .menu-block-wrapper li.mid-906 a, .region-sidebar-first .menu-block-wrapper li.mid-928 a');
    $external_menu_links.each(function(i){
      $(this).attr('rel', 'external');
      $(this).append('<i class="fa fa-external-link"></i>');
    });

		// For all links with rel external, open link in new tab
	  $('body').on('click', 'a[rel="external"], a[rel="license"]', function(e){
	  	e.preventDefault();
      window.open($(this).attr('href'));
	  });

    // microprestecs menu "Call us" link
    $('article#node-284, article#node-285, article#node-290, article#node-292').find('.body a.btn.special').prepend('<i class="fa fa-phone"></i>');

	  // cookies
	  if (getCookie('bcnencomu_cookie_message') != 'accepted'){
	    $('#page').prepend('<div class="cookies-message"><p>'+locale.COOKIES_MESSAGE[config.LANGUAGE]+' <button data-action="close" title="'+locale.CLOSE[config.LANGUAGE]+'">X</button></p></div>');
	    setCookie('bcnencomu_cookie_message', 'accepted', 90);
	    var $cookies_message = $('.cookies-message');
	    $cookies_message.on('click', 'button[data-action="close"]', function(e){
	      e.preventDefault();
	      $cookies_message.fadeOut(300);
	    });
	  }

    // share links
    prepareShareLinks();

    // Calendar: page scrolls until first event
    var $calendar = $('.calendar-calendar');
    if ($calendar.length){
      scrollCalendarToFirstEvent();
    }
    // open event links as overlay
    $('div.single-day div.weekview .views-field-title a, div.single-day div.weekview .views-field-field-date a, .view-calendar-agenda .views-row .views-field-title-field a').each(function(i){
      prepareEventLink($(this));
    });

    // Home Slider
    $('.view-nodequeue-1 .view-content').slick({
      infinite: false,
      autoplay: true,
      adaptiveHeight: true,
      autoplaySpeed: 6000,
      speed: 1000,
      pauseOnHover: true,
      dots: true,
      arrows: false
    });


    // tags icon
    $('article.node-post-like > .content .info .field-name-field-tags .field-items').prepend('<i class="fa fa-tags"></i>');
    
    // media gallery
    var $image_gallery = $('article .image-gallery');
    if ($image_gallery.length){
      var $image_full_link = $image_gallery.find('.full-image a');
      if ($image_full_link.length){
        $image_full_link.fancybox();
      }
      var $image_thumbs = $image_gallery.find('.thumb-list');
      if ($image_thumbs.length){
        // image thumb click
        var $thumbs = $image_thumbs.find('.thumb.image');
        $thumbs.each(function(i){
          var $img = $(this).find('img');
          $img.click(onClickGalleryImageThumb);
          if (i == 0) onClickGalleryImageThumb($img); // load the first image
        });
        if ($thumbs.length == 1){
          $image_thumbs.hide();
        }
      }
    }

    // home agenda
    var $home_agenda = $('.view-display-id-agenda_block');
    if ($home_agenda.length){
      var $rows = $home_agenda.find('.views-row');
      $rows.each(function(){
        // wrap date
        $(this).wrapInner('<div class="content" />');
        $(this).prepend('<div class="date-group" />');
        $(this).find('.views-field-field-date, .views-field-field-date-1, .views-field-field-date-2').detach().appendTo($(this).find('.date-group'));

        // map icon
        $(this).find('.views-field-field-venue .field-content').prepend('<i class="fa fa-map-marker"></i>');
      });
    }

    // accordions inside article body, the html of each collapsible group is like:
    // .group
    //   h3
    //   .content
    var $groups = $('article.node .body .group');
    if ($groups.length){
      $groups.each(function(i){
        var $group = $(this);
        $group.addClass('accordion');
        $group.attr('id', 'accordion-' + i);
        var $title = $group.find('> h3');
        $title.append('<i class="fa fa-chevron-down"></i>');
        var $content = $group.find('> .content');
        $content.slideUp(10);
        $title.css({'cursor':'pointer'});
        var anim_speed = 300;
        $title.click(function(e){
          $groups.each(function(j){
            var $title = $(this).find('> h3');
            var $content = $(this).find('> .content');
            if (i == j){ // this group
              $title.parent().toggleClass('open');
              $content.slideToggle(anim_speed);
              $title.find('.fa').remove();
              if ($title.parent().hasClass('open')){
                $title.append('<i class="fa fa-chevron-up"></i>');
              }else{
                $title.append('<i class="fa fa-chevron-down"></i>');
              }
              
            }else{ // another sibling group
              $title.parent().removeClass('open');
              $content.slideUp(anim_speed);
            }
          });
        });
      });
    }

    // cronograma Qui Som
    var $cronograma = $('#page.cronograma-page');
    if ($cronograma.length){
      $('article > header h1').addClass('appear');
      $cronograma.find('article.node .body p, .view-cronograma-quisom .views-row').each(function(i){
        var $row = $(this);
        $row.addClass('scrollme');
        // paragraphs
        if ($row.is('p')){
          $row.addClass('animateme').attr({
            'data-when': 'enter',
            'data-from': 1,
            'data-to': .1,
            'data-opacity': 0
          });
        }
        // fields
        $row.find('.views-field').each(function(j){
          var $field = $(this);
          var sign = 1;
          if ($row.hasClass('views-row-odd')) sign = -1;
          $field.filter('.views-field-field-image').addClass('animateme').attr({
            'data-when': 'enter',
            'data-from': .6,
            'data-to': .1,
            'data-opacity': 0,
            'data-translatex': 200 * sign
          });
          $field.filter('.views-field-field-day').addClass('animateme').attr({
            'data-when': 'enter',
            'data-from': .6,
            'data-to': .1,
            'data-opacity': 0,
            'data-translatex': -150 * sign
          });
          $field.filter('.views-field-title-field').addClass('animateme').attr({
            'data-when': 'enter',
            'data-from': .6,
            'data-to': .1,
            'data-opacity': 0,
            'data-translatex': -200 * sign
          });
          $field.filter('.views-field-body').addClass('animateme').attr({
            'data-when': 'enter',
            'data-from': .6,
            'data-to': .1,
            'data-opacity': 0,
            'data-translatex': -300 * sign
          });
          $field.filter('.views-field-field-link').addClass('animateme').attr({
            'data-when': 'enter',
            'data-from': .6,
            'data-to': .1,
            'data-opacity': 0,
            'data-translatex': -350 * sign
          });
          $field.filter('.views-field-field-milestone-importance').find('span[data-value]').addClass('animateme').attr({
            'data-when': 'enter',
            'data-from': .6,
            'data-to': .1,
            'data-opacity': 0
          });
        });
      });
    }

    // Grups als barris page
    var $grups_barris = $('.view-grups-als-barris');
    if ($grups_barris.length){
      $grups_barris.addClass('with-js');
      $grups_barris.find('.view-content').before('<div class="barris-map"><ul></ul></div>');
      var $map = $grups_barris.find('.barris-map');
      // prepare verificacions box
      $map.after('<div class="verificacions"><button data-action="close">X</button><h3>'+locale.DISTRICT_VERIFICATIONS_TITLE[config.LANGUAGE]+'</h3><div class="content"></div></div>');
      var $verificacions = $grups_barris.find('.verificacions');
      $verificacions.attr('data-visible', false);
      var $verificacions_content = $verificacions.find('> .content');
      $verificacions.find('[data-action="close"]').click(function(e){
        e.preventDefault();
        $verificacions.attr('data-visible', false);
      });
      //---
      $grups_barris.find('.view-content > .item-list > h3').each(function(i){
        var tid = $(this).find('> span').attr('data-tid');
        $map.find('ul').append('<li data-index="'+i+'" data-tid="'+tid+'">'+$(this).text()+'</li>');
      });
      $map.find('li').click(function(e){
        var index = $(this).attr('data-index');
        var tid = $(this).attr('data-tid');
        $verificacions_content.html('');
        $map.addClass('clicked');
        $map.find('li').removeClass('active');
        $(this).addClass('active');
        $grups_barris.find('.view-content > .item-list').removeClass('active');
        $grups_barris.find('.view-content > .item-list').eq(index).addClass('active');
        // get the verificacions events for this district
        $verificacions.attr('data-visible', false);
        $.ajax({
          url: config.DISTRICT_VERIFICATIONS_URI + tid
        })
        .done(function(data){
          $verificacions.attr('data-visible', true);
          $verificacions_content.html(data);
          $verificacions_content.find('.views-field-title a').each(function(i){
            prepareEventLink($(this));
          })
        });
        // ---
      });
    }
	});

	$(window).load(function(){
    // Masonry
    $('.view-frontpage, .view-blog, .view-articles, .view-multimedia, .view-albums, .term-nodes').masonry({
      itemSelector: '.node-teaser'
    });
	});

  // bind action to image from gallery thumbnail click.
  // e could be an event or directly a jQuery object
  function onClickGalleryImageThumb(e){
    if (e.currentTarget){
      var $img = $(e.currentTarget);
    }else{
      var $img = e;
    }
    var $full_image = $img.closest('.image-gallery').find('> .full-image');
    $full_image.show();
    var image_full_url = $img.attr('data-full');
    var img_html = '<figure>';
    img_html += '<img src="'+image_full_url+'" />';
    img_html += '</figure>';
    $full_image.html(img_html);
  }

  function prepareShareLinks(){
    var popup_measures = [580, 470];
    $('.share-links').on('click', 'a', function(e){
      e.preventDefault();
      popupCenter($(this).attr('href'), $(this).find('.text').html(), popup_measures);
    });
  }

  function popupCenter(url, title, measures) {
    var dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop !== undefined ? window.screenTop : screen.top;
    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
    var left = ((width / 2) - (measures[0] / 2)) + dualScreenLeft;
    var top = ((height / 3) - (measures[1] / 3)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + measures[0] + ', height=' + measures[1] + ', top=' + top + ', left=' + left);
    if (window.focus) {
      newWindow.focus();
    }
  }

  function scrollCalendarToFirstEvent(){
    var $calendar = $('.calendar-calendar');
    if ($calendar.length){
      var $day_container = $calendar.find('#single-day-container');
      var min_top = 100000;
      var item_found = false;
      $calendar.find('.week-view .full div.single-day .inner, .calendar-calendar .day-view .full div.single-day .inner').each(function(i){
        var $item = $(this).find('.view-item');
        if ($item.length){
          item_found = true;
          var top = $item.offset().top - $day_container.offset().top;
          if (top < min_top) min_top = top;
        }
      });
      if (item_found){
        $day_container.animate({
          scrollTop: min_top
        }, 1000);
      }
    }
  }

})(jQuery);

// prepare the event links to open as overlay
function prepareEventLink($obj){
  var href = $obj.attr('href');
  $obj.attr('href', href + '?oasis=1');
  $obj.fancybox(
    {
      'type': 'iframe',
      'width': 500
    }
  );
}