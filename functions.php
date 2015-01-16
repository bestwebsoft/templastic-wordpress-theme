<?php /**
 * Templastic functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action
 * hook in WordPress to change core functionality.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */

/* Templastic Theme Setup --------------------------------------------------------- */
function templastic_theme_setup() {
	/* Sets up the content width value based on the theme's design. */
	if ( ! isset( $content_width ) )
		$content_width = 640;
	/* Makes Templastic available for translation. 
	   Translations can be added to the /languages/ directory. */
	load_theme_textdomain( 'templastic', get_template_directory() . '/languages' );
	/* Styles the visual editor with editor-style.css */
	add_editor_style();
	/* Adds RSS feed links to <head> for posts and comments. */
	/* Set post image size */
	add_image_size( 'templastic_post_thumbnails_size', 503, 276, true ); 
	add_image_size( 'templastic_slider_image_size', 940, 307, true );
	add_theme_support( 'automatic-feed-links' );
	/* Add theme support for Featured Images */
	add_theme_support( 'post-thumbnails' );
	/* This theme supports all available post formats by default.
	   See http://codex.wordpress.org/Post_Formats */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );
	/* Add theme support for Custom Header */
	$header_args = array(
		'default-image'				=> '',
		'width'						=> 1920,
		'height'					=> 200,
		'flex-width'				=> false,
		'flex-height'				=> false,
		'random-default'			=> false,
		'header-text'				=> true,
		'default-text-color'		=> '2d363a',
		'uploads'					=> true,
		'admin-head-callback'		=> '',
		'wp-head-callback'			=> 'templastic_header_style',
	);
	add_theme_support( 'custom-header', $header_args );
	/* Add theme support for Custom Background */
	$background_args = array(
		'default-color'				=> 'e7eaef',
		'default-image'				=> '',
		'wp-head-callback'			=> '_custom_background_cb',
		'admin-head-callback'		=> '',
		'admin-preview-callback'	=> '',
	);
	add_theme_support( 'custom-background', $background_args );
}

/* Function add menu pages */
function templastic_admin_menu() {
	global $bws_theme_info;
	if ( empty( $bws_theme_info ) ) {
		if ( ( function_exists( 'wp_get_theme' ) ) ) {
			$current_theme = wp_get_theme();
			$current_theme_ver = $current_theme->get( 'Version' );
		} else
			$current_theme_ver = '';
		$bws_theme_info = array( 'id' => '144', 'version' => $current_theme_ver );
	}
	require_once( dirname( __FILE__ ) . '/bws_menu/bws_menu.php' );
	add_theme_page( 'BWS Themes', 'BWS Themes', 'edit_theme_options', 'bws_themes', 'bws_add_themes_menu_render' );
}

/* Styles the header text displayed on the blog ---------------------------- */
function templastic_header_style() {
	$header_color = get_header_textcolor();
	$display_text = display_header_text(); ?>
	<style type="text/css">
		/* Set custom header background */
		.templastic-logo-block { 
			background: url( '<?php header_image() ?>' ) no-repeat top center; 
		}
	</style>
	<?php /* If no custom options for text are set... */
	if ( $header_color ==  HEADER_TEXTCOLOR )
		return;
	/* If we get this far, we have custom styles... */ ?>
	<style type="text/css">
	<?php if ( ! ( 'blank' == $header_color ) ) { ?>
		.templastic-site-title a,
		.templastic-site-description {
			color: #<?php echo $header_color; ?> !important;
		}
	<?php }
	if ( ! $display_text ) { ?>
		.templastic-site-title a,
		.templastic-site-description {
			display: none;
		}
	<?php } ?>
	</style>
<?php } 

/* For navigation --------------------------------------------------------- */
function templastic_register_nav_menu() {
	register_nav_menu( 'header-menu', __( 'Header Menu', 'templastic' ) );
}

/* For breadcrumbs ---------------------------------------------------------*/
function templastic_the_breadcrumb() {
	{
    global $post, $wp_query; ?>
    <ul id="templastic_breadcrumbs">
	    <?php if ( ! is_home() ) { ?>
	        <li>
	        	<a href="<?php echo home_url(); ?>"><?php _e( 'Home', 'templastic' ); ?></a>
	        </li>
	        <li> - </li>
	        <?php if ( is_category() || is_single() ) {
	        	if ( is_category() && ! is_single() ) { ?>
	            	<li class="last">
						<?php echo single_cat_title( '', false ); ?>
	            	</li>
	            <?php }
            	else {
                	if ( is_single() ) { 
						/* if it is a page of a paginated post */
						if ( isset( $_GET[ 'page' ] ) && ! empty( $_GET[ 'page' ] ) ) {
							echo '<li><a href=' . get_permalink() . '>' . templastic_words_limit( 30, '...', get_the_title() ) . '</a></li><li> - </li>';
							echo '<li class="last">'; _e( 'Page','templastic' ); echo $_GET[ 'page' ] . '</li>'; 
	           			}
	           			else {
							echo '<li class="last">'; echo templastic_words_limit( 30, '...', get_the_title() ) . '</li>';
						}
	           		}
	        	}
	        }	 
			elseif ( is_page() ) {
				if ( has_category() ) {
								echo '<li>' . the_category() . '</li><li> - </li>';
							}
				if( $post->ancestors ) {
				/* reverse order of a parent pages array for the current page */
				$ancestors = array_reverse( $post->ancestors );
				/* display links to parent pages of the current page */
				for( $i = 0; $i < count( $ancestors); $i++ ) {
					if ( 0 == $i ) {
						echo '<li><a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a></li><li> - </li>';  
					} 
					else {
						echo '<li><a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a></li><li> - </li>';  
					}
				}
				echo '<li class="last">'; echo templastic_words_limit( 30, '...', get_the_title() ) . '</li>';  
				} 
				else {
				echo '<li class="last">'; echo templastic_words_limit( 30, '...', get_the_title() ) . '</li>';  
				}
			}
			elseif ( is_attachment() ) { ?>
				<li class='last'><?php get_the_title() ?></li>;
			<?php }	
	   	    elseif ( is_tag() ) { ?>
	   	    	<li class='last'><?php single_tag_title(); ?></li>
	   	    <?php }    
	    	elseif ( is_day() ) { ?>
	    		<li class='last'><?php the_time( 'F jS, Y' ); ?></li>
	    	<?php }
	    	elseif ( is_month() ) { ?>
	    		<li class='last'><?php the_time( 'F, Y' ); ?></li>
	    	<?php }
	    	elseif ( is_year() ) { ?>
	    		<li class='last'><?php the_time( 'Y' ); ?></li>
	    	<?php }
	   	    elseif ( is_author() ) { ?>
	   	    	<li class='last'><?php echo __( 'Author Archive', 'templastic' ) . '&nbsp;'; ?></li>
	   	    <?php }
	    	elseif ( isset ( $_GET['paged'] ) && ! empty ( $_GET['paged'] ) ) { ?>
	    		<li class='last'><?php echo __( 'Blog Archives', 'templastic' ) . '&nbsp;'; ?></li>
	    	<?php }
	    	elseif ( is_search() ) { ?>
	    		<li class='last'><?php printf( get_search_query() ) ?></li>
	    	<?php }
	    	elseif ( is_404() ) { ?>
	    		<li class='last'><?php echo __( 'Page not found ', 'templastic' ) . '&nbsp;'; ?></li>
	    	<?php } 
	    	else { ?>
	   	    	<li class='last'><?php single_tag_title(); ?></li>
	   	    <?php }
	    	} 
    	} ?>
    </ul>
    <div class="clear"></div>
<?php }

/* Register our sidebars and widgetized areas. --------------------------------*/
function templastic_arphabet_widgets_init() {
	register_sidebar( array(
		'name'			 => __( 'Left sidebar', 'templastic' ),
		'id'			 => 'left_sidebar',
		'before_widget'	 => '<aside class="templastic-sidebar-part" >',
		'after_widget' 	 => '</aside>',
		'before_title' 	 => '<h6 class="templastic-widget-title">',
		'after_title'	 => '</h6>',
	) );
}

/* For slider -----------------------------------------------------------------*/
/*the quantity  of characters in the text slider*/
function templastic_words_limit( $count, $after, $title ) {
if ( mb_strlen( $title ) > $count) $title = mb_substr( $title,0,$count );
else $after = '';
echo $title . $after;
}
/*filter for slider excerpt ( 23 words )*/
function templastic_slider_excerpt_length( $length ) { 
	return 23;
}
/*filter for slider excerpt ( nothing instead [...] )*/
function templastic_slider_excerpt_more( $more ) { 
	return '';
}
/*filter for customize 'more' in excerpt*/
function templastic_excerpt_more( $more ) { 
	return ' <a class="continue" href="'. get_permalink( get_the_ID() ) . '">[' . __( 'Continue', 'templastic' ) . ']</a>';
}
/*adding metabox for show post in slider*/
function templastic_metabox_for_slider() { 
	add_meta_box( 'templastic_checkbox_for_slider', __( 'Add to slider' , 'templastic'), 'templastic_metabox_for_slider_callback', 'post', 'normal' );
}
/* add and save meta for post*/
function templastic_save_post_meta( $post_id ) { 	
	global $post, $post_id;	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
	elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	if ( $post != NULL ) {
		if ( ( isset ( $_POST['templastic_add_slide'] ) ) && ( $_POST['templastic_add_slide'] == 'on' ) &&  ( has_post_thumbnail() ) ) {
			update_post_meta( $post->ID, 'templastic_add_slide', $_POST['templastic_add_slide'] );
		}
		else {
			update_post_meta( $post->ID, 'templastic_add_slide', 'off' );
		}		
	}
}
/*customize metabox*/
function templastic_metabox_for_slider_callback() { 
	global $post; 
	$screen = get_current_screen(); ?>
	<label for='templastic_add_slide'><?php echo __( 'To add this post into the slider, mark it', 'templastic' ); ?></label>	
	<input type='checkbox' name='templastic_add_slide' id='templastic_add_slide' value='on' 
		<?php if ( 'on' == get_post_meta( $post->ID, 'templastic_add_slide', true ) ) {
	    	?> checked='checked' <?php } ?> />
	<?php }

/* Proper way to enqueue scripts and styles ------------------------------------------------*/
function templastic_scripts() {
	if ( is_singular() && comments_open() )
		wp_enqueue_script( 'comment-reply' );
	/* Add style */
	wp_enqueue_style( 'templastic_style', get_stylesheet_uri() );
	/* Run Templastic Blog Theme scripts */
	wp_enqueue_script( 'templastic_script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
	/* Add JavaScript & CSS for slider */
	wp_enqueue_style( 'templastic-slider-css', get_template_directory_uri(). '/css/flexslider.css');
	wp_enqueue_script( 'templastic--slider-script', get_template_directory_uri() . '/js/jquery.flexslider-min.js ', array( 'jquery' ), true );
	/* Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. */
	wp_enqueue_script( 'templastic-support-script', get_template_directory_uri() . '/js/html5.js', array( 'jquery' ) );
	/*array with elements to localize in scripts*/
	$script_localization = array( 
		'choose_file'			        => __( 'Choose file...', 'templastic' ),
		'file_is_not_selected'	        => __( 'File is not selected.', 'templastic' ),
		'templastic_home_url'			=> esc_url( home_url() ),
	);
	/*localization in scripts*/
	wp_localize_script( 'templastic_script', 'script_loc', $script_localization );	
}

/* Templastic Blog title ------------------------------------------------------------------ */
function templastic_wp_title( $title, $sep ) {
    if ( is_feed() ) {
		return $title;
	}	
	global $page, $paged;
	/* Add the blog name */
	$title = get_bloginfo( 'name', 'display' ).$title;
	/* Add the blog description for the home/front page. */
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}
	/* Add a page number if necessary: */
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page', 'templastic' ) . '&nbsp;%s', max( $paged, $page ) );
	}
	return $title;	
}

/* Pagination for index.php, category.php, archive.php, search.php  ------------------------*/
function templastic_page_nav() {
	global $wp_query, $wp_rewrite;
	$max = $wp_query->max_num_pages;
	if ( ! $pagecurrent = get_query_var( 'paged' ) ) 
		$pagecurrent = 1;
	$n = array(
		'base' 		=> str_replace( 999999, '%#%', get_pagenum_link( 999999 ) ),
		'total' 	=> $max,
		'current' 	=> $pagecurrent,
		'mid_size' 	=> 2, /* How many pages before and after current page. */
		'end_size' 	=> 0, /* How many pages at start and at the end. */
		'prev_text' => '&laquo;', 
		'next_text' => '&raquo;',
	);
	if ( $max > 1 )
		echo '<div class="templastic-page-navigation">' . paginate_links( $n ) . '</div>';
}

/* For single navigation  ---------------------------------------------------------------------*/
function templastic_single_navigation() { ?>
	<nav class="templastic-single-navigation" role="navigation">
		<span class="templastic-nav-previous alignleft wrap"><?php previous_post_link( '%link', '&lsaquo;&lsaquo;&nbsp;' . '%title' ); ?></span>
		<span class="templastic-nav-next alignright wrap"><?php next_post_link( '%link', '%title' . '&nbsp;&rsaquo;&rsaquo;' ); ?></span>
	</nav><!-- .templastic-single-navigation -->
	<div class="clear"></div>
<?php }

/* For caption in featured image  -------------------------------------------------------------*/
function templastic_the_post_thumbnail_caption() {
    global $post;
    $thumbnail_id    = get_post_thumbnail_id( $post->ID );
    $thumbnail_image = get_posts( 
    	array( 
    		'p'         => $thumbnail_id, 
    		'post_type' => 'attachment' ) 
    	); 
    if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
        echo '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
    }
}
add_action( 'after_setup_theme', 'templastic_theme_setup' );
add_action( 'init','templastic_register_nav_menu' );
add_action( 'admin_menu', 'templastic_admin_menu' );
add_action( 'templastic_breadcrumbs', 'templastic_the_breadcrumb' );
add_action( 'widgets_init', 'templastic_arphabet_widgets_init' );
add_filter( 'excerpt_more', 'templastic_excerpt_more' );
add_action( 'add_meta_boxes', 'templastic_metabox_for_slider' );
add_action( 'save_post', 'templastic_save_post_meta' );
add_action( 'wp_enqueue_scripts', 'templastic_scripts' );
add_filter( 'wp_title', 'templastic_wp_title', 10, 2 );
add_action( 'templastic_page_nav', 'templastic_page_nav' );
add_action( 'templastic_single_navigation', 'templastic_single_navigation' );
add_action( 'templastic_thumbnail_caption', 'templastic_the_post_thumbnail_caption' );