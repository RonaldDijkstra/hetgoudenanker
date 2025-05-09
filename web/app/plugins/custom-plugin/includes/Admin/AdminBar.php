<?php 


namespace Custom\Plugin\Admin;

use Custom\Plugin\ServiceInterface;

class AdminBar implements ServiceInterface
{
    public function register()
    {
        add_action('admin_bar_menu', [$this, 'removeDefaultMenuItemsFromPluginBar'], 999);
    }

    /** 
     * Remove default menu items from the admin top bar
     * 
     * @return void
     */
    public function removeDefaultMenuItemsFromPluginBar(): void
    {
        global $wp_admin_bar;

        $unwantedMenuItems = [
            'customize',
            'comments',
            'new-content',
            'duplicate-post',
            'updates',
            'dashboard',
            'themes',
            'menus',
            'plugins',
            'widgets',
        ];

        foreach ($unwantedMenuItems as $item) {
            $wp_admin_bar->remove_menu($item);
        }
    }
}
