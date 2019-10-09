<?php
/*
Template Name: login page
*/

global $user_ID;

if (!$user_ID){ 
    if ($_POST){
        $username= sanitize_text_field($_POST['username']);
        $password= sanitize_text_field($_POST['password']);
        
        $creds = array(
            'user_login'    => $username,
            'user_password' => $password
        );
    
        $user = wp_signon( $creds, false );
    
        if ( is_wp_error( $user ) ) {
            get_header();
            echo "<p class='msg'>Invalid Username or Password</p>";
        }
        else{
            wp_redirect(site_url() . "/account");
            exit();
        }
    }   
    get_header();
?>
    <form class="log-form" method="post">
    <p>Please enter your username and password here.</p>
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter Username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter Password">
        </div>
        <div>
            <button type="submit" name="btn_submit">submit</button>
        </div>
    </form>
<?php 
} 
else{
    get_header();
    echo "logged in";
}
get_footer();
?>
