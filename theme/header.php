<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agn_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'agn-theme' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$agn_theme_description = get_bloginfo( 'description', 'display' );
			if ( $agn_theme_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $agn_theme_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<?php
		$current_url = home_url(add_query_arg($_GET, $wp->request));
		$urls = array(
			'wissen' => get_page_link(get_page_by_path('wissen')),
			'denken' => get_page_link(get_page_by_path('denken')),
			'handeln' => get_page_link(get_page_by_path('handeln'))
		);
		?>


		<div class="search-popup">
			<div class="search-popup__header">
				<div class="search-popup__column">
					<form class="search-form" action="/" method="get">
						<?php $category = $_GET['cat'] ? $_GET['cat'] : agn_get_the_area() ?>
						<input hidden type="text" name="cat" value="<?php echo $category ?>">
						<input class="search-input"
							placeholder="Search"
							type="text"
							name="s"
							id="search"
							value="<?php the_search_query(); ?>">
						<button style="position: fixed; pointer-events: none; opacity: 0; top: -100rem;" type="submit">submit</button>
					</form>
				</div>
				<div class="search-popup__column">
					<button type="button" class="filter-button">Filter</button>
				</div>
			</div>

			<div class="search-popup__filter">
				<div class="wordcloud" data-wordcloud-list="
					<?php
					$post_tags = get_tags();
					$topic_tags = get_topic_tags();
					$tags = array();
					foreach ($post_tags as $tag) {
						$tags[strtolower($tag->name)] = $tag;
					}
					foreach ($topic_tags as $tag) {
						if (isset($tags[strtolower($tag->name)])) {
							$tags[strtolower($tag->name)]->count += $tag->count;
						} else {
							$tags[strtolower($tag->name)] = $tag;
						}
					}
					$data = array();
					foreach ($tags as $tag) {
						$slug = $tag->slug ? $tag->slug : $tag->name;
						$data[] = [$tag->name, $tag->count, ['data-tag-slug' => $slug]];
					}
					echo htmlspecialchars(json_encode($data));
					?>
				"></div>
			</div>
		</div>


		<div class="main-navigation-overlay"></div>
		<nav id="site-navigation" class="main-navigation">
			<div id="search-menu">
				<div class="search-icon" <?php echo is_search() ? 'data-disabled="true"' : '' ?>>
					<svg viewbox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
						<path fillmode="even-odd" d="
							M 30 10
							A 20 20 0 0 0 30 50
							A 20 20 0 0 0 30 10
							Z
							M 26 30
							L 34 30
							L 34 60
							L 26 60
							Z"></path>
						<circle fill="white" cx=30 cy=30 r=10></circle>
					</svg>
				</div>
			</div>

			<div id="primary-menu" class="menu">
				<ul class="nav-menu">
					<?php
					foreach ($urls as $category => $url) :
						$is_current_area = "is_$category";

						$classes = $category.'_page';
						if ($is_current_area()) {
							$classes = $classes.' current_page_item is-covering';
						}
						?>
							<li class="page_item <?php echo $classes ?>">
								<a <?php echo $is_current_area() ? '' : 'href="'.$url.'"' ?>>
									<?php echo $category ?>
								</a>
							</li>
					<?php
					endforeach ?>
				</ul>
			</div>

			<?php
			$initial_action = 'cross';
			if (is_page() || is_category()) $initial_action = 'blank';
			?>
			<div id="global-fab"
				data-initial-action="<?php echo $initial_action ?>"
				data-home-url="<?php echo agn_get_parent_archive_url() ?>">
				<button class="the-button fab">
					<svg class="icon-set" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90">
						<defs>
							<style>.cls-1{fill:#fff;}.cls-2{fill:#0f0;}</style>
							<g class="icons">
								<path id="arrow" d="M 0.05 46.773 C 0.066 47.166 0.086 47.56 0.112 47.953 C 0.138 48.347 0.169 48.74 0.206 49.133 C 0.242 49.526 0.283 49.918 0.33 50.31 L 19.51 50.31 L 19.51 45 L 19.51 39.69 L 0.33 39.69 C 0.283 40.082 0.242 40.474 0.206 40.867 C 0.169 41.26 0.138 41.653 0.112 42.047 C 0.086 42.44 0.066 42.834 0.05 43.227 C 0.034 43.621 0.024 44.015 0.019 44.409 C 0.014 44.803 0.014 45.197 0.019 45.591 C 0.024 45.985 0.034 46.379 0.05 46.773 M 60.77 45 L 37.49 21.71 L 45 14.2 L 45 14.2 L 75.8 45 L 45 75.8 L 37.49 68.29 L 60.77 45"/>
								<path id="cross" d="M 23.22 59.27 C 25.723 61.773 28.227 64.277 30.73 66.78 C 35.487 62.023 40.243 57.267 45 52.51 C 49.757 57.267 54.513 62.023 59.27 66.78 L 66.78 59.27 L 52.51 45 L 66.78 30.73 L 59.27 23.22 C 59.27 23.22 59.27 23.22 59.27 23.22 C 54.513 27.977 49.757 32.733 45 37.49 C 40.243 32.733 35.487 27.977 30.73 23.22 C 28.227 25.723 25.723 28.227 23.22 30.73 C 27.977 35.487 32.733 40.243 37.49 45 C 32.733 49.757 27.977 54.513 23.22 59.27 M 66.821 44.728 L 66.821 44.728 L 66.821 44.728 L 66.821 44.728 L 66.821 44.728 L 66.821 44.728 L 66.821 44.728 L 66.821 44.728"/>
								<path id="logo" d="M 23.34 23.34 C 18.03 28.648 14.853 35.727 14.416 43.223 C 13.98 50.718 16.314 58.118 20.973 64.007 C 25.631 69.895 32.295 73.87 39.69 75.17 L 39.69 60.42 C 37.342 59.624 35.21 58.296 33.46 56.54 C 30.401 53.481 28.68 49.327 28.68 45 C 28.68 40.673 30.401 36.519 33.46 33.46 C 36.519 30.401 40.673 28.68 45 28.68 C 49.327 28.68 53.481 30.401 56.54 33.46 C 59.599 36.519 61.32 40.673 61.32 45 C 61.32 49.327 59.599 53.481 56.54 56.54 C 54.79 58.296 52.658 59.624 50.31 60.42 L 50.31 75.17 C 57.938 73.816 64.776 69.616 69.433 63.425 C 74.091 57.234 76.23 49.5 75.416 41.796 C 74.603 34.091 70.896 26.975 65.048 21.893 C 59.201 16.81 51.637 14.131 43.894 14.4 C 36.151 14.669 28.792 17.865 23.31 23.34 Z"></path>
								<path id="plus" d="M 39.69 19.51 L 39.69 39.69 L 19.51 39.69 L 19.51 50.31 L 39.69 50.31 L 39.69 70.49 L 50.31 70.49 L 50.31 50.31 L 70.49 50.31 L 70.49 39.69 L 50.31 39.69 L 50.31 19.51 L 39.69 19.51 Z"></path>
								<path id="search" d="M 45 14.36 C 37.49 14.356 30.234 17.115 24.624 22.108 C 19.013 27.101 15.43 33.987 14.561 41.447 C 13.692 48.907 15.597 56.432 19.91 62.58 L 30.34 52.15 C 28.641 48.674 28.23 44.706 29.18 40.956 C 30.13 37.206 32.381 33.912 35.529 31.664 C 38.678 29.416 42.525 28.357 46.38 28.676 C 50.235 28.996 53.855 30.674 56.591 33.409 C 59.326 36.145 61.004 39.765 61.324 43.62 C 61.643 47.475 60.584 51.322 58.336 54.471 C 56.088 57.619 52.794 59.87 49.044 60.82 C 45.294 61.77 41.326 61.359 37.85 59.66 L 27.42 70.09 C 33.771 74.541 41.58 76.42 49.26 75.343 C 56.941 74.267 63.933 70.313 68.815 64.287 C 73.697 58.261 76.113 50.601 75.572 42.865 C 75.032 35.128 71.574 27.878 65.902 22.59 C 60.229 17.301 52.755 14.358 45 14.36 Z"></path>
							</g>
						</defs>
						<use class="initial cls-2" href="#<?php echo $initial_action ?>"></use>
						<path class="canvas cls-2"></path>
						<path class="search-appendum cls-2" d="M 27.42 70.09 L 19.91 62.58 L 9.65 72.83 C 11.856 75.621 14.379 78.144 17.17 80.35 Z"></path>
					</svg>
				</button>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<noscript>
		<style>
			.loading-screen {
				display: none;
			}
		</style>
	</noscript>
	<div class="loading-screen"></div>

	<div class="text-border">
		<div class="border border-top"></div>
		<div class="border border-bottom"></div>
		<div class="border border-left"></div>
		<div class="border border-right"></div>

		<svg viewBox="0 0 200 200" preserveAspectRatio="none">
			<path id="curve"
				  	d="M 95 195
					   L 10 195 Q 5 195, 5 190
					   L 5 10 Q 5 5, 10 5
					   L 190 5 Q 195 5, 195 10
					   L 195 190 Q 195 195, 190 195
					   L 105 195" fill="transparent" />
			<text>
				<textPath xlink:href="#curve">
					ARBEITSGRUPPE DIE AUSGEHEND VOM DEPARTEMENT
					ARCHITEKTUR DER ETH ZÜRICH VERÄNDERUNG AUF
					ALLEN EBENEN UND IN ALLEN MASSTÄBEN MITGESTALTET.
					FREI IM DENKEN UND VERANTWORTUNGSBEWUSST IM TUN.
					RAUM FÜR DISKUSSION UND ENGAGEMENT. FÜR EINE NEUE
					SELBSTVERSTÄNDLICHKEIT DER NACHHALTIGKEIT.
					ARBEITSGRUPPE DIE AUSGEHEND VOM DEPARTEMENT
					ARCHITEKTUR DER ETH ZÜRICH VERÄNDERUNG AUF
					ALLEN EBENEN UND IN ALLEN MASSTÄBEN MITGESTALTET.
					FREI IM DENKEN UND VERANTWORTUNGSBEWUSST IM TUN.
					RAUM FÜR DISKUSSION UND ENGAGEMENT. FÜR EINE NEUE
					SELBSTVERSTÄNDLICHKEIT DER NACHHALTIGKEIT.
					ARBEITSGRUPPE DIE AUSGEHEND VOM DEPARTEMENT
					ARCHITEKTUR DER ETH ZÜRICH VERÄNDERUNG AUF
					ALLEN EBENEN UND IN ALLEN MASSTÄBEN MITGESTALTET.
					FREI IM DENKEN UND VERANTWORTUNGSBEWUSST IM TUN.
					RAUM FÜR DISKUSSION UND ENGAGEMENT. FÜR EINE NEUE
					SELBSTVERSTÄNDLICHKEIT DER NACHHALTIGKEIT.
				</textPath>
			</text>
		</svg>
	</div>

	<div id="content" class="site-content">
