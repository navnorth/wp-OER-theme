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
			jQuery(value).addClass("active-cat");
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
				}
				else
				{
					jQuery(this).html("");
					jQuery(this).slideUp("slow");
					jQuery(this).html(htmldata);
					jQuery(this).attr("data-class", datid);
					jQuery(this).slideDown("slow");
				}	
			}
			else
			{
				jQuery(this).html(htmldata);
				jQuery(this).attr("data-class", datid);
				jQuery(this).slideDown("slow");
			}
		}
		else
		{
			jQuery(this).slideUp("slow");
		}
	});
	
	//changing background
	/*var back_img = jQuery(ref).attr("data-ownback");
	jQuery(".cat-div").each(function(index, element){
		jQuery(this).css("background-image", "none");
	})
	if(jQuery(ref).css("background-image") == "none")
	{
		jQuery(ref).css("background-image", "url("+back_img+")");
	}
	else
	{
		jQuery(this).css("background-image", "none");
	}*/
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