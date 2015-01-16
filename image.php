<?php /**
 * The template for image attachments
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */
get_header(); ?>
<div class="templastic-main">
	<?php while ( have_posts() ) : the_post(); ?>
		<div <?php post_class( 'templastic-post' ); ?>>
			<article class="templastic-article">
				<header>
					<h1>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h1>
					<p class="templastic-meta">
						<?php $metadata = wp_get_attachment_metadata();
						_e( 'Posted on', 'templastic' ); ?>
						<a href ="<?php the_permalink(); ?>" title="<?php echo get_the_date( 'd F, Y' ); ?>"><?php echo get_the_date( 'd' ) . '&nbsp;'; _e( 'of', 'templastic' ); echo '&nbsp;' . get_the_date( 'F, Y' ); ?></a>
						<?php _e( 'at', 'templastic' ); ?>
						<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" title="<?php _e( 'Link to full-size image', 'templastic' ); ?>" target="<?php _e( 'Link to full-size image', 'templastic' ); ?>">
							<?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?>
						</a>
						<?php _e( 'in', 'templastic' ); ?>
						<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php _e( 'Return to', 'templastic' ); echo '&nbsp' . esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ); ?>" rel="gallery">
							<?php echo get_the_title( $post->post_parent ) . "."; ?>
						</a>
					</p>
				</header>
				<div class="templastic-text">
					<div class="entry-attachment">
						<div class="attachment center">
							<?php /*
							 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
							 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
							 */
							$attachments = array_values( 
								get_children( array( 
										'post_parent'    => $post->post_parent, 
										'post_status'    => 'inherit', 
										'post_type'      => 'attachment', 
										'post_mime_type' => 'image', 
										'order'          => 'ASC', 
										'orderby'        => 'menu_order ID' 
								) ) 
							);
							foreach ( $attachments as $m => $attachment ) :
								if ( $attachment->ID == $post->ID )
									break;
							endforeach;
							$m++;
							// If there is more than 1 attachment in a gallery
							if ( count( $attachments ) > 1 ) :
								if ( isset( $attachments[ $m ] ) ) :
									// get the URL of the next image attachment
									$next_attachment_url = get_attachment_link( $attachments[ $m ]->ID );
								else :
									// or get the URL of the first image attachment
									$next_attachment_url = get_attachment_link( $attachments[0]->ID );
								endif;
							else :
								// or, if there's only 1 image, get the URL of the image
								$next_attachment_url = wp_get_attachment_url();
							endif; ?>
							<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
								<?php 
								// Filter the image attachment size to use.		 
								$attachment_size = apply_filters( 'templastic_attachment_size', array( 540, 9999, true ) );
								echo wp_get_attachment_image( $post->ID, $attachment_size ); ?>
							</a>
							<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<div class="wp-caption-text">
									<?php the_excerpt(); ?>
								</div>
							<?php endif; ?>
						</div><!-- .attachment -->
					</div><!-- .entry-attachment -->
					<nav id="templastic-image-navigation" role="navigation">
						<span class="templastic-nav-previous wrap"><?php previous_image_link( false, '&lsaquo;&lsaquo;&nbsp;' . __( 'Previous', 'templastic' ) ); ?></span>
						<span class="templastic-nav-next wrap"><?php next_image_link( false, __( 'Next', 'templastic' ) . '&nbsp;&rsaquo;&rsaquo;' ); ?></span>
						<div class="clear"></div>
					</nav> <!-- #templastic-image-navigation -->
						<?php the_content(); ?>
						<div class="hr"></div>
					<footer class="templastic-post-footer">
						<section class="templastic-tags-box">
							<a href="#top"><?php _e( '[Top]', 'templastic' ); ?></a> 
							<?php edit_post_link( __( 'Edit', 'templastic' ), '', '' ); ?>
							<div class="clear"></div>
							<?php if ( get_the_tag_list() ) { ?>
								<?php echo get_the_tag_list( '', '<span class="tags-coma">, </span>', '' ); ?>
							<?php } ?>
						</section><!-- .templastic-tags_box --> 
						<?php if ( comments_open() ) { ?>
							<section class="comment">
							  	<?php comments_popup_link( __( 'Leave a comment', 'templastic' ), __( 'Leave a comment', 'templastic' ), __( 'Leave a comment', 'templastic' ) ); ?>
							</section> <!-- .comment  -->
						<?php }; ?> 
						<div class="clear"></div>
					</footer> <!-- .templastic-post-footer -->
				</div><!-- .templastic-text -->
			</article><!-- .templastic-article -->	
		</div><!-- .templastic-post -->
		<?php comments_template();
	endwhile; // end of the loop.
get_sidebar(); 
get_footer(); 