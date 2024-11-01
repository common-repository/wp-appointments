<?php

/**
 * Plugin Name: WP Appointments
 * Plugin URI: https://wordpress.org/plugins/wp-appointments/
 * Description: Advance and modern Appointments managment system powered by <a href="http://themeforest.net/user/webinane" target="_blank">Webinane</a>
 * Version: 1.0
 * Author: Webinane
 * Author URI: http://themeforest.net/user/webinane
 * Text Domain: wp-appointments
 */
if (version_compare(PHP_VERSION, '5.3.0') < 0) {
    die("You're runing WordPress on outdated PHP version. Please contact your hosting company and updgrade PHP to 5.3 or above. Learn more about new features in PHP 5.3 - http://www.php.net/manual/en/migration53.new-features.php For cPanel users - you may easily switch PHP version using your hosting settings.");
}
require_once( __DIR__ . '/app/init.php' );
WST_Module_Init::WST_Init();
register_activation_hook(__FILE__, array('WST_Module_Init', 'wst_db_install'));
add_filter('set-screen-option', array('WST_Panel_options', 'wst_set_custom_setting_screen_options'), 10, 3);

$section = _set($_GET, 'section');
if (isset($section) && $section == 'services') {
    ?>
<!--    <script type="text/javascript">
        jQuery(document).ready(function () {
            new CBPFWTabs.prototype._show(2);
        });
    </script>-->
    <?php

}
