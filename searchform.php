<?php /**
 * The template for displaying search forms in Green Garden
 *
 * @subpackage Templastic
 * @since Templastic 1
 */ ?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="alignleft" name="s" id="s" placeholder="<?php _e( 'Enter search keyword', 'templastic' ); ?>" title="<?php _e( 'Enter search keyword', 'templastic' ); ?>"onblur="this.placeholder=(this.placeholder=='')?this.title:this.placeholder;" onfocus="this.placeholder=(this.placeholder==this.title)?'':this.placeholder;" value="" />
	<div class="clear"></div>
</form><!-- .searchform -->
