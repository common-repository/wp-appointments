<?php

class WST_Medias {

    static public function render_styles() {
        $google_plugin_fonts = self::wst_plugin_google_fonts();
        if (!empty($google_plugin_fonts)):
            wp_enqueue_style(PLUGIN_PREFIX . 'plugin-fonts', $google_plugin_fonts, array(), WST_PLUGIN_VERSION, 'all');
        endif;
        $styles = array(
            'font-awesome' => 'css/font-awesome.min.css',
            'bootstrap' => 'css/bootstrap.min.css',
            'datepicker' => 'css/bootstrap-datepicker.min.css',
            'flags' => 'css/flags.css',
            'main_style' => 'css/style.css',
            'responsive' => 'css/responsive.css',
            'color' => 'css/color.css',
        );
        if (!empty($styles)) {
            foreach ($styles as $style => $item) {
                wp_enqueue_style(PLUGIN_PREFIX . $style, self::static_url($item, 'frontend'), array(), WST_PLUGIN_VERSION, 'all');
            }
        }
    }

    static public function render_scripts() {
        $scripts = array(
            'bootstrap' => 'js/bootstrap.min.js',
            'select2' => 'js/select2.min.js',
            'datepicker' => 'js/bootstrap-datepicker.min.js',
            'script' => 'js/script.js',
        );
        if (!empty($scripts)) {
            foreach ($scripts as $script => $item) {
                wp_register_script(PLUGIN_PREFIX . $script, self::static_url($item, 'frontend'), array(), WST_PLUGIN_VERSION, true);
            }
        }
    }

    static public function wst_plugin_google_fonts() {
        $fonts_url = '';

        $fonts = array(
            'Raleway' => 'Raleway:400,100,200,500,600,300,700,800,900',
            'Arimo' => 'Arimo:400,400italic,700,700italic',
            'Roboto Slab' => 'Roboto+Slab:400,300,100,700',
            'Roboto' => 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic',
        );

        if ($fonts) {
            $font_families = array();
            foreach ($fonts as $name => $font) {
                $string = sprintf(_x('on', '%s font: on or off', sahill), $name);
                if ('off' !== $string) {
                    $font_families[] = $font;
                }
            }
            $query_args = array(
                'family' => urlencode(implode('|', $font_families)),
                'subset' => urlencode('latin,latin-ext'),
            );
            $protocol = ( is_ssl() ) ? 'https' : 'http';
            $fonts_url = add_query_arg($query_args, $protocol . '://fonts.googleapis.com/css');
        }
        return esc_url_raw($fonts_url);
    }

    static public function additional_head() {
        echo '<script>var load_more = "' . __('No Record Found', sahill) . '";</script>';
    }

    static public function wst_render_admin_styles() {
        echo '<script>var ajax_url = "' . admin_url('admin-ajax.php') . '";</script>';
        // jquery localization
        echo '<script>var conn_all_services = "' . __('All Services', sahill) . '";</script>';
        echo '<script>var location_add_new = "' . __('Add New Record', sahill) . '";</script>';
        echo '<script>var location_update_record = "' . __('Update Record', sahill) . '";</script>';
        echo '<script>var upload_title = "' . __('WP Appontment', sahill) . '";</script>';
        echo '<script>var btn_title = "' . __('Use This Media', sahill) . '";</script>';
        $styles = array(
            'wp-appointment-dashicons' => 'css/dashicon.css',
            'select2' => 'css/select2.css',
            'pickday' => 'css/pikaday.css',
            'modal-fonts' => 'http://fonts.googleapis.com/css?family=Josefin+Sans:300,400,700',
            'modal-style' => 'css/app-modal.css',
            'seetings_tab' => 'css/tabs.css',
            'seetings_tab_style' => 'css/tabstyles.css',
            'wp-settings' => 'css/settings.css',
            'wp-appointment-app' => 'css/appointment.css',
        );
        if (!empty($styles)) {
            foreach ($styles as $style => $item) {
                wp_enqueue_style(PLUGIN_PREFIX . $style, self::static_url($item, 'backend'), array(), WST_PLUGIN_VERSION, 'all');
            }
        }
    }

    static public function wst_render_admin_scripts() {
        $scripts = array(
            'select2' => 'js/select2.js',
            'tabs' => 'js/tabs.js',
            'date_picker' => 'js/pikaday.js',
            'jquery_date_picker' => 'js/pikaday.jquery.js',
            'moment' => 'js/moment.min.js',
            'script' => 'js/scripts.js',
        );
        if (!empty($scripts)) {
            foreach ($scripts as $script => $item) {
                wp_register_script(PLUGIN_PREFIX . $script, self::static_url($item, 'backend'), array(), WST_PLUGIN_VERSION, true);
            }
        }
        wp_enqueue_script(array('jquery', PLUGIN_PREFIX . 'script'));
    }

    static public function wst_enq($script = array()) {
        wp_enqueue_script($script);
    }

    static public function static_url($url = '', $source) {
        if (strpos($url, 'http') === 0)
            return $url;
        if ($source == 'backend') {
            return WST_URI . 'app/assets/back-end/' . ltrim($url, '/');
        } elseif ($source == 'frontend') {
            return WST_URI . 'app/assets/front-end/' . ltrim($url, '/');
        }
    }

}
