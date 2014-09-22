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
<div class="cntnr">
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
		$cnt = 1;
		$lepcnt = 1;
		foreach($categories as $category)	
		{
			$getimage = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.'postmeta'." WHERE meta_key='category_image' AND meta_value='$category->term_id'");
			$getimage_hover = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.'postmeta'." WHERE meta_key='category_image_hover' AND meta_value='$category->term_id'");
			
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
				
			$count = oer_post_count($category->term_id, "resource-category");
			$count = $count + $category->count;
				
			echo '<div class="snglctwpr"><div class="cat-div" data-ownback="'.get_template_directory_uri().'/img/top-arrow.png" onMouseOver="changeonhover(this)" onMouseOut="changeonout(this);" onclick="togglenavigation(this);" data-id="'.$cnt.'" data-class="'.$lepcnt.'" data-normalimg="'.$attach_icn->guid.'" data-hoverimg="'.$attach_icn_hover->guid.'">
				<div class="cat-icn" style="background: url('.$attach_icn->guid.') no-repeat scroll center center; "></div>
				<div class="cat-txt-btm-cntnr">
					<ul>
						<li><label class="mne-sbjct-ttl" ><a href="'. site_url() .'/'. $category->slug .'">'. $category->name .'</a></label><span>'. $count .'</span></li>
					</ul>
				</div>';
				
				$children = get_term_children($category->term_id, 'resource-category');
				if( !empty( $children ) )
				{
					echo '<div class="child-category">'. front_child_category($category->term_id) .'</div>';
				}
			echo '</div>';
			//if(($cnt % 4) == 0){
				echo '<div class="child_content_wpr" data-id="'.$lepcnt.'"></div>';
				$lepcnt++;
			//}
		$cnt++;
		echo '</div>';
		
	}
echo '</div>';
		
		
		
/*echo '<div class="ctgry-cntnr ctgry-cntnr-mobile">';
		$cnt = 1;
		foreach($categories as $category)	
		{
			$getimage = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.'postmeta'." WHERE meta_key='category_image' AND meta_value='$category->term_id'");
			$getimage_hover = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.'postmeta'." WHERE meta_key='category_image_hover' AND meta_value='$category->term_id'");
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
			
			$count = oer_post_count($category->term_id, "resource-category");
			$count = $count + $category->count;
			
			echo '<div class="cat-div cat-div-mobile" onclick="togglenavigation_mobile(this);" data-number="'.$cnt.'" onMouseOver="changeonhover(this)" onMouseOut="changeonout(this);" data-normalimg="'.$attach_icn->guid.'" data-hoverimg="'.$attach_icn_hover->guid.'" >
					<div class="cat-icn cat-icn-mobile" style="background: url('.$attach_icn->guid.') no-repeat scroll center center; "></div>
					<div class="cat-txt-btm-cntnr cat-txt-btm-cntnr-mobile">
						<ul>
							<li><label class="mne-sbjct-ttl" ><a href="'. site_url() .'/'. $category->slug .'">'. $category->name .'</a></label><span>'. $count .'</span></li>
						</ul>
					</div>';
			echo '</div>';
			
			$children = get_term_children($category->term_id, 'resource-category');
			if( !empty( $children ) )
			{
				echo '<div class="child-category child-category-mobile child_content_wpr">'. front_child_category($category->term_id) .'</div>';
			}
			$cnt++;
		}
echo '</div>';*/
	?>
	
	<!--Home What's Free Section-->
    <div class="wht-free-cntnr pdng-btm">
    	<?php dynamic_sidebar( 'home_what-free' ); ?>
    </div>
    
	<!--Home Featured Blog Post Section-->
	<div class="ftrd-cntnr mrgn-left">
    	<a href="<?php echo site_url();?>/featured/"><span class="hdng"> - Featured - </span></a>
        <ul>
		<?php
			$args = array(
				'meta_key' => 'home_featured_section',
				'meta_value' => 'yes',
				'post_type' => 'post',
				'posts_per_page' => 4
			);
			$posts = get_posts($args);
			
			if(!empty($posts))
			{
				foreach($posts as $post)
				{
					setup_postdata($post); 
					$feature_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					echo '<li><a href="'.get_permalink().'">';
					if(!empty($feature_image))
					{
						echo '<img src="'. $feature_image .'" alt="List Image"/><span class="ftrd-ttl-frst" >'. get_the_title() .'</span>';
					}
					else
					{
						echo '<img src="'.site_url().'/wp-content/plugins/OpenEducationalResource/images/default-icon.png" alt="List Image"/><span class="ftrd-ttl-frst" >'. get_the_title() .'</span>';
					}
					echo '<span class="date-icn">'. get_the_time( 'F j, Y', $post->ID ) .'</span></a></li>';
				}
				wp_reset_postdata();
			}
		?>
		 </ul>
    </div>
	
	<!--Home Twitter Feed Section-->
	<div class="twtr-cntnr">
		<?php dynamic_sidebar( 'home_twitter' ); ?>
    </div>
	
	<!--Home Featured Resource Post Section-->
	<div class="ftrd-cntnr mrgn-left">
    	<span class="hdng"> - Highlighted Resources - </span> 
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
			
			if(!empty($posts))
			{
				foreach($posts as $post)
				{
					setup_postdata($post); 
					$feature_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					echo '<li><a href="'.get_permalink().'">';
					if(!empty($feature_image))
					{
						echo '<img src="'. $feature_image .'" alt="List Image"/><span class="ftrd-ttl-frst" >'. get_the_title() .'</span>';
					}
					else
					{
						echo '<img src="'.site_url().'/wp-content/plugins/OpenEducationalResource/images/default-icon.png" alt="List Image"/><span class="ftrd-ttl-frst" >'. get_the_title() .'</span>';
					}
					echo '<span class="ftrd-rsrcs-mtr">'. limit_words($post->post_content, 10) .'</span></a></li>';
				}
				wp_reset_postdata();
			}
		?>
        </ul>
    </div>
</div>
<?php get_footer(); ?>