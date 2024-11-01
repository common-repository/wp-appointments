<?php

class WST_Panel_options {

    static public function wst_wp_appointments_app() {
        require_once WST_ROOT . 'app/back-end/templates/appointment.tpl.php';
    }

    static public function wst_appointments_help_tab() {
        $screen = get_current_screen();
        if (_set($screen, 'id') == 'toplevel_page_wst_wp_appointments_app') {
            $screen->add_help_tab(
                    array(
                        'id' => 'appointment_help',
                        'title' => __('Appointments manager', sahill),
                        'content' => __('<p>Use filter for date to reduce output results for appointments. You can filter by <b>location</b>, <b>service</b>, <b>worker</b>, <b>status</b> and <b>date</b>.</p>', sahill),
                    )
            );
            $screen->set_help_sidebar('<a href="http://nikolaloncar.com/easy-appointments-wordpress-plugin/easy-appointments-documentacion/">More info!</a>');
        }
    }

    static public function wst_settings_help_tab() {
        $screen = get_current_screen();
        if (_set($screen, 'id') == 'wp-appointments_page_wst_app_settings') {
            $screen->add_help_tab(
                    array(
                        'id' => 'settings_help',
                        'title' => __('Overview', sahill),
                        'content' => '<p>' . __('Some dynamic tags can be included in your email template :', sahill) . '</p>
					<ul>
						<li>' . __('<strong>%content%</strong> : will be replaced with the message content.', sahill) . '<br />
						<span class="description"> ' . __('NOTE: The content tag is <strong>required</strong>, WP Appointment will be automatically desactivated if no content tag is found.', sahill) . '</span></li>
						<li>' . __('<strong>%blog_url%</strong> : will be replaced with your blog URL.', sahill) . '</li>
						<li>' . __('<strong>%home_url%</strong> : will be replaced with your home URL.', sahill) . '</li>
						<li>' . __('<strong>%blog_name%</strong> : will be replaced with your blog name.', sahill) . '</li>
						<li>' . __('<strong>%blog_description%</strong> : will be replaced with your blog description.', sahill) . '</li>
						<li>' . __('<strong>%admin_email%</strong> : will be replaced with admin email.', sahill) . '</li>
						<li>' . __('<strong>%date%</strong> : will be replaced with current date, as formatted in <a href="options-general.php">general options</a>.', sahill) . '</li>
						<li>' . __('<strong>%time%</strong> : will be replaced with current time, as formatted in <a href="options-general.php">general options</a>.', sahill) . '</li>
					</ul>',
                    )
            );
        }
    }

    static public function wst_app_settings_func() {
        require_once WST_ROOT . 'app/back-end/templates/settings.tpl.php';
    }

    static public function wst_custom_setting_screen_options() {
        $option = 'per_page';
        $args = array(
            'label' => __('Results per page', sahill),
            'default' => 10,
            'option' => 'wst_per_page'
        );
        add_screen_option($option, $args);
    }

    static public function wst_set_custom_setting_screen_options($status, $option, $value) {
        if ('wst_per_page' == $option)
            return $value;
    }

    public function wst_app_reports() {
        
    }

    static public function is_wpbe_page() {
        global $page_hook;
        pr($page_hook);
        if ($page_hook === $this->page)
            return true;

        return false;
    }

    static public function wst_tinymce_plugins($external_plugins) {
        global $wp_version;

        $fullpage = array();
        if (version_compare($wp_version, '3.2', '<')) {
            $fullpage = array(
                'fullpage' => WST_URI . 'app/assets/back-end/tinymce-plugins/3.3.x/fullpage/editor_plugin.js'
            );
        } else {
            $fullpage = array(
                'fullpage' => WST_URI . 'app/assets/back-end/tinymce-plugins/3.4.x/fullpage/editor_plugin.js'
            );
        }
        $cmseditor = array(
            'cmseditor' => WST_URI . 'app/assets/back-end/tinymce-plugins/cmseditor/editor_plugin.js'
        );
        $external_plugins = $external_plugins + $fullpage + $cmseditor;
        return $external_plugins;
    }

    static public function wst_tinymce_buttons($buttons) {
        array_push($buttons, 'cmseditor');

        return $buttons;
    }

    static public function wst_tinymce_config($init) {


        $init['remove_linebreaks'] = false;
        $init['content_css'] = ''; // WP =< 3.0

        if (isset($init['extended_valid_elements']))
            $init['extended_valid_elements'] = $init['extended_valid_elements'] . ',td[*]';

        return $init;
    }

}
