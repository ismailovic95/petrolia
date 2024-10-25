// @codekit-prepend "swipebox/js/jquery.swipebox.js"
(function($){
	$.qtSwipeboxFunction = function(){
		$.qtSwipeboxEnable	= true; // this is for the main jquery file after ajax
		$('.swipebox, .gallery a, a[href*=".jpg"], a[href*="youtube.com/watch"]:not(.qw_social), a[href*="youtube.com"]:not(.qw_social), a[href*="youtu.be"]:not(.qw_social), a[href*="vimeo.com"]:not(.qw_social), a[href*="jpeg"], a[href*=".png"], a[href*=".gif"], .Collage a').swipebox({
	        beforeOpen: function() {
	            $.swipeboxState = 1;
	        } // called before opening
	    });
	}
	$(window).on('load',function(){
		$.qtSwipeboxFunction();
		return;
	});
})(jQuery);