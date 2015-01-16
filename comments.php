<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
    if ( have_comments() || comments_open() ) { ?>
		<div id="comments" class="comments-area">
			<h2 class="comments-title">
				<?php printf( _nx( __( 'One comment on', 'templastic' ) . '&nbsp;&ldquo;%2$s&rdquo;', '%1$s&nbsp;' . __( 'comments on', 'templastic' ) . '&nbsp;&ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'templastic' ),
								number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
			</h2>
			<ol class="comment-list">
				<?php wp_list_comments( array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 44,
				) ); ?>
			</ol><!-- .comment-list -->
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
				<nav class="navigation comment-navigation" role="navigation">
					<h1 class="templastic-screen-reader-text section-heading"><?php _e( 'Comment navigation', 'templastic' ); ?></h1>
					<div class="templastic-nav-previous alignleft"><?php previous_comments_link( __( '&larr; Previous comments', 'templastic' ) ); ?></div>
					<div class="templastic-nav-next alignright"><?php next_comments_link( __( 'Next Comments &rarr;', 'templastic' ) ); ?></div>
					<div class="clear"></div>
				</nav><!-- .comment-navigation -->
			<?php } /* Check for comment navigation */
			if ( ! comments_open() && get_comments_number() ) { ?>
				<p class="templastic-no-comments"><?php _e( 'Comments are closed.' , 'templastic' ); ?></p>
			<?php } ?>
        </div><!-- #comments -->
	<?php } /* have_comments() */ 
    comment_form(); ?>

