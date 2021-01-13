	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php if(is_active_sidebar('footer-widgets-area')) : ?>
			<div class="footer-widgets-button hidden"><span class="ft-button"><i class="fas fa-circle"></i><i class="far fa-times-circle"></i></span></div>
			<div id="footer-widgets" class="footer-widgets-area">

				<?php dynamic_sidebar( 'footer-widgets-area' ); ?>
			</div>
		<?php endif; ?>

		<div class="nav-menu-container nav-menu-footer">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer-menu',
				'menu_id'        => 'footer-menu',
				'depth'			 => 1,
			) );
			?>
		</div>

		<div class="site-info">
				<?php
					$footerText = wp_kses_post( get_theme_mod( 'citadela_setting_footerText', __( 'Created with Citadela WordPress Theme by AitThemes', 'citadela' ) ) );
					if( $footerText != ''){
						echo wp_kses_post( $footerText );
					}
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
