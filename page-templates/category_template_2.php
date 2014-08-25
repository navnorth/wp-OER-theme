<?php
/*
 * Template Name: Category Template Two
 */
get_header();
$term = get_the_title();
$rsltdata = get_term_by( "name", $term, "resource-category", ARRAY_A );
?>

<div class="cntnr">
	<div class="category_sidebar">
	<?php
	echo '<ul class="category">';
			$args = array('hide_empty' => 0, 'taxonomy' => 'resource-category', 'parent' => 0);
			$categories= get_categories($args);
			foreach($categories as $category)
			{
				$children = get_term_children($category->term_id, 'resource-category');
				
				if($rsltdata['term_id'] == $category->term_id)
				{
					$class = ' activelist current_class';	
				}
				elseif($rsltdata['parent']  == $category->term_id)
				{
					$class = ' activelist current_class';
				}
				else
				{
					$class = '';
				}
				
				if( !empty( $children ) )
				{
					echo '<li class="sub-category has-child'.$class.'"><span onclick="toggleparent(this);"><a href="'. site_url() .'/'. $category->slug .'" title="'. $category->name .'" >'. $category->name .'</a></span>';
				}
				else
				{
					echo '<li class="sub-category'.$class.'"><span onclick="toggleparent(this);"><a href="'. site_url() .'/'. $category->slug .'"  title="'. $category->name .'" >'. $category->name .'</a></span>';
				}
				echo get_category_child( $category->term_id);
				echo '</li>';
			}
	echo '</ul>';
	?>
</div> <!--Left Sidebar-->

	<div class="rightcatcntr">
	
		<div class="pgbrdcrums">
			<ul>
				<?php
					$timthumb = get_template_directory_uri().'/lib/timthumb.php';
					
					$termid = get_cat_ID( get_the_title() );
					$top_cat = split(':',get_category_parents($termid, FALSE, ':', TRUE));
					$parent = $top_cat[0];
					
					$catobj = get_category_by_slug($parent);
					$getimage = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix.'postmeta'."  WHERE meta_key='category_image' AND meta_value='$catobj->term_id'");
					if(!empty($getimage))
					{
						$attach_icn = get_post($getimage[0]->post_id);
						echo '<li><img src="'. $timthumb.'?src='.$attach_icn->guid.'&w=32&h=32&zc=0" /></li>';
					}
					else
					{
						echo '<li></li>';
					}
					
				?>
				<li>
					<?php
					if(function_exists('yoast_breadcrumb'))
					{
						echo $breadcrumbs = yoast_breadcrumb("","",false);
					} 
					?>
				</li>
			</ul>	
		</div> <!--Breadcrumbs-->
	
		<div class="allftrdpst">
			<?php 
				 $postid = get_the_ID();
				 echo $rslt = get_post_meta($postid, "enhance_page_content", true);
				?>
		</div> <!--Text and HTML Widget-->
		
		<div class="allftrdrsrc">
			<div class="snglrsrchdng">Browse <?php echo get_the_title();?> Resources</div>
			<div class="allftrdrsrccntr">
				<?php
				$args = array(
					'post_type' => 'resource',
					'posts_per_page' => -1,
					'tax_query' => array(array('taxonomy' => 'resource-category','terms' => array(84)))
				);
				$posts = get_posts($args);
				$timthumb = get_template_directory_uri().'/lib/timthumb.php';
				foreach($posts as $post)
				{
					$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					$title =  $post->post_title;
					$content =  $post->post_content;
					$content = substr($content, 0, 180);
				?>
					<div class="snglrsrc">
						 <?php if(!empty($image)){?>
						<div class="snglimglft"><img src="<?php echo $timthumb.'?src='.$image.'&w=80&h=60&zc=0';?>"></div>
						<?php }?>
						<div class="snglttldscrght <?php if(empty($image)){ echo 'snglttldscrghtfull';}?>">
							<div class="ttl"><a href="<?php echo get_permalink($post->ID);?>"><?php echo $title;?></a></div>
							<div class="desc"><?php echo $content; ?></div>
						</div>
					</div>
				<?php
				}
				wp_reset_postdata();
				?>
		   </div>
		</div> <!--Browse By Categories-->
    
	</div>
</div>

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>