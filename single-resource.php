<?php
/**
 * The Template for displaying all single resource
 */

get_header(); ?>
	<div class="cntnr">
        <div id="sngl-resource" class="sngl_resource_wrapper">
                <?php global $post; ?>
                
                <!--Resource URL-->
                <div class="sngl-rsrc-url">
                    <a href="<?php echo get_post_meta($post->ID, "oer_resourceurl", true); ?>" target="_blank" >
                        <?php echo get_post_meta($post->ID, "oer_resourceurl", true); ?>
                    </a>
                </div>
                
                <!--Resource Image-->
                <div class="sngl-rsrc-img">
                    
                    <?php $img_url = wp_get_attachment_url(get_post_meta( $post->ID, "_thumbnail_id" , true)); ?>
                    <a href="<?php echo get_post_meta($post->ID, "oer_resourceurl", true)?>" target="_blank" >
                        <img src="<?php echo $img_url;?>" alt="<?php echo the_title(); ?>"/>
                    </a>	
                    <div id="criticalInfo">
                        <div id="created">
                            <b>Created:</b>
                            <span><?php echo get_post_meta($post->ID, "oer_datecreated", true); ?></span>
                        </div>
                    </div>
                    
                </div>
                
                <!--Resource Description-->
                <div class="sngl-rsrc-dscrptn">
                    <h1>Description</h1>
                    <?php echo $post->post_content; ?>
                </div>
                
                <!--Resource Meta Data-->
                <div class="sngl-rsrc-meta">
                    <!-- Meta Data Navigation Tab-->
                    <div class="tabNavigator">
                          <a href="javascript:" data-id="tags" title="Metadata Tags" onclick="rsrc_tabs(this);">1</a>
                          <a href="javascript:" data-id="alignedStandards" title="Aligned Standards" onclick="rsrc_tabs(this);">2</a>
                          <a href="javascript:" data-id="keyword" title="Keywords" onclick="rsrc_tabs(this);">3</a>
                          <a href="javascript:" data-id="moreLikeThis" title="More Like This" onclick="rsrc_tabs(this);">1</a>
                   </div>
                   
                   <!-- Meta Data Navigation Tab Tags-->
                   <div class="tags">
                        <h3>Tags</h3>
                        <div class="meta_container">
                            <div id="resourceType" class="cbxl">
                                <h3>Resource Type</h3>
                                <div class="view"><?php echo get_post_meta($post->ID, "oer_lrtype", true); ?></div>
                            </div>
                            <div id="mediaType" class="cbxl">
                                <h3>Media Type</h3>
                                <div class="view"><?php echo get_post_meta($post->ID, "oer_mediatype", true); ?></div>
                            </div>
                            <div id="language" class="cbxl">
                                <h3>Language</h3>
                                <div class="view">English</div>
                            </div>
                            <div id="authorName" class="cbxl">
                                <h3>Creator</h3>
                                <div class="view"><?php echo get_post_meta($post->ID, "oer_authorname", true); ?></div>
                            </div>
                            <div id="publisherName" class="cbxl">
                                <h3>Publisher</h3>
                                <div class="view"><?php echo get_post_meta($post->ID, "oer_publishername", true); ?></div>
                            </div>
                        </div>
                   </div>
                   
                   <!-- Meta Data Navigation Standard-->
                   <div class="alignedStandards" style="display: none;">
                        <h3>Aligned Standards</h3>
                        <div class="meta_container">
                            <?php echo get_post_meta($post->ID, "oer_datecreated", true); ?>
                        </div>
                   </div>
                   
                   <!-- Meta Data Navigation Keyword-->
                   <div class="keyword" style="display: none;">
                        <h3>Keywords</h3>
                        <div class="meta_container">
                        <?php
                            $keywords = wp_get_post_tags($post->ID);
                            if(!empty($keywords))
                            {
                                foreach($keywords as $keyword)
                                {
                                    echo "<span>".$keyword->name."</span>";
                                }
                            }
                            else
                            {
                                echo "No Keywords Are Defined!!";
                            }
                        ?>
                        </div>
                   </div>
                   
                   <!-- Meta Data Navigation Tab Related Post-->
                   <div class="moreLikeThis" style="display: none;" >
                        <h3>More Like This</h3>
                        <div class="meta_container">
                        <?php
                            $tags = wp_get_post_tags($post->ID);
                            if ($tags)
                            {
                                  $tag_ids = array();
                                  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                                
                                  $args=array(
                                    'tag__in' 		=> $tag_ids,
                                    'post__not_in' 	=> array($post->ID),
                                    'showposts'		=> -1,
                                    'post_type'		=> 'resource',
                                    'ignore_sticky_posts'	=> 1
                                   );
                                
                                  $my_query = new WP_Query($args);
                                
                                  if( $my_query->have_posts() )
                                  {
                                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                        <div class="sngl-rltd-rsrc">
                                            <div class="sngl-rltd-rsrc-title">
                                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </div>
                                            <div class="sngl-rltd-rsrc-description">
                                                <?php echo the_content(); ?> 
                                            </div>
                                            <div class="sngl-rltd-rsrc-img">
                                                <?php $img_url = wp_get_attachment_url(get_post_meta( $post->ID, "_thumbnail_id" , true)); ?>
                                                <img src="<?php echo $img_url;?>" alt="<?php the_title();?>"/>
                                            </div>
                                        </div>	
                                      <?php
                                    endwhile;
                                  }
                                  else
                                  {
                                    echo "No Resource Found Like This!!";
                                  }
                            }
                            else
                            {
                                echo "No Resource Found Like This!!";
                            }
                        ?>
                        </div>
                   </div>
                </div>
        
        </div><!-- .single resource wrapper -->
	</div>
<?php get_footer(); ?>