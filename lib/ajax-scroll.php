<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once($parse_uri[0].'/wp-load.php');
global $wpdb;
if($_REQUEST["task"] == 'dataScroll')
{
	$args = array(
					'post_type' => 'resource',
					'posts_per_page' => -1,
					'tax_query' => array(array('taxonomy' => 'resource-category','terms' => array($_REQUEST["termid"])))
				);
	$posts = get_posts($args);
	foreach($posts as $post)
	{
		$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		$title =  $post->post_title;
		$content =  $post->post_content;
		$content = substr($content, 0, 180);
	?>
		<div class="snglrsrc">
			 <?php if(!empty($image)){
				$new_image = wft_resize_image( $image, 80, 60, true );
			?>
				<div class="snglimglft"><img src="<?php echo $new_image;?>" alt="<?php echo $title;?>"></div>
			<?php }
			else
			{
				$dfltimg = site_url().'/wp-content/plugins/OpenEducationalResource/images/default-icon.png';
				$default_image = wft_resize_image( $dfltimg, 80, 60, true );
				echo '<a href="'.get_permalink($post->ID).'"><div class="snglimglft"><img src="'.$default_image.'" alt="'.$title.'"></div></a>';
			}
			?>
			<div class="snglttldscrght <?php if(empty($image)){ echo 'snglttldscrghtfull';}?>">
				<div class="ttl"><a href="<?php echo get_permalink($post->ID);?>"><?php echo $title;?></a></div>
				<div class="desc"><?php echo $content; ?></div>
			</div>
		</div>
	<?php
	}
}
?>