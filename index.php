<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	<div class="cntnr">
        <div id="primary" class="site-content">
           <?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$search_query = array(
					'posts_per_page' => '10',
					'paged' => $paged,
					);
				$wp_query = new WP_Query($search_query);
			?>

            <div id="content" role="main">
                <?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();

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
                        <div class="oer-feature-image">
                        	<?php if(!empty($image)){?>
                            <img width="150" height="150" class="attachment-thumbnail wp-post-image" src="<?php echo $image;?>">
                            <?php } ?>
                        </div>
                        <div class="rght-sd-cntnr-blg">
                            <h2>
                                <a rel="bookmark" href="<?php echo $permalink;?>"><?php echo $title;?></a><br>
                            </h2>
                            <!---->
                            <div class="oer-post-content">
                                <?php echo $excerpt;?>
                            </div>
                            <div class="oer_rdmor">
                            	<a href="<?php echo $permalink;?>">Full Article →</a>
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
                <?php endwhile; ?><?php else : ?>
                    <p class="notfoundtext">Sorry, nothing came back matching what you searched. Try again?</p>
                <?php endif; ?>

                <div class="oer_paginate">
					<?php pagination(); ?>
                </div>

            </div>
        </div><!-- #primary -->
	</div>
<?php get_footer(); ?>
