<?php /**
 * The template for footer
 *
 * @subpackage Templastic
 * @since Templastic 1.0
 */ ?>				
			<div class="clear"></div>
		</div><!--.templastic-content -->
		<div class="clear"></div>
		<footer class="templastic-footer">
			<span><?php _e( 'Created by', 'templastic' ); ?>
				<a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>" target="_blank">BestWebSoft</a> 
				<?php printf( __( 'and', 'templastic' ) ); ?>
				<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" target="_blank"> WordPress </a>
				&copy; <?php echo '&nbsp;' . date( 'Y' ) . '&nbsp;'; ?>
				<?php bloginfo( 'name' ); ?>
			</span>
		</footer><!-- .templastic-footer -->
	</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>
