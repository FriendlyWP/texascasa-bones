			<footer class="footer" role="contentinfo">
			
				<div id="inner-footer" class="wrap clearfix">

					<div class="footer-widgets-main clearfix">

						<?php if ( is_active_sidebar( 'footer1' ) ) : ?>

							<?php dynamic_sidebar( 'footer1' ); ?>

						<?php else : ?>

							<!-- nothing -->

						<?php endif; ?>
					</div>					
				
				</div> <!-- end #inner-footer -->


				
			</footer> <!-- end footer -->

			<div class="footer-copyright">
				<?php 
				if (function_exists('get_field')) { 
					$footer_copyright = get_field('footer_copyright', 'option');
			    	if ( $footer_copyright ) {
			    		echo apply_filters( 'the_content', html_entity_decode( $footer_copyright ) );
			    		//echo $footer_copyright;
			    	}
		    	}
				?>
			</div>
		
		</div> <!-- end #container -->
		
		<?php wp_footer(); ?>

	</body>

</html> <!-- end page. what a ride! -->