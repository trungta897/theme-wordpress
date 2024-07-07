<?php

/**
 * @Khai bao hang gia tri
 *      @THEME_URL: lay duong dan thu muc theme
 *      @CORE: lay duong dan thu muc /core
 */
define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . "/core");

/**
 * @Nhung file /core/init.php
 */

require_once(CORE . "/init.php");

/**
 * @Thiet lap chieu rong noi dung
 */
if (!isset($content_width)) {
  $content_width = 720;
}

/**
 * @Khai bao chuc nang cua THEME
 */
if (!function_exists("myTheme_theme_setup")) {
  function myTheme_theme_setup()
  {

    //Thiet lap textdomain
    $language_folder = THEME_URL . '/languages';
    load_theme_textdomain('news-theme', $language_folder);

    //Tu dong them link RSS len <head>
    add_theme_support('automatic-feed-links');

    //Them post thumbnail
    add_theme_support('post-thumbnails');

    //Post formats
    add_theme_support('post-formats', array(
      'image',
      'video',
      'gallery',
      'quote',
      'link'
    ));

    //Them title tag
    add_theme_support('title-tag');

    //Them custom background
    $default_background = array(
      'default-color' => '#1ee7eb'
    );
    add_theme_support('custom-background', $default_background);

    //Tao menu
    register_nav_menu('primary-menu', __('Primary Menu', 'news-theme'));


    //Tao sidebar
    $sidebar = array(
      'name' => __('Main sidebar', 'news-theme'),
      'id' => 'main-sidebar',
      'description' => __('Default sidebar'),
      'class' => 'main-sidebar',
      'before_title' => '<h3 class="widgettitle">',
      'after_title' => '</h3>'
    );
    register_sidebar($sidebar);
  }

  add_action('init', 'myTheme_theme_setup');
}

/**======
 * TEMPLATE FUNCTIONS
 */
if (!function_exists('news_theme_header')) {
  function news_theme_header(){ ?>
    <div class="site-name">
      <?php 
        global $newsTheme_options;

        if ($newsTheme_options['logo-on'] == 0 ) :
      ?>
      <?php
      if (is_home()) {
        printf(
          '<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
          get_bloginfo('url'),
          get_bloginfo('description'),
          get_bloginfo('sitename')
        );
      } else {
        printf(
          '<p><a href="%1$s" title="%2$s">%3$s</a></p>',
          get_bloginfo('url'),
          get_bloginfo('description'),
          get_bloginfo('sitename')
        );
      }
      ?>
      <?php 
        else :
      ?>

      <img src="<?php echo $newsTheme_options['logo-image']['url']; ?>" />
      <?php endif; ?>
    </div>
    <div class="site-description"><?php bloginfo('description');?></div> <?php
  }
}


//Thiet lap menu
if (!function_exists('news_theme_menu')) {
  function news_theme_menu($menu){
    $menu = array(
      'theme_location'=> $menu,
      'container'=> 'nav',
      'container_class'=> $menu,
      'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>'
    ) ;

    wp_nav_menu($menu);
  }
}

// Ham tao phan trang 
if (!function_exists('news_theme_pagination')) {
  function news_theme_pagination() {
    if ($GLOBALS['wp_query'] -> max_num_pages < 2 ) {
      return '';
    } ?>
    <nav class="pagination" role="navigation">
      <?php if (get_next_posts_link() ) : ?>
        <div class="prev"><?php next_posts_link(__('Older Posts','news-theme')); ?></div>
      <?php endif; ?>
      <?php if (get_previous_posts_link() ) : ?>
        <div class="next"><?php previous_posts_link(__('Newest Posts', 'news-theme'));?></div>
      <?php endif; ?>
    </nav>
  <?php 
  }
}

// Ham hien thu thumbnail
if (!function_exists('news_theme_thumbnail')) {
  function news_theme_thumbnail($size) {
    if (!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')) : ?>
    <figure class="post-thumbnail"><?php the_post_thumbnail($size);?></figure>
    <?php endif; ?> 
  <?php 
  }
}

// Ham hien thi tieu de bai viet
if (!function_exists('news_theme_entry_header')) {
  function news_theme_entry_header() { ?>
    <?php if (is_single() ) : ?>
      <h1 class="entry-title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h1>
      <?php else : ?>
        <h2 class="entry-title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2>
        <?php endif; ?>
  <?php }
}


// Ham lay du lieu post (ten tac gia,tag,...)
if (!function_exists('news_theme_entry_meta')) {
  function news_theme_entry_meta() { ?>
    <?php if (is_page()) : ?>
      <div class="entry-meta">
        <?php 
          printf(__('<span class="author"> Posted by %1$s ', 'news-theme'),
          get_the_author());

          printf(__('<span class="date-published"> at %1$s ', 'news-theme'),
          get_the_date(),
          get_the_modified_date());

          printf(__('<span class="category"> in %1$s ', 'news-theme'),
          get_the_category_list());

          if(comments_open()) :
            echo '<span class="meta-reply">';
            comments_popup_link(__('Leave a comment', 'news-theme'),
                                __('One comment', 'news-theme'),
                                __('% comments', 'news-theme'),
                                __('Read all comment','news-theme')) ;
            echo '</span>';
          endif;
        ?>
      </div>
      <?php endif; ?>
  <?php }
}


// Ham hien thi truoc noi dung cua post/page
if (!function_exists('news_theme_entry_content')) {
  function news_theme_entry_content() { 
    if (!is_single() && !is_page()) {
      the_excerpt();
    } else {
      the_content();

      // Phan trang trong single
      $link_page = array(
        'before'=>__('<p>Page: ','news-theme'),
        'after'=> '</p>',
        'nextpageLink'=>__('Next Page','news-theme'),
        'previouspageLink'=>__('Previous Page','news-theme'),
      );
      wp_link_pages( $link_page );
    }
  }
}


// Ham hien thi readmore cho noi dung xem truoc cua post
function news_theme_readmore() {
  return '<a class="read-more" href="'.get_permalink(get_the_ID()).'">'.__('... Read more','news-theme').'</a>';
}
add_filter('excerpt_more', 'news_theme_readmore');


// Ham hien thi tag neu la single
if (!function_exists('news_theme_entry_tag')) {
  function news_theme_entry_tag() {
    if (has_tag()):
      echo '<div class="entry-tag"';
      printf(__('Tagged in %1$s', 'news-theme'), get_the_tag_list('',','));
      echo '</div>';
    endif;
  }
}


// Nhung tap tin css (file style.css)
function news_theme_css() {
  wp_register_style('main-style', get_template_directory_uri() . "/style.css", array(), null, 'all');
  wp_enqueue_style('main-style');
  wp_register_style('reset-style', get_template_directory_uri()."/normalize.css", array(), null, 'all');
  wp_enqueue_style('reset-style');

  //SuperFish Menu
  //CSS
  wp_register_style('superfish-style', get_template_directory_uri()."/superfish.css", array(), null, 'all');
  wp_enqueue_style('superfish-style');
  //JavaScript
  wp_register_script('superFish-script', get_template_directory_uri()."/superfish.js", array('jquery'));
  wp_enqueue_script('superFish-script');

  //Custom JavaScript
  wp_register_script('newsTheme-script', get_template_directory_uri()."/newsTheme.js", array('jquery'));
  wp_enqueue_script('newsTheme-script');
}
add_action('wp_enqueue_scripts','news_theme_css');