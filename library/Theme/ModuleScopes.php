<?php

namespace Elevroden\Theme;

class ModuleScopes
{
    public function __construct()
    {
        add_filter('Modularity/Editor/ModuleCssScope', array($this, 'addModuleScopes'));
    }

    /**
     * Adds style scope classes
     * @return array
     */
    public function addModuleScopes($scopes)
    {
        $scopes['mod-posts'] = array(
            's-card-sales' => __("Card sales", 'elevroden')
        );

        $scopes['mod-slider'] = array(
            's-slider-padded' => __("Slider padded", 'elevroden')
        );

        return $scopes;
    }
}
