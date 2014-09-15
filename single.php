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
						
						<div class="entry-content">
							<img src="<?php echo $image; ?>" class="blg_featureimg" />
                            <h1><a href=""><?php echo $title; ?></a></h1>
							
							<p><i>Disclaimer: The U.S. Department of Education does not mandate or prescribe particular curricula or lesson plans. This information is provided for the visitor's convenience and is included here as an example of the many resources that parents and educators may find helpful and use at their option. See the <a href="<?php echo site_url(); ?>/disclaimer/" target="_blank">full FREE disclaimer</a></i>.</p>
							
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