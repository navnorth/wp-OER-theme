<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	<!--</div><!-- #main .wrapper 
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<?php //do_action( 'twentytwelve_credits' ); ?>
			<a href="<?php //echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php //esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php //printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
		</div><!-- .site-info 
	</footer><!-- #colophon 
</div><!-- #page -->

<div class="ftr-wrpr">
	<div class="ftr-inr-wrpr">
    	<span class="ftr-navi-cntnr">
        	<?php
			$defaults = array(
				'theme_location'  => '',
				'menu'            => 'Footer-menu',
				'menu_class'      => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'items_wrap'      => '<ul>%3$s</ul>',
				'depth'           => 0);
			
			wp_nav_menu( $defaults );
			?>
        </span>
        <span class="ftr-logos">
        	<ul>
				<?php
					$footer_link_first = get_option('footer_link_first');
					$footer_logo_first = get_option('footer_logo_first');
					
					$footer_link_second = get_option('footer_link_second');
					$footer_logo_second = get_option('footer_logo_second');
					
					$footer_link_third = get_option('footer_link_third');
					$footer_logo_third = get_option('footer_logo_third');
					
					$footer_link_fourth = get_option('footer_link_fourth');
					$footer_logo_fourth = get_option('footer_logo_fourth');
				?>
            	<li><a href="<?php echo $footer_link_first; ?>"><img src="<?php echo $footer_logo_first; ?>" alt="List Image"/></a></li>
                <li><a href="<?php echo $footer_link_second; ?>"><img src="<?php echo $footer_logo_second; ?>" alt="List Image"/></a></li>
                <li><a href="<?php echo $footer_link_third; ?>"><img src="<?php echo $footer_logo_third; ?>" alt="List Image"/></a></li>
                <li><a href="<?php echo $footer_link_fourth; ?>"><img src="<?php echo $footer_logo_fourth; ?>" alt="List Image"/></a></li>
                
            </ul>
        	
        </span>
    
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>