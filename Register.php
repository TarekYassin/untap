<?php
/*
Template Name: registration page
*/
get_header();

    if ($_POST){
        $fname= sanitize_text_field($_POST['fname']);
        $username= sanitize_text_field($_POST['username']);
        $email= sanitize_text_field($_POST['email']);
        $password= sanitize_text_field($_POST['password']);
        $pconfirm= sanitize_text_field($_POST['pconfirm']);

        if (empty($fname)) {
            echo "<p class='msg'>Enter your name</p>";
        }
        else if (strpos($username, ' ') !== FALSE) {
            echo "<p class='msg'>Username has Space</p>";
        }
    
        else if (empty($username)) {
           echo  "<p class='msg'>Username is required</p>";
        }
    
        else if (username_exists($username)) {
            echo "<p class='msg'>Username already exists";
        }
    
        else if (!is_email($email)) {
            echo "<p class='msg'>Email is not valid</p>";
        }
    
        else if (email_exists($email)) {
            echo "<p class='msg'>Email already exists</p>";
        }
    
        else if (strcmp($password, $pconfirm) !== 0) {
            echo "<p class='msg'>Password didn't match</p>";
        }

        else {
            $userdata = array(
                'first_name'  =>  $fname,
                'user_login'  =>  $username,
                'user_email'  =>  $email,
                'user_pass'   =>  $password
            );
            
            $user_id = wp_insert_user( $userdata ) ;
            echo "<p class='msg-success'>User Created Successfully, you can now login with your username and password.</p>";
            get_footer();
            exit();
        }
    }
?>
        <form class="log-form" method="post">
            <p>Fill in all the required feilds below.</p>
                <div>
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="fname" placeholder="Enter Full Name">
                </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter Username">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter Email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password">
                </div>
                <div>
                    <label for="pconfirm">Confirm Password</label>
                    <input type="password" id="pconfirm" name="pconfirm" placeholder="Confirm Password">
                </div>
                <div>
                    <button type="submit" name="btn">Submit</button>
                </div>
        </form>

<?php get_footer(); ?>
    