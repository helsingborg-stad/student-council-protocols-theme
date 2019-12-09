<?php

namespace Elevroden\Theme;

class Sidebars
{
    public function __construct()
    {
        add_action('widgets_init', array($this, 'register'));
    }

    public function register()
    {
        /**
         * Above article
         */
        register_sidebar(array(
            'id'            => 'above-article',
            'name'          => __('Above article', 'municipio'),
            'description'   => __('The area above the article', 'municipio'),
            'before_widget' => '<div class="grid-sm-12"><div class="%2$s">',
            'after_widget'  => '</div></div>'
        ));

        /**
         * Above article
         */
        register_sidebar(array(
            'id'            => 'below-article',
            'name'          => __('Below article', 'municipio'),
            'description'   => __('The area below the article', 'municipio'),
            'before_widget' => '<div class="grid-sm-12"><div class="%2$s">',
            'after_widget'  => '</div></div>'
        ));
    }

}
