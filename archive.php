<?php /**
 * The template for displaying Archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */ 
get_header(); ?>
<div class="templastic-main">		 
	<?php if ( have_posts() ) { ?>
		<h1 class="templastic-archives">
		<?php if ( is_day() ) {
			printf( __( 'Daily Archives', 'templastic' ) . ':' . '&nbsp;%s', '<span>' . get_the_date() . '</span>' );
		}
		elseif ( is_month() ) {
			printf( __( 'Monthly Archives', 'templastic' ) . ':' . '&nbsp;%s', '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'templastic' ) ) . '</span>' );
		}
		elseif ( is_year() ) {
			printf( __( 'Yearly Archives', 'templastic' ) . ':' . '&nbsp;%s', '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'templastic' ) ) . '</span>' );
		}
		elseif ( is_author() ) {
			print( __( 'Archives of', 'templastic' ) . '&nbsp;' . '<span>' . get_the_author() . '</span>' );
		}
		elseif ( is_tag() ) {
			print( __( 'Archives by tag', 'templastic' ) . ':' . '&nbsp;' . '<span>' ); print( single_tag_title() . '</span>' );
		}
		elseif ( is_category() ) {
			print( __( 'Archives by category', 'templastic' ) . ':' . '&nbsp;' . '<span>' ); print( single_cat_title( '', false ) . '</span>' );
		}
		else {
			_e( 'Archives', 'templastic' );
		} ?>
		</h1>				
		<?php while ( have_posts() ) {
			the_post(); ?>
			<div class="templastic-post">
				<article class="templastic-article">
					<header>
						<h1><a href="<?php the_permalink(); ?>" title ="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<p class="templastic-meta">
							<?php _e( 'Posted on', 'templastic' ); ?> 
							<a href="<?php the_permalink(); ?>" title="<?php echo get_the_date( 'd F, Y' ); ?>"> 
								<?php echo get_the_date( 'd' ) . '&nbsp;'; _e( 'of', 'templastic' ); echo '&nbsp;' . get_the_date( 'F, Y' ); ?>
							</a> 
							<?php _e( 'by', 'templastic' ); ?> <?php the_author_posts_link(); ?> <?php _e( 'in', 'templastic' ); ?> <?php the_category ( ', ' ) ?>
						</p>
						<?php if ( has_post_thumbnail() ) { ?>
							<p>
								<a class="templastic-feature-img" href="<?php the_permalink(); ?> " name="<?php the_title_attribute (); ?>">
									<?php the_post_thumbnail( 'post-thumbnails-size' ); ?>
								</a>
								<span class="wp-caption-text">  
									<?php do_action( 'templastic_thumbnail_caption' ); ?>
								</span>
							</p>
						<?php } ?>
					</header>
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
				</article><!--.templastic-article -->	
			</div> <!--.templastic-post -->
		<?php }
		do_action( 'templastic_page_nav' ); 
	}
get_sidebar(); 
get_footer();