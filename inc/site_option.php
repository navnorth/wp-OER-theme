<?php
add_action('admin_menu', 'footer_siteoption');
function footer_siteoption()
{
	add_theme_page('Site Options', 'Site Options', 'manage_options', 'ftr-siteoption', 'ftr_siteoption');
}
function ftr_siteoption()
{ 
	if(isset($_POST["save_img_lnk"]))
	{
		update_option('footer_link_first', $_POST["footer_link_first"]);
		update_option('footer_logo_first', $_POST["footer_logo_first"]);
		
		update_option('footer_link_second', $_POST["footer_link_second"]);
		update_option('footer_logo_second', $_POST["footer_logo_second"]);
		
		update_option('footer_link_third', $_POST["footer_link_third"]);
		update_option('footer_logo_third', $_POST["footer_logo_third"]);
		
		update_option('footer_link_fourth', $_POST["footer_link_fourth"]);
		update_option('footer_logo_fourth', $_POST["footer_logo_fourth"]);
	}
?>
<script>
jQuery(document).ready(function() {
	var current_txt ="";
	jQuery(document).on('click', '#upload_footer_image', function()
	{
		current_txt = jQuery(this).attr("data_id");
		if(jQuery(this).attr("title")=="upload")
		{
			tb_show('','media-upload.php?TB_iframe=true');
			return false;
		}
	});
	
	if((window.original_tb_remove == undefined) && (window.tb_remove != undefined))
	{
	  window.original_tb_remove = window.tb_remove;
	  window.tb_remove = function(){
		 window.original_tb_remove();
	  };
	}
   
   window.original_send_to_editor = window.send_to_editor;

   window.send_to_editor = function(htmldata) {
	  var imgurl = jQuery('img',htmldata).attr('src');
	  jQuery("#"+current_txt).val(imgurl);
	  tb_remove();
   }
});
</script>

<style type="text/css">
.sitoptn_wrpr {
    float: left;
    width: 100%;
}
.sitoptn_sub_wrpr {
    float: left;
    width: 100%;
	margin-bottom: 12px;
}
.sitoptn_txt {
    float: left;
    font-size: 14px;
    font-weight: bold;
    margin-top: 6px;
    text-align: left;
    width: 200px;
}
.sitoptn_fld {
    float: left;
    width: 250px;
}
.sitoptn_fld input[type="text"] {
    height: 30px;
    width: 235px;
}
</style>

<form method="post">
	<div class="sitoptn_wrpr">
		<h2> Footer Websites Settings </h2>
		
		<div class="sitoptn_sub_wrpr">	
			<div class="sitoptn_txt">
				Footer Websites First
			</div>
			<div class="sitoptn_fld">
				<input type="text" name="footer_link_first" value=" <?php echo get_option('footer_link_first'); ?> " id="ftr_link_fst" placeholder="Insert Link href" />
			</div>
			<div class="sitoptn_fld">
				<input type="text" name="footer_logo_first" value=" <?php echo get_option('footer_logo_first'); ?> " id="ftr_logo_fst"/>
			</div>
			<div class="sitoptn_fld">
				<a href="javascript:" id="upload_footer_image" title="upload" data_id="ftr_logo_fst" class="button button-primary">Upload</a>
			</div>
		</div>
		
		<div class="sitoptn_sub_wrpr">	
			<div class="sitoptn_txt">
				Footer Websites Second
			</div>
			<div class="sitoptn_fld">
				<input type="text" name="footer_link_second" value=" <?php echo get_option('footer_link_second'); ?> " id="ftr_link_sec" placeholder="Insert Link href" />
			</div>
			<div class="sitoptn_fld">
				<input type="text" name="footer_logo_second" value=" <?php echo get_option('footer_logo_second'); ?> " id="ftr_logo_sec"/>
			</div>
			<div class="sitoptn_fld">
				<a href="javascript:" id="upload_footer_image" title="upload" data_id="ftr_logo_sec" class="button button-primary">Upload</a>
			</div>
		</div>
		
		<div class="sitoptn_sub_wrpr">	
			<div class="sitoptn_txt">
				Footer Websites Third
			</div>
			<div class="sitoptn_fld">
				<input type="text" name="footer_link_third" value=" <?php echo get_option('footer_link_third'); ?> " id="ftr_link_thrd" placeholder="Insert Link href" />
			</div>
			<div class="sitoptn_fld">
				<input type="text" name="footer_logo_third" value=" <?php echo get_option('footer_logo_third'); ?> " id="ftr_logo_thrd"/>
			</div>
			<div class="sitoptn_fld">
				<a href="javascript:" id="upload_footer_image" title="upload" data_id="ftr_logo_thrd" class="button button-primary">Upload</a>
			</div>
		</div>
		
		<div class="sitoptn_sub_wrpr">	
			<div class="sitoptn_txt">
				Footer Websites Fourth
			</div>
			<div class="sitoptn_fld">
				<input type="text" name="footer_link_fourth" value=" <?php echo get_option('footer_link_fourth'); ?> " id="ftr_link_frth" placeholder="Insert Link href" />
			</div>
			<div class="sitoptn_fld">
				<input type="text" name="footer_logo_fourth" value=" <?php echo get_option('footer_logo_fourth'); ?> " id="ftr_logo_frth"/>
			</div>
			<div class="sitoptn_fld">
				<a href="javascript:" id="upload_footer_image" title="upload" data_id="ftr_logo_frth" class="button button-primary">Upload</a>
			</div>
		</div>
	
	</div>
	<input type="submit" name="save_img_lnk" value="Save" class="button button-primary" />
</form>	

<?php
}
?>