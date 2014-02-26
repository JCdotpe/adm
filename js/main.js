$(window).scroll(function () {
    if ($(window).scrollTop() > 60) {
		$('body').addClass('topNavbar');	
        $('#nav-primary').css('top', '0px');
    }
    else{
		$('body').removeClass('topNavbar');    	
    	$('#nav-primary').css('top', '60px');	
    }
}
);