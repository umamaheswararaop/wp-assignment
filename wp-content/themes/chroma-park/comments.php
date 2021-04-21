<?php
	// Returns without displaying comments if the password has not been entered
	if (post_password_required())
		return;
	if (is_page() && !comments_open() && !have_comments())
		return;
?>

<div id="comments"<?php if (is_page()) echo ' class="pagecomments"' ?>>
	<?php /* translators: %1$s = post title, %2$s = number of comments */ ?>
	<h2 class="reply-header"><?php printf(esc_html__('Comments on &#39;%1$s&#39; (%2$s)', 'chroma-park'), wp_kses_post(get_the_title()), esc_html(get_comments_number())); ?></h2>
	<p class="comment-feed-link"><?php post_comments_feed_link(); ?></p>
	<ol class="commentlist">
		<?php wp_list_comments(array(
			'style' => 'ol',
			'avatar_size' => 14
		)); ?>
	</ol>
	<?php paginate_comments_links(array(
		'prev_text' => '&#171; '._x('Older comments', 'link', 'chroma-park'),
		'next_text' => _x('Newer comments', 'link', 'chroma-park').' &#187;'	
	)); ?>

	<div class="postinput">

		<?php comment_form(array(
			'cancel_reply_before' => '<br>'
		)); ?>
			
	</div> <!-- /post-input -->
</div> <!-- /comments -->
