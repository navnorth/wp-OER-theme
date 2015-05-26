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
<div class="ftr-wrpr">
	<div class="ftr-inr-wrpr">
    	<div class="ftr-navi-cntnr">
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
        </div>
        <div class="ftr-logos">
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
        	
        </div>
    
    </div>
</div>
</div><!--#main closed-->
</div><!--#page closed-->
<input type="hidden" id="siteurl" value="<?php echo site_url();?>" />
<?php wp_footer(); ?>
</body>
</html>