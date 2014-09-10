<?php
add_action("admin_init", "add_image_metabox");
function add_image_metabox()
{
	add_meta_box('featuredpost', 'Home Page Featured Post', "featuredpost", "post", 'side', 'core');
	add_meta_box('featuredresource', 'Home Page Featured Resource', "featuredresource", "resource", 'side', 'core');
	add_meta_box('enhance_page', 'Text / HTML Widget', "enhance_page", "page", 'advanced', 'core');
}

function enhance_page()
{
	global $post;
	$rslt = get_post_meta($post->ID, "enhance_page_content", true);
	?>
		<div class="meta_fld_wrp">
			<textarea name="enhance_page_content" rows="10" cols="90">
				<?php echo $rslt; ?>
			</textarea>
		</div>
	<?php
}


function featuredpost()
{
	global $post;
	$rslt = get_post_meta($post->ID, "home_featured_section", true);
	?>
		<ul class="meta_fld_wrp">
			<li><input type="radio" <?php if($rslt == 'yes'){ echo 'checked="checked"';} ?> name="home_featured" value="yes" />  Yes </li>
			<li><input type="radio" <?php if($rslt == 'no'){ echo 'checked="checked"';} ?>  name="home_featured" value="no" /> No </li>
		</ul>
	<?php
}

function featuredresource()
{
	global $post;
	$rslt = get_post_meta($post->ID, "home_featured_section", true);
	?>
		<ul class="meta_fld_wrp">
			<li><input type="radio" <?php if($rslt == 'yes'){ echo 'checked="checked"';} ?> name="home_featured" value="yes" />  Yes </li>
			<li><input type="radio" <?php if($rslt == 'no'){ echo 'checked="checked"';} ?>  name="home_featured" value="no" /> No </li>
		</ul>
	<?php
}

add_action('save_post', 'save_featured_metabox'); 
function save_featured_metabox()
{ 
	global $post;
	update_post_meta($post->ID, "home_featured_section", $_POST["home_featured"] );
	update_post_meta($post->ID, "enhance_page_content", $_POST["enhance_page_content"] );
}
?>