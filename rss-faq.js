jQuery(function($) {
	$('.rss-faq-title').click(function() {
		if($(this).parent('.rss-faq-item').hasClass('active')) {
			$(this).parent('.rss-faq-item').removeClass('active');
		} else {
			$('.rss-faq-item').removeClass('active');
			$(this).parent('.rss-faq-item').addClass('active');
		}
	});
});