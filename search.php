<?php get_header(); ?>
<div class="content">
    <div id="main-content">
    <div class="search-info">
        <?php 
            $search_query = new WP_Query('s='.$s.'&showpost=-1');
            $search_keyword = wp_specialchars($s,1);
            $search_count = $search_query->post_count;

            printf(__('%1$s articles found', 'news-theme'), $search_count);
        ?>
    </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php get_template_part("content", get_post_format()); ?>

            <?php endwhile ?>
            <?php news_theme_pagination(); ?>
        <?php else : ?>
            <?php get_template_part("content", 'none'); ?>
        <?php endif; ?>
    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>