<?php
/**
 * Template Name: Site Map Page
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
        <?php get_sidebar(); ?>
        <div class="col-md-<?php echo is_active_sidebar( 'sidebar-blog' ) ? '9' : '12'; ?> col-xs-12">
            <?php if ( jobify()->get( 'woocommerce' ) ) : ?>
                <?php wc_print_notices(); ?>
            <?php endif; ?>

            <?php // get_template_part( 'content', 'page' ); ?>

            <ul class="site-map">
            <?php foreach(get_pages('sort_column=menu_order&parent=0') as $page) { ?>
            <li class="page_item page-item-<?php echo $page -> ID; ?><?php if($_GET['page_id'] == $page -> ID) { echo ' current_page_item'; } ?>">
            <a href="<?php echo bloginfo('url') . "/?page_id=" . $page -> ID; ?>">
            <?php echo $page -> post_title; ?>
            </a>
            <?php if(get_pages('child_of='.$page->ID)) { ?>
            <ul class="<?php echo $page -> ID; ?> child">
            <?php foreach(get_pages('child_of='.$page->ID) as $child) { ?>
            <li class="page_item page-item-<?php echo $child -> ID; ?><?php if($_GET['page_id'] == $child -> ID) { echo ' current_page_item'; } ?>">
            <a href="<?php echo bloginfo('url') . "/?page_id=" . $child -> ID; ?>">
            <?php echo $child -> post_title; ?>
            </a>
            </li>
            <?php } ?>
            </ul>
            <?php } ?>
            </li>
            <?php } ?>
            </ul>

            <?php do_action( 'jobify_loop_after' ); ?>
        </div>

    </div>
    </div><!-- #primary -->

    <?php endwhile; ?>

<?php get_footer(); ?>
