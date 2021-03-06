var locale = {
  LOADING: {
    ca: "Carregant...",
    es: "Cargando...",
    en: "Loading..."
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
  DISTRICT_VERIFICATIONS_TITLE: {
    ca: "Propers punts de verificació",
    es: "Próximos puntos de verificación",
    en: "Next verification points"
  }
};
var config = {
  LANGUAGE: 'ca',
  THEME_URI: '/sites/all/themes/custom/bcnencomu/',
  YOUTUBE_API_KEY: 'AIzaSyDdi9PF1O_S7tFUJASw8JC4e2V_C8WWn9Y',
  CACHED_DATA_TTL: 24*60*60*1000, // 24h
  SCROLL_FIX_HEADER: 60, // pixels on which we shall fix the header
  SCROLL_THRESHOLD: 50 // miliseconds
  //DISTRICT_VERIFICATIONS_URI: '/async/verifications/',
};

(function($){
  Drupal.behaviors.views = {
    attach: function(context, settings) {
      if ($(context).is('.view-multimedia')){
        prepareAllVIdeos();
      } else if ($(context).is('.view-event-calendar')){
        scrollCalendarToFirstEvent();
      } else if ($(context).is('.view-agenda')){
        prepareAgendaLayout();
        prepareAllEventLinks();
      }
    }
  };

	// ON READY
	$(window).ready(function(){
		config.LANGUAGE = $('html').attr('lang');
    moment.locale(config.LANGUAGE);

    // prepare scroll
    prepareScrollBehavior();

    // main menu
    var $main_menu = $('#block-system-main-menu');
    if ($main_menu.length) {
      // responsive menu
      $('#page').before('<div class="mobile-menu"><button data-action="open-mobile-menu">Menu</button></div>');
      var $home_link = $('#site-logo a');
      var home_link_html = '';
      if ($home_link.length) home_link_html = '<a href="' + $home_link.attr('href') + '" class="home-link extra-mobile-link">'+$home_link.attr('title')+'</a>';
      var $participa_link = $('.cta-mainmenu-participa .content a');
      var participa_link_html = '';
      if ($participa_link.length) participa_link_html = '<a href="' + $participa_link.attr('href') + '" class="participa-link extra-mobile-link">'+$participa_link.text()+'</a>';
      var $mobile_menu = $('.mobile-menu');
      var $main_menu_content = $main_menu.find('> .content');
      var $secondary_menu_content = $('#block-menu-menu-secondary-menu > .content');
      var $social_networks_content = $('#block-bcnencomu-social_networks_links > .content');
      var $locale_menu_content = $('#block-locale-language > .content');
      $mobile_menu.append('<div class="menus-wrapper">' + home_link_html + $main_menu_content.html() + participa_link_html + $secondary_menu_content.html() + $social_networks_content.html() + $locale_menu_content.html() + '</div>');
      $('button[data-action="open-mobile-menu"]').click(function (e) {
        $mobile_menu.toggleClass('opened');
      });

      // deploy submenus on clicking a mother link
      $mobile_menu.find('nav > ul > li').each(function(i){
        if ($(this).find('ul').length) {
          $(this).find('> a').click(function(e){
            e.preventDefault();
            $(this).parent().toggleClass('open');
          });
        }
      });
    }

    // search block
    var $search_block = $('#block-search-form');
    if ($search_block.length){
      var $form = $search_block.find('form');
      var $txt = $search_block.find('input[type="text"]');
      var $submitBtn = $search_block.find('input[type="submit"]');
      $submitBtn.before('<button data-action="close">x</button>');
      var $closeBtn = $search_block.find('[data-action="close"]');
      var toggleSearch = function(e){
        e.preventDefault();
        $search_block.toggleClass('opened');
        $txt.focus();
      };
      $txt.keypress(function(e) {
        if (e.which === 13) {
          $form.submit();
        }
      });
      $submitBtn.click(toggleSearch);
      $closeBtn.click(toggleSearch);
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

    // share links
    prepareShareLinks();

    // Calendar view
    var $calendar = $('.calendar-calendar');
    if ($calendar.length){
      // page scrolls until first event
      scrollCalendarToFirstEvent();
    }

    // candidates open as overlay
    $('.view-candidacies-list .views-row a').each(function (i) {
      var href = $(this).attr('href');
      $(this).attr('href', href + '?oasis=1');
      $(this).fancybox(
        {
          'type': 'iframe',
          'width': 600,
          'height': 500
        }
      );
    });

    // open event links as overlay
    prepareAllEventLinks();

    // Calendar Search view
    var $calendar_search = $('.view-display-id-agenda_page');
    if ($calendar_search.length){
      // scroll body to the event that has current date or is the next to come, or the last one
      var max_top = 0;
      var item_found = false;
      var today = moment();
      $calendar_search.find('.views-row').each(function(i){
        var item_top = $(this).offset().top;
        if (item_top > max_top) max_top = item_top;
        var machine_date = $(this).find('.views-field-field-date-2').text().trim();
        machine_date = moment(machine_date);
        if (machine_date.isSameOrAfter(today)){
          item_found = true;
          max_top -= (100 + config.SCROLL_FIX_HEADER);
          return false;
        }
      });
      if (item_found){
        $('html').animate({
          scrollTop: max_top
        }, 1000);
      }
    }

    // whatsapp message
    var $whatsapp_message = $('.whatsapp-message');
    if ($whatsapp_message.length) {
      $whatsapp_message.prepend('<button data-action="close"><span>x</span></button>');
      $whatsapp_message.find('.content').prepend('<i data-icon data-social-network="watsapp"></i>');
      var $close_btn = $whatsapp_message.find('[data-action="close"]');
      $whatsapp_message.prependTo('#page');
      $('body').addClass('with-whatsapp-message');
      $('#page').css({'padding-top': $whatsapp_message.height()});
      $close_btn.on('click', function(e){
        $whatsapp_message.slideUp(300);
        $('#page').css({'padding-top': 0});
      });
    }

    // Home Slider
    $('.view-nodequeue-1 .view-content').slick({
      infinite: false,
      autoplay: true,
      adaptiveHeight: true,
      autoplaySpeed: 6000,
      speed: 1000,
      pauseOnHover: true,
      dots: true,
      arrows: false,
      responsive: [
        {
          breakpoint: 480,
          settings: {
            dots: false
          }
        }
      ]
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

    // agenda
    prepareAgendaLayout();

    // home batalles: change last link
    $('.view-batalles-home .view-content .views-row.tid-684 .views-field-field-lead a').attr('href', '/' + config.LANGUAGE + '/batalla/ciutat-dels-barris');

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

    // districtes conselleres Map
    var $district_map = $('.view-districtes-consellers');
    if ($district_map.length) {
      var $districts = $district_map.find('.views-row');
      var map_district_coords = [
        '259,414,258,401,281,375,294,388,319,388,324,396,323,407,334,406,336,430,342,429,342,442,278,494,209,495,206,477,256,472,279,434',
        '255,409,216,369,216,349,252,318,293,340,345,340,346,331,365,331,363,367,348,388,326,389,322,380,301,379,287,365,257,394',
        '300,215,300,252,308,258,307,288,289,304,290,329,340,331,344,280,333,280,332,260,355,236,341,235,335,226,326,236,325,213',
        '286,216,288,189,296,181,324,181,352,154,389,152,392,165,407,180,429,180,443,199,443,217,437,226,412,226,391,243,391,249,372,251,390,273,389,284,402,293,395,299,397,313,390,321,346,321,349,273,336,273,336,264,367,235,350,231,335,217,326,224,328,205,297,204',
        '169,219,186,221,187,238,203,241,204,279,247,315,237,323,218,322,213,316,168,319,168,303,147,284,145,262,173,231',
        '379,255,397,257,396,247,413,234,440,230,448,221,450,203,464,189,510,188,518,183,540,205,489,254,477,255,429,301,418,285,410,289,399,278,399,268',
        '415,292,429,310,480,259,492,258,518,232,518,297,466,351,467,369,441,370,442,329,428,342,401,345,400,326,409,321,406,301',
        '369,328,393,326,394,352,425,352,434,343,438,375,465,378,462,415,450,420,453,435,347,437,347,427,341,426,338,405,345,393,371,369',
        '161,324,213,324,220,329,228,327,213,344,212,374,270,432,237,463,150,471,139,514,66,517,16,462,15,376,58,410,101,412,145,373,158,370,155,342',
        '196,19,122,59,123,102,147,122,148,151,172,154,193,182,189,215,191,237,208,236,206,272,249,313,284,327,284,303,303,287,302,262,294,255,295,219,282,225,282,189,296,176,259,131,264,43'
      ];
      var image_map_html = '<div class="image-map-container"><h3></h3><img src="'+config.THEME_URI+'/img/mapa_districtes.png" usemap="#image-map">';
      image_map_html += '<map name="image-map">';
      $districts.each(function(i){
        var $link = $(this).find('.views-field-name a');
        image_map_html += '<area target="" alt="" title="'+$link.text()+'" href="'+$link.attr('href')+'" coords="'+map_district_coords[i]+'" shape="poly">';
      });
      image_map_html += '</map></div>';
      $district_map.append(image_map_html);
      var $district_title = $district_map.find('.image-map-container > h3');
      $district_map.find('area').hover(
          function() {
            $district_title.text($(this).attr('title'));
          }, function() {
            $district_title.text('');
          }
      );
    }
	});

  // ON SCROLL
  $(window).scroll(debounce(onWindowScroll, config.SCROLL_THRESHOLD)); // for all events that trigger continuosly, we debounce the functions called, for a better performance

  function onWindowScroll(e){
    prepareScrollBehavior();
  }

  function prepareAgendaLayout(){
    var $agenda = $('.view-agenda');
    if ($agenda.length){
      var $rows = $agenda.find('.views-row');
      $rows.each(function(){
        // wrap content in many columns
        $(this).wrapInner('<div class="column column-info" />');
        $(this).prepend('<div class="column column-date" />');
        $(this).prepend('<div class="column column-title" />');
        $(this).find('.views-field-title-field').detach().appendTo($(this).find('.column-title'));
        $(this).find('.views-field-field-date, .views-field-field-date-1, [data-action="add-to-calendar-open"]').detach().appendTo($(this).find('.column-date'));
      });
    }
  }

  function prepareScrollBehavior(){
    var scrollTop = $(this).scrollTop();

    // fixed header check
    if (scrollTop >= config.SCROLL_FIX_HEADER){
      $('body').addClass('header-fixed');
    }else{
      $('body').removeClass('header-fixed');
    }
  }

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

  // prepare the event links to open as overlay
  function prepareAllEventLinks(){
    $('.view-agenda .views-field-title-field a, div.single-day div.weekview .views-field-title a, div.single-day div.weekview .views-field-field-date a, .view-calendar-agenda .views-row .views-field-title-field a').each(function(i){
      prepareEventLink($(this));
    });
  }

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

})(jQuery);

// YouTube iframe Player API
var tag = document.createElement('script');
tag.src = 'https://www.youtube.com/iframe_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function _get_youtube_id_from_uri(url){
  var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
  var match = url.match(regExp);
  if (match && match[7].length==11){
    return match[7];
  }
  return false;
}

// on YouTube iframe Player API Ready
function onYouTubeIframeAPIReady() {
  prepareAllVIdeos();
}

function prepareAllVIdeos() {
  jQuery('[data-youtube-uri]').each(function (i) {
    var $video = jQuery(this);
    var html_id = $video.find('.video').attr('id');
    var youtube_id = false;
    var youtube_uri = jQuery(this).attr('data-youtube-uri');
    if (typeof youtube_uri !== typeof undefined && youtube_uri !== false) {
      youtube_id = _get_youtube_id_from_uri(youtube_uri);
    }
    if ($video.is('.node-teaser')) {
      // --- teaser ---
      // load image if has youtube_id
      if (youtube_id !== false) {
        // this returned data from the youtube API is cached through simpleStorage
        var video_data_key = 'vid_' + youtube_id;
        var video_data = simpleStorage.get(video_data_key);
        if (typeof video_data === 'undefined') {
          var youtube_data_uri = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics&key=' + config.YOUTUBE_API_KEY + '&id=' + youtube_id;
          jQuery.ajax({
            url: youtube_data_uri,
            dataType: 'jsonp',
            success: function (data) {
              simpleStorage.set(video_data_key, data, {TTL: config.CACHED_DATA_TTL});
              placeMetadataInVideoContainer(data, $video);
            }
          });
        } else {
          placeMetadataInVideoContainer(video_data, $video);
        }
      }
      // open as overlay
      $video.find('a').each(function (j) {
        var href = jQuery(this).attr('href');
        jQuery(this).attr('href', href + '?oasis=1');
        jQuery(this).fancybox(
          {
            'type': 'iframe',
            'width': 610,
            'height': 500
          }
        );
      });
    } else if ($video.is('.node-slider')) {
      // --- slider ---
      var $play_btn = $video.find('a[data-action="play"]');
      var $image = $video.find('.image');
      var $content = $video.find('> .content');
      var video_heights = [557, 768]; // original, play mode
      $play_btn.click(function (e) {
        if (youtube_id !== false) {
          e.preventDefault();
          // stop the caroussel
          /*var $carousel = $video.closest('.owl-carousel');
          $carousel.trigger('autoplay.stop.owl');*/
          var carousel = $video.closest('.owl-carousel').data('owlCarousel');
          var current_item = carousel.currentItem;
          carousel.stop();
          carousel.reinit({autoPlay: false});
          carousel.jumpTo(current_item);
          // ---
          /*$video.closest('.view-content').animate({
          height: video_heights[1] + 'px'
          }, 500, function() {

          });*/
          $play_btn.hide();
          $image.hide();
          $content.hide();
          var slide_player_id = 'video-' + html_id;
          $video.prepend('<div class="video" id="' + slide_player_id + '" />');
          var player = new YT.Player(slide_player_id, {
            width: '640',
            height: '390',
            videoId: youtube_id,
            events: {
              'onReady': onPlayerReady
            }
          });
          // carousel events
          /*var $carousel = $video.closest('.owl-carousel');
          $carousel.on('to.owl.carousel', function(e) {
          player.stopVideo();
          });*/
        }
      });
    } else if ($video.is('.node-full')) {
      // --- full ---
      if (youtube_id !== false) {
        var player = new YT.Player(html_id, {
          width: '640',
          height: '390',
          videoId: youtube_id,
          events: {
            'onReady': onPlayerReady
          }
        });
      }
    }
  });
}

function placeMetadataInVideoContainer(data, $container) {
  try {
    var snippet = data.items[0].snippet;
    var details = data.items[0].contentDetails;
    var statistics = data.items[0].statistics;
    $container.find('> .content h2').after('<aside class="info"></aside>');
    var $info = $container.find('aside.info');
    $container.find('> .content .summary').after('<aside class="features"></aside>');
    var $features = $container.find('aside.features');
  } catch (err) {
    console.log(err);
  }

  // thumb
  try {
    var img_src = snippet.thumbnails.medium.url;
    var $link = $container.find('.image a');
    if ($link.find('img').length === 0) {
      $link.append('<img src="' + img_src + '" />');
    }
  } catch (err) {
    console.log(err);
  }
}

// converts ISO 8601 duration format to a human readable string
function getTimeString(duration) {
  var duration2 = moment.duration(duration);
  var time = {};
  time.hours = duration2.hours();
  time.minutes = duration2.minutes();
  time.seconds = duration2.seconds();
  var time_str = (time.hours != 0) ? time.hours + ':' : '';
  time_str += pad(time.minutes, 2) + ':';
  time_str += pad(time.seconds, 2);
  return time_str;
}

function onPlayerReady(e) {
  e.target.playVideo();
}
