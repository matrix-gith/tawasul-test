$(window).scroll(function(){
    if ($(window).scrollTop() >= 100) {
       $('.left-sidebar').addClass('fixed-side');
    }
    else {
       $('.left-sidebar').removeClass('fixed-side');
    }
});





////////second nav////////////
$(window).scroll(function(){
    'use strict';
    if ($(this).scrollTop() > 400){  
        $('.fixme').addClass("sccondbar");
    }
    else{
        $('.fixme').removeClass("sccondbar");
    }
});
////////second nav////////////


////////group banner////////////
$(window).scroll(function(){
    'use strict';
    if ($(this).scrollTop() > 240){  
        $('.fixme .group-tag').addClass("fullbanner");
    }
    else{
        $('.fixme .group-tag').removeClass("fullbanner");
    }
});
////////group banner////////////



 $(window).scroll(function(){
    'use strict';
    if ($(this).scrollTop() > 450){  
        $('.left-sidebar').addClass("fixedleftbar");
    }
    else{
        $('.left-sidebar').removeClass("fixedleftbar");
    }
});


$(window).scroll(function(){
    'use strict';
    if ($(this).scrollTop() > 820){  
        $('.occasion').addClass("fixedrightbar");
    }
    else{
        $('.occasion').removeClass("fixedrightbar");
    }
});


$(window).scroll(function(){
    'use strict';
    if ($(this).scrollTop() > 120){  
        $('.emDirectory-seaRch').addClass("fixedsearchbar");
    }
    else{
        $('.emDirectory-seaRch').removeClass("fixedsearchbar");
    }
});





$('a.open_close').on("click",function() {
	$('.main-menu').toggleClass('show');
	$('.layer').toggleClass('layer-is-visible');
});

$('a#close_in').on("click",function() {
	$('.main-menu').removeClass('show');
	
});

$('a.show-submenu').on("click",function() {
	$(this).next().toggleClass("show_normal");
});
$('a.show-submenu-mega').on("click",function() {
	$(this).next().toggleClass("show_mega");
});
if($(window).width() <= 480){
	$('a.open_close').on("click",function() {
	$('.cmn-toggle-switch').removeClass('active')
});
}

$(window).bind('resize load',function(){
if( $(this).width() < 767 )
{
$('.collapse#collapseFilters').removeClass('in');
$('.collapse#collapseFilters').addClass('out');
}
else
{
$('.collapse#collapseFilters').removeClass('out');
$('.collapse#collapseFilters').addClass('in');
}   
});

////////back to top////////////

$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');

});

////////select////////////

$(document).ready(function () {
    $(".btn-select").each(function (e) {
        var value = $(this).find("ul li.selected").html();
        if (value != undefined) {
            $(this).find(".btn-select-input").val(value);
            $(this).find(".btn-select-value").html(value);
        }
    });
});

$(document).on('click', '.btn-select', function (e) {
    e.preventDefault();
    var ul = $(this).find("ul");
    if ($(this).hasClass("active")) {
        if (ul.find("li").is(e.target)) {
            var target = $(e.target);
            target.addClass("selected").siblings().removeClass("selected");
            var value = target.html();
            $(this).find(".btn-select-input").val(value);
            $(this).find(".btn-select-value").html(value);
        }
        ul.hide();
        $(this).removeClass("active");
    }
    else {
        $('.btn-select').not(this).each(function () {
            $(this).removeClass("active").find("ul").hide();
        });
        ul.slideDown(300);
        $(this).addClass("active");
    }
});

$(document).on('click', function (e) {
    var target = $(e.target).closest(".btn-select");
    if (!target.length) {
        $(".btn-select").removeClass("active").find("ul").hide();
    }
});


////////ebook filter///////////


if($(window).width() < 767)
{
   $(document).ready(function(){
	$('.ebook-left-sidebar h2').click(function(){
		$('.cat-list').slideToggle();
	});
});

} else {
   // change functionality for larger screens
}


