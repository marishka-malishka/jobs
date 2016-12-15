<?php

class RegistrationForm
{
    static $messages = array(

        'user_exists' => 'Username already exists.',
        'email_exists' => 'Email already exists.',
        'internal_error' => 'Something went wrong. Internal error.',
        'user_added' => 'User was successful added.',
        'password_not_confirmed' => 'Passwords doesn\'t match.',
        'not_enough_data' => 'Fill all fields.',
        'role_error' => 'You dont set role!',
        'bad_captcha' => 'Captcha error!',
    );

    static function init()
    {
        $action = $_POST['reg_form_action']?$_POST['reg_form_action']:false;
		switch ($action) {
			case 'ajax': self::RegisterUser(); break;
        }
        
    }
    public static function returnJson($success,$massage,$custom){
        echo '{"success":'.($success?'true':'false').',"massage":"'.$massage.'"'.$custom.'}';
        exit;
    }
    private static function RegisterUser()
    {
        $role = in_array($_POST['role'],array('employer','candidate')) ? $_POST['role'] : false;
        $password = (!empty($_POST['password'])) ? $_POST['password'] : false;
        $username = (!empty($_POST['username'])) ? $_POST['username'] : false;
        $confirm_password = (!empty($_POST['confirm_password'])) ? $_POST['confirm_password'] : false;
        $email = (!empty($_POST['email'])) ? $_POST['email'] : false;
        $response = $_POST['response'] ? $_POST['response'] : '';

        if (!$role) {
        	self::returnJson(false,self::$messages['role_error']);
        }
        if (!$password || !$email) {
        	self::returnJson(false,self::$messages['not_enough_data']);
        }
        if ($password != $confirm_password) {
        	self::returnJson(false,self::$messages['password_not_confirmed']);
        }
        if(self::checkCaptcha($response)=='f'){
        	self::returnJson(false,self::$messages['bad_captcha']);
        }
        if(username_exists($username)){
            self::returnJson(false,self::$messages['user_exists']);
        }
        if(email_exists($email)){
            self::returnJson(false,self::$messages['email_exists']);
        }

        $user_id = wp_create_user($username, $password, $email);
        if ($user_id) {
            $user = new WP_User($user_id);
            $user->set_role($role);
            self::SendEmail($username, $email, $password, $role);
            wp_signon(array(
	                        'user_login' => $username,
	                        'user_password' => $password
                			));
            self::returnJson(true,self::$messages['user_added']);
        } else {
        	self::returnJson(false,self::$messages['internal_error']);
        }
    }
    public static function SendEmail($username, $email, $password, $role)
    {
        $text_arr = get_options_value(['singup_email_all','singup_email_employer','singup_email_candidate']);
        $variables = array('{email}'=>$email,'{password}'=>$password,'{role}'=>$role,'{username}'=>$username);

        $headers[] = 'From: JobMarket <' . get_option('admin_email') . '>';
        $headers[] = 'content-type: text/html';
        if($password){
            $message = text_replace($variables,$text_arr['singup_email_all']);
            wp_mail($email, 'JobMarket. Registration', $message, $headers);
        }

        
        $message = text_replace($variables,$text_arr['singup_email_'.$role]);
        wp_mail($email, 'JobMarket. Registration', $message, $headers);

        $message = text_replace($variables,'<h3>New user on site.</h3>Role:<b>{role}</b><br>Username:<b>{username}</b><br>Email:<b>{email}</b>');
        wp_mail(get_option('admin_email'), 'JobMarket. Registration', $message, $headers);

    }

    private static function checkCaptcha($response) {
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret=6LcHzQYUAAAAAEtBkdn_8yAJHYeAGA5-ZrlRJ5N4&response='.$response);

	    $data = curl_exec($ch);
	    curl_close($ch);
	    return substr($data, strpos($data,':')+2,1);
	}
}


add_action( 'woocommerce_after_customer_login_form', function () {
    echo '
    <div class="woocommerce-customer-login">
        <div class="login">
            <a href="/signup/">Registration</a>
        </div>
    </div>
    ';
} );

add_action('after_setup_theme', function () {
    if($_GET['action']=='redirect'){
        $user = new WP_User(get_current_user_id());
        if (in_array( 'employer', $user->roles )) {
            wp_redirect( site_url('employers'));
            exit;
        }else if(in_array( 'candidate', $user->roles )){
            wp_redirect( site_url('job-seekers'));
            exit;
        }
    }
    RegistrationForm::init();
    social_user_role();
});

add_shortcode('reg_form', function () use ($message) {
	if($_GET['role']=='candidate') $sel = 'selected';
	return '
	    <script src=\'https://www.google.com/recaptcha/api.js?hl=en\'></script>
	    <div class="warning">' . $message . '</div>
	    <form action="" method="post">
	        <div>
	        
	            <label for="role">Register As:</label>
	            <select name="role" id="role">
	                <option value="employer">Employer</option>
	                <option value="candidate" '.$sel.' >Candidate</option>
	            </select>
	        </div>
	        <div>
	            <label for="username">Username:</label>
	            <input type="text" id="username" name="username" required>
	        </div>
	        <div>
	            <label for="email">E-mail:</label>
	            <input type="email" id="email" name="email" required>
	        </div>
	        <div>
	            <label for="password">Password:</label>
	            <input type="password" id="password" name="password" required>
	        </div>
	        <div>
	            <label for="confirm_password">Password Confirmation:</label>
	            <input type="password" id="confirm_password" name="confirm_password" required>
	        </div>
	        <div class="recaptcha-error"></div>
	        <div class="g-recaptcha" data-sitekey="6LcHzQYUAAAAAOjq3fEujSdR-ocsHM2I-7t5C5vm"></div>
	        <input type="text" name="cb_phone" style="display: none;">
	        <input type="hidden" name="reg_form_action" value="registration">
	        <div class="button-row"><button type="submit">Register</button></div>
	    </form>
	    <script>
	    jQuery(\'.reg-form form\').submit(function(){
            jQuery(\'.reg-form .warning\').text(\'\');
            jQuery(\'.reg-form form\').addClass(\'wait\');
            jQuery.ajax({
                url:\'/\',
                data:{
                        \'role\':jQuery(\'.reg-form form #role\').val(),
                        \'username\':jQuery(\'.reg-form form #username\').val(),
                        \'email\':jQuery(\'.reg-form form #email\').val(),
                        \'password\':jQuery(\'.reg-form form #password\').val(),
                        \'confirm_password\':jQuery(\'.reg-form form #confirm_password\').val(),
                        \'response\': grecaptcha.getResponse(),
                        \'reg_form_action\':\'ajax\'
                    },
                method:\'POST\',
                success:function(res){
                    var json = JSON.parse(res);
                    if(!json.success){
                        grecaptcha.reset();
                        jQuery(\'.reg-form form\').removeClass(\'wait\');
                        jQuery(\'.reg-form .warning\').text(json.massage);
                    }else{
                        window.location.search = \'?action=redirect\';
                    }
                }
            });
            return false;
        });
	    </script>
	    <style>
	    .reg-form .warning{
	        border:solid 1px #f00;
	        background:rgba(255,0,0,0.2);
	        padding: 10px;
	        text-align:center;
	        margin-bottom:14px;
	        color:#000;
	    }
	    .reg-form .warning:empty{
	        display:none;
	    }
	    .reg-form form.wait{
	        pointer-events:none;
	        opacity:0.5;
	    }
        .g-recaptcha{
            margin-bottom:14px;
        }
	    </style>
	';
});

add_filter( 'woocommerce_login_redirect', 'custom_login_redirect', 10, 2 );

function custom_login_redirect( $redirect_to, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'employer', $user->roles ) ) {
            return home_url( 'employers' );
        } else if ( in_array( 'candidate', $user->roles ) ){
            return home_url( 'job-seekers' );
        } else {
            return $redirect_to;
        }
    } else {
        return $redirect_to;
    }
}
function social_user_role(){
    if($_GET['social-role']=='sub'){
        $user = new WP_User(get_current_user_id());
        $user->set_role('subscriber');
        exit();
    }
    global $current_user;
    $role = $current_user->roles[0];
    //var_dump('<pre>',$current_user->data->user_email,'</pre>');

    if(($role && $role!='subscriber')|| !get_current_user_id()) return false;

    if($_POST['social-role']){
        $user = new WP_User(get_current_user_id());
        if($_POST['social-role']=='employer') $user->set_role('employer');
        if($_POST['social-role']=='candidate') $user->set_role('candidate');
        RegistrationForm::SendEmail($current_user->data->user_email,'',$_POST['social-role']);
        wp_redirect( custom_login_redirect( site_url('my-account'), $user ) );
        exit;
    }else{
        echo '
            <div class="popup-after-social">
                <form action="" method="POST">
                    <h3>Choose your role:</h3>
                    <select name="social-role">
                        <option value="employer">Employer</option>
                        <option value="candidate">Candidate</option>
                    </select>
                    <button type="submit">Register</button>
                </form>
            </div>
            <style>
                .popup-after-social{
                    position:fixed;
                    height:100%;
                    width:100%;
                    left:0;
                    top:0;
                    background:rgba(0,0,0,0.8);
                    z-index:9999999;
                }
                .popup-after-social form{
                    width: 340px;
                    height: 250px;
                    position: absolute;
                    left: 0;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    margin: auto;
                    background: #fff;
                    border-radius: 20px;
                    padding: 20px;
                    text-align: center;
                }
                .popup-after-social form button{
                    margin-top:31px;
                }
            </style>
        ';
    }
}
add_shortcode('wordpress_soc_log','wp_soc_log');

function wp_soc_log($atts){ 
   if(get_current_user_id()) return '';

   $str = '<div class="soc-login" style="'.$atts['style'].'"> <div class="wp-social-login-connect-with">'.$atts['title'].'</div>'.do_shortcode('[miniorange_social_login theme="default"]').'</div>';
   
   return $str;
}

add_action('wp_logout', 'page_after_logout');

function page_after_logout(){
    wp_redirect( custom_login_redirect( site_url('my-account'), $user ) );
    exit;
}

/*add_action('wp_login','page_after_login');

function page_after_login(){ 
    $user = new WP_User(get_current_user_id());
    $page = 'job-seekers';
    if( in_array( 'employer', $user->roles )) $page = 'employers';
    wp_redirect( site_url($page));
    exit; 
}*/

function my_login_redirect( $redirect_to, $request, $user ) {
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		if ( in_array( 'administrator', $user->roles ) ) {
			return $redirect_to;
		} else if(in_array( 'employer', $user->roles )) {
			return home_url('employers');
		} else if(in_array( 'candidate', $user->roles )) {
			return home_url('job-seekers');
		}else{
			home_url();
		}

	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );