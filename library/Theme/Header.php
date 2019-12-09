<?php
namespace Elevroden\Theme;

class Header
{
    public function __construct()
    {
        add_filter('Municipio/mobile_menu_breakpoint', array($this, 'mobileMenuBreakpoint'), 6);
    }

    public function mobileMenuBreakpoint()
    {
        return 'hidden-lg hidden-xl hidden-xxl';
    }
}
