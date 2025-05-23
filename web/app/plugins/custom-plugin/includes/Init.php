<?php

/*
 * @package Custom_Plugin
 */

namespace Custom\Plugin;

final class Init
{
    /**
     * Store all the classes inside an array.
     *
     * @return array Full list of classes
     */
    public static function get_services(): array
    {
        return [
            Admin\AdminBar::class,
            Admin\Dashboard::class,
            Admin\Editor::class,
        ];
    }

    /*
     * Loop through the classes, initialize them, and call the register()
     * method if it exists.
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /*
     * Initialize the class.
     *
     * @param  class $class   class from the services array
     * @return class instance New instance of the class
     */
    private static function instantiate($class): object
    {
        return new $class();
    }
}
