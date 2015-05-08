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
}
var config = {
  LANGUAGE: 'ca',
  THEME_URL: '/sites/all/themes/bcnencomu/',
  YOUTUBE_API_KEY: 'AIzaSyC_oxmNRn9OI3_SaRbHfFWJtTyeaiD24bY',
  CACHED_DATA_TTL: 24*60*60*1000 // 24h
};

(function($){
  Drupal.behaviors.views = {
    attach: function(context, settings) {
      if ($(context).is('.view-multimedia')){
        prepareAllVIdeos();
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
      var $mobile_menu = $('.mobile-menu');
      var $main_menu_content = $main_menu.find('> .content');
      var $secondary_menu_content = $('#block-menu-menu-secondary-menu > .content');
      $mobile_menu.append('<div class="menus-wrapper">' + $main_menu_content.html() + $secondary_menu_content.html() + '</div>');
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

    // Home Slider
    $home_slider = $('.view-nodequeue-1 .view-content');
    if ($home_slider.length){
      $home_slider.owlCarousel({
        items: 1,
        navigation: true,
        pagination: true,
        navigationText: false,
        scrollPerPage: true,
        slideSpeed: 500,
        autoPlay: true,
        stopOnHover: true,
        itemsCustom: [[0, 1]]
      });
    }

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

})(jQuery);

// YouTube iframe Player API
var tag = document.createElement('script');
tag.src = 'https://www.youtube.com/iframe_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function _get_youtube_id_from_uri(url){
  var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
  var match = url.match(regExp);
  if (match&&match[7].length==11){
    return match[7];
  }
  return false;
}

 // on YouTube iframe Player API Ready
function onYouTubeIframeAPIReady() {
  prepareAllVIdeos();
}

function prepareAllVIdeos(){
  jQuery('[data-youtube-uri]').each(function(i){
    var $video = jQuery(this);
    var html_id = $video.find('.video').attr('id');
    var youtube_id = false;
    var youtube_uri = jQuery(this).attr('data-youtube-uri');
    if (typeof youtube_uri !== typeof undefined && youtube_uri !== false) {
      youtube_id = _get_youtube_id_from_uri(youtube_uri);
    }
    if ($video.is('.node-teaser')){
      // --- teaser ---
      // load image if has youtube_id
      if (youtube_id !== false){
        // this returned data from the youtube API is cached through simpleStorage
        var video_data_key = 'vid_' + youtube_id;
        var video_data = simpleStorage.get(video_data_key);
        if (typeof video_data === 'undefined'){
          var youtube_data_uri = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics&key=' + config.YOUTUBE_API_KEY + '&id=' + youtube_id;
          jQuery.ajax({
            url: youtube_data_uri,
            dataType: 'jsonp',
            success: function (data) {
              simpleStorage.set(video_data_key, data, {TTL: config.CACHED_DATA_TTL});
              placeMetadataInVideoContainer(data, $video);
            }
          });
        }else{
          placeMetadataInVideoContainer(video_data, $video);
        }
      }
      // open as overlay
      $video.find('a').each(function(j){
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
    }else if ($video.is('.node-slider')){
      // --- slider ---
      var $play_btn = $video.find('a[data-action="play"]');
      var $image = $video.find('> .image');
      var $content = $video.find('> .content');
      var video_heights = [557, 768]; // original, play mode
      $play_btn.click(function(e){
        if (youtube_id !== false){
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
          $play_btn.hide();
          $image.hide();
          $content.hide();
          var slide_player_id = 'video-' + html_id;
          $video.prepend('<div class="video" id="'+slide_player_id+'" />');
          var player = new YT.Player(slide_player_id, {
            width: '640',
            height: '390',
            videoId: youtube_id,
            events: {
              'onReady': onPlayerReady
            }
          });
        }
      });
    }else if ($video.is('.node-full')){
      // --- full ---
      if (youtube_id !== false){
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

function placeMetadataInVideoContainer(data, $container){
  try {
    var snippet = data.items[0].snippet;
    var details = data.items[0].contentDetails;
    var statistics = data.items[0].statistics;
    $container.find('> .content h2').after('<aside class="info"></aside>');
    var $info = $container.find('aside.info');
    $container.find('> .content .summary').after('<aside class="features"></aside>');
    var $features = $container.find('aside.features');
  }catch(err){
    console.log(err);
  }

  // thumb
  try {
    var img_src = snippet.thumbnails.high.url;
    var $link = $container.find('> .image a');
    if ($link.find('img').length == 0){
      $link.append('<img src="'+img_src+'" />');
    }
  }catch(err){
    console.log(err);
  }

  /*if ($container.parents('.view-multimedia').length > 0){
    // duration
    try {
      var duration = getTimeString(details.duration);
      $container.find('> .image a').append('<span class="duration">'+duration+'</span>');
    }catch(err){
      console.log(err);
    }

    // time ago
    try {
      var date = Date.parse(snippet.publishedAt);
      var seconds = Math.round(date/1000);
      $info.append('<time data-livestamp="'+seconds+'" datetime="'+seconds+'">'+seconds+'</time>');
    }catch(err){
      console.log(err);
    }

    // view count
    try {
      var views_count = parseInt(statistics.viewCount).toLocaleString();
      $info.append('<span class="views-count">'+views_count+ ' ' + locale.VIDEO_VIEWS[config.LANGUAGE] + '</span>');
    }catch(err){
      console.log(err);
    }

    // HD available
    try {
      if (details.definition == 'hd'){
        $features.append('<span class="hd" title="' + locale.VIDEO_HD_AVAILABLE[config.LANGUAGE] + '">HD</span>');
      }
    }catch(err){
      console.log(err);
    }

    // CC available
    try {
      if (details.caption == 'true'){
        $features.append('<span class="cc" title="' + locale.VIDEO_CC_AVAILABLE[config.LANGUAGE] + '">CC</span>');
      }
    }catch(err){
      console.log(err);
    }
  }*/
}

// converts ISO 8601 duration format to a human readable string
function getTimeString(duration){
  var duration2 = moment.duration(duration);
  var time = {};
  time.hours = duration2.hours();
  time.minutes = duration2.minutes();
  time.seconds = duration2.seconds();
  var time_str = (time.hours != 0)? time.hours + ':' : '';
  time_str += pad(time.minutes, 2) + ':';
  time_str += pad(time.seconds, 2);
  return time_str;
}

function onPlayerReady(e) {
  e.target.playVideo();
}
