<?php
/**
 * List Blog Posts
 *
 * @since Jobify 1.0
 */
class Jobify_Widget_Blog_Posts extends Jobify_Widget {

	public function __construct() {
		$this->widget_cssclass    = 'jobify_widget_blog_posts';
		$this->widget_description = __( 'Jobify - Display recent blog posts.', 'jobify' );
		$this->widget_id          = 'jobify_widget_blog_posts';
		$this->widget_name        = __( 'Jobify - Home: Blog Posts', 'jobify' );
		$this->settings           = array(
			'home' => array(
				'std' => __( 'Homepage', 'jobify' ),
				'type' => 'widget-area'
			),
			'title' => array(
				'type'  => 'text',
				'std'   => __( 'Recent News Article', 'jobify' ),
				'label' => __( 'Title:', 'jobify' )
			),
			'description' => array(
				'type'  => 'textarea',
				'rows'  => 4,
				'std'   => '',
				'label' => __( 'Description:', 'jobify' ),
			),
			'number' => array(
				'type' => 'number',
				'std' => 3,
				'label' => __( 'Number to show:', 'jobify' )
			)
		);
		parent::__construct();
	}

	function widget( $args, $instance ) {
		ob_start();

		extract( $args );

		$title       = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance[ 'title' ] : '', $instance, $this->id_base );
		$description = isset( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';
		$number      = isset( $instance[ 'number' ] ) ? absint( $instance[ 'number' ] ) : 3;
		
		$original_blog_id = get_current_blog_id();
		if($original_blog_id!=1){
			switch_to_blog( 1 );
			$cat_slug = explode('.',$_SERVER['HTTP_HOST'])[0];
			$idObj = get_category_by_slug($cat_slug);
			//$posts = get_posts( "category=".$idObj->term_id );
			
		}else{
			$idObj = get_category_by_slug('news');
			//$posts = get_posts( "category=".$idObj->term_id );
		}

		$posts       = new WP_Query( apply_filters( 'widget_jobify_blog_posts', array( 
			'posts_per_page' => absint( $number ),
			'ignore_sticky_posts' => true,
			'no_found_rows' => true,
			'post_type' => 'post',
			'post_status' => 'publish',
			'cat' => $idObj->term_id
		) ) );
                
		echo $before_widget;
?>

<div class="container">

	<?php 
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
	?>
	<?php if ( $description ) : ?>
		<p class="widget-description widget-description--home">
			<?php echo $description; ?>
			</p>
		<p class="widget-description widget-description--home">
			<?php $site_url = get_site_url('1');?>
			<a href="<?php echo $site_url;?>/blog/" class="button button--color-green button--size-medium">Veiw / Post News</a>
		</p>
	<?php endif; ?>

	<div class="content-grid" data-columns>
	<?php if ( $posts->have_posts() ) : ?>
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<?php get_template_part( 'content', 'grid' ); ?>
		<?php endwhile; ?>
	<?php endif; ?>
	</div>

</div>

<?php
		echo $after_widget;

		$content = apply_filters( 'jobify_widget_blog_posts', ob_get_clean(), $instance, $args );

		echo $content;
		if($original_blog_id!=1){ switch_to_blog( $original_blog_id ); }
	}
}
