var primaries_locale = {
  
}
var primaries_config = {
  
};

(function($){
  // ON READY
  $(window).ready(function(){
  	var $page_results = $('.primaries-resultats');

  	// council
    if ($page_results.attr('data-voting-type') == 'council'){
    	// map or list
    	var $results_panel = $page_results.find('[data-results-type]');
    	$results_panel.each(function(i){
    		if ($(this).attr('data-results-type') != 'map'){
    			$(this).hide();
    		}
    		$(this).find('> button.toggle-view').click(function(e){
    			$results_panel.slideToggle(300);
    		});
    	});
    }
  });

})(jQuery);