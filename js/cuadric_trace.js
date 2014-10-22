
(function($){

	$(document).ready(function (){

		/*
		$('.cony_bullet').hover(
				function () { // mouseenter
					$(this).find('ul')
						.stop()
						.show('fast');
				},
				function () { // mouseleave
					$(this).find('ul')
						.stop()
						.hide('fast');
				}
		);
		*/

		$('.debug_trace .expand_btn').on('click', function(event) {
			//event.preventDefault();
			$(this).parents('.debug_trace').toggleClass('expanded');
			$(this).toggleClass('active');
		});
		$('.debug_trace .colapse_btn').on('click', function(event) {
			//event.preventDefault();
			$(this).parents('.debug_trace').toggleClass('colapsed');
			$(this).toggleClass('active');
		});

	});
	
})(window.jQuery);