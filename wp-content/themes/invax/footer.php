<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Invax
 */

?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer">
		<?php if( is_active_sidebar('footer-widgets')) : ?>
		<div class="footer-top-widgets">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar('footer-widgets'); ?>
				</div>
			</div>
		</div>
	    <?php endif; ?>
		
		<div class="footer-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
					 &copy; <?php esc_html_e( 'Copyright by ', 'invax' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo bloginfo( 'name ' ); ?></a> <?php echo esc_html( date_i18n( __( 'Y ', 'invax' ) ) ); ?>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<div class="back-to-top"><i class="fa fa-angle-double-up"></i></div>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
