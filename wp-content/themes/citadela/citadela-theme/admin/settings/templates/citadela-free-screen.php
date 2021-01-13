<?php
$imgs_url = CitadelaTheme::get_instance()->themePaths->url->settings . '/templates/img';
?>

<div class="citadela-dashboard">
	<div class="citadela-screen-header ctdl-free">
		<img src="<?php echo esc_attr( "$imgs_url/ait-logo.png" ); ?>" alt="<?php esc_attr_e('Created by AitThemes', 'citadela'); ?>">
		<h1><?php esc_html_e('Thank you for installing Citadela Theme by AitThemes', 'citadela'); ?></h1>
		<p class="ctdl-main-desc"><?php esc_html_e('Citadela is a free multi-purpose WordPress theme created by AitThemes. You can use it without any restrictions on your commercial or non-commercial website. We have also created premium versions of Citadela that will shift your website to the whole new level.', 'citadela'); ?></p>
	</div>

	<div class="citadela-screen-holder ctdl-free">
		<div class="ctdl-screen-items">

			<div class="ctdl-screen-item ctdl-bus">
				<div class="ctdl-screen-body">
					<div class="ctdl-screen-thumb">
						<img src="<?php echo esc_attr( "$imgs_url/ctdl-business-opt.jpg" ); ?>" alt="<?php esc_attr_e('Citadela Business', 'citadela'); ?>">
					</div>
					<div class="ctdl-screen-content">

						<h2 class="ctdl-item-title"><?php esc_html_e('Citadela Business', 'citadela'); ?></h2>
						<p class="ctdl-item-desc"><?php esc_html_e('Citadela Business extends free Citadela theme with advanced options that will allow you to customize look & feel of your website. Using WordPress Customizer you will be able to change fonts, configure color, choose different header, footer, sidebars and other layout settings. Extends default WordPress block editor with new useful blocks. These blocks can be used just like standard WordPress ones, on any page or blog post. This plugin can be also used with any WordPress theme compatible with blocks editor.', 'citadela'); ?></p>

						<ul class="ctdl-item-list">
							<li><?php esc_html_e('Various theme layout options', 'citadela'); ?></li>
							<li><?php esc_html_e('Different headers', 'citadela'); ?></li>
							<li><?php esc_html_e('200+ Google fonts', 'citadela'); ?></li>
							<li><?php esc_html_e('Smart color management with unlimited colors', 'citadela'); ?></li>
							<li><?php esc_html_e('Responsive sidebars', 'citadela'); ?></li>
							<li><?php esc_html_e('Full support for WP Customizer', 'citadela'); ?></li>
							<li><?php esc_html_e('Cluster block', 'citadela'); ?></li>
							<li><?php esc_html_e('Services with several layouts', 'citadela'); ?></li>
							<li><?php esc_html_e('Custom Page Title', 'citadela'); ?></li>
						</ul>

						<p class="ctdl-item-cta"><a href="https://www.citadelawp.com/wordpress-layouts-design/#business" target="_blank"><?php esc_html_e('Get Citadela Business', 'citadela'); ?></a></p>

					</div>
				</div>
			</div>

			<div class="ctdl-screen-item ctdl-list">
				<div class="ctdl-screen-body">
					<div class="ctdl-screen-thumb">
						<img src="<?php echo esc_attr( "$imgs_url/ctdl-listing-opt.jpg" ); ?>" alt="<?php esc_attr_e('Citadela Listing', 'citadela'); ?>">
					</div>
					<div class="ctdl-screen-content">

						<h2 class="ctdl-item-title"><?php esc_html_e('Citadela Listing', 'citadela'); ?></h2>
						<p class="ctdl-item-desc"><?php esc_html_e('Citadela Listing knows everything you need to turn your standard website into directory portal. It will allow you to add unlimited listing items, categorize them to locations and categories. You can show them on map, filter and search. Everything is nicely integrated to WordPress block editor. This plugin can be used with any WordPress theme compatible with blocks editor.', 'citadela'); ?></p>

						<ul class="ctdl-item-list">
							<li><?php esc_html_e('Unlimited listing items', 'citadela'); ?></li>
							<li><?php esc_html_e('Categories & Locations', 'citadela'); ?></li>
							<li><?php esc_html_e('Maps with search feature', 'citadela'); ?></li>
							<li><?php esc_html_e('Listing item detail page customizable using blocks', 'citadela'); ?></li>
							<li><?php esc_html_e('Customizable search results page using blocks', 'citadela'); ?></li>
							<li><?php esc_html_e('Customizable categories & locations page using blocks', 'citadela'); ?></li>
						</ul>

						<p class="ctdl-item-cta"><a href="https://www.citadelawp.com/wordpress-layouts-design/#listing" target="_blank"><?php esc_html_e('Get Citadela Listing', 'citadela'); ?></a></p>

					</div>
				</div>
			</div>

		</div>
	</div>

	<?php get_template_part( 'citadela-theme/admin/settings/templates/_layout_packs' ) ?>

</div>
