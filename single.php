<?php /**
 * The template for displaying all single posts
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */
get_header(); ?>
<div class="templastic-main">
	<?php if ( have_posts() ) {
		the_post(); 
		get_template_part( 'content', get_post_format() ); 
		do_action( 'templastic_single_navigation' ); ?>
		<div class="comments">
			<?php comments_template( '', true ); ?>
		</div> <!--.comments -->
	<?php } 
get_sidebar(); 	 
get_footer();