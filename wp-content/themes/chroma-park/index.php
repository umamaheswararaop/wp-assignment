<?php get_header(); ?>

<h1 id="index-type" >
	<?php the_archive_title(); ?>
</h1>

<?php while (have_posts()) : the_post(); ?>

	<div <?php post_class(); ?>>

		<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>	
		<?php chromapark_post_meta(); ?>		

		<div class="main">
			<?php the_excerpt(); ?>
			<span class="readmore">
			<?php /* translators: %s = post title */ ?>
				<a href="<?php the_permalink(); ?>"><?php printf(esc_html__('Continue reading %s', 'chroma-park'), wp_kses_post(get_the_title())); ?></a>
			</span>
		</div>

	</div> <!-- /entry -->


<?php endwhile;?>

<?php the_posts_pagination(array(
	'prev_text' => '&#171; '._x('Previous page', 'link', 'chroma-park'),
	'next_text' => _x('Next page', 'link', 'chroma-park').' &#187;'	
)); ?>

<?php get_footer(); ?>
