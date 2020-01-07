<?php
namespace Elevroden;

class App
{
    public function __construct()
    {
        new \Elevroden\Theme\Event();
        new \Elevroden\Theme\Enqueue();
        new \Elevroden\Theme\ModuleScopes();
        new \Elevroden\Theme\ModuleTemplates();
        new \Elevroden\Theme\Article();
        new \Elevroden\Theme\Header();
        new \Elevroden\Theme\Sidebars();
        new \Elevroden\CustomMods();

        new \Elevroden\Modularity\Posts();


    }
}
