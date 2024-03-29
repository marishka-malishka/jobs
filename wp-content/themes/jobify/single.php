<?php
/**
 * Single Post
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <div id="content" class="container content-area" role="main">

        <div class="row">
	    <?php get_sidebar(); ?>

            <div class="col-md-<?php echo is_active_sidebar( 'sidebar-blog' ) ? '9' : '12'; ?> col-xs-12">
                <?php get_template_part( 'content', 'single' ); ?>
                <?php comments_template(); ?>
            </div>

        </div>

    </div><!-- #content -->

    <?php do_action( 'jobify_loop_after' ); ?>

    <?php endwhile; ?>

<?php get_footer(); ?>
