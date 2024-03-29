<?php
/**
 * The homepage
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
<div id="page" class="site has-content-centered">
    <div id="content">

    <div class="agn-logo">
        <a href="/denken">
            <svg viewbox="0 0 100 100">
                <defs>
                <mask id="hole">
                    <rect x=0 y=0 width="100" height="100" fill="white"/>
                    <circle r="26" cx="50" cy="50" fill="black"/>
                    <rect x="41" y="50" width="18" height="50" fill="black"/>
                </mask>
                </defs>
                <circle r="50" cx="50" cy="50" mask="url(#hole)" />
            </svg>
        </a>
    </div>

    <h1>
        <span class="is-left">Arbeitsgruppe</span>
        <span class="is-right">Nachhaltigkeit</span>
    </h1>
    
    <p class="login">
        <span class="is-left">
            <a href="<?php echo esc_url( wp_login_url('/denken') ); ?>" alt="<?php esc_attr_e( 'Login', 'textdomain' ); ?>">
                ETH login
            </a>
        </span>
        <span class="is-right">
            <a href="/denken">
                or enter
            </a>
        </span>
    </p>

    <p class="social">
        <span class="is-left">
            <a href="mailto:agn@arch.ethz.ch">
                Email
            </a>
        </span>
        
        <span class="is-right">
            <a href="https://www.instagram.com/agn_ethz/" rel="norefferer" target="_blank">
                Insta
            </a>
        </span>
    </p>
    
    <script type="text/javascript">
    window.addEventListener('keydown', event => {
        if (event.key == 'Enter') {
            window.location = '/denken'
        }
    })
    </script>

<?php
// get_sidebar();
get_footer();
