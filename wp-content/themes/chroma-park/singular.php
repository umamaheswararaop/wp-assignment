<?php get_header(); ?>
	
<?php the_post(); ?>

<div <?php post_class(); ?>>
	<h1 class="title"><?php the_title(); ?></h1>
	<?php chromapark_post_meta(); ?>

	<div class="main">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div>
				
</div> <!-- /entry -->

<?php comments_template(); ?>

<?php if (is_single())
	the_post_navigation(array(
		'prev_text' => '&#171; %title',
		'next_text' => '%title &#187;'
	)); ?>

<?php get_footer(); ?>
