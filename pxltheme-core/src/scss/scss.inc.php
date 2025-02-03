<?php
//https://scssphp.github.io/scssphp/
//https://github.com/scssphp/scssphp
//version: 1.12.0 – November 14, 2023

if (version_compare(PHP_VERSION, '5.6') < 0) {
    throw new \Exception('scssphp requires PHP 5.6 or above');
}

if (! class_exists('ScssPhp\ScssPhp\Version')) {
    spl_autoload_register(function ($class) {
        if (0 !== strpos($class, 'ScssPhp\ScssPhp\\')) {
            // Not a ScssPhp class
            return;
        }

        $subClass = substr($class, strlen('ScssPhp\ScssPhp\\'));
        $path = __DIR__ . '/src/' . str_replace('\\', '/', $subClass) . '.php';

        if (file_exists($path)) {
            require $path;
        }
    });
}
