<?php
/**
 * The main template file.
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

    <header class="page-header">
        <h2 class="page-title"><?php echo get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : _x( 'Blog', 'blog page title', 'jobify' ); ?></h2>
    </header>

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
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'content', get_post_format() ); ?>
                        <?php endwhile; ?>
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
