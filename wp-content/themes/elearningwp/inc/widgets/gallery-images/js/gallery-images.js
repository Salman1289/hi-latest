(function ($) {
	"use strict";
	$(document).ready(function () {
		$(".thim-gallery-images-slider").each(function () {
			var $this = jQuery(this);
			var $item = $this.attr("data-column-slider");
			$this.owlCarousel({
				autoPlay      : 3000,
				loop          : true,
				autoHeight    : false,
				stopOnHover   : true,
				items         : $item,
				navigation    : true,
				navigationText: ["<i class=\'fa fa-chevron-left\'></i>", "<i class=\'fa fa-chevron-right\'></i>"]
				, pagination  : false
			});
		});
		$('.image-popup').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			},
		});
	});
})(jQuery);
