<?php
/**
 * The Template for displaying all single resource
 */
$timthumb = get_template_directory_uri()."/lib/timthumb.php";
get_header(); ?>
	<div class="cntnr">
        <div id="sngl-resource" class="sngl_resource_wrapper">
                <?php global $post; global $wpdb; ?>
                
				<div class="rsrclftcntr-img">
                    <!--Resource URL-->
                    <div class="sngl-rsrc-url">
                        <a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a>
                    </div>
                   
                    <!--Resource Image-->
                    <div class="sngl-rsrc-img">
                        <a class="featureimg" href="<?php echo get_post_meta($post->ID, "oer_resourceurl", true)?>" target="_blank" >
					<?php
                    	$img_url = wp_get_attachment_url(get_post_meta( $post->ID, "_thumbnail_id" , true));
						if(!empty($img_url))
						{
					      echo '<img src="'.$timthumb.'?src='.$img_url.'&w=528&h=455&zc=0" alt="'.get_the_title().'"/>';
                        }
						else
						{
							$dfltimg = site_url().'/wp-content/plugins/OpenEducationalResource/images/default-icon.png';
							echo '<img src="'.$timthumb.'?src='.$dfltimg.'&w=528&h=455&zc=0" alt="'.get_the_title().'"/>';
						}
						?>
                    	</a>
                        <a class="rsrcurl" href="<?php echo get_post_meta($post->ID, "oer_resourceurl", true); ?>" target="_blank" >
                            <?php echo get_post_meta($post->ID, "oer_resourceurl", true); ?>
                        </a>	
                    </div>

              </div>
              
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
									$parent[] = get_parent_term($term->term_id);
								}
								else
								{
									echo '<a href="'.site_url().'/'.$term->slug.'">'.ucwords ($term->name).'</a>';
								}	
							}
							
							if(!empty($parent) && array_filter($parent))	
							{
								$recur_multi_dimen_arr_obj =  new RecursiveArrayIterator($parent);
								$recur_flat_arr_obj =  new RecursiveIteratorIterator($recur_multi_dimen_arr_obj);
								$flat_arr = iterator_to_array($recur_flat_arr_obj, false);
											
								$flat_arr = array_values(array_unique($flat_arr));
								for($k=0; $k < count($flat_arr); $k++)
								{
									$idObj = get_category_by_slug($flat_arr[$k]);
									if(!empty($idObj->name))
									echo '<a href="'.site_url().'/'.$idObj->slug.'">'.ucwords ($idObj->name).'</a>';
								}
							}
						}	
						?>
                    </div>
					
                    <!--Resource Description-->
					<?php if(!empty($post->post_content)) {?>
						<div class="sngl-rsrc-dscrptn">
							<h1>Description</h1>
							<?php echo $post->post_content; ?>
						</div>
					<?php } ?>
					                    
                    <div id="" class="authorName cbxl">
						<?php 
							$oer_authorname = get_post_meta($post->ID, "oer_authorname", true);
							$oer_authorurl = get_post_meta($post->ID, "oer_authorurl", true);
							
							if(!empty($oer_authorname) && !empty($oer_authorurl))
							{
							?>
								<h3>Creator:</h3>
								<div class="view"><a href="<?php echo $oer_authorurl; ?>" target="_blank"><?php echo $oer_authorname; ?></a></div>
							<?php } ?>	
                    </div>
                    <div id="" class="publisherName cbxl">
                        <?php 
							$oer_publishername = get_post_meta($post->ID, "oer_publishername", true);
							$oer_publisherurl = get_post_meta($post->ID, "oer_publisherurl", true);
							
							if(!empty($oer_publishername) && !empty($oer_publisherurl))
							{
							?>
								<h3>Publisher:</h3>
								<div class="view"><a href="<?php echo $oer_publisherurl; ?>" target="_blank"><?php echo $oer_publishername; ?></a></div>
							<?php } ?>	
					</div>
                    <div id="" class="mediaType cbxl">
						<?php
							$oer_mediatype = get_post_meta($post->ID, "oer_mediatype", true);
							if(!empty($oer_mediatype))
							{ ?>
								<h3>Type:</h3>
								<div class="view"><?php echo ucwords($oer_mediatype); ?></div>
						<?php } ?>		
                    </div>
					<?php 
						$grades =  trim(get_post_meta($post->ID, "oer_grade", true),",");
						$grades = explode(",",$grades);
						
						if(is_array($grades) && !empty($grades) && array_filter($grades))
						{
					?>	
						<div class="rsrcgrd cbxl">
							<h3>Grades:</h3>
							<div class="view">
                        	<?php
									sort($grades);
								
									for($x=0; $x < count($grades); $x++)
									{
									  $grades[$x];
									}
									$fltrarr = array_filter($grades, 'strlen');
									
									$flag = array();
									$elmnt = $fltrarr[min(array_keys($fltrarr))]; 
									for($i =0; $i < count($fltrarr); $i++)
									{
										if($elmnt == $fltrarr[$i])
										{
											$flag[] = 1;
										}
										else
										{
											$flag[] = 0;
										}
										$elmnt++;
									}
									
									if(in_array('0',$flag))
									{
										echo implode(",",array_unique($fltrarr));
									}
									else
									{
										echo $fltrarr[0]."-".$fltrarr[end(array_keys($fltrarr))];
									}
							?>
                        </div>
                    </div>
					<?php }?>
					
					<?php 
						$oer_datecreated = get_post_meta($post->ID, "oer_datecreated", true);
						if(!empty($oer_datecreated))
						{
						?>
                    <div class="created cbxl">
                        <h3>Created:</h3>
                        <div class="view"><?php echo $oer_datecreated; ?></div>
                    </div>
					<?php } ?>
					
					<?php
						$keywords = wp_get_post_tags($post->ID);
						if(!empty($keywords))
						{
					?>
							<div class="rsrckeyword">
								<h3>Keywords</h3>
								<div class="meta_container">
							   <?php
									foreach($keywords as $keyword)
									{
										echo "<span><a href='".get_tag_link($keyword->term_id)."'>".ucwords($keyword->name)."</a></span>";
									}
								?>
								</div>
							</div>
					<?php } ?>		
                    
                    
                    <!--Resource Meta Data-->
                    <div class="sngl-rsrc-meta">
                        <!-- Meta Data Navigation Tab-->
                        <!--<div class="tabNavigator">
                         <a href="javascript:" data-id="tags" title="Metadata Tags" onclick="rsrc_tabs(this);">1</a>
                         <a href="javascript:" data-id="alignedStandards" title="Aligned Standards" onclick="rsrc_tabs(this);"><?php //echo count($stnd_arr);?></a>
                         <a href="javascript:" data-id="keyword" title="Keywords" onclick="rsrc_tabs(this);"><?php //echo count($keywords); ?></a>
                         <a href="javascript:" data-id="moreLikeThis" title="More Like This" onclick="rsrc_tabs(this);"><?php //echo $count; ?></a>
                       </div>-->
                       
                       <!-- Meta Data Navigation Tab Tags-->
                       <!--<div class="tags">
                            <h3>Tags</h3>
                            <div class="meta_container">
                                <div id="resourceType" class="cbxl">
                                    <h3>Resource Type</h3>
                                    <div class="view"><?php //echo get_post_meta($post->ID, "oer_lrtype", true); ?></div>
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
								
                                /*$tags = wp_get_post_tags($post->ID);
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
                                        while ($my_query->have_posts()) : $my_query->the_post(); */?>
                                            <div class="sngl-rltd-rsrc">
                                                <div class="sngl-rltd-rsrc-title">
                                                    <a href="<?php //the_permalink() ?>" rel="bookmark" title="<?php //the_title_attribute(); ?>"><?php //the_title(); ?></a>
                                                </div>
                                                <div class="sngl-rltd-rsrc-description">
                                                    <?php //echo the_content(); ?> 
                                                </div>
                                                <div class="sngl-rltd-rsrc-img">
                                                    <?php //$img_url = wp_get_attachment_url(get_post_meta( //$post->ID, "_thumbnail_id" , true)); ?>
                                                    <img src="<?php //echo $img_url;?>" alt="<?php //the_title();?>"/>
                                                </div>
                                            </div>	
                                          <?php
                                        /*endwhile;
                                      }
                                      else
                                      {
                                        echo "No Resource Found Like This!!";
                                      }
                                }
                                else
                                {
                                    echo "No Resource Found Like This!!";
                                }*/
                            ?>
                            </div>
                       </div>-->
                    </div>
                </div> <!--Description & Resource Info at Right-->
                
                <div class="rsrclftcntr">
                    
					<?php 
						
						$stdrd_id = get_post_meta($post->ID, 'oer_standard_alignment', true);
						$oer_standard = get_post_meta($post->ID, 'oer_standard', true);
						
						if(!empty($stdrd_id) || !empty($oer_standard))
						{
					?>			
                    	<div class="alignedStandards">
                            <h3>Standards</h3>
                            <div class="meta_container">
                                <div class="stndrd_align">
                                <?php 
                                    if(!empty($stdrd_id))
                                    {
										echo "<h3>Standard Alignment</h3>";
                                        $res = $wpdb->get_row("select standard_name from oer_core_standards where id='$stdrd_id'", ARRAY_A);
                                        echo "<div class='stndrd_ttl'>".$res['standard_name']."</div>";
                                    }	
                                    ?>
                                </div>
                                <div class="stndrds_notn">
                                    <?php
                                        if(!empty($oer_standard))
                                        {
                                            echo "<h3>Standard Notations</h3>";
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
                                    ?>
                                </div>	
                            </div>
                       </div>
					<?php } ?>   
                </div> <!--Thumbnail & Standards Info at Left-->
                
        
        </div><!-- .single resource wrapper -->
	</div>
<?php get_footer(); ?>