<?php
/**
 * Single Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <header class="page-header">
        <h2 class="page-title"><?php the_title(); ?></h2>
    </header>

    <div id="primary" class="content-area container" role="main">
    <div class="row">
        <div class="col-xs-12">
            <?php if ( jobify()->get( 'woocommerce' ) ) : ?>
                <?php wc_print_notices(); ?>
            <?php endif; ?>

            <?php get_template_part( 'content', 'page' ); ?>

            <?php do_action( 'jobify_loop_after' ); ?>
        </div>

    </div>
    </div><!-- #primary -->

    <?php endwhile; ?>

<?php get_footer(); ?>
