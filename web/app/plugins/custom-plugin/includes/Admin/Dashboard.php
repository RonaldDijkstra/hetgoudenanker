<?php 

namespace Custom\Plugin\Admin;

use Custom\Plugin\ServiceInterface;

class Dashboard implements ServiceInterface
{
    public function register()
    {
        // Hooks to customize dashboard behavior
        add_action('admin_head', [$this, 'customAdminDashboardTitle']);
        add_action('admin_init', [$this, 'removeWelcomePanel']);
        add_action('admin_init', [$this, 'removeDashboardMetaBoxes']);
    }

    /**
     * Customize the dashboard title with the current user's name
     */
    public function customAdminDashboardTitle(): void
    {
        if ($GLOBALS['title'] != 'Dashboard') {
            return;
        }

        $currentUser = wp_get_current_user();
        $userName = $currentUser->display_name;

        $greetings = [
            'Howdy',
            'Moi',
            'Hoi',
            'Hallöchen',
            'Salut là',
            'Oi lá',
            'Hola qué tal',
        ];
    
        $randomGreeting = $greetings[array_rand($greetings)];

        $GLOBALS['title'] = sprintf(__('%s, %s!', 'het-gouden-anker'), $randomGreeting, $userName);
    }

    /**
     * Disable the welcome panel
     */
    public function removeWelcomePanel(): void 
    {
        update_user_meta(get_current_user_id(), 'show_welcome_panel', false);
        remove_action('welcome_panel', 'wp_welcome_panel');
    }

    /**
     * Remove default dashboard meta boxes
     */
    public function removeDashboardMetaBoxes(): void
    {
        $metaBoxes = [
            'dashboard_primary',
            'dashboard_site_health',
            'dashboard_right_now',
            'dashboard_quick_press',
        ];

        foreach ($metaBoxes as $box) {
            remove_meta_box($box, 'dashboard', 'normal');
        }
    }
}
