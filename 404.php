<?php get_header(); ?>
<div class="content">
    <div id="main-content">
        <?php 
            _e("<h1>404 NOT FOUND</h1>",'news-theme');
            _e('<h2>Not found the article you are looking for</h2>','news-theme');
            get_search_form();

            _e('<h3>Content categories: </h3>','news-theme');
            echo '<div class="404-cat-list">';
                wp_list_categories( array('title_li'=> '') );
            echo '</div>';

            echo 'Tag cloud', 'news-theme';
            wp_tag_cloud();
        ?>
    </div>
    <div id="side-bar">
        <?php get_sidebar()?>
    </div>
</div>
<?php get_footer()?>