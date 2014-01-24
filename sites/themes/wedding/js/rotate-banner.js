$(document).ready(function() {
  var total = $('#rotate-banner div').size();
  var current = 1;
  var timeout = 10;
  var timer;
  var list = '';
  
	for (i = 1; i <= total; i++) {
		list += '<li><a href="#" title="' + i + '">' + i + '</a></li>';
	}
	
	if (total > 1) {
		$('#rotate-banner').append('<a href="#" class="bannerPrev" title="Previous"></a>');
		$('#rotate-banner').append('<a href="#" class="bannerNext" title="Next"></a>');
		$('#rotate-banner').append('<ul class="bannerList">' + list + '</ul>');
		$('#rotate-banner .bannerList').css('right', (((1000 - (total * 22)) / 2) - 6) + 'px');
		transition(true);
	}
	
  $('#rotate-banner .bannerList li a').click(function() {
    timeout = 20;
    current = ($(this).parent().prevAll().length) + 1;
    transition(false);
  });
  
  $('#rotate-banner .bannerPrev').click(function() {
    timeout = 20;
    
    if (current == 1) {
      current = total;
    } else {
      current = current - 1;
    }
  
    transition(false);
  });

	$('#rotate-banner .bannerNext').click(function() {
		timeout = 20;
		
		if (current == total) {
		  current = 1;
		} else {
			current = current + 1;
		}
		
		transition(false);
	});
	
	function auto() {
		if (current == total) {
			current = 1;
		} else {
			current = current + 1;
		}
		
		transition(true);
	}
	
	function transition(auto) {
		stopTimer();
		
		$('#rotate-banner div').hide();
		$('#rotate-banner .bannerList li a').removeClass('selected');
		$('#rotate-banner div').eq(current - 1).fadeIn('slow');
		$('#rotate-banner .bannerList li a').eq(current - 1).addClass('selected');
		
		if (auto) {
			timeout = 10;
			startTimer();
		} else {
			startTimer();
		}
	}
	
	function startTimer() {
		timer = window.setTimeout(auto,timeout * 1000);
	}
	
	function stopTimer() {
		window.clearTimeout(timer);
	}
});