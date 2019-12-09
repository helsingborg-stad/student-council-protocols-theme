<?php
namespace Elevroden\Modularity;

class Posts
{
    public function __construct()
    {
        add_filter('Modularity/Module/Posts/TemplateController/GridTemplate/Pattern', array($this, 'modifyGridPattern'), 6, 2);
        // add_filter('Modularity/Module/Classes', array($this, 'modifyIndexClass'), 6, 3);
    }

    public function modifyIndexClass($classes, $postType, $args)
    {
        var_dump($postType);
        $classes = array(
            'c-card',
            'c-card--action'
        );
        return $classes;
    }

    public function modifyGridPattern($pattern, $size)
    {
        $pattern = array(
            array(8, 4),
            array(4, 4, 4),
            array(4, 4, 4)
        );
        return $pattern;
    }
}
