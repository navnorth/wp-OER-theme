<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Twelve already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
<div class="cntnr">
	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
					else :
						_e( 'Archives', 'twentytwelve' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="oer_blgpst">

                    <?php if ( has_post_thumbnail() ) {?>
						<div class="oer-feature-image">
						<?php if ( ! post_password_required() && ! is_attachment() ) :
							the_post_thumbnail("thumbnail");
						endif; ?>
						</div>
					<?php }?>

                    <div class="rght-sd-cntnr-blg">
                        <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                        <div class="small"><span><?php the_time('F jS, Y'); ?> </span></div>

                        <div class="oer-post-content">
                            <?php the_excerpt(); ?>
                        </div>
					</div>
				</div>
		 <?php endwhile; ?>

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->
</div>
<?php get_footer(); ?>
