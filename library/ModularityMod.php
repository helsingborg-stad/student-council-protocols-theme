<?php

namespace Elevroden;

class ModularityMod {
  public function __construct() {
    
    $this->postTypeSlug = 'protocol';

    update_option('options_mod_form_crypt', false);

    add_filter('Municipio/blog/post_settings', array($this, 'modularityMod'), 10, 2);
    add_filter('wp_nav_menu_args', array($this, 'my_wp_nav_menu_args'));
  }

  public function modularityMod($items, $post) {
    $formData = get_post_meta($post->ID, 'form-data')[0];
    
    $items['site_url'] = get_home_url();
    $items['subjects'] = $formData['valj-amnen-kategorier'];
    $items['header_image'] = $formData['ladda-upp-en-header-bild'] ? $items['site_url'] . '/wp-content' . explode('wp-content', $formData['ladda-upp-en-header-bild'][0])[1] : $formData['ladda-upp-en-header-bild'];
    $items['gallery_images'] = $formData['ladda-upp-en-eller-flera-galleri-bilder'];
    $items['attachments'] = $formData['ladda-up-en-eller-flera-filer'];
    $items['currentUserId'] = get_current_user_id();

    return $items;
  }

  public function my_wp_nav_menu_args($args) {
    if( is_user_logged_in() ) { 
      $args['menu'] = 'logged-in';
    } else {
      $args['menu'] = 'logged-out';
    }
      return $args;
  }
}