</main> <!-- /main -->
</div> <!-- /content -->

<?php if (is_active_sidebar('left-sidebar')) : ?>
<!-- begin left sidebar -->
<aside id="left" class="sidebar" aria-label="<?php echo is_active_sidebar('right-sidebar') ? esc_attr_x('First Sidebar', 'ARIA label', 'chroma-park') : esc_attr_x('Sidebar', 'ARIA label', 'chroma-park') ?>">
	<ul>
		<?php dynamic_sidebar('left-sidebar'); ?>
	</ul>
</aside> <!-- end left sidebar -->
<?php endif; ?>

<?php if (is_active_sidebar('right-sidebar')) :?>
<!-- begin right sidebar -->
<aside id="right" class="sidebar" aria-label="<?php echo is_active_sidebar('left-sidebar') ? esc_attr_x('Second Sidebar', 'ARIA label', 'chroma-park') : esc_attr_x('Sidebar', 'ARIA label', 'chroma-park') ?>">
	<ul>
		<?php dynamic_sidebar('right-sidebar'); ?>
	</ul>
</aside> <!-- end right sidebar -->
<?php endif; ?>
