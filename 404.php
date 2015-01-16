<?php
/**
 * The Template for displaying 404 pages ( Not Found ).
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */
get_header(); ?>
	<div class="templastic-main">
		<div class="templastic-post">
			<article class="templastic-article">
				<h2>404</h2>
				<p><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'templastic' ); ?></p>
				<p><?php _e( 'Please try using our search box below to look for the information on the Internet.', 'templastic' ); ?></p>	
				<?php get_search_form(); ?>
			</article><!-- .templastic-article -->
		</div> <!--.templastic-post -->
	<?php get_sidebar();
get_footer();