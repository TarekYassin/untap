<?php
/*
Template Name: account page
*/
get_header();

global $user_ID;
$user = wp_get_current_user();
echo "<p class='acc-top'><b>Hello</b> ".$user->user_login. "<p>";

if(!get_user_meta($user_ID, 'gf_submission', true)=="1"){
    echo do_shortcode( ' [gravityform id=1 ajax=true] ' );
}
else{
    echo "<div id='ac-sp'></div>";
}
get_footer();
?>
