<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>
	<!--<header class="entry-header col-sm-3 col-xs-12">
		<div class="entry-author">
			<div class="avatar entry-author__avatar">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
			</div>
			<?php printf( __( 'Written by <a class="author-link entry-author__link" href="%s" rel="author">%s</a>', 'jobify' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() ); ?>
		</div>

		<div class="entry-meta">
			<data class="entry-date entry-meta__date" itemprop="datePublished" value="<?php echo get_the_date(); ?>"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_the_date(); ?></a></data>

			<?php if ( comments_open() ) : ?>
				<span class="comments-link entry-meta__comments-link">
					<?php comments_popup_link( __( '0 Comments', 'jobify' ), __( '1 Comment', 'jobify' ), __( '% Comments', 'jobify' ) ); ?>
				</span><!-- .comments-link -->
			<?php endif; ?>
		<!--</div><!-- .entry-meta -->
	<!--</header><!-- .entry-header -->

	<div class="entry col-xs-12">
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>

		<div class="entry-summary">
			<span class="date"><?php echo get_the_date(); ?></span>
			<?php the_post_thumbnail('thumbnail', array( 'class' => 'alignleft' )); ?><?php the_excerpt(); ?>
			<?php //the_content( 'More ...' ); ?>

			<p><a href="<?php the_permalink(); ?>" rel="bookmark" class="button button--size-medium button--type-inverted pull-right"><?php _e( 'Continue Reading', 'jobify' ); ?></a></p>
		</div>
	</div>
</article><!-- #post -->
