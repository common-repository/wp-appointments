<?php

class WST_panel {

    public static $wst_panel_options, $wst_setting_page, $wst_appontment;

    static public function wst_init() {
        add_action('admin_menu', array(__CLASS__, 'wst_add_menu_page'));
    }

    static public function wst_add_menu_page() {
        self::$wst_appontment = add_menu_page(__('WP Appointments', sahill), __('WP Appointments', sahill), 'manage_options', 'wst_wp_appointments_app', null, 'dashicons-wp-app-appointments', '10.842016');
        self::$wst_panel_options = add_submenu_page('wst_wp_appointments_app', __('Appointments', sahill), __('Appointments', sahill), 'manage_options', 'wst_wp_appointments_app', array('WST_Panel_options', 'wst_wp_appointments_app'));
        self::$wst_setting_page = add_submenu_page('wst_wp_appointments_app', __('Settings', sahill), __('Settings', sahill), 'manage_options', 'wst_app_settings', array('WST_Panel_options', 'wst_app_settings_func'));
        //add_submenu_page('wst_wp_appointments_app', __('Overview', sahill), __('Reports', sahill), 'manage_options', 'wst_app_reports', array('WST_Panel_options', 'wst_app_reports'));
        // add help tabs
        $a = self::$wst_panel_options;
        $b = self::$wst_setting_page;
        add_action("load-$a", array('WST_Panel_options', 'wst_appointments_help_tab'), 20);
        add_action("load-$b", array('WST_Panel_options', 'wst_settings_help_tab'), 20);

        // add screen options
        add_action('load-' . self::$wst_setting_page, array('WST_Panel_options', 'wst_custom_setting_screen_options'), 20);
        add_action('load-' . self::$wst_appontment, array('WST_Panel_options', 'wst_custom_setting_screen_options'), 20);
        // remove update notification
        if (_set($_GET, 'page') == 'wst_wp_appointments_app' || _set($_GET, 'page') == 'wst_app_settings') {
            remove_action('admin_notices', 'update_nag', 3);
        }
    }

}
