<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!--<meta charset="<?php bloginfo( 'charset' ); ?>" />-->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<meta name="viewport" content="initial-scale=1">
	<meta name="viewport" content="width=device-width" />

	<?php wp_head(); ?>
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<style type="text/css">
		.nav-menu .menu-item .button--color-green{
			color:#fff;
		}
		.nav-menu .menu-item:hover .button--color-green{
			color:#333;
			background: transparent;
			border:solid 2px #4eb318;
		}
		.nav-menu .menu-item .button--color-green:after{
			content: "";
		}
		.nav-menu--primary .sub-menu.sub-menu-type2{
			padding: 0;
			width: 100%;
			border:solid 1px #ccc;
		}
		.nav-menu--primary .sub-menu.sub-menu-type2 .menu-item a{
			padding-top: 5px;
			padding-bottom: 5px;
		}
		.nav-menu--primary .sub-menu.sub-menu-type2 .menu-item:not(:first-child){
			border-top: solid 1px #ccc;
		}
		.header-social{
			
		}
		.buttons-menu{
			display:inline-block; 
			vertical-align:top;
		}
		.buttons-menu .menu-item a:hover,
		#menu-main-menu	.menu-item a:hover{
			background:#ddd !important;
		}
		

	@media (min-width:768px){
		#menu-main-menu{
			
		}
		.nav-menu.nav-menu--primary{
			margin-tight:5px;
		}
	}
	@media (max-width:997px){
		
		.site-branding{
			width:100%;
			text-align:center;
			float:none;
		}
		.site-branding:after{
			content:'';
			clear:both;
			display:block;
		}
		.site-branding .site-title{
			width:100%;
			margin-right:0;
		}
	}
	@media (max-width:767px){
		#text-8{
			
		}
		#menu-main-menu	.menu-item{
			margin:0;
		}
		#menu-main-menu .menu-item a{
			width:100%;
			display:block;
		}
		.buttons-menu{
			display:block;
			width:100%;
		}
		.buttons-menu li{
			background:transparent;
		}
		.nav-menu .menu-item .button--color-green{
			pointer-events:none;
		}
		.nav-menu--primary .sub-menu{
			display:none;
			list-style:none;
			position:absolute;
			top:100%;
			left:0;
			z-index:10;
		}
		.nav-menu .menu-item .button--color-green{
			width:100%;
			font-size:12px;
			padding:7px 10px;
		}
		.nav-menu--primary .menu-item{
			position:relative;
		}
		.nav-menu--primary .menu-item:hover .sub-menu{
			display:block;		
		}
		.header-social{
			margin-right: 55px !important;
			margin-top:0 !important;
		}
		.js-primary-menu-toggle.primary-menu-toggle{
			margin-right:12px;
			top:104px;
			right:0;
		}
		#page{
			overflow:visible;
		}
		.block-mobile-menu{
			width: 204px;
			margin: 0 auto;
			position: relative;
		}
		.site-primary-navigation{
			padding:0;
			margin-top:8px;
		}
		.js-primary-menu-toggle.primary-menu-toggle.primary-menu-toggle--opened{
			position:absolute;
			top:90px;
			right:-10px;
		}

	}
	.mobile-soc-link{
		width: 293px;
		margin: 0 auto;
		display: none;
	}
	#___page_0{
		width: 293px !important;
	    border-right: solid 1px #ccc !important;
	}

	.linkedin-text{
		position: absolute;
		margin-left: 12px;
		margin-top: 10px;
		font-size: 22px;
	}
	.linkedin-feeds{
		margin-top:20px;
	}
	@media (max-width: 768px){
		.linkedin-feeds{
			margin-top:0;
		}
		.frame-soc-link{
			display: none !important;
		}
		.mobile-soc-link{
			display: block;
			margin-bottom: 15px;
		}
		.social-linked-in{
			margin-top: -25px !important;
		}
		.social-linked-in span{
			bottom: -31px !important;
		}
	}
        .mo-openid-app-icons{
 text-align:center !important;
 display:block !important;
 width:100%;
}
.mo-openid-app-icons>p{
  display:none;
}
.mo-openid-app-icons>a{
  display:inline-block !important;
  vertical-align:top !important;
  margin:5px !important;
  float:none !important;
  font-weight:bold;
}
.soc-login{
  position:relative;
}
.soc-login:after{
  content:'------- or -------';
  position:absolute;
  top:100%:
  width:100%;
  display:block;
  left:0;
  right:0;
  line-height:20px;
  font-size:20px;
  font-weight:400;
  color:#000;
  text-align:center;
}
	</style>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script>
	jQuery(document).ready(function(){
		jQuery('#slick-slider').slick({
			dots: true,
			infinite: true,
			speed: 1400,
			autoplay: true,
			autoplaySpeed: 4000,
			pauseOnFocus: true,
			pauseOnHover:false,
			cssEase:'ease-out',
			slidesToShow: 1,
		slidesToScroll: 1
		});
	});
</script>
</head>

<body <?php body_class(); ?>>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84613925-1', 'auto');
  ga('send', 'pageview');

</script>

	<div id="page" class="hfeed site">

		<header id="masthead" class="site-header" role="banner">
			<!--<div class="container">
				<div class="social-wrap">
				<div class="header-social">
					<div class="social-icon"><a href="https://www.linkedin.com/groups/5173428/profile" target="_blank"><span class="icon-linkedin"></span></a></div>
					<div class="social-icon"><a href="https://www.facebook.com/JobsMarketNC" target="_blank"><span class="icon-facebook"></span></a></div>
					<div class="social-icon"><a href="https://plus.google.com/+Jobsmarketdotcom/posts" target="_blank"><span class="icon-google"></span></a></div>
					<div class="social-icon"><a href="https://twitter.com/jobsmkt" target="_blank"><span class="icon-twitter"></span></a></div>
				</div>
				</div>
			</div>-->
            <div class="container" style="text-align:right;">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="site-branding">
					<?php $header_image = get_header_image(); ?>
					<h1 class="site-title">
						<?php if ( ! empty( $header_image ) ) : ?>
							<img src="<?php echo $header_image ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
						<?php endif; ?>

						<!--<span><?php bloginfo( 'name' ); ?></span>-->
					</h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</a>
<div class="block-mobile-menu clearfix">
<?php
 $user = new WP_User(get_current_user_id());
 $title['seek'] = 'Start Here';
 $title['empl'] = 'Start Here';
 if( in_array( 'employer', $user->roles )) $title['empl'] = 'Menu';
 if( in_array( 'candidate', $user->roles )) $title['seek'] = 'Menu';
 $main_url = get_site_url('1');
 $current_site = get_current_blog_id();
 //var_dump($main_url); 
 //var_dump($current_site);
?>
<ul class="buttons-menu nav-menu nav-menu--primary">
	<li class="menu-item">
		<a href="<?= $main_url; ?>/job-seekers/" class="button button--color-green button--size-small" <?php if ($current_site != 1): ?> target="_blank" <?php endif; ?> >Job Seekers <?=$title['seek']; ?></a>
		<?wp_nav_menu( array( 
							'theme_location' => 'jobseeker-menu', 
							'menu_class' => 'sub-menu sub-menu-type2',
							'container' => false
						) );?>
	</li>
	<li class="menu-item">
		<a href="<?= $main_url; ?>/employer/" class="button button--color-green button--size-small" <?php if ($current_site != 1): ?> target="_blank" <?php endif; ?>>Employers <?=$title['empl'];?></a>
		<?wp_nav_menu( array( 
							'theme_location' => 'employer-menu', 
							'menu_class' => 'sub-menu sub-menu-type2' ,
							'container' => false
						) ); ?>
	</li>
	
</ul>
<div class="header-social" style="margin-top:16px;">
<div class="social-icon"><a href="https://www.linkedin.com/groups/5173428/profile" target="_blank"><span class="icon-linkedin"></span></a></div>
<div class="social-icon"><a href="https://www.facebook.com/JobsMarketNC" target="_blank"><span class="icon-facebook"></span></a></div>
<div class="social-icon"><a href="https://plus.google.com/+Jobsmarketdotcom/posts" target="_blank"><span class="icon-google"></span></a></div>
<div class="social-icon"><a href="https://twitter.com/jobsmkt" target="_blank"><span class="icon-twitter"></span></a></div>
</div>
<div class="button-wrap header-button">
<?php /*
$start_button = array(
	'link' => home_url( 'signup' ),
	'title' => 'Employers Start Here!'
);
if ( is_user_logged_in() ) {
	$user = new WP_User( $user_ID );
	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
	        if ( in_array( 'employer', $user->roles ) ) {
				$start_button= array(
					'link' => home_url( 'employers' ),
					'title' => 'Employer\'s Profile'
				);
	        } else if ( in_array( 'candidate', $user->roles ) ){
                $start_button = array(
                        'link' => home_url( 'job-seekers' ),
                        'title' => 'Job Seeker\'s Profile'
                );
	        } 
	}
	
}
*/?>
<!-- <a href="<?php echo $start_button['link']; ?>" class="button button--size-small button--type-inverted pull-right"><?php echo $start_button['title']; ?></a> -->
				</div>

			    				<nav id="site-navigation" class="site-primary-navigation">
					<a href="#site-navigation" class="js-primary-menu-toggle primary-menu-toggle primary-menu-toggle--close pull-right"><?php //_e( 'Close', 'jobify' ); ?></a>

					<?php
						// output searchform-header.php
						//add_filter( 'get_search_form', array( jobify()->template->header, 'search_form' ) );
						//get_search_form();
						//remove_filter( 'get_search_form', array( jobify()->template->header, 'search_form' ) );

						// output primary menu location
						wp_nav_menu( array( 
							'theme_location' => 'primary', 
							'menu_class' => 'nav-menu nav-menu--primary' ,
							'container_class' => 'nav-menu nav-menu--primary' 
						) ); 
					?>
				</nav>

				<a href="#site-navigation" class="js-primary-menu-toggle primary-menu-toggle primary-menu-toggle--open"><span class="screen-reader-text"><?php _e( 'Menu', 'jobify' ); ?></span></a>
</div>
    		                           
                
</div>

			</div>
		</header><!-- #masthead -->
		<div id="main" class="site-main">
<?php
//if ( !empty( $pagename ) && $pagename == 'signup' ) {
//	RegistrationForm::init();
//}