(function ($) {
	"use strict";

	$(window).load(function () {
		thim_elearningwp.load();
	});

	$(document).ready(function () {
		thim_elearningwp.ready();
	});

	var thim_elearningwp = window.thim_elearningwp = {

		/**
		 * Call functions in window.load
		 */
		load: function () {
			/** WooCommerce **/
			this.woo_product_slider();

			/** LearnPress **/
			this.learnpress_course_slider();
			this.learnpress_course_media_slider();
		},

		/**
		 * Call functions in document.ready
		 */
		ready: function () {
			this.mobile_menu_toggle();
			this.footer_fixed();
			this.hidden_title();
			this.social_share();
			this.full_slider();
			this.gallery_posts();
			this.back_to_top();
			this.feature_preloading();
			this.widget_form_login();
			this.login_form();
			this.postformat_audio();
			this.postformat_gallery();
			this.sidebar_sticky();
			this.mobile_menu();
			this.waypoints_magic();
			this.parallax_effect();
			this.header_menu();
			this.header_overlay();
			this.round_slider();


			/******************* WOOCOMMERCE ******************/
			this.woo_switcher();
			this.woo_quickview();


			/******************* LEARNPRESS ******************/
			this.learnpress_profile_tab();
			this.learpress_reviews();
			this.learnpress_media_courses();
			this.learnpress_tab_filter();
			this.learnpress_set_wishlist();
		},

		/**
		 * Round slider for testimonials
		 */
		round_slider: function () {
			$('.thim-round-testimonial-slider').each(function () {
				var elem = $(this),
					item_visible = 3,
					autoplay = elem.data('autoplay') ? true : false,
					mousewheel = elem.data('mousewheel') ? true : false;

				var thim_round_slider = $(this).thimContentSlider({
					items            : elem,
					itemsVisible     : item_visible,
					mouseWheel       : mousewheel,
					autoPlay         : autoplay,
					itemMaxWidth     : 331,
					itemMinWidth     : 331,
					activeItemRatio  : 1,
					activeItemPadding: -85,
					itemPadding      : 0,
					imageSelector    : '.image',
					contentSelector  : '.content',
				});
			});
		},

		/**
		 * Header menu
		 */
		header_menu: function () {
			//Add class for masthead
			var $header = $('#masthead.sticky-header'),
				off_Top = ($('.content-pusher').length > 0) ? $('.content-pusher').offset().top : 0,
				menuH = $header.outerHeight(),
				latestScroll = 0;
			if ($(window).scrollTop() > 2) {
				$header.removeClass('affix-top').addClass('affix');
			}

			var $thimfixed = $('.thim-fixed');
			var thimfixedTop = ($thimfixed.length > 0) ? $thimfixed.offset().top : 0;
			if (thimfixedTop != 0) {
				$thimfixed.css('width', $thimfixed.width());
			}

			$(window).scroll(function () {

				var current = $(this).scrollTop();

				if (current > 2) {
					$header.removeClass('affix-top').addClass('affix');
					if ($header.hasClass('header_v2')) {
						$header.css({
							top: off_Top
						});
					}

					if (current > menuH + off_Top) {
						if ($header.hasClass('header_v2')) {
							var $header_inner = $('.inner-header-top'),
								header_inner_height = $header_inner.outerHeight();
							$header.css({
								top: off_Top - header_inner_height
							});
						}

					}

				} else {
					$header.removeClass('affix').addClass('affix-top').removeClass('menu-show');
				}

				if (current > latestScroll && current > menuH + off_Top) {
					if (!$header.hasClass('menu-hidden')) {
						$header.addClass('menu-hidden').removeClass('menu-show');
					}
				} else {
					if ($header.hasClass('menu-hidden')) {
						if ($header.hasClass('header_v2')) {
							var $header_inner = $('.inner-header-top'),
								header_inner_height = $header_inner.outerHeight();
							$header.css({
								top: off_Top - header_inner_height
							});
						}

						$header.removeClass('menu-hidden').addClass('menu-show');
					}
				}

				latestScroll = current;


			});
		},


		header_overlay: function () {
			var $header = $('#masthead.sticky-header.header_overlay');
			var $content_pusher = $('#wrapper-container .top_site_main');
			$header.imagesLoaded(function () {
				var height_sticky_header = $header.outerHeight(true);
				$content_pusher.css({"padding-top": height_sticky_header + 'px'})
				$(window).resize(function () {
					var height_sticky_header = $header.outerHeight(true);
					$content_pusher.css({"padding-top": height_sticky_header + 'px'})
				});
			});
		},

		/**
		 * Parallax effect.
		 */
		parallax_effect: function () {
			$('.parallax_effect').each(function () {
				var $bgobj = $(this); // assigning the object
				$(window).scroll(function () {
					var yPos = -($(window).scrollTop() / 4);
					var coords = '50%' + (yPos + 0) + 'px';
					$bgobj.css({backgroundPosition: coords});
				}); // window scroll Ends
			});
		},

		learnpress_tab_filter: function () {
			$('.filter_courses .filter li a').on('click', function (e) {
				e.preventDefault();

				var item = $(this);
				var url = item.parent().attr('rel');
				$.ajax({
					type      : 'POST',
					dataType  : 'html',
					url       : url,
					beforeSend: function () {
						$('.filter_courses .wrapper-item').addClass('loading');
						$('.filter_courses .filter li.active').removeClass('active');
						item.parent().addClass('active');
					},
					success   : function (html) {
						var archive_html = $(html).find('.site-content .archive-courses .content_archive').html();
						if (archive_html) {
							$('.filter_courses .wrapper-item').html(archive_html);
							$('.filter_courses .wrapper-item').removeClass('loading');
						}
					},
					error     : function () {
						$('.filter_courses .wrapper-item .loading').removeClass('loading');
					}
				});
			});
		},


		learnpress_course_media_slider: function () {
			$(".courses-media-slider").each(function () {
				var $this = jQuery(this);
				var column = $this.attr("data-column"),
					show_page_nav = $this.attr("data-show-page-nav"),
					show_nav = $this.attr("data-show-nav"),
					item_desktopsmall = $this.attr('data-desktopsmall') ? parseInt($this.attr('data-desktopsmall')) : column,
					itemsTablet = $this.attr('data-itemtablet') ? parseInt($this.attr('data-itemtablet')) : 1,
					itemsMobile_horizontal = $this.attr('data-itemmobile_horizontal') ? parseInt($this.attr('data-itemmobile_horizontal')) : 1,
					itemsMobile = $this.attr('data-itemmobile') ? parseInt($this.attr('data-itemmobile')) : 1;
				if (show_page_nav == 1) {
					show_page_nav = true;
				} else {
					show_page_nav = false;
				}
				if (show_nav == 1) {
					show_nav = true;
				} else {
					show_nav = false;
				}
				$this.owlCarousel({
					items       : 1,
					loop        : true,
					stagePadding: 95,
					dots        : show_page_nav,
					autoPlay    : false,
					nav         : show_nav,
					navText     : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
					responsive  : {
						0   : {
							items       : 1,
							stagePadding: 0,
						},
						450 : {
							items       : 1,
							stagePadding: 0,
						},
						650 : {
							items       : 1,
							stagePadding: 0,
						},
						980 : {
							items: 1
						},
						1024: {
							items: 1
						}
					}
				});
			});
		},

		learnpress_course_slider: function () {
			$(".courses-slider").each(function () {
				var $this = jQuery(this);
				var column = $this.attr("data-column"),
					show_page_nav = $this.attr("data-show-page-nav"),
					show_nav = $this.attr("data-show-nav"),
					item_desktopsmall = $this.attr('data-desktopsmall') ? parseInt($this.attr('data-desktopsmall')) : column,
					item_desktopsmall2 = $this.attr('data-desktopsmall') ? parseInt($this.attr('data-desktopsmall')) : column,
					itemsTablet = $this.attr('data-itemtablet') ? parseInt($this.attr('data-itemtablet')) : 2,
					itemsMobile_horizontal = $this.attr('data-itemmobile_horizontal') ? parseInt($this.attr('data-itemmobile_horizontal')) : 2,
					itemsMobile = $this.attr('data-itemmobile') ? parseInt($this.attr('data-itemmobile')) : 1;
				if (show_page_nav == 1) {
					show_page_nav = true;
				} else {
					show_page_nav = false;
				}
				if (show_nav == 1) {
					show_nav = true;
				} else {
					show_nav = false;
				}
				if ($(this).hasClass('post-carousel')) {
					item_desktopsmall = 4;
					item_desktopsmall2 = 3;
					itemsTablet = 1;
					itemsMobile_horizontal = 2;
					itemsMobile = 1;
				}
				$this.owlCarousel({
					items     : column,
					loop      : true,
					dots      : show_page_nav,
					autoPlay  : false,
					nav       : show_nav,
					navText   : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
					responsive: {
						0   : {
							items: 1
						},
						450 : {
							items: itemsMobile
						},
						650 : {
							items: itemsMobile_horizontal
						},
						980 : {
							items: itemsTablet
						},
						1024: {
							items: item_desktopsmall2
						},
						1450: {
							items: item_desktopsmall
						}
					}
				});
			});
		},

		learnpress_profile_tab: function () {
			if ($("body").hasClass("learnpress-v3")) {
				return;
			}
			$('.profile-tabs .nav-tabs li a').click(function (e) {
				e.preventDefault();

				$('.profile-tabs').find('.active').removeClass('active');
				$(this).parent().addClass('active');
				$('.profile-tabs .tab-content').find($(this).attr('href')).addClass('active');
			});
		},

		learnpress_media_courses: function () {
			$('.media-link').magnificPopup({
				type: 'iframe',
			});
			$('.media-iframe').magnificPopup({
				type    : 'inline',
				midClick: true
			});
		},

		learpress_reviews: function () {
			if (!$('.add-review').length) {
				return;
			}
			var $star = $('.add-review .filled');
			var $review = $('#review-course-value');
			$star.find('li').on('mouseover',
				function () {
					$(this).nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
					$(this).prevAll().find('span').removeClass('fa-star-o').addClass('fa-star');
					$(this).find('span').removeClass('fa-star-o').addClass('fa-star');
					$review.val($(this).index() + 1);
				}
			);

		},

		/**
		 * Waypoints magic
		 */
		waypoints_magic: function () {
			if (typeof $.fn.waypoint !== 'undefined') {
				$('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').waypoint(function () {
					$(this).addClass('wpb_start_animation');
				}, {offset: '85%'});
			}
		},

		/**
		 * Mobile menu arrow, show/hide
		 */
		mobile_menu: function () {
			if ($(window).width() <= 768) {
				$('.mobile-menu-container>ul>li.menu-item-has-children:not(.current-menu-parent)>a').after('<span class="icon-toggle"><i class="fa fa-angle-down"></i></span>');
				$('.mobile-menu-container>ul>li.menu-item-has-children.current-menu-parent >a').after('<span class="icon-toggle"><i class="fa fa-angle-up"></i></span>');
			}
			$('.mobile-menu-container>ul>li.menu-item-has-children .icon-toggle').on('click', function () {
				if ($(this).find('i').hasClass('fa-angle-down')) {
					$(this).next('.sub-menu').slideDown(500, 'linear');
					$(this).html('<i class="fa fa-angle-up"></i>');
				}
				else {
					$(this).next('.sub-menu').slideUp(500, 'linear');
					$(this).html('<i class="fa fa-angle-down"></i>');
				}
			});
		},

		/**
		 * Sticky sidebar
		 */
		sidebar_sticky: function () {
			if ($(window).width() > 769) {
				$(document).ready(function () {
					var offsetTop = 75;
					if ($("#wpadminbar").length) {
						offsetTop += $("#wpadminbar").outerHeight();
					}
					if ($("#masthead.sticky-header").length) {
						offsetTop += $("#masthead.sticky-header").outerHeight();
					}

					$(".sticky-sidebar").theiaStickySidebar({
						"containerSelector"     : "",
						"additionalMarginTop"   : offsetTop,
						"additionalMarginBottom": "0",
						"updateSidebarHeight"   : false,
						"minWidth"              : "768",
						"sidebarBehavior"       : "modern"
					});

					$("#sing-button-sidebar.sticky-sidebar").theiaStickySidebar({
						"containerSelector"     : "",
						"additionalMarginTop"   : offsetTop,
						"additionalMarginBottom": "0",
						"updateSidebarHeight"   : false,
						"minWidth"              : "768",
						"sidebarBehavior"       : "modern"
					});
				});
			}
		},

		/**
		 * Product slider
		 */
		woo_product_slider: function () {

			$('#carousel').flexslider({
				animation    : "slide",
				controlNav   : false,
				animationLoop: false,
				slideshow    : true,
				itemWidth    : 132,
				itemMargin   : 5,
				maxItems     : 3,
				directionNav : true,
				asNavFor     : '#slider'
			});

			$('#slider').flexslider({
				animation    : "slide",
				controlNav   : false,
				animationLoop: false,
				directionNav : false,
				slideshow    : false,
				sync         : "#carousel"
			});
		},

		/**
		 * Woo Quickview product
		 */
		woo_quickview: function () {
			$('.quick-view').click(function (e) {
				e.preventDefault();

				$(this).find("i").before('<div class="loading dark"></div>');
				$(this).find("i").css('display', 'none');
				var product_id = $(this).attr('data-prod');
				var data = {action: 'jck_quickview', product: product_id};
				$.post(ajaxurl, data, function (response) {
					$.magnificPopup.open({
						mainClass: 'my-mfp-zoom-in',
						items    : {
							src : '<div class="product-lightbox">' + response + '</div>',
							type: 'inline'
						}
					});
					$('.loading').remove();
					$(this).find("i").css('display', 'inline-block');
					setTimeout(function () {
						if (typeof wc_add_to_cart_variation_params !== 'undefined') {
							$('.product-info .variations_form').each(function () {
								$(this).wc_variation_form().find('.variations select:eq(0)').change();
							});
						}
					}, 600);
				});
			});
		},

		/**
		 * WooCommerce switcher
		 */
		woo_switcher: function () {
			var cookie_name = $('.grid-list-switch').data('cookie');

			if (cookie_name == 'product-switch') {
				var gridClass = 'products-grid',
					listClass = 'products-list';
			} else if (cookie_name == 'lpr_course-switch') {
				var gridClass = 'course-grid',
					listClass = 'course-list';
			} else {
				var gridClass = 'blog-grid',
					listClass = 'blog-list';
			}

			var activeClass = 'switcher-active';

			$('.switchToList').click(function () {
				if (!Cookies.get('name') || Cookies.get('name') === 'grid') {
					thim_elearningwp.woo_switchToList(activeClass, gridClass, listClass, cookie_name);
				}
			});
			$('.switchToGrid').click(function () {
				if (!Cookies.get('name') || Cookies.get('name') === 'grid') {
					thim_elearningwp.woo_switchToGrid(activeClass, gridClass, listClass, cookie_name);
				}
			});
			thim_elearningwp.woo_check_view_mod(activeClass, gridClass, listClass, cookie_name);

		},

		/**
		 *
		 * @param activeClass
		 * @param gridClass
		 * @param listClass
		 * @param cookie_name
		 */
		woo_switchToList: function (activeClass, gridClass, listClass, cookie_name) {
			$('.switchToList').addClass(activeClass);
			$('.switchToGrid').removeClass(activeClass);
			$('.archive_switch').fadeOut(300, function () {
				$(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
				Cookies.set(cookie_name, 'list', {expires: 1, path: ''});
			});
		},

		/**
		 *
		 * @param activeClass
		 * @param gridClass
		 * @param listClass
		 * @param cookie_name
		 */
		woo_switchToGrid: function (activeClass, gridClass, listClass, cookie_name) {
			$('.switchToGrid').addClass(activeClass);
			$('.switchToList').removeClass(activeClass);
			$('.archive_switch').fadeOut(300, function () {
				$(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
				Cookies.set(cookie_name, 'grid', {expires: 1, path: ''});
			});
		},

		/**
		 *
		 * @param activeClass
		 * @param gridClass
		 * @param listClass
		 * @param cookie_name
		 */
		woo_check_view_mod: function (activeClass, gridClass, listClass, cookie_name) {
			if (Cookies.get(cookie_name) == 'grid') {
				$('.archive_switch').removeClass(listClass).addClass(gridClass);
				$('.switchToGrid').addClass(activeClass);
				$('.switchToList').removeClass(activeClass);
			} else if (Cookies.get(cookie_name) == 'list') {
				$('.archive_switch').removeClass(gridClass).addClass(listClass);
				$('.switchToList').addClass(activeClass);
				$('.switchToGrid').removeClass(activeClass);
			}
			else {
				$('.switchToList').addClass(activeClass);
				$('.switchToGrid').removeClass(activeClass);
				$('.archive_switch').removeClass(gridClass).addClass(listClass);
			}
		},


		/**
		 * Postformat Gallery
		 */
		postformat_gallery: function () {
			if ($('article.format-gallery .flexslider').length > 0) {
				$('article.format-gallery .flexslider').imagesLoaded(function () {
					$('.flexslider').flexslider({
						slideshow     : false,
						animation     : 'fade',
						pauseOnHover  : true,
						animationSpeed: 400,
						smoothHeight  : true,
						directionNav  : true,
						controlNav    : false
					});
				});
			}
		},

		/**
		 * Post format: audio
		 */
		postformat_audio: function () {
			$('.jp-jplayer').each(function () {
				var $this = $(this),
					url = $this.data('audio'),
					type = url.substr(url.lastIndexOf('.') + 1),
					player = '#' + $this.data('player'),
					audio = {};
				audio[type] = url;

				$this.jPlayer({
					ready              : function () {
						$this.jPlayer('setMedia', audio);
					},
					swfPath            : 'jplayer/',
					cssSelectorAncestor: player
				});
			});
		},

		/**
		 * Open login-popup if not logged in.
		 */
		widget_form_login: function () {
			$(document).on('click', 'body:not(".logged-in") .purchase-course .purchase-button', function (e) {
				if ($(window).width() > 769) {
					if ($('.thim-widget-form-login .thim-link-login a').length > 0) {
						e.preventDefault();
						$('.thim-widget-form-login .thim-link-login a').trigger('click');
					}
				}
			});

		},

		/**
		 * Preloading
		 */
		feature_preloading: function () {
			var $preload = $('#thim-preloading');
			if ($preload.length > 0) {
				$preload.fadeOut(1000, function () {
					$preload.remove();
				});
			}
		},

		//Back To top
		back_to_top: function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('#back-to-top').css({bottom: "15px"});
				} else {
					$('#back-to-top').css({bottom: "-100px"});
				}
			});
			$('#back-to-top').click(function () {
				$('html, body').animate({scrollTop: '0px'}, 800);
				return false;
			});
		},

		/**
		 * Open/close mobile menu
		 */
		mobile_menu_toggle: function () {
			$('.menu-mobile-effect').on('click touchstart', function (ev) {
				$('#wrapper-container').addClass('mobile-menu-open');
				return false;
			});

			$('.overlay-menu').on('click touchstart', function (ev) {
				$('#wrapper-container').removeClass('mobile-menu-open');
				return false;
			});
		},

		footer_fixed: function () {
			var footer_h = $('.copyright-bottom').outerHeight();

			$('.copyright-area').css({
				'margin-bottom': footer_h
			})

		},

		/**
		 * hidden page title
		 */
		hidden_title: function () {
			var $title = $('.page-title');
			var $header_menu = $('#masthead');
			if ($title.length <= 0 && $("body").hasClass("home")) {
				if ($header_menu.hasClass('header_overlay') || $header_menu.hasClass('sticky-header')) {
					$('body').addClass('hidden-page-title');

					$('.content-pusher').css({
						'padding-top': $header_menu.outerHeight()
					});
				}
			}
		},

		social_share: function () {
			var $shares = $('.thim-post-social-share');

			$shares.on('click', 'a', function (event) {
				event.preventDefault();
				var shareurl = $(this).attr('href');
				var top = (screen.availHeight - 500) / 2;
				var left = (screen.availWidth - 500) / 2;
				var popup = window.open(shareurl, 'social sharing', 'width=650,height=520,left=' + left + ',top=' + top + ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');
				return false;
			});
		},

		full_slider: function () {
			if ($('body').hasClass('home')) {
				var $header = $('#masthead.site-header'),
					off_Top = ($('.content-pusher').length > 0) ? $('.content-pusher').offset().top : 0,
					windowH = $(window).outerHeight();

				var fullH;
				var $img_size = $('.ob-slider-wrapper img').prop('naturalHeight');
				var windowsize = $(window).width();

				if (windowsize > 480) {
					fullH = $(window).outerHeight() - off_Top;
					$('.home4-slider .ob-slider-base').css('height', $img_size);
				} else {
					fullH = screen.height - off_Top;
				}

				$('.full-height').css('height', fullH);

				var timer = false;
				$(window).resize(function () {
					if (timer) clearTimeout(timer);
					timer = setTimeout(function () {
						thim_elearningwp.full_slider();
					}, 300);
				});
			}
		},

		gallery_posts: function () {
			$(window).load(function () {
				if ($('.thim-widget-gallery-posts .wrapper-gallery-filter').length > 0) {
					$('.thim-widget-gallery-posts .wrapper-gallery-filter').isotope({filter: '*'});
				}
			});

			$(document).on('click', '.filter-controls .filter', function (e) {
				e.preventDefault();
				var filter = $(this).data('filter'),
					filter_wraper = $(this).parents('.thim-widget-gallery-posts').find('.wrapper-gallery-filter');
				$('.filter-controls .filter').removeClass('active');
				$(this).addClass('active');
				filter_wraper.isotope({filter: filter});
			});

			$(document).on('click', '.thim-gallery-popup', function (e) {
				e.preventDefault();
				var elem = $(this),
					post_id = elem.attr('data-id'),
					data = {action: 'thim_gallery_popup', post_id: post_id};
				elem.addClass('loading');
				$.post(ajaxurl, data, function (response) {
					elem.removeClass('loading');
					$('.thim-gallery-show').append(response);

					if ($('.thim-gallery-show img').length > 0) {
						$('.thim-gallery-show').magnificPopup({
							mainClass   : 'my-mfp-zoom-in',
							type        : 'image',
							delegate    : 'a',
							showCloseBtn: false,
							gallery     : {
								enabled: true
							},
							callbacks   : {
								open: function () {
									$('body').addClass('thim-popup-active');
									$.magnificPopup.instance.close = function () {
										$('.thim-gallery-show').empty();
										$('body').removeClass('thim-popup-active');
										$.magnificPopup.proto.close.call(this);
									};
								},
							}
						}).magnificPopup('open');
					} else {
						$.magnificPopup.open({
							mainClass   : 'my-mfp-zoom-in',
							items       : {
								src : $('.thim-gallery-show'),
								type: 'inline'
							},
							showCloseBtn: false,
							callbacks   : {
								open: function () {
									$('body').addClass('thim-popup-active');
									$.magnificPopup.instance.close = function () {
										$('.thim-gallery-show').empty();
										$('body').removeClass('thim-popup-active');
										$.magnificPopup.proto.close.call(this);
									};
								},
							}
						});
					}

				});

			});
		},

		login_form: function () {
			/*Validate register form*/
			//Register form untispam
			$('.thim-login form#registerform').submit(function (event) {
				var elem = $(this),
					input_username = elem.find('#user_login'),
					input_email = elem.find('#user_email'),
					input_captcha = $('.thim-login-captcha .captcha-result'),
					input_pass = elem.find('#password'),
					input_rppass = elem.find('#repeat_password');

				var email_valid = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;

				if ($('#registerform #check_spam_register').val() != '') {
					event.preventDefault();
				}

				if (input_captcha.length > 0) {
					var captcha_1 = parseInt(input_captcha.data('captcha1')),
						captcha_2 = parseInt(input_captcha.data('captcha2'));

					if (captcha_1 + captcha_2 != parseInt(input_captcha.val())) {
						input_captcha.addClass('invalid').val('');
						event.preventDefault();
					}
				}

				if (input_username.length > 0 && input_username.val() == '') {
					input_username.addClass('invalid');
					event.preventDefault();
				}

				if (input_email.length > 0 && (input_email.val() == '' || !email_valid.test(input_email.val()))) {
					input_email.addClass('invalid');
					event.preventDefault();
				}

				if (input_pass.val() !== input_rppass.val() || input_pass.val() == '') {
					input_pass.addClass('invalid');
					input_rppass.addClass('invalid');
					event.preventDefault();
				}
			});

			//Validate login submit
			$('.thim-login form#loginform').submit(function (event) {
				var elem = $(this),
					input_username = elem.find('#thim_login'),
					input_captcha = $('.thim-login-captcha .captcha-result'),
					input_pass = elem.find('#thim_pass');

				if (input_username.length > 0 && input_username.val() == '') {
					input_username.addClass('invalid');
					event.preventDefault();
				}

				if (input_pass.length > 0 && input_pass.val() == '') {
					input_pass.addClass('invalid');
					event.preventDefault();
				}

				if (input_captcha.length > 0) {
					var captcha_1 = parseInt(input_captcha.data('captcha1')),
						captcha_2 = parseInt(input_captcha.data('captcha2'));

					if (captcha_1 + captcha_2 != parseInt(input_captcha.val())) {
						input_captcha.addClass('invalid').val('');
						event.preventDefault();
					}
				}
			});

			//Validate lostpassword submit
			$('.thim-login form#lostpasswordform').submit(function (event) {
				var elem = $(this),
					input_username = elem.find('#user_login');

				if (input_username.length > 0 && input_username.val() == '') {
					input_username.addClass('invalid');
					event.preventDefault();
				}
			});


			$('.thim-login .captcha-result, .thim-login #repeat_password, .thim-login #password, .thim-login #user_email, .thim-login #user_login').on('focus', function () {
				$(this).removeClass('invalid');
			});

			$('.thim-login #thim_login, .thim-login #thim_pass').on('focus', function () {
				$(this).removeClass('invalid');
			});
		},

		learnpress_set_wishlist: function () {
			$(".course-wishlist-box [class*='course-wishlist']").on('click', function (event) {
				event.preventDefault();
				var $this = $(this);
				if ($this.hasClass('loading')) return;
				$this.addClass('loading');
				$this.toggleClass('course-wishlist');
				$this.toggleClass('course-wishlisted');
				if ($this.hasClass('course-wishlisted')) {
					$.ajax({
						type    : "POST",
						url     : window.location.href,
						dataType: 'html',
						data    : {
							//action   : 'learn_press_toggle_course_wishlist',
							'lp-ajax': 'toggle_course_wishlist',
							course_id: $this.data('id'),
							nonce    : $this.data('nonce')
						},
						success : function () {
							$this.removeClass('loading')
						},
						error   : function () {
							$this.removeClass('loading')
						}
					});
				}
				if ($this.hasClass('course-wishlist')) {
					$.ajax({
						type    : "POST",
						url     : window.location.href,
						dataType: 'html',
						data    : {
							//action   : 'learn_press_toggle_course_wishlist',
							'lp-ajax': 'toggle_course_wishlist',
							course_id: $this.data('id'),
							nonce    : $this.data('nonce')
						},
						success : function () {
							$this.removeClass('loading')
						},
						error   : function () {
							$this.removeClass('loading')
						}
					});
				}
			});
		},
	};

})(jQuery);