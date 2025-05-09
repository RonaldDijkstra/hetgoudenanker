<?php

/*
 * @package Custom_Fields
 */

namespace Custom\Fields;

final class Init
{
    /**
     * Loop through the directories and scan all files.
     * Store all filenames in classes in an array.
     *
     * @return array Full list of classes
     */
    public static function get_services(): array
    {
        $directories = [
            plugin_dir_path(__FILE__) . 'Fields',
        ];
        
        $classes = [];
        $namespace = 'Custom\\Fields\\Fields\\';

        foreach ($directories as $directory) {
            $fileNames = scandir($directory);
            $phpFiles = array_filter($fileNames, function ($file) {
                return pathinfo($file, PATHINFO_EXTENSION) === 'php' && $file !== 'AbstractField.php';
            });

            foreach ($phpFiles as $phpFile) {
                $className = $namespace . pathinfo($phpFile, PATHINFO_FILENAME);
                $classes[] = str_replace('.php', '', $className);
            }
        }

        return $classes;
    }
    /**
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

    /**
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
