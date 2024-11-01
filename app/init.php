<?php

/*
 * Plugin Entry Point
 */

class WST_Module_Init {

    static public function WST_Init() {
        self::wst_constants();
        $files = glob(WST_ROOT . "app/helpers/*.php");
        foreach ($files as $file) {
            if (!is_dir($file)) {
                require_once( $file );
            }
        }

        $_files_ = glob(WST_ROOT . "app/back-end/classes/*.php");
        foreach ($_files_ as $file) {
            if (!is_dir($file)) {
                require_once( $file );
            }
        }

        if (is_admin()) {
            self::wst_backend();
            require_once( ABSPATH . WPINC . '/class-phpmailer.php' );
        }
        self::wst_frontend();
        WST_PageTemplater::get_instance();
        add_filter('wp_mail_from_name', array('WST_Common_fun', 'wst_set_from_name'));
        add_filter('wp_mail_from', array('WST_Common_fun', 'wst_set_from_email'));
        add_action('phpmailer_init', array('WST_Common_fun', 'wst_send_html'));
        add_filter('wp_mail_content_type', array('WST_Common_fun', 'wst_set_content_type'), 100);
        add_filter('mandrill_payload', array('WST_Common_fun', 'wst_wpmandrill_compatibility'));
    }

    static public function wst_constants() {
        if (!file_exists(ABSPATH . '/wp-admin/includes/plugin.php')) {
            require_once ABSPATH . '/wp-admin/includes/plugin.php';
        }
        define('WST_URI', self::wst_removelastdir(plugins_url(null, __FILE__), 1) . '/');
        define('WST_ROOT', self::wst_removelastdir(strtr(plugin_dir_path(__FILE__), '\\', '/'), 2) . '/');
        define('WST_PLUGIN_VERSION', '1.0');
        define('PLUGIN_PREFIX', 'WST_');
        define('sahill', '');
        @define(BFITHUMB_UPLOAD_DIR, PLUGIN_PREFIX . '_dir');
    }

    static public function wst_backend() {
        self::wst_admin_actions();
        WST_panel::wst_init();
        WST_Ajax::wst_init();
    }

    static public function wst_frontend() {
        add_action('init', array('WST_Module_Init', 'init_actions'));
    }

    static public function wst_admin_actions() {
        add_action('init', array('WST_Module_Init', 'admin_init_actions'));
        add_action('init', array(__CLASS__, 'wst_template_setup'));
    }

    static public function init_actions() {
        add_action('wp_enqueue_scripts', array('WST_Medias', 'render_styles'));
        add_action('wp_enqueue_scripts', array('WST_Medias', 'render_scripts'));
        add_action('wp_head', array('WST_Medias', 'additional_head'));
    }

    static public function admin_init_actions() {
        //if (_set($_GET, 'page') == 'wst_wp_appointments_app' || _set($_GET, 'page') == 'wst_app_settings') {
            add_action('admin_enqueue_scripts', array('WST_Medias', 'wst_render_admin_styles'));
            add_action('admin_enqueue_scripts', array('WST_Medias', 'wst_render_admin_scripts'));
        //}
    }

    static public function wst_removelastdir($path, $level) {
        if (is_int($level) && $level > 0) {
            $path = preg_replace('#\/[^/]*$#', '', $path);
            return self::wst_removelastdir($path, (int) $level - 1);
        }
        return $path;
    }

    static public function wst_template_setup() {
        $templates = array(
            'tpl-appointment.php' => 'WP Appointment',
        );
        $my_post = '';
        foreach ($templates as $key => $tp) {
            if (get_page_by_title($tp, 'OBJECT', 'page') == NULL) {
                $my_post = array(
                    'post_title' => $tp,
                    'post_name' => strtolower(str_replace(' ', '_', $tp)),
                    'post_type' => 'page',
                    'post_content' => "",
                    'post_status' => 'publish',
                    'post_author' => 1
                );
                $post_id = wp_insert_post($my_post);
                update_post_meta($post_id, "_wp_page_template", $key);
                update_option("wp_appointment_id", $post_id);
            }
        }
    }

    static public function wst_db_install() {
        WST_DB_Setup::wst_init();
    }

}
