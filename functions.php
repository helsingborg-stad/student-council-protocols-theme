<?php

define('ELEVRODEN_PATH', get_stylesheet_directory() . '/');

add_action('after_setup_theme', function () {
    load_theme_textdomain('elevroden', ELEVRODEN_PATH . 'languages');
});

//Include vendor files
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

require_once ELEVRODEN_PATH . 'library/Vendor/Psr4ClassLoader.php';
$loader = new ELEVRODEN\Vendor\Psr4ClassLoader();
$loader->addPrefix('Elevroden', ELEVRODEN_PATH . 'library');
$loader->addPrefix('Elevroden', ELEVRODEN_PATH . 'source/php/');
$loader->register();

new Elevroden\App();
