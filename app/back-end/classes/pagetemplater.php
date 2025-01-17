<?php

class WST_PageTemplater {

    private static $instance;
    protected $templates;
    protected $plugin_slug;

    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new WST_PageTemplater();
        }

        return self::$instance;
    }

    private function __construct() {
        $this->templates = array();
        add_filter('page_attributes_dropdown_pages_args', array($this, 'register_project_templates'));
        add_filter('wp_insert_post_data', array($this, 'register_project_templates'));
        add_filter('template_include', array($this, 'view_project_template'));

        $this->templates = array(
            'tpl-appointment.php' => 'WP Appointment',
        );
    }

    public function register_project_templates($atts) {
        $cache_key = 'page_templates-' . md5(get_theme_root() . '/' . get_stylesheet());
        $templates = wp_get_theme()->get_page_templates();

        if (empty($templates)) {
            $templates = array();
        }

        wp_cache_delete($cache_key, 'themes');
        $templates = array_merge($templates, $this->templates);
        wp_cache_add($cache_key, $templates, 'themes', 1800);

        return $atts;
    }

    public function view_project_template($template) {
        global $post;
        if (!isset($this->templates[get_post_meta(_set($post, 'ID'), '_wp_page_template', true)])) {
            return $template;
        }
        $file = WST_ROOT . 'app/front-end/template/' . get_post_meta($post->ID, '_wp_page_template', true);
        if (file_exists($file)) {
            return $file;
        } else {
            echo $file;
        }

        return $template;
    }

}
