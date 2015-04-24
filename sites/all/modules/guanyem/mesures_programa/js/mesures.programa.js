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
  });

})(jQuery);