<?php /**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */ 
get_header(); ?>
<div class="templastic-main">
	<?php if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );	
        }
	    do_action( 'templastic_page_nav' ); 
	}
    elseif ( current_user_can( 'edit_posts' ) ) {
		// Show a different message to a logged-in user who can add posts.?> 
		<div class="templastic-post">
			<article class="templastic-article">
				<h1><?php _e( 'No posts to display', 'templastic' ); ?></h1>
				<p><?php printf( __( 'Ready to publish your first post? ', 'templastic' ) . '<a href="%s">' . __( 'Get started here ', 'templastic' ) . '</a>.', admin_url( 'post-new.php' ) ); ?></p>
			</article><!-- .templastic-article -->
		</div><!-- .templastic-post -->
	<?php }
    else { ?>
		<div class="templastic-post">
			<article class="templastic-article">
				<h1><?php _e( 'No posts found', 'templastic' ); ?></h1>
				<h3><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'templastic' ); ?></h3>
				<div class="entry">		
					<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'templastic' ); ?></p>			
					<?php get_search_form(); ?>
				</div><!-- .entry -->
			</article><!-- .templastic-article -->	
		</div> <!-- .templastic-post -->
	<?php };
get_sidebar();		 
get_footer();