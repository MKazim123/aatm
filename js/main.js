jQuery(document).ready(function($){
	
	function setCookie(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		let expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	function getCookie(cname) {
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for(let i = 0; i <ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	if (!getCookie('popup')){
		$('.modal-sweep').fadeIn();
		setCookie('popup','set', 7);
	}


	function setSizes(){

		$(".match").matchHeight();
		$(".match2").matchHeight();
		$(".sweepstakes_form .gfield_label").matchHeight();

		if ($(window).width() <= 640)
			$placeholder = 'Email address';
		else
			$placeholder = 'Enter your email address';

		$('.ginput_container_email input').prop('placeholder', $placeholder);
		$('.sweepstakes_form .ginput_container_email input').prop('placeholder', '');

		if ($(window).width() <= 1366)
			$('#menu').height($(window).innerHeight() - 364);
		else
			$('#menu').height('auto');

		$('.read-next .post-wrap .img,	.post-wrap .img').each(function (){
			$(this).height($(this).width() * 0.675);
		});
	}
	
	//$('select.nice').niceSelect();
	$('select').niceSelect();
	
	$('#menu-main-menu').addClass('container-sm');

	$('.mega-menu-item').each(function() {
		$($(this).data('menu')).append($(this).html());
	});
	$('ol li > *').each(function() {
		$(this).parent().addClass('l');
		
	});
	$('.txt.post-content img').each(function() {
		$(this).parent().addClass('img-wrap');
		
	});
	$('#menu-main-menu .sub-menu').wrapInner('<li><ul class="flex"></ul></li>');
	$('.mega-menu').each(function() {
		$($(this).data('menu')).append($(this).html());
	});	

	$('.menu-offers').append($('.mega-menu-offers').html());

	$("#menu-main-menu > li:not(.single)").append('<span class="toggle-sub-menu tr"><i class="fas fa-caret-down tr"></i></span>');

	$(document).on('click', '.toggle-sub-menu', function() {
		if (!$(this).parent().hasClass('hover')) 
			$("#menu-main-menu > li").removeClass('hover');
		$(this).parent().toggleClass('hover');
		$('#menu').scrollTop(0);
	})
	$(document).on('click', '.menu-back', function() {
		$("#menu-main-menu > li").removeClass('hover');
	});

	$("#menu-main-menu > li > a").mouseenter(function() {
		if (!$(this).parent().hasClass('hover')) 
			$("#menu-main-menu > li").removeClass('hover');
		$(this).parent().addClass('hover');
	});

	$("#menu-main-menu").mouseleave(function() {
		$("#menu-main-menu > li").removeClass('hover');
	});
	$(".toggle-filter").click(function() {
		$(this).toggleClass('swap');
		$("#offer_form").stop(true, false).slideToggle();
	});
	/*
	$('#menu-main-menu > li > a').click(function(e){
		e.preventDefault();
	});
	*/
	
	$left = '<svg xmlns="http://www.w3.org/2000/svg" width="18.298" height="32" viewBox="0 0 18.298 32"><path id="Path_260" data-name="Path 260" d="M2.84,146.007l1.431,1.431a.867.867,0,0,0,1.226,0L18.586,134.38l13.089,13.058a.867.867,0,0,0,1.226,0l1.431-1.431a.867.867,0,0,0,0-1.226L19.2,129.647a.867.867,0,0,0-1.226,0L2.84,144.78A.867.867,0,0,0,2.84,146.007Z" transform="translate(-129.393 34.586) rotate(-90)" fill="#f084f4"/></svg>';
	$right = '<svg xmlns="http://www.w3.org/2000/svg" width="18.298" height="32" viewBox="0 0 18.298 32"><path id="Path_261" data-name="Path 261" d="M2.84,146.007l1.431,1.431a.867.867,0,0,0,1.226,0L18.586,134.38l13.089,13.058a.867.867,0,0,0,1.226,0l1.431-1.431a.867.867,0,0,0,0-1.226L19.2,129.647a.867.867,0,0,0-1.226,0L2.84,144.78A.867.867,0,0,0,2.84,146.007Z" transform="translate(147.691 -2.586) rotate(90)" fill="#f084f4"/></svg>';

	setSizes();
	
	$(document).on('click', '.toggle-search', function() {
		$(this).toggleClass('open');
		
		if ($(this).hasClass('open'))
			$('#header #s').focus();
	});

	//$('.posts-carousel')

	$('.posts-carousel').each(function() {
		$loop = ($(this).data('pages') == 1) ? false : true;

		$(this).owlCarousel({
			smartSpeed: 1000,
			loop: $loop,
			mouseDrag: $loop,
			touchDrag: $loop,
			pullDrag: $loop,
			margin: 0,
			nav: false,
			dots: true,
			items: 1
		});
	});

	var owl;

	$('.offers-carousel').each(function () {

		$pages = parseInt($(this).data('pages'));
		$loop5 = ($pages >= 5) ? true : false;
		$loop4 = ($pages >= 4) ? true : false;
		$loop3 = ($pages >= 3) ? true : false;
		$loop2 = ($pages >= 2) ? true : false;
		$loop1 = ($pages > 1) ? true : false;
		
		owl = $(this);
			owl.on('initialized.owl.carousel', function(event) {
			$(".match").matchHeight();
		});

		owl.owlCarousel({
			smartSpeed: 750,
			margin: 0,
			nav: true,
			dots: false,
			navText: [$left,$right],
			responsive: {
				0: {
					autoWidth: true,
					nav: false,
					loop: $loop1
				},
				641: {
					autoWidth: false,
					items: 2,
					slideBy: 2,
					nav: true,
					loop: $loop2
				},
				992: {
					autoWidth: false,
					items: 3,
					slideBy: 3,
					nav: true,
					loop: $loop3
				},
				1200: {
					autoWidth: false,
					items: 4,
					slideBy: 4,
					nav: true,
					loop: $loop4
				},
				1361: {
					autoWidth: false,
					items: 5,
					slideBy: 5,
					nav: true,
					loop: $loop5
				}
			}
		});

	});

	$('.ig-mod #sbi_images').owlCarousel({
		smartSpeed: 750,
		margin: 0,
		nav: true,
		dots: false,
		navText: [$left,$right],
		loop: false,
		responsive: {
			0: {
				autoWidth: true,
				nav: false
			},
			641: {
				autoWidth: false,
				items: 2,
				slideBy: 2,
				nav: true
			},
			992: {
				autoWidth: false,
				items: 3,
				slideBy: 3,
				nav: true
			},
			1200: {
				autoWidth: false,
				items: 4,
				slideBy: 4,
				nav: true
			},
			1361: {
				autoWidth: false,
				items: 5,
				slideBy: 5,
				nav: true
			}
		}
	});

	$('.ig-post #sbi_images').owlCarousel({
		smartSpeed: 750,
		margin: 0,
		nav: true,
		dots: false,
		navText: [$left,$right],
		loop: false,
		responsive: {
			0: {
				autoWidth: true,
				nav: false
			},
			641: {
				autoWidth: false,
				items: 2,
				slideBy: 2,
				nav: true
			},
			992: {
				autoWidth: false,
				items: 3,
				slideBy: 3,
				nav: true
			},
			1200: {
				autoWidth: false,
				items: 4,
				slideBy: 4,
				nav: true
			}
		}
	});
	
	
	$('.txt iframe').each(function() {
		$(this).parent().addClass('iframe-wrapper');
	});	
	$('p.iframe-wrapper').each(function() {
		$(this).wrap('<div class="iframe-parent"></div>');
	});

	$('.logos-carousel').owlCarousel({
		smartSpeed: 750,
		loop: true,
		margin: 0,
		nav: true,
		dots: false,		
		navText: [$left,$right],
		responsive: {
			0: {
				items: 2,
				slideBy: 2,
			},
			641: {
				items: 3,
				slideBy: 3,
			},
			1201: {
				items: 4,
				slideBy: 4,
			},
			1361: {
				items: 5,
				slideBy: 5,
			}
		}
	});
	
	$('.img-carousel').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: false,
		fade: true,
		swipe: false,
		draggable: false,
		asNavFor: '.thumbs-carousel'
	});	
	
	$('.thumbs-carousel').slick({
		infinite: true,
		arrows: true,
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '.img-carousel',
		vertical: true,
		focusOnSelect: true,
		verticalSwiping: true,
		responsive: [

		{
			breakpoint: 993,
			settings: {		
				vertical: false,
				verticalSwiping: false,
				slidesToShow: 5,
			}
		}
		]
	});

	$("#offer_form h3").click(function (){

		$(this).next().stop(true, false).slideToggle();
		$(this).parent().toggleClass('swap');
	});

	$("#offer_form input:checked").parent().parent().removeClass('swap');

	$(".toggle-menu").click(function (){

		$('body').toggleClass('menu-opened');
		$('#header > section').stop(true, false).slideToggle();
	});
	
	/*
	$(document).on("click", ".toggle-sub-menu", function(e){

		if ($(window).width() >= 992 && ($(window).width() < 1100)){
			e.preventDefault();
			$subMenu = $(this).parent().next();
			$(this).parent().toggleClass("hov");
			$(this).toggleClass("show");
			//$(".sub-menu").removeClass("show");
			$subMenu.toggleClass("show");
			//$subMenu.stop(true, false).slideToggle();
		}

		if ($(window).width() < 992){
			e.preventDefault();
			$(this).toggleClass("show");
			$subMenu = $(this).parent().next();
			$subMenu.stop(true, false).slideToggle();
		}
	});
	
	$(document).on("click", ".toggle-menu", function(){
		$(this).toggleClass("toggle");
		$("body").toggleClass("menu-opened");
		$("#menu, #header .container:not(.flex-center)").stop(true, false).slideToggle();
	});
	*/

	$(document).on('click', '.modal-close, .modal > .overlay', function() {
		$('.modal').fadeOut();
	});

	$(document).on('click', '.modal-show', function() {
		$($(this).data('modal')).fadeIn();
	});

	$('body').css('opacity', 1);

	$(window).load(function() {
		
	});

	$(window).scroll(function() {
		 
		/*
		if ($("#header").offset().top > 0)
			$("body").addClass("sticky");
		else
			$("body").removeClass("sticky");
		*/

		//console.log()
	});

	$(window).resize(function() {
		setSizes();
	});
	
	/*
	var anchor = window.location.hash;
	
	if (anchor) {
		window.location.hash = "";
		var $header = $("#header .flex-center").innerHeight();
		setTimeout(function () {
			window.scrollTo(0, 0);
		}, 0);

		//console.log($(anchor).css("padding-top"))
		setTimeout(function(){
			$("html, body").animate({ scrollTop: $(anchor).offset().top - $header }, 2500);
			//anchorMagic(anchor);
		}, 150);
	}
	*/

});