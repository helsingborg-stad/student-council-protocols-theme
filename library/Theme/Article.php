<?php

namespace Elevroden\Theme;

class Article extends \Elevroden\Entity\PostType
{
    public static $postTypeSlug;
    public static $categoryTaxonomySlug;

    public function __construct()
    {
        //Main post type
        self::$postTypeSlug = $this->postType();

        //Taxonomy
        self::$categoryTaxonomySlug = $this->taxonomyCategory();

        //Remove template
        add_filter('Municipio/CustomPostType/ExcludedPostTypes', array($this, 'excludePostType'));
    }

    // Exclude this post type from page template filter.
    public function excludePostType($postTypes)
    {
        $postTypes[] = $this->postType();
        return $postTypes;
    }

    /**
     * Create post type
     * @return string
     */
    public function postType() : string
    {
        // Create posttype
        $postType = new \Elevroden\Entity\PostType(
            _x('Articles', 'Post type plural', 'elevroden'),
            _x('Article', 'Post type singular', 'elevroden'),
            'article',
            array(
                'description'          =>   __('Stores articles for elevroden.', 'elevroden'),
                'menu_icon'            =>   'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4Ij48Zz48Zz48cGF0aCBkPSJNNDM4Ljg1NywwSDczLjE0M2MtMTQuNjI5LDAtMjUuNiwxMC45NzEtMjUuNiwyNS42djQ2MC44YzAsMTQuNjI5LDEwLjk3MSwyNS42LDI1LjYsMjUuNmgzNjUuNzE0ICAgIGMxNC42MjksMCwyNS42LTEwLjk3MSwyNS42LTI1LjZWMjUuNkM0NjQuNDU3LDEwLjk3MSw0NTMuNDg2LDAsNDM4Ljg1NywweiBNNDI3Ljg4Niw0NzUuNDI5SDg0LjExNFYzNi41NzFoMzQzLjc3MVY0NzUuNDI5eiIgZmlsbD0iI0ZGRkZGRiIvPjwvZz48L2c+PGc+PGc+PHBhdGggZD0iTTM5OC42MjksNjRIMTEzLjM3MWMtMTAuOTcxLDAtMTguMjg2LDcuMzE0LTE4LjI4NiwxOC4yODZ2NzguNjI4YzAsMTAuOTcxLDcuMzE0LDE4LjI4NiwxOC4yODYsMTguMjg2aDI4NS4yNTcgICAgYzEwLjk3MSwwLDE4LjI4Ni03LjMxNCwxOC4yODYtMTguMjg2VjgyLjI4NkM0MTYuOTE0LDcxLjMxNSw0MDkuNiw2NCwzOTguNjI5LDY0eiBNMzgwLjM0MywxNDIuNjNIMTMxLjY1N2MwLDAsMC00Mi4wNTgsMC00Mi4wNTggICAgaDI0OC42ODZWMTQyLjYzeiIgZmlsbD0iI0ZGRkZGRiIvPjwvZz48L2c+PGc+PGc+PHBhdGggZD0iTTIyNC45MTQsMzMyLjhIMTEzLjM3MWMtMTAuOTcxLDAtMTguMjg2LDcuMzE0LTE4LjI4NiwxOC4yODZ2NjRjMCw5LjE0Miw3LjMxNCwxOC4yODYsMTguMjg2LDE4LjI4NmgxMTEuNTQyICAgIGMxMC45NzEsMCwxOC4yODYtNy4zMTQsMTguMjg2LTE4LjI4NnYtNjRDMjQzLjIsMzQwLjExNCwyMzUuODg1LDMzMi44LDIyNC45MTQsMzMyLjh6IE0yMDYuNjI4LDM5Ni44aC03NC45NzF2LTI3LjQyOWg3NC45NzEgICAgVjM5Ni44eiIgZmlsbD0iI0ZGRkZGRiIvPjwvZz48L2c+PGc+PGc+PHBhdGggZD0iTTM5OC42MjksMjA2LjYyOUgxMTMuMzcxYy0xMC45NzEsMC0xOC4yODYsNy4zMTQtMTguMjg2LDE4LjI4NnM3LjMxNCwxOC4yODYsMTguMjg2LDE4LjI4NmgyODUuMjU3ICAgIGMxMC45NzEsMCwxOC4yODYtNy4zMTQsMTguMjg2LTE4LjI4NlM0MDkuNiwyMDYuNjI5LDM5OC42MjksMjA2LjYyOXoiIGZpbGw9IiNGRkZGRkYiLz48L2c+PC9nPjxnPjxnPjxwYXRoIGQ9Ik0zOTguNjI5LDI2OC44SDExMy4zNzFjLTEwLjk3MSwwLTE4LjI4Niw3LjMxNC0xOC4yODYsMTguMjg2YzAsMTAuOTcsNy4zMTQsMTguMjg2LDE4LjI4NiwxOC4yODZoMjg1LjI1NyAgICBjMTAuOTcxLDAsMTguMjg2LTcuMzE0LDE4LjI4Ni0xOC4yODZTNDA5LjYsMjY4LjgsMzk4LjYyOSwyNjguOHoiIGZpbGw9IiNGRkZGRkYiLz48L2c+PC9nPjxnPjxnPjxwYXRoIGQ9Ik0zOTguNjI5LDMzMi44SDI4Ny4wODVjLTEwLjk3MSwwLTE4LjI4Niw3LjMxNC0xOC4yODYsMTguMjg2czcuMzE0LDE4LjI4NiwxOC4yODYsMTguMjg2aDExMS41NDMgICAgYzEwLjk3MSwwLDE4LjI4Ni03LjMxNCwxOC4yODYtMTguMjg2UzQwOS42LDMzMi44LDM5OC42MjksMzMyLjh6IiBmaWxsPSIjRkZGRkZGIi8+PC9nPjwvZz48Zz48Zz48cGF0aCBkPSJNMzk4LjYyOSwzOTYuOEgyODcuMDg1Yy0xMC45NzEsMC0xOC4yODYsNy4zMTQtMTguMjg2LDE4LjI4NnM3LjMxNCwxOC4yODYsMTguMjg2LDE4LjI4NmgxMTEuNTQzICAgIGMxMC45NzEsMCwxOC4yODYtNy4zMTQsMTguMjg2LTE4LjI4NlM0MDkuNiwzOTYuOCwzOTguNjI5LDM5Ni44eiIgZmlsbD0iI0ZGRkZGRiIvPjwvZz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PC9zdmc+',
                'public'               =>   true,
                'publicly_queriable'   =>   true,
                'show_ui'              =>   true,
                'show_in_nav_menus'    =>   true,
                'has_archive'          =>   true,
                'rewrite'              =>   array(
                    'slug'       =>   __('article', 'elevroden'),
                    'with_front' =>   false
                ),
                'hierarchical'          =>  false,
                'exclude_from_search'   =>  false,
                'taxonomies'            =>  array(),
                'supports'              =>  array('title', 'revisions', 'editor', 'comments', 'thumbnail')
            )
        );

        //Category in list
        $postType->addTableColumn(
            'category',
            __('Categories', 'elevroden'),
            true,
            function ($column, $postId) {
                $i = 0;
                $categories = get_the_terms($postId, self::$categoryTaxonomySlug);

                if (empty($categories)) {
                    echo __("Uncategorized", 'elevroden');
                } else {
                    foreach ((array)$categories as $category) {
                        echo isset($category->name) ? $category->name : '';
                    }
                }
            }
        );

        return $postType->slug;
    }

    /**
     * Create category taxonomy
     * @return string
     */
    public function taxonomyCategory() : string
    {
        //Register new taxonomy
        $categories = new \Elevroden\Entity\Taxonomy(
            __('Categories', 'elevroden'),
            __('Category', 'elevroden'),
            'article-category',
            array('article'),
            array(
                'hierarchical' => true
            )
        );

        //Add filter
        new \Elevroden\Entity\Filter(
            'article-category',
            'article'
        );

        //Return taxonomy slug
        return $categories->slug;
    }
}
