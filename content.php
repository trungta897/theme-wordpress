<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-thumbnail">
        <?php news_theme_thumbnail('thumbnail');  ?>
    </div>
    <div class="entry-header">
        <?php news_theme_entry_header(); ?>
        <?php news_theme_entry_meta(); ?>
    </div>
    <div class="entry-content">
        <?php news_theme_entry_content(); ?>
        <?php (is_single() ? news_theme_entry_tag() : ''); ?>
    </div>
</article>