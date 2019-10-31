<?php
// Untap functions page

//Redirect after login
function my_logout_rdr() {
	wp_redirect(site_url() . "/login");
	exit();
}
add_action('wp_logout', 'my_logout_rdr');

//This function calculates the final score field from the frontend
add_filter( 'gform_pre_render_1', 'add_readonly_script' );
function add_readonly_script( $form ) {
    ?>
 
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery("li.gf_rdonly input").attr("readonly","readonly");
			jQuery("#calc-score").click(function(){

				var i1=parseFloat(jQuery("#input_1_2").val());
				var i2=parseFloat(jQuery("#input_1_4").val());
				var i3=parseFloat(jQuery("#input_1_3").val());
				var final= i1 + i2 + i3;
				if(final>0){
					jQuery("li.gf_rdonly input").val(final);
				}
				else {
					jQuery("li.gf_rdonly input").val("Please fill in all score fields");
				}
			})
        });
    </script>
 
    <?php
    return $form;
}

//add user meta to the db
add_action( 'gform_after_submission_1', 'user_gf_submit', 10, 2 );
function user_gf_submit(){
	global $user_ID;

	$meta_key="gf_submission";
	add_user_meta( $user_ID, $meta_key, TRUE);
}

//add custom menu for logged in and logged out users
add_action('wp_head', 'add_custom_css');
function add_custom_css(){
		if ( is_user_logged_in()){?>
			<style>
				#menu-item-13, #menu-item-14, .menu-item-13, .menu-item-14{
					display:none;
				}
			</style>
		
	<?php	}
	else {	?>
		<style>
				#menu-item-12, #menu-item-26, .menu-item-12, .menu-item-26{
					display:none;
				}
		</style>
	<?php }
}
