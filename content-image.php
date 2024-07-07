<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail">
        <?php news_theme_thumbnail('large');  ?>
    </div>
    <div class="entry-header">
        <?php news_theme_entry_header(); ?>
        <?php
            $attachment = get_children(array('post_parent'=>$post->ID));
            $attachment_number = count($attachment);
            printf(__('This image post contains %1$s photo', 'news-theme'), $attachment_number);
        ?>
    </div>
    <div class="entry-content">
        <?php news_theme_entry_content(); ?>
        <?php (is_single() ? news_theme_entry_tag() : ''); ?>
    </div>
</article>