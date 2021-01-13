<?php
	$imgs_url = CitadelaTheme::get_instance()->themePaths->url->settings . '/templates/img';
	$layout_packs = [
		[
			'img_url'  => "$imgs_url/ctdl-architect-opt.jpg",
			'title'    => __( 'Citadela Architect', 'citadela' ),
			'subtitle' => __( 'Architect Layout Pack', 'citadela' ),
		],
		[
			'img_url'  => "$imgs_url/ctdl-business2-opt.jpg",
			'title'    => __( 'Citadela Business', 'citadela' ),
			'subtitle' => __( 'Business Layout Pack', 'citadela' ),
		],
		[
			'img_url'  => "$imgs_url/ctdl-doctor-opt.jpg",
			'title'    => __( 'Citadela Doctor', 'citadela' ),
			'subtitle' => __( 'Doctor Layout Pack', 'citadela' ),
		],
		[
			'img_url'  => "$imgs_url/ctdl-free-opt.jpg",
			'title'    => __( 'Citadela Free', 'citadela' ),
			'subtitle' => __( 'Free Layout Pack', 'citadela' ),
		],
		[
			'img_url'  => "$imgs_url/ctdl-hotel-opt.jpg",
			'title'    => __( 'Citadela Hotel', 'citadela' ),
			'subtitle' => __( 'Hotel Layout Pack', 'citadela' ),
		],
		[
			'img_url'  => "$imgs_url/ctdl-listing2-opt.jpg",
			'title'    => __( 'Citadela Listing', 'citadela' ),
			'subtitle' => __( 'Listing Layout Pack', 'citadela' ),
		],
		[
			'img_url'  => "$imgs_url/ctdl-photographer-opt.jpg",
			'title'    => __( 'Citadela Photographer', 'citadela' ),
			'subtitle' => __( 'Photographer Layout Pack', 'citadela' ),
		],
		[
			'img_url'  => "$imgs_url/ctdl-restaurant-opt.jpg",
			'title'    => __( 'Citadela Restaurant', 'citadela' ),
			'subtitle' => __( 'Restaurant Layout Pack', 'citadela' ),
		],
	];
?>

<div class="citadela-screen-section ctdl-section-space">
	<h2 class="citadela-screen-title"><?php esc_html_e( 'Ready to use Citadela layouts', 'citadela' ) ?></h2>
	<?php if ( CITADELA_THEME_PACKAGE === 'themeforest' ): ?>
	<p class="citadela-screen-subtitle"><?php esc_html_e( 'You can import any of these layouts to start building your website. Layout can be imported using Citadela Pro plugin. Layout packages can be found in the main zip file you can download from Themeforest.', 'citadela' ) ?></p>
	<?php else: ?>
	<p class="citadela-screen-subtitle"><?php esc_html_e( 'You can import any of these layouts to start building your website. Layout can be imported using Citadela Pro plugin.', 'citadela' ) ?></p>
	<?php endif ?>
</div>

<div class="citadela-screen-holder ctdl-layouts">
	<div class="ctdl-screen-items">

		<?php foreach( $layout_packs as $pack ): ?>
		<div class="ctdl-screen-item">
			<?php if ( CITADELA_THEME_PACKAGE !== 'themeforest' ): ?>
			<a href="https://www.citadelawp.com/wordpress-layouts-design/" target="_blank">
			<?php endif ?>
			<div class="ctdl-screen-body">
				<div class="ctdl-screen-thumb">
					<img src="<?php echo esc_attr( $pack['img_url'] ); ?>" alt="<?php echo esc_attr( $pack['title'] ) ?>">
				</div>
				<div class="ctdl-screen-content">
					<h2 class="ctdl-item-title"><?php echo esc_html( $pack['title'] ) ?></h2>
					<p class="ctdl-item-subtitle"><?php echo esc_html( $pack['subtitle'] )  ?></p>
				</div>
			</div>
			<?php if ( CITADELA_THEME_PACKAGE !== 'themeforest' ): ?>
			</a>
			<?php endif ?>
		</div>
		<?php endforeach ?>

	</div>
</div>

<?php if ( CITADELA_THEME_PACKAGE !== 'themeforest' ): ?>
<div class="citadela-screen-section">
	<p class="ctdl-item-cta"><a href="https://www.citadelawp.com/wordpress-layouts-design/" target="_blank"><?php esc_html_e( 'Download layouts', 'citadela' ); ?></a></p>
</div>
<?php endif ?>
