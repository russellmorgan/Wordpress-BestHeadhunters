jQuery(document).ready(function( $ ) {


	// Formatting
	$('.social-block div:nth-child(3n)').addClass('remove-margin');


	// Nav menu
	$('.menu li:first').addClass('current');

	// If the URL includes a modal link upon page load, show a loading animation
	// This loading animation is then hidden in the openModal() function.
	var modalOnLoad = $.bbq.getState( "modal" );
	if ( modalOnLoad !== undefined && modalOnLoad != '' ) {
		$('#overlay').show();
	}


	// Scrolls the page to the div given by location
	goToSection = function(location) {
  	var destination = $(location).offset().top;
  	$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination - 50 }, 500 );

  	return false;
  };


  // Update the history params (#menu=) when a user clicks menu links
  $("#nav a").click(function(){
  	var href = $(this).attr( "href" ).replace('#','');

  	// Push the URL state onto the history hash.
  	$.bbq.pushState({ menu: href, modal: ''});

  	return false;
  });


  // Update the history params (#modal=) when a user visits portfolio items
  $("#portfolio .filter-posts a").click(function(){
  	var href = $(this).attr( "href" ).replace('#modal-','');

  	// Push the URL state onto the history hash.
  	$.bbq.pushState({ modal: href, menu: '' });

  	return false;
  });


  // Update history params (#modal=) when a user visits blog items
  $('.modal-toggle').live( "click", function(){
  	var href = $(this).attr( "href" ).replace('#modal-','');

  	// Push the URL state onto the history hash.
  	$.bbq.pushState({ modal: href, menu: '' });

  	return false;
  });

  // Detect URL history params upon change and restore the page state
  $(window).bind( "hashchange", function(e) {

    	var menu = $.bbq.getState( "menu" );
    	var modal = $.bbq.getState( "modal" );

    	var menuID = '#' + menu;
    	var modalClass = '.modal-' + modal;

    	// If a menu name is present, scroll the page to that div
    	if ( menu !== undefined && menu != '' )
    		goToSection(menuID);

    	// If a modal ID is present, show the relevant modal
    	if ( modal !== undefined && modal != '' ){
	    	if ( $('body').hasClass('modal-open') ) {
		    	goToModal(modalClass);
		    } else {
			   	openModal(modalClass);
			}
		}

		// If no modal ID is present AND the modal is still open, close the modal.
		// This ensures modals close when the user steps back through history.
		if ( (modal == undefined || modal == '')
        	&& $('body').hasClass('modal-open') )

        	closeModal();

        return false;
  });

	// Trigger the hashchange event on full initial page load in case the user's
	// arrived via a link containing existing history params. This is what allows
	// us to restore the state of the page if a URL contains the 'menu' or
	// 'modal' hash params.
	$(window).load(function() {
  	$(this).trigger( "hashchange" );
  });


	// Waypoints
	$('body').delegate('#sections > .section-wrap', 'waypoint.reached', function(event, direction) {
		var $active = $(this);

		if (direction === "up") {
			$active = $active.prev();
		}
		if (!$active.length) $active = $active.end();

		$('.section-active').removeClass('section-active');
		$active.addClass('section-active');

		$('.link-active').removeClass('link-active');
		$('a[href=#'+$active.attr('id')+']').addClass('link-active');

	});


	// Register each section as a waypoint.
	$('#sections > .section-wrap').waypoint({ offset: '14px' });


	// Scroll to top
	$('a[href=#top]').click(function(){
    	$('html, body').animate({scrollTop:0}, 500);
    	return false;
    });


  	// FitVids
	$(".okvideo, .post-content").fitVids();

	// Quicksand
	if ((custom_js_vars.portfolio_sort) == 'enabled') {
		var $data = $(".filter-posts").clone();

		$('.filter-list .sub-menu li').click(function(e) {
			$(".filter-list .sub-menu li").removeClass("active cat-item");
			// Use the last category class as the category to filter by.
			//var filterClass=$(this).attr('class').split(' ').slice(-1)[0];

			var filterClass=$(this).attr('class');

			if (filterClass == 'all-projects') {
				var $filteredData = $data.find('.project');
			} else {
				var $filteredData = $data.find('.project[data-type~=' + filterClass + ']');
			}
			$(".filter-posts").quicksand($filteredData, {
				duration: 400,
				easing: 'jswing',
				adjustHeight: 'auto',
			});
			$(this).addClass("active");
			return false;
		});
	}

	// Sort drop menu
	$('.filter-menu').on("click touchstart", function(){
	$('.filter-list .sub-menu').slideToggle();
	return false;
	});

	// Modal logic
	var hiddenModalBoxes; // for saving any modal boxes we hide
	var pagePosition; // for storing the current scroll position

	// Adapt "Continue Reading" links so that they open modals
	if ( $('.more-link').length != 0) {

	    $('.more-link').wrap('<div class="launch-modal" />');
	    $('.more-link').addClass('post-modal modal-toggle');

	    // Change the Continue Reading link href so that history state is pushed
	    var oldref = $('.more-link').attr('href');
	    var postID = oldref.split('#')[1].split('-')[1];
	    var newref = "#modal-" + postID;
	    $('.more-link').attr('href', newref);
	}

	openModal = function(modalClass){

	    // Find out if we're showing a blog post or a portfolio piece
	    if ( $(modalClass).hasClass('type-blog') ){ //It's a blog post

	      // Since we're showing blog posts, remove the portfolio stuff.
	      // We do this so that users can browse only the blog posts
	      // with the modal's next and previous buttons.
	      hiddenModalBoxes = $('.modal:not(.type-blog)').detach();

	    } else { // It's a portfolio piece

	      // We're showing portfolio pieces, so remove the blog posts for now.
	      // We do this so that users can browse only the portfolio pieces
	      // with the modal's next and previous buttons.
	      hiddenModalBoxes = $('.modal:not(.type-portfolio)').detach();

	    }

	    //Hide all portfolio pieces and blog posts inside div.modal-toggle
	    $('#modals-wrap .modal').hide();

	    //Now show the portfolio piece or blog post that the user clicked on
	    $("#modals-wrap " + modalClass).show();

	    //Finally, fade everything in
	    $('.modal-close').fadeIn();
	    $('#modals-wrap').fadeIn( function(){

        $('#overlay').hide();

	      // Once everything's faded in, store the background page position
	      // then lock it to the top. This fixes an iOS scroll bug.
	      pagePosition = $('body').scrollTop();
	      if ($.browser.mozilla) {
	      	pagePosition = $('html').scrollTop();
	      }	
	      $('body').addClass('modal-open');

	    });

	    return false;
    };

    goToModal = function(modalClass) {
      $('.modal').hide(); //hide all modals
      $(modalClass).show(); //show the new one
    };

    closeModal = function(){
      $('#overlay').hide();

    	// Allow the main body to scroll again and return it to its previous y position
    	$('body').removeClass('modal-open');
    	$('html, body').scrollTop(pagePosition);

    	// Fade out the modal
    	$('.modal-close').fadeOut();
    	$('#modals-wrap').fadeOut();

    	// Add any modal boxes we removed when opening the modal
    	if ( hiddenModalBoxes ) {
      		hiddenModalBoxes.appendTo("#modals-wrap");
      		hiddenModalBoxes = null;
      	}

    	// Clear the history state
    	$.bbq.pushState({ modal: '', menu: '' });

    	return false;
    };

  // Set modal size to the full window height
	$(window).load(function(){ // On load
		$('#modals-wrap').css({'height':(($(window).height()))+'px'});
	});

	$(window).resize(function(){ // On resize
		$('#modals-wrap').css({'height':(($(window).height()))+'px'});
	});

	// Modal navigation actions
	$('.modal-close').click( closeModal );

	$('.modal-previous').click(function() {
	    var previous = $(this).closest('.modal').prevAll('.modal').eq(0);
	    if (previous.length === 0) previous = $(this).closest('.modal').nextAll('.modal').last();
	    
	    //Scroll to top of modal
	    $('#modals-wrap').animate({scrollTop:0}, 'slow');

	    // Push the new modal state to history
	    var modalID = previous.data('modal');
	    $.bbq.pushState({ modal: modalID, menu: '' });

	    return false;
	});

	$('.modal-next').click(function() {
	    var next = $(this).closest('.modal').nextAll('.modal').eq(0);
	    if (next.length === 0) next = $(this).closest('.modal').prevAll('.modal').last();
	    
	    //Scroll to top of modal
	    $('#modals-wrap').animate({scrollTop:0}, 'slow');

      // Push the new modal state to history
      var modalID = next.data('modal');
      $.bbq.pushState({ modal: modalID, menu: '' });

	    return false;
	});


	/* Handle inline comment replies */

	// Variables to store the positions of the elements we're manipulating
	var commentText;		// .comment-text
	var commentList; 		// ol.commentlist
	var respondBox;			// #respond
	var cancelReply; 		// #cancel-comment-reply
	var cancelReplyLink; 	// #cancel-comment-reply-link

	// Remove existing JavaScript on comment reply links (which breaks due to multiple #reply sections in the modals )
	$('.comment-reply-link').removeAttr("onclick");

	// Override the comment "reply" button to move the reply form under the reply button without reloading the page
	$('.comment-reply-link').click(function() {

		// Store the positions of the elements we're manipulating
		commentText 	= $(this).closest('.comment-text');
		commentList 	= commentText.parents('ol.commentlist');
		respondBox 		= commentList.next();
		cancelReply 	= respondBox.children('#cancel-comment-reply');
		cancelReplyLink	= cancelReply.children('#cancel-comment-reply-link');

		// Show the comment reply link
		cancelReply.show();
		cancelReplyLink.show();

		// Put the reply box after the comment text
		commentText.after( respondBox );

		// Change the hidden input#comment_parent value to reflect the comment being replied to.
		// This ensures that the comment is saved in the WordPress db as a response to its parent.
		var comment_href = $(this).attr('href');
		var comment_parent_id = getURLParameter(comment_href, "replytocom").replace('#respond','');
		$('#comment_parent').val( comment_parent_id );

		return false;
	});

	// Hide "cancel comment reply" link upon click, return form to original position
	$('#cancel-comment-reply-link').live('click', function() {

		// Hide the comment reply link
		cancelReply.hide();
		cancelReplyLink.hide();

		// Reset the comment reply parameter so comments aren't counted as responses
		$('#comment_parent').val('0');

		// Return the #reply div to its original position at the foot of the comment area
		commentList.after( respondBox );

    return false;

	});


	// Flexslider
	$('.flexslider').flexslider({
		animation: "fade",
		slideshow: false
	});

	$('.load-more').click(function() {
		$('#blog .flexslider').flexslider("next")
		return false;
	});

	$('.load-less').click(function() {
  		$('#blog .flexslider').flexslider("prev")
  		return false;
  	});

  	// Helper functions
	function getURLParameter(url, name) {
  		return decodeURIComponent(
  			(url.match(RegExp("[?&]"+name+"=([^&]*)"))||[,null])[1]
  		);
  	}

	// Mobile Menu
	$('#nav').mobileMenu();
	$("<div class='mobile-icon'></div>").insertAfter('.select-menu');

});
