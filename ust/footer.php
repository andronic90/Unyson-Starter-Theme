<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 */
?>
	</div><!--#main-->

	<!-- Footer -->
	<footer class="fly-site-footer">
		<div class="fly-footer-copyright">
			<div class="container">
				<div class="row">
					<div class="fly-copyright-text">
						<?php if(function_exists('fw_get_db_settings_option')) echo fw_get_db_settings_option('footer_options/footer_copyright', ''); else _e('Powered by <a rel="nofollow" target="_blank" href="https://flytemplates.com/">FlyTemplaes</a>', 'ust'); ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div><!-- /#page -->
<?php wp_footer(); ?>
</body>
</html>