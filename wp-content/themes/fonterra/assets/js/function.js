if (!window.$) window.$ = jQuery;

$( document ).ready(function() {

		var $mobileNavTrigger = $(".mobile-nav-bar"),
	    $targetMobileNav = $(".mobile-nav"),
	    showMobileNavClass = "show-mobile-nav";

	  $mobileNavTrigger.click(function(){
	    $targetMobileNav.toggleClass(showMobileNavClass);
	  });

		$('.mobile-score-item.item-1').on('click', function(){
	        $(this).addClass('active').siblings().removeClass('active');
			$('.content-container').show();
	        $('.right-side').hide();
	        $('.bottle-container').hide();
	        $('.container').removeClass('showtab2');
	        $('.container').removeClass('showtab3');
		});

	    $('.mobile-score-item.item-2').on('click', function(){
	        $(this).addClass('active').siblings().removeClass('active');
			$('.content-container').hide();
	        $('.right-side').show();
	        $('.bottle-container').hide();
	        $('.container')
	        .addClass('showtab2')
	        .removeClass('showtab3');
		});

	    $('.mobile-score-item.item-3').on('click', function(){
	        $(this).addClass('active').siblings().removeClass('active');
			$('.content-container').hide();
	        $('.right-side').hide();
	        $('.bottle-container').show();
	        $('.container')
	        .removeClass('showtab2')
	        .addClass('showtab3');
		});

		// accordian start
	  $(".score-top").click(function(){
	    $(".score-bottom").slideUp("fast");if(
	      $(this).next().is(":hidden")==true){
	        $(this).next().slideDown("normal")
	      }
	    });
	    $(".score-bottom").hide()

	  $('.score-top').on('click', function(){
	    $(this).toggleClass('active').parent().siblings().find('.score-top').removeClass('active');
	  });
		// accordian end

		$('.video-link').magnificPopup({
		  type: 'iframe'
		  // other options
		});

	}

);
