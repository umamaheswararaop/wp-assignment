</main>
</div> <!-- /content -->
<?php if (is_active_sidebar('right-sidebar')) :?>
<!-- begin right sidebar -->
<aside role="complementary" id="right" class="sidebar" aria-label="<?php echo is_active_sidebar('left-sidebar') ? esc_attr_x('Second Sidebar', 'ARIA label', 'chroma-park') : esc_attr_x('Sidebar', 'ARIA label', 'chroma-park') ?>">
	<ul>
		<?php dynamic_sidebar('right-sidebar'); ?>
	</ul>
</aside> <!-- end right sidebar -->
<?php endif; ?>
	</div> <!-- /responsive -->
	<footer id="footer" role="contentinfo">
		<p id="footer-content" >
			&copy; <?php echo esc_html(date('Y')); ?> <a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a>
			<br /><?php echo wp_kses(sprintf(__('Powered by <a href="%1$s">WordPress</a> | Theme by <a href="%2$s">Vivi</a>', 'chroma-park'), esc_url(__('https://wordpress.org', 'chroma-park')), esc_url(__('https://profiles.wordpress.org/vivi04/', 'chroma-park'))), 'data'); ?>
		</p>
	</footer> <!-- /footer -->

		</div> <!-- /wrapper -->
	</div> <!-- /container -->

	<?php wp_footer(); ?>

	</body>
</html>
