<?php
/**
 * Template part for displaying results in search pages
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			citadelaTheme_posted_on();
			citadelaTheme_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php citadelaTheme_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php
		if( has_excerpt() ){
				$content = strip_shortcodes(get_the_excerpt());
				echo strip_tags( $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}else{
				$content = strip_shortcodes(get_the_content());
				echo wp_trim_words( $content, 50, "..." ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php
			citadelaTheme_categories_list( ' ' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
