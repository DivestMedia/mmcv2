

jQuery(function($){


    if(jQuery.browser.mobile)
    {
        $('.post-content img').each(function(){
            $(this).addClass('img-responsive');
        });
    }
});
