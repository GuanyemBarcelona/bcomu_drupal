// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function f(){ log.history = log.history || []; log.history.push(arguments); if(this.console) { var args = arguments, newarr; args.callee = args.callee.caller; newarr = [].slice.call(args); if (typeof console.log === 'object') log.apply.call(console.log, console, newarr); else console.log.apply(console, newarr);}};

// make it safe to use console.log always
(function(a){function b(){}for(var c="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),d;!!(d=c.pop());){a[d]=a[d]||b;}})
(function(){try{console.log();return window.console;}catch(a){return (window.console={});}}());

/**
 * Helper methods
**/
// get number with 'size' leading zeros
function pad(num, size) {
  var s = num + '';
  while (s.length < size) s = '0' + s;
  return s;
}
 
//strips pixels from measure
function stripMagnitude(measure){
  var index = measure.indexOf('px');
  if (index != -1) return parseInt(measure.substring(0,index));
  return -1;
}

// get a value from an url get parameter
function getURLParameter(name, url) {
	//location.search
  return decodeURI(
    (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1]
  );
}

// easy debounce function
function debounce(fn, delay) {
  var timer = null;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function(){
      fn.apply(context, args);
    }, delay);
  };
}

(function($){
  /**
	 * Group some content into a Tabbed group
	 * @params
	 *   Object options: options for the instance
	 * @return void
	**/
	GrouppedTabs = function(options){
		this.selector = options.selector;
		this.$panes = null;
		this.block_name = options.block_name;
		this.active_tab = options.active_tab || 0;
	  this.$pane_items = $(this.selector);
	  this.$global_pane = this.$pane_items.closest('.async-container');
	  this.events = {};
	  this.$nav_list = null;
	  
	  var self = this;

	  this.init = function(events){
	  	this.events = events;
	  	if (this.$pane_items.length){
	  		this.prepareTabs();
	  		this.prepareNavigation();
	  		try {
	  			this.events.on_start();
	  		} catch(err) {}
	  	}
	  };
	  this.prepareTabs = function(){
	    this.$pane_items.wrapAll('<div id="'+this.block_name+'" class="block tabs"><div class="tab-panes"></div></div>');
	    this.$panes = this.$pane_items.parent();
	    this.$panes.parent().prepend('<div class="tab-nav"><ul></ul></div>');
	    this.$nav_list = this.$panes.parent().find('.tab-nav ul');
	    this.$pane_items.each(function(i){
	      var this_pane = $(this);
	      var id = this_pane.attr('data-id');
	      if (id == undefined) id = 'tab-' + (i+1);
	      this_pane.removeAttr('class');
	      var title = this_pane.find('> header');
	      title.hide();
	      self.$nav_list.append('<li data-tab-id="'+id+'"><a href="#">' + title.text() + '</a></li>');
	      if (i != self.active_tab) this_pane.hide();
	    });
	  };
	  this.prepareNavigation = function(){
	  	this.$nav_list.find('> li').each(function(j){
	      var this_nav_item = $(this);
	      if (j == self.active_tab) this_nav_item.addClass('active');
	      this_nav_item.find('> a').click(function(){
	      	if (self.$global_pane.length) self.$global_pane.attr('data-selected-tab', j);
	        self.$nav_list.attr('data-tab', (j+1));
	        self.$nav_list.find('> li').each(function(k){
	          if (j == k){
	            $(this).addClass('active');
	          }else{
	            $(this).removeClass('active');
	          }
	        });
	        self.$pane_items.each(function(k){
	          if (j == k){
	            $(this).show();
	          }else{
	            $(this).hide();
	          }
	        });
	        return false;
	      });
	    });
	  };
	}

})(jQuery);