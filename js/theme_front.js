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
	jQuery(ref).next(".category").toggle();
}