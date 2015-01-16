<?php /**
 * The template for content page
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */ ?>
 <div <?php post_class( 'templastic-post' ); ?>>
 	<article class="templastic-article">
 		<header>
 			<?php if ( ! is_page() && ! is_single() ) { ?>
				<h1>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h1>
				<p class="templastic-meta"><?php _e( 'Posted on', 'templastic' ); ?> 
					<a href="<?php the_permalink(); ?>" title="<?php echo get_the_date( 'd F, Y' ); ?>"><?php echo get_the_date( 'd' ) . '&nbsp;'; _e( 'of', 'templastic' ); echo '&nbsp;' . get_the_date( 'F, Y' ); ?></a> 
					<?php _e( 'by', 'templastic' ); ?> <?php the_author_posts_link();
					if ( has_category() ) { 
						printf( '&nbsp;' . __( 'in', 'templastic' ) . '&nbsp;' );
						the_category( ', ' );
					} ?>
				</p>
			<?php } 
			else { ?>
				<h1><?php the_title(); ?></h1>
				<p class="templastic-meta"><?php _e( 'Posted on', 'templastic' ); 
					$arc_year = get_the_time( 'Y' ); $arc_month = get_the_time( 'm' ); $arc_day = get_the_time( 'd' ); ?>
					<a href="<?php echo get_day_link( $arc_year, $arc_month, $arc_day ); ?>">
						<?php echo get_the_date( 'd' ) . '&nbsp;'; _e( 'of', 'templastic' ); echo '&nbsp;' . get_the_date( 'F, Y' ); ?>
					</a> 
					<?php _e( 'by', 'templastic' ); ?> <?php the_author_posts_link();
					if ( has_category() ) { 
						printf( '&nbsp;' . __( 'in', 'templastic' ) . '&nbsp;' );
						the_category( ', ' );
					} ?>
				</p>
			<?php } ?>
		</header>	
		<div>
			<?php if ( has_post_thumbnail() ) { ?>
				<a class="templastic-feature-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'templastic_post_thumbnails_size' ); ?>
				</a>
				<span class="wp-caption-text">                         
					<?php do_action( 'templastic_thumbnail_caption' ); ?>
				</span>
			<?php } ?>
		</div>
		<?php the_content(); 
		wp_link_pages( array( 
			'before' => '<div class="page-links">' . __( 'Pages', 'templastic' ) . ':',
			'after'  => '</div>' 
		) ); ?>
		<div class="hr"></div>
		<footer class="templastic-post-footer">		
			<section class="templastic-tags-box">
				<a href="#top"><?php _e( '[Top]', 'templastic' ); ?></a> 
				<?php edit_post_link( __( 'Edit', 'templastic' ), '', '' ); ?>
				<div class="clear"></div>
				<?php if ( get_the_tag_list() ) { ?>
					<?php echo get_the_tag_list( '', '<span class="tags-coma">, </span>', '' );?>
				<?php } ?>
			</section><!-- .templastic-tags-box -->		
			<?php if ( comments_open( '', true ) ) { ?>
				<section class="comment">
				  	<?php comments_popup_link( __( 'Leave a comment', 'templastic' ), __( 'Leave a comment', 'templastic' ), __( 'Leave a comment', 'templastic' ) ); ?>
				</section> <!-- .comment  -->
			<?php } ?>
			<div class="clear"></div>
		</footer> <!--.templastic-post-footer -->
	</article><!-- .templastic-article -->
</div> <!--.templastic-post -->