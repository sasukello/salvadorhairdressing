;(function () {
	
	'use strict';

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var mobileMenuOutsideClick = function() {

		$(document).click(function (e) {
	    var container = $("#fh5co-offcanvas, .js-fh5co-nav-toggle");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {

	    	if ( $('body').hasClass('offcanvas') ) {

    			$('body').removeClass('offcanvas');
    			$('.js-fh5co-nav-toggle').removeClass('active');
				
	    	}
	    
	    	
	    }
		});

	};


	var offcanvasMenu = function() {

		$('#page').prepend('<div id="fh5co-offcanvas" />');
		$('#page').prepend('<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle fh5co-nav-white"><i></i></a>');
		var clone1 = $('.menu-1 > ul').clone();
		$('#fh5co-offcanvas').append(clone1);
		var clone2 = $('.menu-2 > ul').clone();
		$('#fh5co-offcanvas').append(clone2);

		$('#fh5co-offcanvas .has-dropdown').addClass('offcanvas-has-dropdown');
		$('#fh5co-offcanvas')
			.find('li')
			.removeClass('has-dropdown');

		// Hover dropdown menu on mobile
		$('.offcanvas-has-dropdown').mouseenter(function(){
			var $this = $(this);

			$this
				.addClass('active')
				.find('ul')
				.slideDown(500, 'easeOutExpo');				
		}).mouseleave(function(){

			var $this = $(this);
			$this
				.removeClass('active')
				.find('ul')
				.slideUp(500, 'easeOutExpo');				
		});


		$(window).resize(function(){

			if ( $('body').hasClass('offcanvas') ) {

    			$('body').removeClass('offcanvas');
    			$('.js-fh5co-nav-toggle').removeClass('active');
				
	    	}
		});
	};


	var burgerMenu = function() {

		$('body').on('click', '.js-fh5co-nav-toggle', function(event){
			var $this = $(this);


			if ( $('body').hasClass('overflow offcanvas') ) {
				$('body').removeClass('overflow offcanvas');
			} else {
				$('body').addClass('overflow offcanvas');
			}
			$this.toggleClass('active');
			event.preventDefault();

		});
	};

	var fullHeight = function() {

		if ( !isMobile.any() ) {
			$('.js-fullheight').css('height', $(window).height());
			$(window).resize(function(){
				$('.js-fullheight').css('height', $(window).height());
			});
		}

	};



	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated-fast') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn animated-fast');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft animated-fast');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight animated-fast');
							} else {
								el.addClass('fadeInUp animated-fast');
							}

							el.removeClass('item-animate');
						},  k * 200, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '85%' } );
	};


	var dropdown = function() {

		$('.has-dropdown').mouseenter(function(){

			var $this = $(this);
			$this
				.find('.dropdown')
				.css('display', 'block')
				.addClass('animated-fast fadeInUpMenu');

		}).mouseleave(function(){
			var $this = $(this);

			$this
				.find('.dropdown')
				.css('display', 'none')
				.removeClass('animated-fast fadeInUpMenu');
		});

	};


	var goToTop = function() {

		$('.js-gotop').on('click', function(event){
			
			event.preventDefault();

			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});

		$(window).scroll(function(){

			var $win = $(window);
			if ($win.scrollTop() > 200) {
				$('.js-top').addClass('active');
			} else {
				$('.js-top').removeClass('active');
			}

			if ( $win.scrollTop() > 100 ) {
				$('.fh5co-nav').addClass('scrolled');
			} else {
				$('.fh5co-nav').removeClass('scrolled');
			}

		});
	
	};


	// Loading page
	var loaderPage = function() {
		$(".fh5co-loader").fadeOut("slow");
	};


	var counterWayPoint = function() {
		if ($('#fh5co-counter').length > 0 ) {
			$('#fh5co-counter').waypoint( function( direction ) {
										
				if( direction === 'down' && !$(this.element).hasClass('animated') ) {
					setTimeout( counter , 400);					
					$(this.element).addClass('animated');
				}
			} , { offset: '90%' } );
		}
	};

	var sliderMain = function() {
		
	  	$('#fh5co-slider-wrwap .flexslider').flexslider({
			animation: "fade",
			slideshowSpeed: 5000,
			directionNav: true,
			start: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			},
			before: function(){
				setTimeout(function(){
					$('.slider-text').removeClass('animated fadeInUp');
					$('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
				}, 500);
			}

	  	});

	  	$('#fh5co-slider-wrwap .flexslider .slides > li').css('height', $(window).height());	
	  	$(window).resize(function(){
	  		$('#fh5co-slider-wrwap .flexslider .slides > li').css('height', $(window).height());	
	  	});

	  	
	};

	var parallax = function() {
		if ( !isMobile.any() ) {
			$(window).stellar();
		}
	};

	var DateTimePickerFunc = function() {
		if ($('#taskdatetime').length > 0) {
			$('#taskdatetime').datetimepicker();
		}
	}

	var zoomFunc = function() {
		if ($('.zoomerang').length > 0) {
	   	// Zoomerang.config({maxHeight:730,maxWidth:900}).listen('.zoomerang');

	   	$('.fh5co-bg-img').each(function(){
	   		$(this).css('width', '100%');
	   	});
	   	Zoomerang
                .config({
                    maxHeight: 900,
                    maxWidth: 800,
                    bgColor: '#000',
                    bgOpacity: .85,
                    onOpen: openCallback,
                    onClose: closeCallback,
                    onBeforeOpen: beforeOpenCallback,
                    onBeforeClose: beforeCloseCallback
                })
                .listen('.zoomerang')

            function openCallback (el) {
                console.log('zoomed in on: ')
                // console.log(el)
            }

            function closeCallback (el) {
                console.log('zoomed out on: ')
                // console.log(el)
            }

            function beforeOpenCallback (el) {
            	console.log('on before zoomed in on:')
            	// console.log(el)
            }

            function beforeCloseCallback (el) {
            	console.log('on before zoomed out on:')
            	// console.log(el)
            }

	   }
	}

	
	$(function(){
		mobileMenuOutsideClick();
		offcanvasMenu();
		burgerMenu();
		contentWayPoint();
		sliderMain();
		dropdown();
		goToTop();
		loaderPage();
		counterWayPoint();
		fullHeight();
		parallax();
		DateTimePickerFunc();

		$('.fh5co-bg-img').each(function(){
   		$(this).css('width', '100%');
   	});
		// zoomFunc();
	});


}());

/**Modal**/
	function revistacambio($numero){
		if ($numero=="") {
			document.getElementById("espaciorevista").innerHTML = "Edición no disponible para vista previa.";
		} else{
			if ($numero=="35") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/52530331' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 35";
			} else if ($numero=="34") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/52840135' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 34";
			} else if ($numero=="32") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/33875050' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 32";
			} else if ($numero=="31") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/30603428' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 31";
			} else if ($numero=="30") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/11278279' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 30";
			} else if ($numero=="29") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/10436809' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 29";
			} else if ($numero=="28") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/10232148' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 28";
			} else if ($numero=="27") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/7176302' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 27";
			} else if ($numero=="26") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/4594846' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 26";
			} else if ($numero=="25") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/2534176' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 25";
			} else if ($numero=="24") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/1540140' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 24";
			} else if ($numero=="23") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/4696918' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 23";
			} else if ($numero=="21") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/4696848' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 21";
			} else if ($numero=="20") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/52531048' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 20";
			} else if ($numero=="18") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/4954197' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 18";
			} else if ($numero=="17") {
				document.getElementById("espaciorevista").innerHTML = "<iframe style='width:100%; height:600px;' src='//e.issuu.com/embed.html#3474702/52531075' frameborder='0' allowfullscreen></iframe>";
				document.getElementById("titulorevista").innerHTML = "Edición 17";
			}
		}
	}

$('#myModal').on('show.bs.modal', function (event) {
    	var button = $(event.relatedTarget);
    	var ident = button.data('id');
    	var modal = $(this)    
        document.getElementById("espaciorevista").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        revistacambio(ident);
    
});