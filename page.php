<?php /**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */ 
 get_header(); ?>
<div class="templastic-main">
	<?php if ( have_posts() ) {
		the_post();
		get_template_part( 'content', get_post_format() ); ?>
		<div>
			<div class="comments">
				<?php comments_template( '', true ); ?>
			</div> <!--.comments -->
		</div> <!-- div -->
	<?php }
get_sidebar(); 		
get_footer();