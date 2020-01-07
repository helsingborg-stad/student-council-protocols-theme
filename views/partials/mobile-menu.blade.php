

{!! $navigation['sidebarMenu'] !!}

{!!
    wp_nav_menu(array(
        'theme_location' => 'help-menu',
        'container' => 'nav',
        'container_class' => 'menu-help',
        'container_id' => '',
        'menu_class' => 'nav nav-mobile',
        'menu_id' => 'help-menu-top',
        'echo' => 'echo',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '<ul class="%2$s">%3$s</ul>',
        'depth' => 1,
        'fallback_cb' => '__return_false'
    ));
!!}
