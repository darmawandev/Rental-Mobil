<?php
	$allowedHtml = array(
		'a' => array(
				'href' => array(),
        		'title' => array(),
        		'target' => array(),
        		'follow' => array()
        	),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'i' => array(),
	);

	$isWoocommerce = CitadelaTheme::get_instance()->is_active_woocommerce();
	$isPro = CitadelaTheme::get_instance()->is_active_pro_plugin();

/*
	Latest posts page selected as front page in Reading settings do not use page title at all
	if necessary to acces only this page, use condition
	( is_front_page() && is_home() )
*/

	if ( is_front_page() && !is_home()) {
		/*
		*	Static Page homepage defined in Reading Settings
		*/

		$pId = get_the_ID();
		//check if page shows title
		$hideTitle = get_post_meta( $pId, '_citadela_hide_page_title', true );
		if(!$hideTitle) :
			$titleText = get_the_title();
			?>
			<div class="page-title standard">
				<header class="entry-header">
					<div class="entry-header-wrap">
						<h1 class="entry-title"><?php echo esc_html($titleText); ?></h1>
					</div>
				</header>
			</div>
			<?php
		endif;

	} elseif ( is_home() && !is_front_page() ) {
		/*
		*	Blog Page defined in Reading Settings
		*/

		if( ! $isPro ) : 
			//free theme, show page title, width pro plugin is title displayed via plugin
			$pId = get_option('page_for_posts'); //id of page defined as Posts Page in Reading settings
			$blog_page_post = get_post($pId);
			$titleText = $blog_page_post->post_title;
			?>

			<div class="page-title standard">
				<header class="entry-header">
					<div class="entry-header-wrap">
						<h1 class="entry-title"><?php echo esc_html($titleText); ?></h1>
					</div>
				</header>
			</div>

		<?php endif; 

	} else {
		// other types
		if( is_page() ){
			/*
			*	Standard Page
			*/

			$pId = get_the_ID();
			//check if page shows title
			$hideTitle = get_post_meta( $pId, '_citadela_hide_page_title', true );
			if(!$hideTitle) :
				$titleText = get_the_title();
				?>

				<div class="page-title standard">
				<header class="entry-header">
					<div class="entry-header-wrap">
						<h1 class="entry-title"><?php echo esc_html($titleText); ?></h1>
					</div>
				</header>
			</div>

				<?php
			endif;

		}elseif( is_single() ){
			/*
			*	Single posts pages
			*/

				if( get_post_type() === 'post' ){
					/*
					*	Blog Post page
					*/
					$titleText = get_the_title();

					?>

					<div class="page-title standard">
						<header class="entry-header">
							<div class="entry-header-wrap">
								<h1 class="entry-title"><?php echo esc_html($titleText); ?></h1>
								<div class="entry-meta">
									<?php
									citadelaTheme_posted_on();
									citadelaTheme_posted_by();
									?>
								</div>
							</div>
						</header>
					</div>

					<?php

				}else{
					/*
					*	Other single post pages
					*/
					$titleText = get_the_title();
					?>

					<div class="page-title standard">
						<header class="entry-header">
							<div class="entry-header-wrap">
								<h1 class="entry-title"><?php echo esc_html($titleText); ?></h1>
							</div>
						</header>
					</div>

					<?php
				}

		}elseif( is_tax() ){

			if( !is_tax('citadela-item-category') && !is_tax('citadela-item-location') ){
				$titleText = single_term_title('', false);
				$description = term_description();

				?>
				<div class="page-title standard">
					<header class="entry-header">
						<div class="entry-header-wrap">
							<?php 
								// add breadcrumbs for woocommerce product category page
								if ( $isWoocommerce ) {
									woocommerce_breadcrumb();
								}
							?>

							<h1 class="entry-title"><?php echo esc_html($titleText); ?></h1>

							<?php if( $description ) : ?>
							<div class="entry-subtitle">
								<p class="ctdl-subtitle">
									<?php echo wp_kses($description, $allowedHtml); ?>
								</p>
							</div>
							<?php endif; ?>

						</div>

					</header>
				</div>
				<?php
			}

		}elseif( is_archive() ){
			/*
			*	Archives pages
			*/

			if( is_category() ){
				/*
				*	Category archives page
				*/
				$titlePrefix = '<span class="main-text">' . __('Category archives: ', 'citadela') . '</span>';
				$titleText = '<span class="main-data">' . single_cat_title('', false) . '</span>';
				$description = get_the_archive_description();

				?>
				<div class="page-title standard">
					<header class="entry-header">
						<div class="entry-header-wrap">

							<h1 class="entry-title"><?php echo $titlePrefix . $titleText; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1>

							<?php if( $description ) : ?>
							<div class="entry-subtitle">
								<p class="ctdl-subtitle">
									<?php echo wp_kses($description, $allowedHtml); ?>
								</p>
							</div>
							<?php endif; ?>

						</div>
					</header>
				</div>
				<?php
			}


			if (is_author()){
				/*
				*	Author archives page
				*/
				$authorUrl = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
				$authorName = esc_html( get_the_author() );
				$titlePrefix = '<span class="main-text">' . __('Author archives: ', 'citadela') . '</span>';
				$titleText = '<span class="author vcard main-data"><a class="url fn n" href="' . $authorUrl . '">' . $authorName . '</a></span>';
				$description = get_the_archive_description();
				?>
				<div class="page-title standard">
					<header class="entry-header">
						<div class="entry-header-wrap">

							<h1 class="entry-title"><?php echo $titlePrefix . $titleText; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?></h1>

							<?php if( $description ) : ?>
								<div class="entry-subtitle">
									<p class="ctdl-subtitle">
										<?php echo wp_kses($description, $allowedHtml); ?>
									</p>
								</div>
							<?php endif; ?>

						</div>
					</header>
				</div>
				<?php
			}

			if( is_tag() ){
				/*
				*	Tag archives page
				*/
				$titlePrefix = '<span class="main-text">' . __('Tag archives: ', 'citadela') . '</span>';
				$titleText = '<span class="main-data">' . single_tag_title('', false) . '</span>';
				$description = get_the_archive_description();
				?>
				<div class="page-title standard">
					<header class="entry-header">
						<div class="entry-header-wrap">

							<h1 class="entry-title"><?php echo $titlePrefix . $titleText; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?></h1>

							<?php if( $description ) : ?>
								<div class="entry-subtitle">
									<p class="ctdl-subtitle">
										<?php echo wp_kses($description, $allowedHtml); ?>
									</p>
								</div>
							<?php endif; ?>

						</div>
					</header>
				</div>
				<?php
			}

			if( is_date() ){
				/*
				*	Date archives page
				*/
				$titlePrefix = '<span class="main-text">' . __('Date archives: ', 'citadela') . '</span>';
				$titleText = '<span class="main-data">' . get_the_date() . '</span>';
				?>
				<div class="page-title standard">
					<header class="entry-header">
						<div class="entry-header-wrap">
							<h1 class="entry-title"><?php echo $titlePrefix . $titleText; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?></h1>
						</div>
					</header>
				</div>
				<?php
			}


			if ( $isWoocommerce && is_shop() ){
				/*
				*	Woocommerce shop page
				*/
				$pId = get_option( 'woocommerce_shop_page_id' );
				$hideTitle = get_post_meta( $pId, '_citadela_hide_page_title', true );
				?>
				
				<?php if ( ! $hideTitle ) : ?>
					<div class="page-title standard">
						<header class="entry-header">
							<div class="entry-header-wrap">
								<h1 class="entry-title"><?php woocommerce_page_title() ?></h1>
							</div>
						</header>
					</div>
				<?php endif;
			}
			
		}elseif( is_404() ){
			/*
			*	404 Nothing Found Page
			*/
			?>
			<div class="page-title standard">
				<header class="entry-header">
					<div class="entry-header-wrap">
						<h1 class="entry-title"><?php echo esc_html_e( 'Oops! That page can&rsquo;t be found.', 'citadela') ; ?></h1>
					</div>
				</header>
			</div>

			<?php

		}elseif( is_search() ){
			/*
			*	Search results page
			*/
			$searchQuery = '<span class="main-data">' . get_search_query() . '</span>';
			$titleText = '<span class="main-text">' . __('Search results for: ', 'citadela') . '</span>' . $searchQuery;
			?>
			<div class="page-title standard">
				<header class="entry-header">
					<div class="entry-header-wrap">
						<h1 class="entry-title"><?php echo $titleText; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?></h1>
					</div>
				</header>
			</div>

			<?php
		}
	}
?>