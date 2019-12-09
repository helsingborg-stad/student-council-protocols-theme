<?php

namespace Elevroden\Theme;

class ModuleTemplates
{
    public function __construct()
    {
        add_filter('acf/load_field/key=field_571dfd4c0d9d9', array($this, 'addPostTemplates'));
    }

    /**
     * Add custom view values
     * @param $field
     * @return mixed
     */
    public function addPostTemplates($field)
    {
        $field['choices']['highlighted-posts'] = __('Highlighted posts', 'elevroden');
        return $field;
    }
}
