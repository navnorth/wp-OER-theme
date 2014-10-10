jQuery(document).ready(function(e) {
    jQuery('.featuredwpr_bxslider').bxSlider({
		minSlides: 3,
  		maxSlides: 3,
		moveSlides: 1,
  		slideWidth: 320,
  		slideMargin: 10,
		pager: false
	});

	jQuery('.allftrdpst_slider').bxSlider({
		pager: false
	});


	jQuery(".snglctwpr").each(function(index, element) {
        var hght = jQuery(this).children(".cat-div").children(".child-category").height();
		jQuery(this).children(".cat-div").children(".child-category").attr("data-height", hght);
		jQuery(this).children(".cat-div").children(".child-category").hide();
		//alert(hght);
    });

	jQuery(".smooth_slideri").each(function(index, element) {
		var src = jQuery(this).children("a").children("img").attr("src");
		var siteurl = jQuery("#siteurl").val();
		var timthumb = jQuery("#timthumburl").val();

		/*var pathArray = siteurl.split( '/' );
		var protocol = pathArray[0];
		var host = pathArray[2];
		var siteurl = protocol + '//' + host;

		var pathArray = src.split( '/' );
		var protocol = pathArray[0];
		var host = pathArray[2];
		var url = protocol + '//' + host;

		if(url == siteurl)
		{*/
			src = timthumb+"?src="+src+"&w=1024&h=833&zc=0";
		/*}*/
		jQuery(this).children("a").children("img").attr("src", src);
	});

});

function toggleparent(ref)
{
	jQuery(ref).parent(".sub-category").toggleClass("activelist");
	jQuery(ref).next(".category").slideToggle();
}

function togglenavigation(ref)
{
	jQuery(".cat-div").each(function(index, value)
	{
		if(value == ref)
		{
			if(jQuery(value).hasClass("active-cat"))
			{
				jQuery(value).removeClass("active-cat");
			}
			else
			{
				jQuery(value).addClass("active-cat");
			}


			if ( jQuery(value).children(".active-arrow").length )
			{
				jQuery(value).children( ".active-arrow" ).remove();
			}
			else
			{
				jQuery(value).append( "<div class='active-arrow'></div>" );
			}
		}
		else
		{
			jQuery(value).removeClass("active-cat");
			jQuery(value).children( ".active-arrow" ).remove();
		}
	});
	var htmldata = jQuery(ref).children(".child-category").html();
	var datcls = jQuery(ref).attr("data-class");
	var datid = jQuery(ref).attr("data-id");
	jQuery(".child_content_wpr").each(function(index, element) {
		if(jQuery(this).attr("data-id") == datcls)
		{
			var dspl = jQuery(this).css("display");
			if(dspl == "block")
			{
				if(jQuery(this).attr("data-class") == datid)
				{
					jQuery(this).slideUp("slow");
					jQuery(this).parent(".snglctwpr").height("auto");
				}
				else
				{
					jQuery(this).html("");
					jQuery(this).slideUp("slow");
					jQuery(this).html(htmldata);
					jQuery(this).attr("data-class", datid);
					jQuery(this).slideDown("slow");

					var hght_upr = jQuery(ref).height();
					var hght_lwr = jQuery(ref).children(".child-category").attr("data-height");
					var ttl_hght = parseInt(hght_upr) + parseInt(hght_lwr) + parseInt(80);
					jQuery(ref).parent(".snglctwpr").height(ttl_hght);
				}
			}
			else
			{
				jQuery(this).html(htmldata);
				jQuery(this).attr("data-class", datid);
				jQuery(this).slideDown("slow");

				var hght_upr = jQuery(ref).height();
				var hght_lwr = jQuery(ref).children(".child-category").attr("data-height");
				var ttl_hght = parseInt(hght_upr) + parseInt(hght_lwr) + parseInt(80);
				jQuery(ref).parent(".snglctwpr").height(ttl_hght);
			}

		}
		else
		{
			jQuery(this).slideUp("slow");
			jQuery(this).parent(".snglctwpr").height("auto");
		}
	});

}

function togglenavigation_mobile(ref)
{
	var dspl = jQuery(ref).next(".child-category-mobile").css("display");
	jQuery(".cat-div-mobile").each(function(){
		jQuery(this).next(".child-category-mobile").slideUp("slow");
		jQuery(this).removeClass("child_mobileactive");
	});
	if(dspl == 'none')
	{
		jQuery(ref).next(".child-category-mobile").slideDown("slow");
		jQuery(ref).addClass("child_mobileactive");
	}
	else
	{
		jQuery(ref).next(".child-category-mobile").slideUp("slow");
		jQuery(ref).removeClass("child_mobileactive");
	}
}

function changeonhover(ref)
{
	var img = jQuery(ref).attr("data-hoverimg")
	jQuery(ref).addClass("change_mouseover");
	jQuery(ref).children(".cat-icn").css("background", "url("+img+") no-repeat scroll center center transparent");
}

function changeonout(ref)
{
	var img = jQuery(ref).attr("data-normalimg")
	jQuery(ref).removeClass("change_mouseover");
	/*jQuery(".cat-div").each(function(){
		jQuery(this).removeClass("change_mouseover");
	});*/
	jQuery(ref).children(".cat-icn").css("background", "url("+img+") no-repeat scroll center center transparent");
}

//tab functionality at single resource page
function rsrc_tabs(ref)
{
	var dataid = jQuery(ref).attr("data-id");
	var arrClass = [ "tags", "alignedStandards", "keyword", "moreLikeThis" ];
	jQuery.each( arrClass, function( index, value )
	{
	  if(value == dataid)
	  {
		jQuery( "." + value ).css("display", "block");
	  }
	  else
	  {
		jQuery( "." + value ).css("display", "none");
	  }
	});
}

function load_onScroll(ref)
{
	var path = jQuery(ref).attr("file-path");
	var dataId = jQuery(ref).attr("data-id");

	if(jQuery(ref).scrollTop() >= 15)
	{
		jQuery.ajax({
			type: "POST",
			url: path,
			data: "termid="+dataId+"&task=dataScroll",
			success: function (res)
			{
           		jQuery(ref).html(res);
        	}
        });
	}
}
function collapse(ref)
{
	jQuery(".category_sidebar").slideToggle(500, function () {
        jQuery(ref).text(function () {
            return jQuery(ref).is(":visible") ? "Collapse" : "Expand";
        });
    });
}
// Slide Toggole in Subject Button
function tglcategories(ref)
{
	if(jQuery(ref).hasClass("open"))
	{
		jQuery(ref).removeClass("open")
	}
	else
	{
		jQuery(ref).addClass("open")
	}
    jQuery(".category_sidebar").slideToggle("slow");
}
