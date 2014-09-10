<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<div class="cntnr">
	<div id="primary" class="site-content">
		<div id="content" role="main">
            
            <?php
				if ( have_posts() ) : 
					while ( have_posts() ) : the_post(); 
						$id = get_the_ID();

						$image = wp_get_attachment_url( get_post_thumbnail_id($id) );
						$title = get_the_title($id);
						$content = $post->post_content;
						$tag     = wp_get_post_tags($id);
						$date    =  get_the_time('F j, Y', $id); 
						?>
						<!--<div class="entry-header">
							
						</div>-->
						<div class="entry-content">
							<img src="<?php echo $image; ?>" />
                            <h1><a href=""><?php echo $title; ?></a></h1>
							<p><?php echo the_content();?></p> 
                            <span><?php foreach($tag as $tags){ ?> <a href=""> <?php echo $tags->name."" ;?> </a> // <?php }?> <a href=""><?php echo $date ;?></a></span>
						</div>
					<?php
					endwhile; 
				endif;
				?>
            
            

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- cntnr -->

<?php get_footer(); ?>