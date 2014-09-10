<?php
/**
 * The Template for displaying all single resource
 */

get_header(); ?>
	<div class="cntnr">
        <div id="sngl-resource" class="sngl_resource_wrapper">
                <?php global $post; global $wpdb; ?>
                
                <div class="rsrclftcntr">
                    <!--Resource URL-->
                    <div class="sngl-rsrc-url">
                        <a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a>
                    </div>
                    
                    <!--Resource Image-->
                    <div class="sngl-rsrc-img">
                        <?php $img_url = wp_get_attachment_url(get_post_meta( $post->ID, "_thumbnail_id" , true)); ?>
                        <a class="featureimg" href="<?php echo get_post_meta($post->ID, "oer_resourceurl", true)?>" target="_blank" >
                            <?php
                            if(!empty($img_url))
							{
							?>
                            	<img src="<?php echo $img_url;?>" alt="<?php echo the_title(); ?>"/>
                        	<?php
							}
							?>
                        </a>
                        <a class="rsrcurl" href="<?php echo get_post_meta($post->ID, "oer_resourceurl", true); ?>" target="_blank" >
                            <?php echo get_post_meta($post->ID, "oer_resourceurl", true); ?>
                        </a>	
                    </div>
                    
                    <div class="alignedStandards">
                            <h3>Standards</h3>
                            <div class="meta_container">
                                <div class="stndrd_align">
                                    <h3>Standard Alignment</h3>
                                <?php 
                                    $stdrd_id = get_post_meta($post->ID, 'oer_standard_alignment', true);
                                    if(!empty($stdrd_id))
                                    {
                                        $res = $wpdb->get_row("select standard_name from oer_core_standards where id='$stdrd_id'", ARRAY_A);
                                        echo "<div class='stndrd_ttl'>".$res['standard_name']."</div>";
                                    }	
                                    ?>
                                </div>
                                <div class="stndrds_notn">
                                    <h3>Standard Notations</h3>
                                    <?php
                                        $oer_standard = get_post_meta($post->ID, 'oer_standard', true);
                                        if(!empty($oer_standard))
                                        {
                                            $stnd_arr = explode(",", $oer_standard);
                                            for($i=0; $i< count($stnd_arr); $i++)
                                            {
                                                $table = explode("-",$stnd_arr[$i]);
                                                $table_name = $table[0];
                                                $id = $table[1];
                                                if(strcmp($table_name, 'oer_standard_notation') == 0)
                                                {
                                                    $res = $wpdb->get_row("select * from $table_name where id='$id'", ARRAY_A);
                                                    echo "<div class='sngl_stndrd'>";
                                                    echo "<div class='sngl_notation'>".$res['standard_notation']."</div>";
                                                    echo "<div class='sngl_description'>".$res['description']."</div>";
                                                    echo "</div>";
                                                }
                                            }
                                        }
                                        else
                                        {
                                            echo "Standards are not defined !";
                                        }
                                    ?>
                                </div>	
                            </div>
                       </div>
                </div> <!--Thumbnail & Standards Info at Left-->
				
				<div class="rsrcrghtcntr">
                	<div class="rsrcctgries">
                    	<?php
                        $post_terms = get_the_terms( $post->ID, 'resource-category' );
						if(!empty($post_terms))
						{
							foreach($post_terms as $term)
							{
								if($term->parent != 0)
								{
									$parent = get_parent_term($term->term_id);
									for($k=0; $k < count($parent); $k++)
									{
										$idObj = get_category_by_slug($parent[$k]);
										if(!empty($idObj->name))
										echo '<a href="'.site_url().'/'.$idObj->slug.'">'.ucwords ($idObj->name).'</a>';
									}
								}	
							}
						}	
						?>
                    </div>
                    <!--Resource Description-->
                    <div class="sngl-rsrc-dscrptn">
                        <h1>Description</h1>
                        <?php echo $post->post_content; ?>
                    </div>
                    
                    <div id="" class="authorName cbxl">
                        <h3>Creator:</h3>
                        <div class="view"><a href="<?php echo get_post_meta($post->ID, "oer_authorurl", true); ?>" target="_blank"><?php echo get_post_meta($post->ID, "oer_authorname", true); ?></a></div>
                    </div>
                    <div id="" class="publisherName cbxl">
                        <h3>Publisher:</h3>
                        <div class="view"><a href="<?php echo get_post_meta($post->ID, "oer_publisherurl", true); ?>" target="_blank"><?php echo get_post_meta($post->ID, "oer_publishername", true); ?></a></div>
                    </div>
                    <div id="" class="mediaType cbxl">
                        <h3>Type:</h3>
                        <div class="view"><?php echo get_post_meta($post->ID, "oer_mediatype", true); ?></div>
                    </div>
                    <div class="rsrcgrd cbxl">
                    	<h3>Grades:</h3>
                        <div class="view">
                        	<?php echo get_post_meta($post->ID, "oer_grade", true);?>
                        </div>
                    </div>
                    <div class="created cbxl">
                        <h3>Created:</h3>
                        <div class="view"><?php echo get_post_meta($post->ID, "oer_datecreated", true); ?></div>
                    </div>
                    <?php ?>
                    <div class="rsrckeyword">
                            <h3>Keywords</h3>
                            <div class="meta_container">
                            <?php
                                $keywords = wp_get_post_tags($post->ID);
                                if(!empty($keywords))
                                {
                                    foreach($keywords as $keyword)
                                    {
                                        echo "<span><a href='".get_tag_link($keyword->term_id)."'>".$keyword->name."</a></span>";
                                    }
                                }
                                else
                                {
                                    echo "No Keywords Are Defined!!";
                                }
                            ?>
                            </div>
                       </div>
                    
                    
                    <!--Resource Meta Data-->
                    <div class="sngl-rsrc-meta">
                        <!-- Meta Data Navigation Tab-->
                        <!--<div class="tabNavigator">
                         <a href="javascript:" data-id="tags" title="Metadata Tags" onclick="rsrc_tabs(this);">1</a>
                         <a href="javascript:" data-id="alignedStandards" title="Aligned Standards" onclick="rsrc_tabs(this);"><?php echo count($stnd_arr);?></a>
                         <a href="javascript:" data-id="keyword" title="Keywords" onclick="rsrc_tabs(this);"><?php echo count($keywords); ?></a>
                         <a href="javascript:" data-id="moreLikeThis" title="More Like This" onclick="rsrc_tabs(this);"><?php echo $count; ?></a>
                       </div>-->
                       
                       <!-- Meta Data Navigation Tab Tags-->
                       <!--<div class="tags">
                            <h3>Tags</h3>
                            <div class="meta_container">
                                <div id="resourceType" class="cbxl">
                                    <h3>Resource Type</h3>
                                    <div class="view"><?php echo get_post_meta($post->ID, "oer_lrtype", true); ?></div>
                                </div>
                                
                                <div id="language" class="cbxl">
                                    <h3>Language</h3>
                                    <div class="view">English</div>
                                </div>
                            </div>
                       </div>-->

                       <!-- Meta Data Navigation Tab Related Post-->
                       <!--<div class="moreLikeThis" style="display: none;" >
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
                       </div>-->
                    </div>
                </div> <!--Description & Resource Info at Right-->
        
        </div><!-- .single resource wrapper -->
	</div>
<?php get_footer(); ?>