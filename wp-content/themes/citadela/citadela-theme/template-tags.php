<?php
/**
 * Citadela Theme Custom template tags functions
 *
 */

if ( ! function_exists( 'citadelaTheme_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function citadelaTheme_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$archiveYear  = get_the_time('Y');
		$archiveMonth = get_the_time('m');
		$archiveDay   = get_the_time('d');
		$archiveLink = get_day_link( $archiveYear, $archiveMonth, $archiveDay );

		echo '<span class="posted-on">';
				/* translators: Posted on [post date]. */
        echo 	'<span class="posted-on-text">';
        esc_html_e( 'Posted on', 'citadela' );
        echo '</span> ';
		echo 	'<span class="posted-on-date"><a href="' . esc_url( $archiveLink ) . '" rel="bookmark">' . $time_string . '</a></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</span>';

	}
endif;

if ( ! function_exists( 'citadelaTheme_posted_on_data' ) ) :
	/**
	 * Returns data related to post date
	 */
	function citadelaTheme_posted_on_data() {
		$archiveYear  = get_the_time('Y');
		$archiveMonth = get_the_time('m');
		$archiveDay   = get_the_time('d');
		$archiveLink = get_day_link( $archiveYear, $archiveMonth, $archiveDay );

		return (object) [
			'date'	=> esc_html( get_the_date() ),
			'year' 	=> esc_html( $archiveYear ),
			'month' => esc_html( $archiveMonth ),
			'day' 	=> esc_html( $archiveDay ),
			'monthText' => (object) [
					'full' => esc_html( get_the_time('F') ),
					'short' => esc_html( get_the_time('M') ),
				],
			'link'	=> (object) [
					'year' 	=> esc_url( get_year_link( $archiveYear ) ),
					'month' => esc_url( get_month_link( $archiveYear, $archiveMonth ) ),
					'day' 	=> esc_url( get_day_link( $archiveYear, $archiveMonth, $archiveDay ) ),
				],
		];
	}
endif;

if ( ! function_exists( 'citadelaTheme_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function citadelaTheme_posted_by() {
		if( is_single() ){
			global $post;
			$authorName = get_the_author_meta( 'display_name', $post->post_author);
			$authorUrl = get_author_posts_url( $post->post_author);
		}else{
			$authorUrl = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
			$authorName = esc_html( get_the_author() );
		}
		echo '<span class="byline">';
				/* translators: [posted] by [post author]. */
        echo 	'<span class="byline-text">';
        esc_html_e( 'by', 'citadela' );
        echo '</span> ';
		echo 	'<span class="author vcard"><a class="url fn n" href="' . esc_url($authorUrl) . '">' . esc_html($authorName) . '</a></span>';
		echo '</span>';

	}
endif;

if ( ! function_exists( 'citadelaTheme_categories_list' ) ) :
	/**
	 * Prints HTML with meta information for categories
	 */
	function citadelaTheme_categories_list( $cats_sep = '' ) {
		if ( 'post' === get_post_type() ) {
			$cat_list = get_the_category_list( $cats_sep );
			if ( $cat_list ) {
				echo '<span class="cats-links">';
				/* translators: Posted in [categories list]. */
                echo 	'<span class="cats-text">';
                esc_html_e( 'Posted in', 'citadela' );
                echo '</span> ';
				echo 	'<span class="cats-list">' . $cat_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '</span>';
			}
		}
	}
endif;

if ( ! function_exists( 'citadelaTheme_tags_list' ) ) :
	/**
	 * Prints HTML with meta information for tags .
	 */
	function citadelaTheme_tags_list( $tags_sep = '' ) {
		if ( 'post' === get_post_type() ) {
			$tags_list = get_the_tag_list( '', $tags_sep );
			if ( $tags_list ) {
				echo '<span class="tags-links">';
				/* translators: Tags assigned to post. */
                echo 	'<span class="tags-text">';
                esc_html_e( 'Tagged', 'citadela' );
                echo '</span> ';
				echo 	'<span class="tags-list">' . $tags_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo '</span>';
			}
		}
	}
endif;

if ( ! function_exists( 'citadelaTheme_leave_comment' ) ) :
	/**
	 * Prints HTML with Leave Comment information
	 */
	function citadelaTheme_leave_comment() {
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			$post_title = get_the_title();
			$number = get_comments_number();

			$leave_comment =
				'<span class="comments-number">0</span> '.
				'<span class="comments-text">'.
					sprintf(
						wp_kses(
							/* translators: %s: post title */
							__( 'Comments<span class="screen-reader-text"> on %s</span>', 'citadela' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						$post_title
					).
				'</span>';

			$one_comment =
				'<span class="comments-number">1</span> '.
				/* translators: %s: post title */
				'<span class="comments-text">' . sprintf( __( 'Comment<span class="screen-reader-text"> on %s', 'citadela' ), $post_title ) . '</span>';

			$more_comments =
				'<span class="comments-number">' . $number . '</span> '.
				/* translators: %s: post title */
				'<span class="comments-text">' . sprintf( __( 'Comments<span class="screen-reader-text"> on %s', 'citadela' ), $post_title ) . '</span>';


			echo '<span class="comments-link">';
				comments_popup_link(
					$leave_comment,
					$one_comment,
					$more_comments
				);
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'citadelaTheme_edit_post_link' ) ) :
	/**
	 * Prints HTML with Edit Post link
	 */
	function citadelaTheme_edit_post_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'citadela' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'citadelaTheme_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function citadelaTheme_post_thumbnail() {
		if ( post_password_required() ) {
			return;
		}

		global $post;

		if ( is_singular() ) :

			if ( is_attachment() && wp_attachment_is_image( $post->ID ) ) :
			?>
				<div class="post-thumbnail">
					<a href="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID ) ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
						<?php echo wp_get_attachment_image($post->ID, 'large'); ?>
					</a>
				</div><!-- .post-thumbnail -->

			<?php else : ?>

				<?php 
				$post_thumbnail_url = get_the_post_thumbnail_url( $post->ID );
				if ( $post_thumbnail_url ) :
				?>
				
				<div class="post-thumbnail">
					<a href="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID ) ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
					<?php
					the_post_thumbnail( 'post-thumbnail', array(
						'alt' => the_title_attribute( array(
							'echo' => false,
						) ),
					) );
					?>
				</a>
				</div><!-- .post-thumbnail -->
				<?php endif; ?>
					
			<?php endif; ?>

		<?php else : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
					<?php
					the_post_thumbnail( 'post-thumbnail', array(
						'alt' => the_title_attribute( array(
							'echo' => false,
						) ),
					) );
					?>
				</a>
			</div>

		<?php
		endif; // End is_singular().
	}
endif;
