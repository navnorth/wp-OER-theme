<?php
/**
 * Template Name: Home Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<?php
		$args = array(
			'type'                     => 'post',
			'parent'                   => 0,
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 0,
			'exclude'                  => '',
			'include'                  => '',
			'number'                   => '',
			'taxonomy'                 => 'resource-category',
			'pad_counts'               => false );
			
		$categories = get_categories( $args );
		echo '<div class="ctgry-cntnr">';
		foreach($categories as $category)	
		{
			$getimage = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.'postmeta'."  WHERE meta_key='category_image' AND meta_value='$category->term_id'");
			$getimage_hover = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.'postmeta'."  WHERE meta_key='category_image_hover' AND meta_value='$category->term_id'");
			if(!empty($getimage) || !empty($getimage_hover))
			{
				$attach_icn = get_post($getimage[0]->post_id);
				$attach_icn_hover = get_post($getimage_hover[0]->post_id);
			}
			else
			{
				$attach_icn = array();
				$attach_icn_hover = array();
			}
			
			echo '<div class="cat-div" onMouseOver="changeback(this);">
        			<div class="cat-icn" style="background: url('.$attach_icn->guid.') no-repeat scroll center center; "></div>
           			<div class="cat-txt-btm-cntnr">
						<ul>
							<li> '. $category->name .' <span>'. $category->count .'</span></li>
						</ul>
						
					</div>
       		 	  </div>';
				  
			echo '<div class="cat-div backgou" style="display: none;" onMouseOut="changebackagain(this);">
        			<div class="cat-icn" style="background: url('.$attach_icn_hover->guid.') no-repeat scroll center center; "></div>
           			<div class="cat-txt-btm-cntnr"><ul><li> '. $category->name .' <span>'. $category->count .'</span></li></ul></div>
       		 	  </div>';
				  
		}
		echo '</div>';
	?>
	
	<script type="text/javascript">
		function changeback(ref)
		{
			jQuery(ref).hide();
			jQuery(ref).next(".backgou").show();
		}
		function changebackagain(ref)
		{
			jQuery(ref).hide();
			jQuery(ref).prev(".cat-div").show();
		}
	</script>
    
    <div class="wht-free-cntnr pdng-btm">
    	<?php dynamic_sidebar( 'home_what-free' ); ?>
    </div>
    
	<div class="ftrd-cntnr mrgn-left">
    	<span class="hdng"> - Featured - </span> 
        <ul>
		<?php
			$args = array(
				'meta_key' => 'home_featured_section',
				'meta_value' => 'yes',
				'post_type' => 'post',
				'posts_per_page' => 4
			);
			$posts = get_posts($args);
			
			foreach($posts as $post)
			{
				setup_postdata($post); 
				$feature_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				echo '<li><img src="'. $feature_image .'" alt="List Image"/>'. get_the_title() .' <br />
					  <span class="date-icn">'. get_the_time( 'F j, Y', $post->ID ) .'</span> <span class="time-icn">'. date('H:i', get_post_time( 'U', true)) .'</span></li>';
			}
			wp_reset_postdata();
		?>
		 </ul>
    </div>
	
	<div class="twtr-cntnr">
		<?php dynamic_sidebar( 'home_twitter' ); ?>
    </div>
	
	<div class="ftrd-cntnr mrgn-left">
    	<span class="hdng"> - Featured Resources - </span> 
        <ul>
		<?php
			function limit_words($string, $word_limit)
			{
				$words = explode(" ",$string);
				return implode(" ",array_splice($words,0,$word_limit));
			}
			$args = array(
				'meta_key' => 'home_featured_section',
				'meta_value' => 'yes',
				'post_type' => 'resource',
				'posts_per_page' => 4
			);
			$posts = get_posts($args);
			
			foreach($posts as $post)
			{
				setup_postdata($post); 
				$feature_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				echo '<li><img src="'. $feature_image .'" alt="List Image"/>'. get_the_title() .' <br />
					  <span class="ftrd-rsrcs-mtr">'. limit_words($post->post_content, 10) .'</span></li>';
			}
			wp_reset_postdata();
		?>
        </ul>
    </div>
	
<?php get_footer(); ?>