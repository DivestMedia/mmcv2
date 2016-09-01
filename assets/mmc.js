

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
});
