var programa_locale = {
  
}
var programa_config = {
  
};

(function($){
  // ON READY
  $(window).ready(function(){
    // open measure detail as overlay
    $('.view-measures-list-city, .view-measures-list-district, .view-mesures-cercador').find('.views-field-title-field a').each(function(i){
      var href = $(this).attr('href');
      $(this).attr('href', href + '?oasis=1');
      $(this).fancybox(
        {
          'type': 'iframe',
          'width': 800,
          'height': 600
        }
      );
    });

    // sidebar menu icons
    var $sidebar_menu = $('.region-sidebar-first ul.menu');
    if ($sidebar_menu.length){
      $sidebar_menu.find('li.mid-966 > a').prepend('<i class="fa fa-star-o"></i>');
      $sidebar_menu.find('li.mid-967 > a').prepend('<i class="fa fa-cogs"></i>');
      $sidebar_menu.find('li.mid-968 > a').prepend('<i class="fa fa-map-marker"></i>');
      $sidebar_menu.find('li.mid-969 > a').prepend('<i class="fa fa-tag"></i>');
      $sidebar_menu.find('li.mid-970 > a').prepend('<i class="fa fa-search"></i>');
    }
    // programa navega menu icons
    var $navega_page_menu = $('article#node-369 .body > ul');
    if ($navega_page_menu){
      $navega_page_menu.find('li').eq(0).find('> a').prepend('<i class="fa fa-cogs"></i>');
      $navega_page_menu.find('li').eq(1).find('> a').prepend('<i class="fa fa-map-marker"></i>');
      $navega_page_menu.find('li').eq(2).find('> a').prepend('<i class="fa fa-tag"></i>');
    }
  });

})(jQuery);