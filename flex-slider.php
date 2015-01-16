<?php /**
 * The template for displaying slider in header.
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */
global $wp_query;
$args = array( 
	'post_type'				=> 'post',
	'meta_key'				=> 'templastic_add_slide',
	'meta_value'			=> 'on',
	'posts_per_page'		=> -1,
	'ignore_sticky_posts'	=> 1,
);
$wp_query = new WP_Query( $args );
/* check for existing posts with specified parameters*/
if ( $wp_query->have_posts() ) {  ?>
	<div class="flexslider">
		<ul class="slides">
			<?php add_filter( 'excerpt_length', 'templastic_slider_excerpt_length' );
			add_filter( 'excerpt_more', 'templastic_slider_excerpt_more' );
			while ( $wp_query->have_posts() ) { 
				$wp_query->the_post(); ?>
				<li>
					<div class="slider-text">							
						<div class="templastic-slider-head ">
							<a href="<?php the_permalink(); ?>">
								<h4><?php templastic_words_limit( 20, '...', get_the_title() ); ?></h4>
							</a>
						</div>						
						<div class="templastic-slider-content">
							<?php templastic_words_limit( 103, '...', get_the_excerpt() ); ?>
						</div><!-- .templastic-slider-content -->
						<a class="templastic-slider-more" href="<?php the_permalink(); ?>"><?php _e( 'Learn More', 'templastic' ); ?></a>
					</div><!-- .slider-text -->
					<?php if ( has_post_thumbnail() ) { 
						the_post_thumbnail( 'templastic_slider_image_size' ); 
					} ?>
				</li>
			<?php }
			remove_filter( 'excerpt_length', 'templastic_slider_excerpt_length' );
			remove_filter( 'excerpt_more', 'templastic_slider_excerpt_more' ); ?>
		</ul><!-- .slides -->
	</div><!--.flexslider-->
<?php } /* $wp_query->have_posts() */	
wp_reset_postdata();
wp_reset_query(); ?>