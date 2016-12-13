<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Second_Exam
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'secondexam' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'secondexam' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'secondexam' ), 'secondexam', '<a href="http://facebook.com/tajulislamdu" rel="designer">Mohammad Tajul Islam</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
