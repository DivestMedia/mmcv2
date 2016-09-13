var newsimages = [];

jQuery(function($){



    if(jQuery.browser.mobile)
    {
        $('.post-content img').each(function(){
            $(this).addClass('img-responsive');
        });
    }
    $(window).load(function() {
        $("body").find(".cont-glossary").find(".cminds_poweredby").remove();
        $("#glossaryList").find(".glossaryLink").each(function() {
            var e = $(this).data("cmtooltip");
            $(this).removeData("cmtooltip").removeAttr("data-cmtooltip").removeAttr("href").clone().appendTo($(this).parent());
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
    }, function(){
    });

    if( $('.news-feature-grid').length > 0 ){
        assignnewsimage(jQuery('.news-feature-grid .font-proxima.uppercase'),jQuery('.news-feature-grid figure'),false);
    }

    if( $('.video-grid').length > 0 ){
        jQuery('.video-grid .item-box-big figure img').css('min-height',jQuery('.video-grid .col-md-3').first().height()-10)
    }
    newsimages = [];
    if( $('#global_news').length > 0 ){

        assignnewsimage(jQuery('#global-news-post-slider .img-hover label.badge'),jQuery('#global-news-post-slider .img-hover figure'),true);
        assignnewsimage(jQuery('<span>USA</span>'),jQuery('#global-news-post-slider-usa a figure'),true);
        assignnewsimage(jQuery('<span>Asia</span>'),jQuery('#global-news-post-slider-asia a figure'),true);
        assignnewsimage(jQuery('<span>Stocks</span>'),jQuery('#global-news-post-slider-stocks a figure'),true);
    }

    if( $('.featured-grid').not('.video-grid').length > 0 ){
        assignnewsimage(jQuery('.featured-grid h3 em a'),jQuery('.featured-grid figure img'),true);
    }

    $('#subscribenow').find('.btn').removeClass('btn-default').addClass('secondary-bg border-1');

    $('.btn-play-vid-a').click(function(){
        $('.btn-play-vid').trigger('click');
    });

    if($('#masterslider-promo').length){
        setTimeout(function(){
            window.dispatchEvent(new Event('resize'));
        },2000);

    }

	
	



});



function isScrolledIntoView(c){var e=$(window).scrollTop();var d=e+$(window).height();var a=$(c).offset().top;var b=a+$(c).height();return((b>=e)&&(a<=d))};
function xyrLoadImg(){
			$(".img_place").each(function(){
				if(isScrolledIntoView(this) == true){
					if($(this).attr('org_img') !== undefined){
						var the_orig_img=$(this).attr("org_img");
						this.src=the_orig_img;
						
						$(this).animate({opacity: 0.01},1);
						$(this).animate({opacity: 1}, 800);
	  
						$(this).removeAttr("org_img");
						$(this).removeClass("img_place");
						
						console.log(the_orig_img);
					}
				}
			});
		}
		function loadIframe(){
			$(".iframe_content").each(function(){
				if(isScrolledIntoView(this) == true){
					if($(this).attr('iframe_url') !== undefined){
						var the_orig_url=$(this).attr("iframe_url");
						this.src=the_orig_url;
						
						$(this).animate({opacity: 0.01},1);
						$(this).animate({opacity: 1}, 800);
	  
						$(this).removeAttr("iframe_url");
						$(this).removeClass("iframe_content");
					}
				}
			});
		}
		
		function loadAjax(){
			$(".ajax_content").each(function(){
				if(isScrolledIntoView(this) == true){
					if($(this).attr('ajax_url') !== undefined){
						var the_orig_ajax=$(this).attr("ajax_url");
						var the_div_id=$(this).attr("id");
						$.ajax({url:the_orig_ajax,success:function(c){$("#"+the_div_id).html(c)}});
						$(this).animate({opacity: 0.01},1);
						$(this).animate({opacity: 1}, 800);
						$(this).removeAttr("ajax_url");
						$(this).removeClass("ajax_content");
					}
				}
			});
		}

function assignnewsimage(tagelem,itemelem,taglist){

    var tags = '';
    var newimgsrc = '';
    var newscount = 0;
    newimgsrc = '';
    if(taglist){
        tags = [];
        tagelem.each(function(i,v){
            tags.push($(this).text().trim().toLowerCase().replace(/[^0-9a-z]/gi, '-'));
        });
    }else{
        tags = tagelem.text().trim().toLowerCase().replace(/[^0-9a-z]/gi,'-').replace('-news', '');
        newimgsrc = switch_tags(tags);
    }
    // setInterval(function(){
    countnow = itemelem.length;
    if(countnow>newscount){
        var max = newimgsrc.length-1;
        var ctr = 0;

        itemelem.each(function(ii,v){
            var imgsrc = '';
            if($(v).prop("tagName")=='IMG'){
                imgsrc = jQuery(v).attr('src') || '';
            }else{
                imgsrc = jQuery(v).css('background-image') || '';
            }
            if(taglist){
                var tagkey = tags[ii].toString().replace(/\s+/g, '-').toLowerCase();

                if(['asia','usa'].indexOf(tagkey)!=-1){
                    tagkey = 'default';
                }
                newimgsrc = switch_tags(tagkey);
            }
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
                'rcom-default',
                'mw_logo_social',
                '6325547',
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
                    if(taglist){
                        var tagkey = tags[ii].toString().replace(/\s+/g, '-').toLowerCase();
                        if(['asia','usa'].indexOf(tagkey)!=-1){
                            tagkey = 'default';
                        }
                        if(typeof newsimages[tagkey] == 'undefined'){
                            newsimages[tagkey] = 0;
                        }

                    }
                    if(jQuery.isArray(newimgsrc)){
                        if(taglist){
                            var tagkey = tags[ii].toString().replace(/\s+/g, '-').toLowerCase();
                            if(['asia','usa'].indexOf(tagkey)!=-1){
                                tagkey = 'default';
                            }
                            rnewimgsrc = newimgsrc[newsimages[tagkey]];
                            if(newsimages[tagkey]>=newimgsrc.length){
                                newsimages[tagkey] = 0;
                            }
                            newsimages[tagkey]++;
                            // console.log(newsimages[tagkey]);
                        }else{
                            rnewimgsrc = newimgsrc[ctr];
                            if(ctr++>=max)
                            ctr = 0;
                        }
                    }
                    else
                    rnewimgsrc = newimgsrc;
                    if($(v).prop("tagName")=='IMG'){
                        jQuery(v).attr('src', rnewimgsrc );
                    }
                    else{
                        jQuery(v).css('background-image','url("'+ rnewimgsrc +'")');
                    }
                }
            }
            // }else{
            //     jQuery(this).css('background-image','url("http://www.marketmasterclass.com/wp-content/themes/sage-8.4/dist/images/placeholder.png")');
            // }
        });
        newscount = countnow;
    }
    // },1000);
    // console.log(newsimages);
}




function switch_tags(tags){
    switch(tags){
        case 'real-estate':
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
        case 'banking-finance':
        case 'stocks':
        newimgsrc = [
            '/wp-content/uploads/sites/8/2016/09/glocdn.investing.comtrkd-imagesLYNXNPEC3S1CP_L-1391d561df4fd8ca7c1ac0a9be36cc1690d251db.jpg',
            '/wp-content/uploads/sites/8/2016/09/Banking-and-Finance-banner.jpg',
            '/wp-content/uploads/sites/8/2016/09/banking-finance-insurance.jpg',
            '/wp-content/uploads/sites/8/2016/09/Finance-Bank.jpg',
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
        case 'consumer-goods':
        newimgsrc = [
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
        case 'industrial':
        case 'industrial-goods':
        newimgsrc = [
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
        case 'pharmaceutical':
        case 'pharmaceuticals':
        case 'pharmacueticals':
        case 'pharmacueticals-medical':
        newimgsrc = [
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
