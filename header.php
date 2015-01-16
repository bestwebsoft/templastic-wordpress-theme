<?php /**
 * The header template for Templastic theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */ ?>
 <!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body id="top" <?php body_class(); ?>>
	<div id="wrapper">	
		<div id="templastic_header"> 
		    <div class="templastic-logo-block">
				<div class="templastic-logo">
					<header class="templastic-banner alignleft">
						<h3 class="templastic-site-title wrap">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h3>
						<p class="templastic-site-description wrap"><?php bloginfo( 'description' ); ?></p>
					</header><!-- .templastic-banner -->
					<div class="templastic-search alignright">
						<?php get_search_form(); ?>
					</div><!--templastic-search -->
		 			<div class="clear"></div>
				</div><!--.templastic-logo -->
			</div><!-- .templastic-logo-block -->		
			<div class="templastic-nav-block">
				<nav id="templastic_nav">
					<button class="templastic-toggleMenu"></button>
		    		<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>	
		    		<div class="clear"></div>    
				</nav><!-- #templastic_nav -->
			</div> <!--.templastic-nav-block -->
			<div class="templastic-title-block">	
				<div class="templastic-title">
		            <?php do_action( 'templastic_breadcrumbs' ); ?>
				</div><!--.templasic-title -->
			</div><!-- .templastic-title-block -->
		</div><!--#templastic_header -->	
		<div class="templastic-content">
			<?php if ( is_home() ) 
				get_template_part( 'flex-slider', '' );			  						