<?php /**
 * The sidebar containing the main widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */ ?>
	<div class="clear"></div>
</div> <!--.templastic-main -->
<div id="templastic_sidebar">			
	<?php if ( is_active_sidebar( 'left_sidebar' ) ) { ?>
		<?php dynamic_sidebar( 'left_sidebar' ); ?>		
	<?php }
	else { ?>
		<aside class="templastic-sidebar-part">
			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
		</aside>
		<aside class="templastic-sidebar-part">
			<?php the_widget( 'WP_Widget_Recent_Comments' ); ?>
		</aside>
	<?php } ?>			
</div><!--#templastic_sidebar -->