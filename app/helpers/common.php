<?php

class WST_Common {

    static public function wst_remove_notification() {
        global $user_ID;
        get_currentuserinfo();
        add_action('init', create_function('$a', "remove_action( 'init', 'wp_version_check' );"), 2);
        add_filter('pre_option_update_core', create_function('$a', "return null;"));
    }

}
