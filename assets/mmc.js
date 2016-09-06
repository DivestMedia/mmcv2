

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

    if( $('.news-feature-grid').length > 0 ){
        assignnewsimage();
    }

});

function assignnewsimage(){
        var tags = jQuery('.news-feature-grid .font-proxima.uppercase').text().trim().toLowerCase().replace(/[^0-9a-z]/gi, ' ').replace(' news', '');
        var newimgsrc = '';
        var newscount = 0;
        newimgsrc = switch_tags(tags);
        setInterval(function(){
            countnow = jQuery('.news-feature-grid figure').length;
            if(countnow>newscount){
                var max = newimgsrc.length-1;
                var ctr = 0;

                jQuery('.news-feature-grid figure').each(function(){
                    var imgsrc = jQuery(this).css('background-image') || '';
                    // if(imgsrc.length > 0){
                        var fnd = 0;
                        var terms = [
                            'comrssmarketwatch',
                            'invlogosinv',
                            'ft-news',
                            'Default_Image',
                            'vc_gitem_image',
                            'moneycontrol_logo',
                            'cms-59',
                            'v2imagesreuters',
                            'default',
                            'bbc_news_logo',
                            'cnnmoney_logo',
                            'mw_logo_social',
                        ];
                        for(var i in terms){
                            if(imgsrc.search(terms[i])>-1){
                                fnd++;
                            }
                        }

                        var cloneimgsrc = imgsrc;
                        if(imgsrc.length== 0 || cloneimgsrc.replace('url("','').replace('")','').trim().length == 0 || imgsrc== 'url("'+window.location+'")' ){
                            fnd++;
                        }
                        if(fnd>0){
                            if(tags.length>0){
                                if(jQuery.isArray(newimgsrc)){
                                    rnewimgsrc = newimgsrc[ctr];
                                    if(ctr++>=max)
                                    ctr = 0;
                                }
                                else
                                rnewimgsrc = newimgsrc;
                                jQuery(this).css('background-image','url("'+ rnewimgsrc +'")');
                            }
                        }
                    // }else{
                    //     jQuery(this).css('background-image','url("http://www.marketmasterclass.com/wp-content/themes/sage-8.4/dist/images/placeholder.png")');
                    // }
                });
                newscount = countnow;
            }
        },1000);
}

function switch_tags(tags){
    switch(tags){
        case 'real estate':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/ei.marketwatch.comMultimedia20160510PhotosZHMW-EM390_roofto_20160510093609_ZH-cf2792d26d887ed37889f6b4e15b816cefb25830.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/real-estate-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-11.jpg'
        ];
        break;
        case 'banking finance':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/glocdn.investing.comtrkd-imagesLYNXNPEC3S1CP_L-1391d561df4fd8ca7c1ac0a9be36cc1690d251db.jpg',
            '/wp-content/uploads/sites/8/2016/09/Banking-and-Finance-banner.jpg',
            '/wp-content/uploads/sites/8/2016/09/banking-finance-insurance.jpg','/wp-content/uploads/sites/8/2016/09/Finance-Bank.jpg',
            '/wp-content/uploads/sites/8/2016/09/pakistan-s-islamic-banking-push-faces-industry-gaps-1413296787-9951.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_5.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_3.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_2.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_1.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_6.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_7.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_8.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_9.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_10.jpg',
            '/wp-content/uploads/sites/8/2016/09/bankingfinance_11.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'construction':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/ei.marketwatch.comMultimedia20141230PhotosMGMW-DC458_morton_20141230161657_MG-646c06ceed097bbcea9357e607583e0e9e14dff8.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction_10.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction_6.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction_7.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction_8.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction_9.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction_10.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction_11.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction_12.jpg',
            '/wp-content/uploads/sites/8/2016/09/construction_13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-11.jpg'

        ];
        break;
        case 'consumer goods':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/im.ft-static.comcontentimages89684900-e334-4572-9da9-8451a5584044.img-7a9f3e11ea63967cfe55242465f5c16694a99c86',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/consumer-goods-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-7.jpg'
        ];
        break;
        case 'energy':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/im.ft-static.comcontentimagesf6626971-dbf7-422c-9bf4-06ca03c34af1-2.img-b0f5c60f5d88d247bd3c7a26478cbae42adf556a',
            '/wp-content/uploads/sites/8/2016/09/energy-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy_7.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy_6.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/energy-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'industrial goods':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/im.ft-static.comcontentimagesf034eb6f-67e9-4df5-8eb7-b2104078d9b2-1.img-005375d837f55c805e99cf367263e3d02b7a81e9',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/industrial-goods-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-11.jpg'
        ];
        break;
        case 'manufacturing':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/im.ft-static.comcontentimages997d3771-2f43-4bd2-91d2-5fc79c643cbd-1.img-1da5af8e21c71a56f58877bc9f2615356735f614',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/manufacturing-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'media':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/media_4.jpg',
            '/wp-content/uploads/sites/8/2016/09/media_3.jpg',
            '/wp-content/uploads/sites/8/2016/09/media_2.jpg',
            '/wp-content/uploads/sites/8/2016/09/media_3.jpg',
            '/wp-content/uploads/sites/8/2016/09/media_4.jpg',
            '/wp-content/uploads/sites/8/2016/09/media_5.jpg',
            '/wp-content/uploads/sites/8/2016/09/media_6.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-16.jpg'
        ]; break;
        case 'mining':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/im.ft-static.comcontentimages9df37d4b-6b7a-4560-8c25-848b49af4279.img-b5c3d6085da5b944eae31b08da37e54a5922e1c5',
            '/wp-content/uploads/sites/8/2016/09/mining-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining_5.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining_7.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/mining-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'pharmacueticals':
        case 'pharmacueticals medical':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/im.ft-static.comcontentimagesa9e2969f-ef66-4587-91ea-3d905a422ba4-1.img-3fcb18b4743531319ead6e258ea1d5cfa8b34331',
            '/wp-content/uploads/sites/8/2016/09/medical-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/medical-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'retail':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/Floating-Markets-in-Asia-640x375.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/retail-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'technology':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/im.ft-static.comcontentimages5ca57ba4-15cc-11e6-9d98-00386a18e39d.img-dbfb7b86646a0ee25b03ef7da5c5bc1201232eed',
            '/wp-content/uploads/sites/8/2016/09/technology-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/techonology_4.jpg',
            '/wp-content/uploads/sites/8/2016/09/techonology_5.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/technology-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-11.jpg'
        ];
        break;
        case 'travel':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/im.ft-static.comcontentimagesb7a05f08-5fee-4de9-90fa-c40e4a1e4a1d.img-92b21a9dee3b823600093bb176cb669a8a0b38b8',
            '/wp-content/uploads/sites/8/2016/09/travel-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/travel-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/travel-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/travel-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/travel-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/travel-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/travel-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/travel-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/travel-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-11.jpg'
        ];
        break;
        default:
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/www.newsoracle.comwp-contentuploads201509how-to-buy-stocks-e8ba2c93ea77c74045ee9d6badfe17c688654767.jpg',
            '/wp-content/uploads/sites/8/2016/09/www.newsoracle.comwp-contentuploads201509Stock-Investment-1-4c260dbd76e9480e0d12c9c11d882f6c3a9f43e0.jpg',
            '/wp-content/uploads/sites/8/2016/09/glocdn.investing.comnewsWarsWarsaw-Stock-Exchange_800x533_L_1430991033-dae82efb6283addfa779cad83ad60f22338685a5.jpg',
            '/wp-content/uploads/sites/8/2016/09/stock-market-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/stock-market-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/glocdn.investing.comnewsLYNXNPEB7A004_L-55a0d1b38df4279dbc302f3d57dc3ef9c9925239.jpg',
            '/wp-content/uploads/sites/8/2016/09/stock-watch.jpg',
            '/wp-content/uploads/sites/8/2016/09/WideModern_StockMarketChart_062613-e1462847698711.jpg',
            '/wp-content/uploads/sites/8/2016/09/glocdn.investing.comnewsBrazil-Stock-Market_1_309X149._800x533_L_1413121146-896630eb895cfa2c8e6ca0df38eeef72301215f9.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-7.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-11.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-16.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-17.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-18.jpg',
            '/wp-content/uploads/sites/8/2016/09/gen-news-19.jpg'
        ];
        break;
    }
    return newimgsrc;
}
