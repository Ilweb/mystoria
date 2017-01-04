var currentScroll = 0;
var enabledScroll = true;
var scrollTimer;

$(document).ready(function(){

	//toggle calendar function
	
	($(window).width() < 780)&&$( ".firstset" ).click(function() { 
	  if($(this).data('clicked') == true)
	  {
		  $( this ).find(".down").fadeToggle(1000);
		  $(this).data('clicked', false);
		}
	  else
	  {
			$( this ).find(".down").css("display","block");
			$(".firstset").css("display","block");
			$(this).data('clicked', true);
	  }
	});
	
	//mobile  show function onclick
	jQuery(".mobile_button").click(function()
	{
		/*if ((jQuery(".navigation_bars").hasClass("show"))&&($(window).width() <= 680))
		{
			jQuery(".navigation_bars").removeClass("show").slideUp(1000);
		}
		else
		{
			jQuery(".navigation_bars").addClass("show").slideDown(1000);
		}*/
		jQuery(".navigation_bars").fadeToggle(1000).css("padding-top","20px")
	});
	
	jQuery(".menu a").click(function()
	{
		checkHash();
	});
	
	checkHash();
	currentScroll = $(window).scrollTop();
});

// change slide if needed
function slideWheel()
{
	if ($(window).scrollTop() > currentScroll) // scrolling down
	{	
		if (($(window).scrollTop() > $("#wall_3").offset().top - $(window).height())
			&& ($(window).scrollTop() < $("#wall_3").offset().top - 100))
		{
			goToByScroll( "#wall_3", -100 );
		}
		if (($(window).scrollTop() > $("#wall_4").offset().top - $(window).height())
			&& ($(window).scrollTop() < $("#wall_4").offset().top - 100))
		{
			goToByScroll( "#wall_4", -100 );
		}
		if (($(window).scrollTop() > $("#wall_5").offset().top - $(window).height() + 100)
			&& ($(window).scrollTop() < $("#wall_5").offset().top - 100))
		{
			goToByScroll( "#wall_5", -100 );
		}
	}
	else // scolling up
	{
		if (($(window).scrollTop() > $("#wall_4").offset().top - 100)
			&& ($(window).scrollTop() < $("#wall_4").offset().top - 100 + $("#wall_3").height()))
		{
			goToByScroll( "#wall_4", -100 );
		}
		if (($(window).scrollTop() > $("#wall_3").offset().top - 100)
			&& ($(window).scrollTop() < $("#wall_3").offset().top - 100 + $("#wall_3").height()))
		{
			goToByScroll( "#wall_3", -100 );
		}
		if (($(window).scrollTop() > $("#wall_1").offset().top) 
			&& ($(window).scrollTop() < $("#wall_1").offset().top + $("#wall_1").height()))
		{
			goToByScroll( "#wall_1", 0 );
		}
	}
	
	currentScroll = $(window).scrollTop();
}

//sticky header scrolling
function stickyHeader()
{
	if ($("#wall_1").length)
	{
		if ($(window).scrollTop() > $("#wall_1").height()) {
			$('.menu').addClass('fixed');
		} else {
			$('.menu').removeClass('fixed');
		}
	}
	else if (!$('.menu').hasClass("fixed"))
	{
		$('.menu').addClass('fixed');
	}
}

$(window).on('hashchange', function() {
	checkHash();
});

function checkHash()
{
	if (window.location.hash == '#reserve')
	{
		goToByScroll( "#wall_4", -100 );
	}
	stickyHeader();
}

$(window).bind('mousewheel DOMMouseScroll', function(event)  {
	clearTimeout(scrollTimer);
	scrollTimer = setTimeout(function()
	{ 
		stickyHeader();
		//slideWheel();
	}, 150);
});

function goToByScroll( id, correction)
{
	if (enabledScroll)
	{
		enabledScroll = false;
		$('html,body').animate({ 
			scrollTop: $(id).offset().top + correction
		}, 500, function() 
		{
			stickyHeader();
			enabledScroll = true;
			currentScroll = $(window).scrollTop();
		});
	}
}




