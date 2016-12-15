<?php
/**
 * Jobify
 *
 * Do not modify this file. Place all modifications in a child theme.
 *
 * @package Jobify
 * @category Theme
 * @since 1.0.0
 */
class Jobify {

	/**
	* The single instance of the Jobify object.
	*
	* @var object $instance
	*/
	private static $instance;

	/**
	* @var object $activation
	*/
	public $activation;

	/**
	* @var object $setup
	*/
	public $setup;

	/**
	* @var object $integrations
	*/
	public $integrations;

	/**
	* @var object $template
	*/
	public $template;

	/**
	* @var object $widgets
	*/
	public $widgets;

	/**
	* Find the single instance of the class.
	*
	* @since 3.0.0
	*/
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Jobify ) ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Start things up.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		$this->includes();
		$this->setup();
	}

	/**
	* Integration getter helper.
	*
	* @since 3.0.0
	*
	* @param string $integration The name of the integration to load.
	* @return object $integration
	*/
	public function get( $integration ) {
		return $this->integrations->get( $integration );
	}

	/**
	 * Load the necessary files.
	 *
	 * @since 3.0.0
	 * 
	 * @return void
	 */
	private function includes() {
		$this->files = array(
			'customizer/class-customizer.php',

			'class-deprecated.php',
			'class-helpers.php',

			'activation/class-activation.php',

			'setup/class-setup.php',

			'integrations/class-integrations.php',
			'integrations/class-integration.php',

			'template/class-template.php',

			'widgets/class-widgetized-pages.php',
			'widgets/class-widgets.php',
			'widgets/class-widget.php',
		);

		foreach ( $this->files as $file ) {
			require_once( get_template_directory() . '/inc/' . $file );
		}
	}

	/**
	 * Instantiate necessary classes and assign them to relevant
	 * class properties.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	private function setup() {
		$this->activation = Jobify_Activation::init();
		$this->setup = Jobify_Setup::init();

		$this->integrations = new Jobify_Integrations();
		$this->template = new Jobify_Template();
		$this->widgets = new Jobify_Widgets();

		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
	}

	/**
	 * Standard WordPress theme setup
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function setup_theme() {
		// set the content width
		$GLOBALS[ 'content_width' ] = apply_filters( 'jobify_content_width', 680 );

		// load translations
		$locale = apply_filters( 'plugin_locale', get_locale(), 'jobify' );
		load_textdomain( 'jobify', WP_LANG_DIR . "/jobify-$locale.mo" );
		load_theme_textdomain( 'jobify', get_template_directory() . '/languages' );

		// load editor-style.css
		add_editor_style();

		// theme supports
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'custom-background', array(
			'default-color'    => '#ffffff'
		) );

		add_theme_support( 'custom-header', array(
			'default-text-color'     => '666666',
			'height'                 => 44,
			'width'                  => 200,
			'flex-width'             => true,
			'flex-height'            => true,
			'wp-head-callback'       => array( jobify()->template->header, 'custom_header_style' )
		) );
		register_sidebar(array('name'=>'slick-slider',
					'id'=>'slick-slider',
					'description'=>'slick, do you use slick?',
					'before_widget'=>'',
					'after_widget'=>'',
					'before_title' => '',
					'after_title' => '',
					));

		// nav menus
		register_nav_menus( array(
			'primary'       => __( 'Navigation Menu', 'jobify' ),
			'footer-social' => __( 'Footer Social', 'jobify' ),
			'left-menu' => __( 'Account Menu', 'jobify' ),
			'footer-menu' => __( 'Footer Menu', 'jobify' ),
			'jobseeker-menu' => __( 'Job Seeker Menu', 'jobify' ),
			'employer-menu' => __( 'Employer Menu', 'jobify' )

		) );

		// images
		add_image_size( 'content-grid', 400, 200, true );
		add_image_size( 'content-job-featured', 1350, 525, true );

		// extras
		add_filter( 'excerpt_more', '__return_false' );
		add_filter( 'widget_text', 'do_shortcode' );
	}

}

/**
 * Helper function for accessing the main `Jobify` class.
 *
 * @since 3.0.0
 *
 * @return object Jobify The single instance of the `Jobify` class.
 */
function jobify() {
	return Jobify::instance();
}

// Oh get a job? Just get a job?
jobify();

/*class RegistrationForm {
    static $reCaptcha = array(
        'secret_key' => '6Ld5QCcTAAAAADnO0DCy7etIXJLFIOQMvzl-aSu-',
        'public_key' => '6Ld5QCcTAAAAANBfqyBUe1d-F8u4gSXOZopCNlRc'
    );
        static $messages = array(
                        'user_exists'           => 'User already exists.',
                                'internal_error'        => 'Something went wrong. Internal error.',
                                        'user_added'            => 'User was successful added.',
                                                'password_not_confirmed' => 'Passwords doesn\'t match.',
                                                        'not_enough_data'       => 'Fill all fields.',
                        'not_verifed' => 'You are not verifed!'
                                                            );
            static function init() {
                        $message = '';
                                $action = ( !empty( $_POST['reg_form_action'] ) ) ? $_POST['reg_form_action'] : false;
                                        if ( empty( $_POST['cb_phone'] ) ) {
                                                        switch ($action) {
                                                                            case 'registration':
                                                                                                    $message = self::RegisterUser();
                                                                                                                        break;
                                                                                                                                    }
                                                                }
                                                self::CreateForm( $message );
                                                    }
                private static function RegisterUser() {
//                    var_dump('<pre>',$_POST,'</pre>');
                            $role = ( !empty( $_POST['role'] ) ) ? $_POST['role'] : false;
                            $password = ( !empty( $_POST['password'] ) ) ? $_POST['password'] : false;
                            $confirm_password = ( !empty( $_POST['confirm_password'] ) ) ? $_POST['confirm_password'] : false;
                            $email = ( !empty( $_POST['email'] ) ) ? $_POST['email'] : false;
                            $gReCaptchaResponse = ( !empty( $_POST['g-recaptcha-response'] ) ) ? $_POST['g-recaptcha-response'] : false;
                            if ( !self::gReCaptchaVerify( $gReCaptchaResponse ) ) {
                                return self::$messages['not_verifed'];
                            }
                                                        if ( !$password || !$email ) {
                     return self::$messages['not_enough_data'];
                }
               if ( $password != $confirm_password ) {
                           return self::$messages['password_not_confirmed'];
                                      }
                $user_id = email_exists($email);
                                   if ( !$user_id ) {
                               if ( $user_id = wp_create_user( $email, $password, $email ) ) {
                                              $user = new WP_User( $user_id );
                                             $user->set_role( $role );
                         self::SendEmail( $email, $password );
                if ( $user = wp_signon(
                    array(
                        'user_login' => $email,
                        'user_password' => $password
                    )
                ) ) {
                    wp_redirect( custom_login_redirect( site_url('my-account'), $user ) );
                    exit();
               }
               return self::$messages['user_added'];
                            } else {
                                return self::$messages['internal_error'];
                            }
                        } else {
                        return self::$messages['user_exists'];
                     }
                    }
                    private static function SendEmail( $email, $password ) {

                        $headers[] = 'From: JobMarket <' . get_option( 'admin_email' ) . '>';
                        $headers[] = 'content-type: text/html';
                        $message = "
                          <p>You or someone has registered at jobmarket.com</p>
                           <p>E-mail: {$email}</p>
                           <p>Password: {$password}</p>
                        ";
                        wp_mail( $email, 'JobMarket. Registration', $message, $headers );
                    }
                       private static function CreateForm ( $message = '' ) {
                                    add_shortcode( 'reg_form', function () use ( $message ) {
                                                        return '
                                                        <div class="warning">' . $message . '</div>
                                                        <form action="" method="post" id="registration-form">
                                                        <div>
                                                            <select name="role">
                                                                <option value="employer">Employer</option>
                                                                <option value="candidate">Candidate</option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label for="username">E-mail:</label>
                                                            <input type="email" id="username" name="email" required>
                                                        </div>
                                                        <div>
                                                            <label for="password">Password:</label>
                                                            <input type="password" id="password" name="password" required>
                                                        </div>
                                                        <div>
                                                            <label for="confirm_password">Password Confirmation:</label>
                                                            <input type="password" id="confirm_password" name="confirm_password" required>
                                                        </div>
                                                        <div>
                                                            <div class="g-recaptcha" data-sitekey="' . self::$reCaptcha['public_key'] . '"></div>
                                                        </div>
                                                        <div>&nbsp;</div>
                                                        <!-- <input type="text" name="cb_phone" style="display: none;"> -->
                                                        <input type="hidden" name="reg_form_action" value="registration">
                                                        <div><button type="submit">Register</button></div>
                                                        </form>
                                                        ';
                                                                } );
                                        }
    private static function gReCaptchaVerify ( $response ) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
            'secret' => self::$reCaptcha['secret_key'],
            'response' => $response
        )));

        $result = curl_exec($curl);

        $result = json_decode($result,true);


        curl_close($curl);
        if ( !$result['success'] )
           return false;
        return true;
    }
}

add_action( 'after_setup_theme', function () { RegistrationForm::init(); } );

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
}*/

function add_post_btn_shortcode_function() {
        if ( is_user_logged_in() ) {
		if ( current_user_can('employer') ) {
			return '<div class="btn-wrap"><a class="button button--size-small button--type-inverted" href="/post-a-job/">Post a Job</a></div>';
             	} 
	}   
}

add_shortcode('addpostbtn', 'add_post_btn_shortcode_function');

