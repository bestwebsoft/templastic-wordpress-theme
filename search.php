<?php /**
 * The template for displaying search result
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */
get_header(); ?>
<div class="templastic-main">
	<?php if ( have_posts() ) { ?>
		<h1 class="templastic-search-result">
			<?php printf( __( 'Search Results for', 'templastic' ) . ':' . '&nbsp;%s', '<span>' . get_search_query() . '</span>' ); ?>
		</h1>
		<?php while ( have_posts() ) { 
			the_post(); 
			get_template_part( 'content', get_post_format() );
		}
		do_action( 'templastic_page_nav' );
	}
	else { ?>
		<div class="templastic-post">
			<article class="templastic-article">
				<h1 class="templastic-search-result"><?php printf( __( 'Search Results for', 'templastic' ) . ':' . '&nbsp;%s', '<span>' . get_search_query() . '</span>' ); ?></h1>
				<h2 class="templastic-search-result"><?php _e( 'Nothing Found', 'templastic' ); ?></h2>
				<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'templastic' ); ?></p>
				<?php get_search_form(); ?>
			</article><!-- .templastic-article -->
		</div><!--.templastic-post -->
	<?php }
get_sidebar();			
get_footer();