<?php
/**
 * Job Archives
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

	<header class="page-header">
		<h2 class="page-title"><?php echo apply_filters( 'jobify_job_archives_title', __( 'All Jobs', 'jobify' ) ); ?></h2>
	</header>

	<div id="primary" class="content-area">
		<div id="content" class="container" role="main">
			<a class="button button--size-small button--type-inverted pull-right" href="/post-a-job/">Post a Job</a>
			<div class="row">
		                <?php get_sidebar(); ?>
               			<div class="col-md-<?php echo is_active_sidebar( 'sidebar-blog' ) ? '9' : '12'; ?> col-xs-12">
					<div class="entry-content">
						<?php do_action( 'jobify_output_job_results' ); ?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>