var programa_locale = {
  
}
var programa_config = {
  
};

(function($){
  // ON READY
  $(window).ready(function(){
    // open measure detail as overlay
    $('.view-measures-list-city, .view-measures-list-district').find('.views-field-title a').each(function(i){
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
    var $menu = $('#block-menu_block-3 .menu-block-wrapper > ul.menu');
    if ($menu.length){
      $menu.find('li.mid-956 > a').prepend('<i class="fa fa-star-o"></i>');
      $menu.find('li.mid-957 > a').prepend('<i class="fa fa-cogs"></i>');
      $menu.find('li.mid-958 > a').prepend('<i class="fa fa-map-marker"></i>');
      $menu.find('li.mid-959 > a').prepend('<i class="fa fa-tag"></i>');
      $menu.find('li.mid-961 > a').prepend('<i class="fa fa-search"></i>');
    }
  });

})(jQuery);