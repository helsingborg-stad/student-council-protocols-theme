<?php

namespace Elevroden;

class ModularityMod {
  public function __construct() {
    
    $this->postTypeSlug = 'protocol';

    update_option('options_mod_form_crypt', false);

    add_filter('Municipio/blog/post_settings', function($items, $post) {
      $formData = get_post_meta($post->ID, 'form-data')[0];
      
      $items['site_url'] = get_home_url();
      $items['subjects'] = $formData['valj-amnen-kategorier'];
      $items['header_image'] = $formData['ladda-upp-en-header-bild'] ? $items['site_url'] . '/wp-content' . explode('wp-content', $formData['ladda-upp-en-header-bild'][0])[1] : $formData['ladda-upp-en-header-bild'];
      $items['gallery_images'] = $formData['ladda-upp-en-eller-flera-galleri-bilder'];
      $items['attachments'] = $formData['ladda-up-en-eller-flera-filer'];
      $items['currentUserId'] = get_current_user_id();

      return $items;
    }, 10, 2);

    add_filter('is_active_sidebar', array($this, 'isActiveSidebar'), 9, 2);
  }


  /**
     * Manually activate right and bottom sidebar to add custom content
     * @param  boolean  $isActiveSidebar Original response
     * @param  string   $sidebar         Sidebar id
     * @return boolean
     */
    public function isActiveSidebar($isActiveSidebar, $sidebar)
    {
      
      if (($sidebar === 'right-sidebar' || $sidebar === 'bottom-sidebar') && $this->isProtocolPage()) {
        return true;
      }

      return $isActiveSidebar;
    }

    public function isProtocolPage()
    {
      global $post;

      if (is_object($post) && $post->post_type == $this->postTypeSlug && !is_archive() && !is_admin()) {
          return true;
      }

      return false;
    }
}