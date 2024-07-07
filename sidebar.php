<?php 
    if(is_active_sidebar('main-sidebar')):
        dynamic_sidebar('main-sidebar');
    else:
        _e('Sidebar','news-theme');
    endif;
?>