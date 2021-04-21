<?php
/** 
 * Display attachment content.
 * This content called from attachment.php page.
 * 
 * @package bootstrap-basic4
 */


$Bsb4Design = new \BootstrapBasic4\Bsb4Design();
?> 
<article id="post-<?php the_ID(); ?>" <?php post_class('post-view-attachment'); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?> 

        <div class="entry-meta">
            <?php
            /* translators: %1$s: Date/time in datetime attribute, %2$s: Date/time text. */
            printf(__('Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span>', 'bootstrap-basic4'),
                esc_attr(get_the_date('c')),
                esc_html(get_the_date())
            );
            $metadata = wp_get_attachment_metadata();
            if (is_array($metadata) && array_key_exists('width', $metadata) && array_key_exists('height', $metadata) && null != $metadata['width'] && null != $metadata['height']) {
                echo ' ';
                /* translators: %1$s: URL to attachment, %2$s: Attachment width, %3$s: Attachment height. */
                printf(__('at <a href="%1$s" title="Link to attachment file">%2$s &times; %3$s</a>', 'bootstrap-basic4'),
                    esc_url(wp_get_attachment_url()),
                    $metadata['width'],
                    $metadata['height']
                );
            }
            echo ' ';
            /* translators: %1$s: URL to post parent, %2$s: Post parent title in the title attribute, %3$s: Post parent title. */
            printf(__('in <a href="%1$s" title="Return to %2$s" rel="gallery">%3$s</a>', 'bootstrap-basic4'),
                esc_url(get_permalink($post->post_parent)),
                esc_attr(strip_tags(get_the_title($post->post_parent))),
                get_the_title($post->post_parent)
            );
            if (
                !is_array($metadata) ||
                (
                    is_array($metadata) && 
                    (
                        !array_key_exists('width', $metadata) ||
                        !array_key_exists('height', $metadata) ||
                        null == $metadata['width'] ||
                        null == $metadata['height']
                    )
                )
            ) {
                echo ' ';
                /* translators: %1$s: URL to attachment. */
                printf(__('(<a href="%1$s" title="Link to attachment file">attachment file</a>)', 'bootstrap-basic4'),
                    esc_url(wp_get_attachment_url())
                );
            }

            echo ' ';
            $Bsb4Design->editPostLink();
            unset($metadata);
            ?> 
        </div><!-- .entry-meta -->

        <div class="row mb-3">
            <div class="nav-previous col-6"><?php previous_image_link(false, __('<span class="meta-nav">&larr;</span> Previous', 'bootstrap-basic4')); ?></div>
            <div class="nav-next col-6 text-right"><?php next_image_link(false, __('Next <span class="meta-nav">&rarr;</span>', 'bootstrap-basic4')); ?></div>
        </div><!-- #image-navigation -->
    </header><!-- .entry-header -->

    <div class="entry-content">
        <div class="entry-attachment">
            <div class="attachment">
                <?php $Bsb4Design->attachment(); ?> 
            </div><!-- .attachment -->

            <?php if (has_excerpt()) { ?> 
            <div class="entry-caption">
                <?php the_excerpt(); ?> 
            </div><!-- .entry-caption -->
            <?php } //endif; ?> 
        </div><!-- .entry-attachment -->

        <?php
        the_content();

        /**
         * This wp_link_pages option adapt to use bootstrap pagination style.
         * 
         * This wp_link_pages on attachment.php or image.php page will results in page not found.
         * @link https://github.com/WordPress/twentysixteen/issues/438 Some people have issue about this in the topic "Remove wp_link_pages() from image.php".
        */
        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'bootstrap-basic4') . ' <ul class="pagination">',
            'after'  => '</ul></div>',
            'separator' => ''
        ));
        ?> 
    </div><!-- .entry-content -->
</article><!-- #post-## -->
<?php unset($Bsb4Design); ?> 