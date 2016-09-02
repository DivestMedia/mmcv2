

jQuery(function($){


    if(jQuery.browser.mobile)
    {
        $('.post-content img').each(function(){
            $(this).addClass('img-responsive');
        });
    }
    $(window).load(function() {
	    $("body").find("#container-glossary").find(".cminds_poweredby").remove();
	    $("#glossaryList").find(".glossaryLink").each(function() {
	        var e = $(this).data("cmtooltip");
	        $(this).removeData("cmtooltip").removeAttr("data-cmtooltip").clone().appendTo($(this).parent()); 
	        $(this).parent().append("<div>" + e + "</div>"), $(this).remove();
	    })
	    $("#glossaryList-nav .ln-letters").find("a:first-child").trigger("click"); 
    });

    $('.btn-team-show-more').click(function(){
        $(this).hide();
        $(this).siblings('p').css('height','100%');
         $(this).parents('.box2').css('height','100%');
    });

    $('.about_heads .item img').hover(function(){
        console.log(1);
    }, function(){
       console.log(1);
    });
});
