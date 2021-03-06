<?php

namespace Elevroden;

class CustomMods
{
    public function __construct()
    {
        $this->postTypeSlug = 'protocol';

        $subRole = get_role('subscriber');
        $subRole->add_cap('read_private_pages');

        update_option('options_mod_form_crypt', false);

        add_filter('Municipio/blog/post_settings', array($this, 'modularityMod'), 10, 2);
        add_filter('wp_nav_menu_args', array($this, 'display_wp_nav_menu_args'));
        add_filter('walker_nav_menu_start_el', array($this, 'modify_login_item'), 10, 2);
        add_filter('login_form_bottom', array($this, 'ad_nonce_field'));
        add_filter('login_redirect', array($this, 'login_redirect'), 10, 3);
        add_filter('wp_nav_menu_objects', array($this,'remove_logout_confirmation'));
        add_filter('adApiWpIntegration/login/subscriberRedirect', array($this, 'subscriberRedirect'));
        add_filter('Modularity/Module/Posts/CouncilPoliticianName', array($this, 'councilPoliticianName'));
        add_filter('Modularity/Module/Posts/commentCount', array($this, 'commentCount'));

        add_action('wp_logout', array($this, 'logout_redirect'));
        add_action('wp_login', array($this, 'update_ad_user_meta'), 10, 2);
        add_action('wp_login_failed', array($this, 'login_failed'));
        add_action('after_setup_theme', array($this,'remove_admin_bar'));
    }

    public function modularityMod($items, $post)
    {
        $formData = get_post_meta($post->ID, 'form-data')[0];
        $post_author_id = get_post_field('post_author', $post->id);
    
        $items['site_url'] = get_home_url();
        $items['subjects'] = $formData['valj-amnen-kategorier'];
        $items['header_image'] = $formData['ladda-upp-en-header-bild'] ? $items['site_url'] . '/wp-content' . explode('wp-content', $formData['ladda-upp-en-header-bild'][0])[1] : $formData['ladda-upp-en-header-bild'];
        $items['gallery_images'] = $formData['ladda-upp-en-eller-flera-galleri-bilder'];
        $items['attachments'] = $formData['ladda-up-en-eller-flera-filer'];
        $items['currentUserId'] = get_current_user_id();
        $items['targetGroup'] = get_user_meta($post_author_id, 'target_group')[0];

        return $items;
    }

    public function display_wp_nav_menu_args($args)
    {
        if (is_user_logged_in()) {
            $args['menu'] = 'logged-in';
        } else {
            $args['menu'] = 'logged-out';
        }
        return $args;
    }

    public function modify_login_item($item_output, $item)
    {
        if ($item->url == '#login') {
            $item_output = '<a href="#" data-dropdown=".login-dropdown" class="">Logga in <i class="fa fa-caret-down"></i></a>';
        }
        return $item_output;
    }

    public function ad_nonce_field()
    {
        $adNonce = md5(NONCE_KEY."ad".date("Ymd"));
        return '<input type="hidden" name="_ad_nonce" value="'.$adNonce.'"/>';
    }

    public function logout_redirect()
    {
        wp_redirect(get_home_url() . '?loggedout=true');
        exit();
    }

    public function login_redirect($redirect_to, $request, $user)
    {
        return $request . '?loggedin=true';
    }

    public function subscriberRedirect()
    {
        return get_home_url() . '?redirect=true';
    }

    public function remove_logout_confirmation($items)
    {
        foreach ($items as $item) {
            if (strpos($item->url, 'logout') !== false) {
                $item->url = $item->url . "&_wpnonce=" . wp_create_nonce('log-out');
            }
        }
        return $items;
    }

    public function update_ad_user_meta($user_login, $user)
    {
        $userId = $user->data->ID;
        $userMeta = get_user_meta($userId);
        if (!$userMeta["name_of_council_or_politician"][0] && !$userMeta["target_group"][0]) {
            update_user_meta($userId, 'name_of_council_or_politician', $userMeta['first_name'][0] . ' ' . $userMeta['last_name'][0]);
            update_user_meta($userId, 'target_group', 'politician');
        }
    }

    public function login_failed($username)
    {
        // Where did the submit come from
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

        // If there's a valid referrer, and it's not the default log-in screen
        if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
            // let's append some information (login=failed) to the URL for the theme to use
            wp_redirect(strstr($referrer, '?login=failed') ? $referrer : $referrer . '?login=failed');
        }
    }

    public function remove_admin_bar()
    {
        if (current_user_can('subscriber')) {
            show_admin_bar(false);
        }
    }

    public function councilPoliticianName($postId)
    {
        $userMeta = get_post_meta($postId);
        $name = $userMeta["name_of_council_or_politician"][0] ? $userMeta["name_of_council_or_politician"][0] : '';

        return $name;
    }

    public function commentCount($postId)
    {
        return count(get_comments(array('post_id' => $postId)));
    }
}
