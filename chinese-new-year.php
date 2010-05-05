<?php
/*
Plugin Name:Chinese NewYear
Plugin URI: http://liucheng.name/1169/
Description: Happy New Year! A wordpress Plugin for Chinese New Year.
Author: 柳城
Version: 1.0.1
Author URI: http://liucheng.name/

*/
function chinese_new_year_admininit()
{
	 // Add a page to the options section of the website
   if (current_user_can('manage_options')) 				
 		add_options_page("NewYear","NewYear", 8, __FILE__, 'chinese_new_year_optionpage');
}

function chinese_new_year_topbarmessage($msg)
{
	 echo '<div class="updated fade" id="message"><p>' . $msg . '</p></div>';
}

/**
 * Returns the URL to the directory where the plugin file is located
 * @since 3.0b5
 * @access private
 * @author Arne Brachhold
 * @return string The URL to the plugin directory
 */
if(!function_exists('chinese_new_year_GetPluginUrl')) {
	function chinese_new_year_GetPluginUrl() {
		
		//Try to use WP API if possible, introduced in WP 2.6
		if (function_exists('plugins_url')) return trailingslashit(plugins_url(basename(dirname(__FILE__))));
		
		//Try to find manually... can't work if wp-content was renamed or is redirected
		$path = dirname(__FILE__);
		$path = str_replace("\\","/",$path);
		$path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
		return $path;
	}
}

function update_chinese_new_year_option() {
	if(isset($_POST['action'])) {
		if($_POST[chinese_new_year_enable]){ $chinese_new_year_enable = '1'; }else{ $chinese_new_year_enable = '0'; }
		if($_POST[chinese_new_year_Home]){ $chinese_new_year_Home = '1'; }else{ $chinese_new_year_Home = '0'; }
		if($_POST[chinese_new_year_Post]){ $chinese_new_year_Post = '1'; }else{ $chinese_new_year_Post = '0'; }
		if($_POST[chinese_new_year_Tag]){ $chinese_new_year_Tag = '1'; }else{ $chinese_new_year_Tag = '0'; }
		if($_POST[chinese_new_year_Category]){ $chinese_new_year_Category = '1'; }else{ $chinese_new_year_Category = '0'; }
		if($_POST[chinese_new_year_Page]){ $chinese_new_year_Page = '1'; }else{ $chinese_new_year_Page = '0'; }
		if($_POST[chinese_new_year_Post_id]){ $chinese_new_year_Post_id = $_POST[chinese_new_year_Post_id]; }
		if($_POST[chinese_new_year_cookie]){ $chinese_new_year_cookie = '1'; }else{ $chinese_new_year_cookie = '0'; }
		$update_chinese_new_year_option = implode('|',array($chinese_new_year_enable,$chinese_new_year_Home,$chinese_new_year_Post,$chinese_new_year_Tag,$chinese_new_year_Category,$chinese_new_year_Page,$chinese_new_year_Post_id,$chinese_new_year_cookie));
        update_option(chinese_new_year_option,$update_chinese_new_year_option);
		chinese_new_year_topbarmessage(__('Options saved.'));
	}
}

function chinese_new_year_optionpage() {
      /* Perform any action */
		if(isset($_POST['action'])) {
			if ($_POST['action']=='update') update_chinese_new_year_option(); 
		}
		
		/* Definition */
      echo '<div class="wrap"><div style="background: url('.chinese_new_year_GetPluginUrl().'liucheng_name32.png) no-repeat;" class="icon32"><br /></div>';
		echo '<h2>Chinese NewYear</h2>';

		/* Introduction */ 
		echo '<p>'.__('Happy New Year! A wordpress Plugin for Chinese New Year.','chinese_new_year').'</p>';

		/* Show the options */
		chinese_new_year_show_option();	

		echo '</div>';    
}

function chinese_new_year_show_option(){
   $get_chinese_new_year_option = get_option(chinese_new_year_option);
   if($get_chinese_new_year_option){
	   list($chinese_new_year_enable, $chinese_new_year_Home, $chinese_new_year_Post, $chinese_new_year_Tag, $chinese_new_year_Category, $chinese_new_year_Page, $chinese_new_year_Post_id, $chinese_new_year_cookie) = explode('|',$get_chinese_new_year_option);
   }else{
	   $chinese_new_year_enable = '1';
       $chinese_new_year_Home = '1';
   }
	?>
		<div class="tool-box">
			<h3 class="title"><?php _e('Profile');?></h3>
			<a name="chinese_new_year_option"></a><form name="chinese_new_year_option" method="post" action="">
			<input type="hidden" name="action" value="update" />
			<table>
				<tr><td><label for="chinese_new_year_Enable"><?php _e('Enable');?></label></td><td><input type="checkbox" name="chinese_new_year_enable" value="1" <?php if($chinese_new_year_enable){ echo "checked"; }?> /></td></tr>
				<tr><td><label for="chinese_new_year_cookie"><?php _e('Cookie Control');?></label></td><td><input type="checkbox" name="chinese_new_year_cookie" value="1" <?php if($chinese_new_year_cookie){ echo "checked"; }?> /></td><td><i>Display once!</i></td></tr>
				<tr><td><label for="chinese_new_year_Display"><strong><?php _e('Display In:');?></strong></td></tr>
				<tr><td><label for="chinese_new_year_Home"><?php _e('Home');?></label></td><td><input type="checkbox" name="chinese_new_year_Home" value="1" <?php if($chinese_new_year_Home){ echo "checked"; }?> /></td></tr>
				<tr><td><label for="chinese_new_year_Post"><?php _e('Post');?></label></td><td><input type="checkbox" name="chinese_new_year_Post" value="1" <?php if($chinese_new_year_Post){ echo "checked"; }?> /></td><td><label for="chinese_new_year_Post_id"><?php _e('Post_ID');?></label></td><td><input type="text" name="chinese_new_year_Post_id" value="<?php if($chinese_new_year_Post_id){ echo $chinese_new_year_Post_id; }?>" /><i>Example: 1166,120,542</i></td></tr>
				<tr><td><label for="chinese_new_year_Tag"><?php _e('Tag');?></label></td><td><input type="checkbox" name="chinese_new_year_Tag" value="1" <?php if($chinese_new_year_Tag){ echo "checked"; }?> /></td></tr>
				<tr><td><label for="chinese_new_year_Category"><?php _e('Category');?></label></td><td><input type="checkbox" name="chinese_new_year_Category" value="1" <?php if($chinese_new_year_Category){ echo "checked"; }?> /></td></tr>
				<tr><td><label for="chinese_new_year_Page"><?php _e('Page');?></label></td><td><input type="checkbox" name="chinese_new_year_Page" value="1" <?php if($chinese_new_year_Page){ echo "checked"; }?> /></td></tr>
			</table>
			<p><strong>Happy New Year! My blog: <a href="http://liucheng.name/" target="_blank">柳城(Lc.)</a> , Plugin Homepage: <a href="http://liucheng.name/1169/" target="_blank">Chinese NewYear</a></strong></p>
			<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Update Profile'); ?>" /></p>
			</form>
		</div>
    <?php
}

function Happy_New_Year(){
    $new_year_path = chinese_new_year_GetPluginUrl()."Chinese-new-year.swf";
	$new_year = '
	<div id=layer11 style="z-index: 1; right: 22px; right: 240px \9; visibility: visible; width: 240px; position: absolute; top: 1px; height: 240px">
	  <object codebase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0 
			  height=480 width=480 
			  classid=clsid:d27cdb6e-ae6d-11cf-96b8-444553540000>
		<param name="_cx" value="6879">
		<param name="_cy" value="6879">
		<param name="flashvars" value>
		<param name="movie" value="'.$new_year_path.'">
		<param name="src" value="'.$new_year_path.'">
		<param name="wmode" value="transparent">
		<param name="quality" value="high">
		<param name="allowscriptaccess" value="always">
		<param name="devicefont" value="0">
		<param name="embedmovie" value="0">
		<param name="swremote" value>
		<param name="moviedata" value>
		<param name="seamlesstabbing" value="1">
		<embed src="'.$new_year_path.'" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash" type="application/x-shockwave-flash" width="260" height="260" wmode="transparent">
	  </object>
	</div>';
	print $new_year;
}

function chinese_new_year_cookie(){
	   $get_chinese_new_year_option = get_option(chinese_new_year_option);
   if($get_chinese_new_year_option){
	   list($chinese_new_year_enable, $chinese_new_year_Home, $chinese_new_year_Post, $chinese_new_year_Tag, $chinese_new_year_Category, $chinese_new_year_Page, $chinese_new_year_Post_id, $chinese_new_year_cookie) = explode('|',$get_chinese_new_year_option);
   }
   if($chinese_new_year_cookie){
	   print '<script type="text/javascript">document.cookie="chinese_new_year_donotplay=chinese_new_year_donotplay;"</script>';
   }
}


function the_chinese_new_year(){
   $get_chinese_new_year_option = get_option(chinese_new_year_option);
   if($get_chinese_new_year_option){
	   list($chinese_new_year_enable, $chinese_new_year_Home, $chinese_new_year_Post, $chinese_new_year_Tag, $chinese_new_year_Category, $chinese_new_year_Page, $chinese_new_year_Post_id, $chinese_new_year_cookie) = explode('|',$get_chinese_new_year_option);
	   if($chinese_new_year_Post_id){
		   $array_chinese_new_year_Post_id = explode(',', $chinese_new_year_Post_id);
	   }
   }else{
	   $chinese_new_year_enable = '1';
       $chinese_new_year_Home = '1';
   }
    if (!isset($_COOKIE['chinese_new_year_donotplay'])){
	   if($chinese_new_year_enable){
		   if( is_home() && $chinese_new_year_Home ){
			   Happy_New_Year();
			   chinese_new_year_cookie();
		   }
		   if($array_chinese_new_year_Post_id){
			   foreach($array_chinese_new_year_Post_id as $ID){
				   if( is_single($ID) ){
					   Happy_New_Year();
					   chinese_new_year_cookie();
				   }
			   }
		   }else{
			   if( is_single() && $chinese_new_year_Post ){
				   Happy_New_Year();
				   chinese_new_year_cookie();
			   }
		   }
		   if (function_exists('is_tag')) { 
			   if ( is_tag() && $chinese_new_year_Tag ){
				   Happy_New_Year();
				   chinese_new_year_cookie();
			   }
		   }
		   if( is_category() && $chinese_new_year_Category ){
			   Happy_New_Year();
			   chinese_new_year_cookie();
		   }
		   if( is_page() && $chinese_new_year_Page ){
			   Happy_New_Year();
			   chinese_new_year_cookie();
		   }
	   }
	}
}

 /* Tie the module into Wordpress */
add_action('admin_menu','chinese_new_year_admininit');
add_filter('wp_footer','the_chinese_new_year',9999);