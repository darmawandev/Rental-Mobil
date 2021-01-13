<?php
$imgs_url = CitadelaTheme::get_instance()->themePaths->url->settings . '/templates/img';
?>

<div class="citadela-dashboard">
	<div class="citadela-screen-header ctdl-active">
		<img src="<?php echo esc_attr( "$imgs_url/ait-logo.png" ); ?>" alt="<?php esc_attr_e('Created by AitThemes', 'citadela'); ?>">
		<h1><?php esc_html_e('Citadela Dashboard by AitThemes', 'citadela'); ?></h1>
		<p class="ctdl-main-desc"><?php esc_html_e('Thank you for using premium Citadela plugins. As paying AitThemes customer you have access to our support forum and documentation.', 'citadela'); ?></p>
	</div>

	<div class="citadela-screen-holder ctdl-active">
		<div class="ctdl-screen-items">

			<div class="ctdl-screen-item ctdl-doc">
				<div class="ctdl-screen-body">
					<div class="ctdl-screen-thumb">
						<img src="<?php echo esc_attr( "$imgs_url/ctdl-documentation-opt.jpg" ); ?>" alt="<?php esc_attr_e('Documentation', 'citadela'); ?>">
					</div>
					<div class="ctdl-screen-content">
						<h2 class="ctdl-item-title"><?php esc_html_e('Helpful Documentation', 'citadela'); ?></h2>
						<p class="ctdl-item-desc"><?php esc_html_e('Citadela documentation includes everything you need to understand how theme and premium plugins work. It is written for you and other users to get to know our theme as quickly as possible. Documentation is updated on daily basis. Includes description of new features and frequently asked questions from our support.', 'citadela'); ?></p>
						<p class="ctdl-item-cta"><a href="https://system.citadelawp.com/documentation/" target="_blank"><?php esc_html_e('Start Reading', 'citadela'); ?></a></p>
					</div>
				</div>
			</div>

			<div class="ctdl-screen-item ctdl-support">
				<div class="ctdl-screen-body">
					<div class="ctdl-screen-thumb">
						<img src="<?php echo esc_attr( "$imgs_url/ctdl-support-opt.jpg" ); ?>" alt="<?php esc_attr_e('Customer support', 'citadela'); ?>">
					</div>
					<div class="ctdl-screen-content">
						<h2 class="ctdl-item-title"><?php esc_html_e('Support Access', 'citadela'); ?></h2>
						<p class="ctdl-item-desc"><?php esc_html_e('Trained support team will help you to start working on your website quickly. Our goal is to teach you how to use our products efficiently and the right way. Support system is fully confidential and closed, you can ask there any question regarding our theme you like. Please bear in mind that we do not do any customizations. There are plenty of location designers that will be happy to help you with your custom ideas.', 'citadela'); ?></p>
						<p class="ctdl-item-cta"><a href="https://system.citadelawp.com/support/" target="_blank"><?php esc_html_e('Visit Support', 'citadela'); ?></a></p>
					</div>
				</div>
			</div>

		</div>
	</div>

	<?php get_template_part( 'citadela-theme/admin/settings/templates/_layout_packs' ) ?>

</div>
