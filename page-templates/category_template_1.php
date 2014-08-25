<?php
/*
 * Template Name: Category Template One
 */
get_header();
?>
<div class="category_sidebar">
	<?php
	echo '<ul class="category">';
			$args = array('hide_empty' => 0, 'taxonomy' => 'resource-category', 'parent' => 0);
			$categories= get_categories($args);
			foreach($categories as $category)
			{
				$children = get_term_children($category->term_id, 'resource-category');
				if( !empty( $children ) )
				{
					echo '<li class="sub-category has-child" id="'.$category->term_id.'"><span onclick="toggleparent(this);"><a href="'. site_url() .'/'. $category->slug .'" title="'. $category->name .'" >'. $category->name .'</a></span>';
				}
				else
				{
					echo '<li class="sub-category" id="'.$category->term_id.'"><span onclick="toggleparent(this);"><a href="'. site_url() .'/'. $category->slug .'"  title="'. $category->name .'" >'. $category->name .'</a></span>';
				}
				echo get_category_child( $category->term_id);
				echo '</li>';
			}
	echo '</ul>';
	?>
</div>

<div class="rightcatcntr">
	
	<div class="pgbrdcrums">
		<ul>
			<li><img src="<?php echo site_url();?>/wp-content/uploads/2014/08/msc-brdcrmb-icn.png" /></li>
			<li><?php echo get_the_title(); ?></li>
		</ul>	
	</div>
	
	<div class="right_featuredwpr">
		<div class="ftrdttl">Featured Resources</div>
		<?php
        $args = array(
            'meta_key' => 'oer_highlight',
            'meta_value' => 1,
            'post_type' => 'resource',
            'posts_per_page' => -1,
			'tax_query' => array(array('taxonomy' => 'resource-category','terms' => array(84)))
        );
        $posts = get_posts($args);
        ?>
        <ul class="featuredwpr_bxslider">
        	<?php
			$timthumb = get_template_directory_uri().'/lib/timthumb.php';
            foreach($posts as $post)
			{
				$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				$title =  $post->post_title;
				$content =  $post->post_content;
				$content = substr($content, 0, 40);
			?>
          		<li>
                	<div class="frtdsnglwpr">
                    	<?php
                        if(!empty($image)){?>
                    	<div class="img"><img src="<?php echo $timthumb.'?src='.$image.'&w=220&h=180&zc=0';?>"></div>
                        <?php }?>
                        <div class="ttl"><a href="<?php echo get_permalink($post->ID);?>"><?php echo $title;?></a></div>
                        <div class="desc"><?php echo $content; ?></div>
                    </div>
                </li>
        	<?php
			}
			wp_reset_postdata();
			?>
        </ul>

    </div>
    
    <div class="allftrdrsrc">
    	<div class="snglrsrchdng">Featured</div>
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
    </div>
    
	<div class="allftrdpst">
		<?php 
			 $postid = get_the_ID();
			 echo $rslt = get_post_meta($postid, "enhance_page_content", true);
			?>
	</div>
	
    <div class="allftrdpst">
    	<div class="alltrdpsthdng">Educator Resource Spotlight</div>
        <div class="inrftrdpstwpr">
        	<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => -1,
				'category' => 84
			);
			$posts = get_posts($args);
			?>
            
            <ul class="allftrdpst_slider">
        	<?php
			$timthumb = get_template_directory_uri().'/lib/timthumb.php';
            foreach($posts as $post)
			{
				$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				$title =  $post->post_title;
				$content =  $post->post_content;
				$content = substr($content, 0, 250);
			?>
          		<li>
                	<div class="allftrdsngl">
                    	<?php
                        if(!empty($image)){?>
                    	<div class="pstimg"><img src="<?php echo $timthumb.'?src='.$image.'&w=220&h=180&zc=0';?>"></div>
                        <?php }?>
                        <div class="psttl"><?php echo $title;?></div>
                        <div class="pstdesc"><?php echo $content; ?></div>
                        <div class="pstrdmr"><a href="<?php echo get_permalink($post->ID);?>">More</a></div>
                        <div class="pstmta">
                        	<span class="date-icn"><?php echo get_the_time( 'F j, Y', $post->ID );?></span>
                            <span class="time-icn"><?php echo  date('H:i', get_post_time( 'U', true));?></span>
                        </div>
                    </div>
                </li>
        	<?php
			}
			wp_reset_postdata();
			?>
        </ul>
            
            
        </div>
    </div>
    
</div>


<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>