<?php
/**
 * Template Name: Layout: Blog Page 
 *
 * @package Jobify
 * @since Jobify 1.5.0
 */

get_header(); ?>

   <?php
 	$original_blog_id = get_current_blog_id();
	if($original_blog_id!=1){
		switch_to_blog( 1 );
		$cat_slug = explode('.',$_SERVER['HTTP_HOST'])[0];
		$idObj = get_category_by_slug($cat_slug);
		$posts = get_posts( "category=".$idObj->term_id );
	}else{
		$idObj = get_category_by_slug('news');
		$posts = get_posts( "category=".$idObj->term_id );
	}
?>

<div id="primary" class="content-area">
        <div id="content" class="container" role="main">
            <div class="blog-archive row">
                <?php get_sidebar(); ?>
                <div class="col-md-<?php echo is_active_sidebar( 'sidebar-blog' ) ? '9' : '12'; ?> col-xs-12">
                <div class="blog-archive_top-content">
                                <h3><b>Stay current and informed on Employment related news trending now!  Bookmark this page and check back frequently. Do you have News of your own, Share it with us!</b></h3>
                                <a class="button button--size-small button--type-inverted pull-right" href="/post-new/">Submit an Article!</a>
                                </div>
                    <?php if ( have_posts() ) : ?>
                      <?php foreach( $posts as $post){ ?>
                            <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php } ?>
                    <?php else : ?>
                        <?php get_template_part( 'content', 'none' ); ?>
                    <?php endif; ?>

					<?php do_action( 'jobify_loop_after' ); ?>
					<?php //echo do_shortcode('[ap-form]');?>
                </div>


            </div>

        </div><!-- #content -->

    </div><!-- #primary -->

<?php get_footer(); ?>
