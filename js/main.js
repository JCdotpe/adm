$(window).scroll(function () {
    if ($(window).scrollTop() > 100) {
        $('#nav-primary').css('top', '0px');
    }
    else{
    	$('#nav-primary').css('top', '60px');	
    }
}
);