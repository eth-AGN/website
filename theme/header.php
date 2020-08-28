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
			'wissen' => get_category_link(get_category_by_slug('wissen')),
			'denken' => get_category_link(get_category_by_slug('denken')),
			'handeln' => get_category_link(get_category_by_slug('handeln'))
		);
		?>


		<div class="search-popup">
			<div class="search-popup__header">
				<div class="search-popup__column">
					<form action="/" method="get">
						<input class="search-input"
							placeholder="Search"
							type="text"
							name="s"
							id="search"
							value="<?php the_search_query(); ?>">
						<input hidden type="text" name="cat" value="<?php echo get_the_category()[0]->slug ?>">
						<button hidden type="submit">submit</button>
					</form>
				</div>
				<div class="search-popup__column">
					<button type="button" class="filter-button">Filter</button>
				</div>
			</div>

			<div class="search-popup__filter">
				<div class="wordcloud" data-wordcloud-list="
					<?php
					$tags = get_tags();
					$data = array();
					foreach ($tags as $tag) {
						$data[] = [$tag->name, $tag->count, ['data-tag-slug' => $tag->slug]];
					}
					echo htmlspecialchars(json_encode($data));
					?>
				"></div>
			</div>
		</div>


		<div class="main-navigation-overlay"></div>
		<nav id="site-navigation" class="main-navigation">
			<div id="search-menu">
				<div class="search-icon">
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
					<?php foreach ($urls as $category => $url) :
						if (is_category($category)):
						?>
						<li class="page_item current_page_item is-covering <?php echo $category.'_page' ?>">
							<a><?php echo $category ?></a>
						</li>
						<?php else: ?>
						<li class="page_item <?php echo $category.'_page' ?>">
							<a href="<?php echo $url ?>">
								<?php echo $category ?>
							</a>
						</li>
					<?php endif; endforeach ?>
				</ul>
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
				  	d="M 90 195
					   L 10 195 Q 5 195, 5 190
					   L 5 10 Q 5 5, 10 5
					   L 190 5 Q 195 5, 195 10
					   L 195 190 Q 195 195, 190 195
					   L 110 195" fill="transparent" />
			<text style="font-size: 3pt">
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
