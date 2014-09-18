<?php
/*
 *Template Name: Featured Blog Post
 */
 
 get_header(); 
 
 $args = array(
		'meta_key' => 'home_featured_section',
		'meta_value' => 'yes',
		'post_type' => 'post',
		'posts_per_page' => -1);
		
 $posts = get_posts($args);
?>
<div class="cntnr">
	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php
				if(!empty($posts))
				{
					foreach($posts as $post)
					{
						$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						$permalink = get_permalink($post->ID);
						$date =  get_the_time('F j, Y', $post-ID);
						$title = $post->post_title;
						$excerpt = $post->post_content;
						$excerpt = strip_tags($excerpt);
						$excerpt = substr($excerpt, 0, 400);
						$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
						$tags = wp_get_post_tags($post->ID);
			?>
				<div class="oer_blgpst">
					<a href="<?php echo get_permalink($post->ID);?>">
						<div class="oer-feature-image">
							<img width="150" height="150" class="attachment-thumbnail wp-post-image" src="<?php echo $image;?>">
						</div>
					</a>
					
					<div class="rght-sd-cntnr-blg">
						<h2>
							<a rel="bookmark" href="<?php echo $permalink;?>"><?php echo $title;?></a><br>
						</h2>
						<!---->
						<div class="oer-post-content">
							<?php echo $excerpt;?>
						</div>
						<div class="oer_rdmor">
							<a href="<?php echo $permalink;?>">Full Article ?</a>
						</div>
					</div>
					<div class="oer_entry_meta">
						<div class="oer_pstag">
							<?php 
							$count = count($tags);
							foreach($tags as $tag)
							{
								$count--;
							?>
								<a href="<?php echo get_tag_link($tag->term_id);?>">
									<?php echo $tag->name;?>
								</a>
								<?php
								if($count != 0)
								{
									echo '<span class="sprtr">,</span>';
								}
								?>
							<?php }?>
						<?php
						if(!empty($tags))
						{
						?><span class="sprtr">//</span>
						<?php
						}
						?>
						</div>
						<div class="oer_date">
							<span>
								<?php echo $date;?>
							</span>
						</div>
					</div>
				</div>
			<?php
				}
			}
			?>
		</div>
	</div><!-- #primary -->
</div>
<?php get_footer();?>