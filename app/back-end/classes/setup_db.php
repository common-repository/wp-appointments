<?php

class WST_DB_Setup {

    static public function wst_init() {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $charset_collate = $wpdb->get_charset_collate();
        $table_querys = array();
        $alter_querys = array();

        $table_querys[] = array("
            CREATE TABLE {$table_prefix}appointments (
                id int(11) NOT NULL AUTO_INCREMENT,
                location int(11) NOT NULL,
                service int(11) NOT NULL,
                worker int(11) NOT NULL,
                name varchar(255) DEFAULT NULL,
                email varchar(255) DEFAULT NULL,
                phone varchar(45) DEFAULT NULL,
                date date DEFAULT NULL,
                slot varchar(45) DEFAULT NULL,
                status varchar(45) DEFAULT NULL,
                created timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                price decimal(10, 0) DEFAULT NULL,
                ip varchar(45) DEFAULT NULL,
                PRIMARY KEY (id),
                KEY appointments_location (location),
                KEY appointments_service (service),
                KEY appointments_worker (worker)
            ) $charset_collate"
        );

        $table_querys[] = array("
            CREATE TABLE {$table_prefix}connections (
                id int(11) NOT NULL AUTO_INCREMENT,
                location int(11) NOT NULL,
                worker varchar(255) NOT NULL,
                service varchar(255) NOT NULL,
                date_start date DEFAULT NULL,
                date_end date DEFAULT NULL,
                week_of_days varchar(60) DEFAULT NULL,
                PRIMARY KEY (id),
                KEY location_to_connection (location),
                KEY worker_to_connection (worker)
                
                
              ) $charset_collate"
        );

        $table_querys[] = array("
            CREATE TABLE {$table_prefix}locations (
                id int(11) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                address text NOT NULL,
                country varchar(255) DEFAULT NULL,
                location varchar(255) DEFAULT NULL,
                cord varchar(255) DEFAULT NULL,
                image int(11) NOT NULL,
                PRIMARY KEY  (id)
              ) $charset_collate"
        );

        $table_querys[] = array("
                CREATE TABLE IF NOT EXISTS {$table_prefix}options (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    wst_key varchar(45) DEFAULT NULL,
                    wst_value text,
                    type varchar(45) DEFAULT NULL,
                    PRIMARY KEY  (id)
                  ) $charset_collate"
        );

        $table_querys[] = array("
                CREATE TABLE {$table_prefix}staff (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    name varchar(100) DEFAULT NULL,
                    description text,
                    email varchar(100) DEFAULT NULL,
                    phone varchar(45) DEFAULT NULL,
                    country varchar(255) DEFAULT NULL,
                    start_time time DEFAULT NULL,
                    end_time time DEFAULT NULL,
                    interval_time int(11) DEFAULT NULL,
                    interval_set varchar(1000) DEFAULT NULL,
                    image int(11) NOT NULL,
                    PRIMARY KEY  (id)
                  ) $charset_collate"
        );

        $table_querys[] = array("
                CREATE TABLE {$table_prefix}services (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    name varchar(255) NOT NULL,
                    description varchar(1000) DEFAULT NULL,
                    duration int(11) NOT NULL,
                    price decimal(10,0) DEFAULT NULL,
                    image int(11) NOT NULL,
                    PRIMARY KEY  (id)
                  ) $charset_collate"
        );
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        foreach ($table_querys as $query) {
            dbDelta(_set($query, '0'));
        }
    }

    static public function wst_get_row_count($table) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . $table;
        $total = $wpdb->get_var("SELECT COUNT('id') FROM " . $table_name);
        return $total;
    }

    static public function wst_get_result($table, $id = '', $type) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . $table;
        if (!empty($id)) {
            $result = $wpdb->get_results("SELECT * FROM $table_name where id=$id Limit 1", ARRAY_A);
        } else {
            if ($type == 'locations') {
                $pagenum = isset($_GET['location-paged']) ? (int) $_GET['location-paged'] : 1;
            } elseif ($type == 'services') {
                $pagenum = isset($_GET['services-paged']) ? (int) $_GET['services-paged'] : 1;
            } elseif ($type == 'staff') {
                $pagenum = isset($_GET['staff-paged']) ? (int) $_GET['staff-paged'] : 1;
            } elseif ($type == 'connections') {
                $pagenum = isset($_GET['conn-paged']) ? (int) $_GET['conn-paged'] : 1;
            } elseif ($type == 'appointments') {
                $pagenum = isset($_GET['paged']) ? (int) $_GET['paged'] : 1;
            }
            $user = get_current_user_id();
            $screen = get_current_screen();
            $screen_option = $screen->get_option('wst_per_page');
            $per_page = get_user_meta($user, $screen_option, true);
            $get_per_page = _set($per_page, 'wst_per_page');
            $limit = (_set($get_per_page, '0') != '') ? _set($get_per_page, '0') : 10;
            $offset = ( $pagenum - 1 ) * $limit;
            $total = $wpdb->get_var("SELECT COUNT('id') FROM " . $table_name);
            $num_of_pages = ceil($total / $limit);
            $result = $wpdb->get_results('select * from ' . $table_name . ' ORDER BY id DESC LIMIT ' . $limit . ' offset ' . $offset, ARRAY_A);
        }
        return $result;
    }

    static public function wst_table_data($table) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . $table;
        $result = $wpdb->get_results("SELECT * FROM " . $table_name);
        return $result;
    }

    static public function wst_table_data_offset($table, $limit = 5, $offset = 0) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . $table;
        $result = $wpdb->get_results("SELECT * FROM  $table_name LIMIT $limit OFFSET $offset");
        return $result;
    }

    static public function wst_get_table_data($table, $column, $id) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . $table;
        $result = $wpdb->get_results("SELECT $column FROM $table_name where id = $id", ARRAY_A);
        return _set(_set($result, '0'), $column);
    }

    static public function wst_get_column($table, $column, $row_id) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . $table;
        $result = $wpdb->get_results("SELECT $column FROM $table_name where id = $row_id", ARRAY_A);
        return _set(_set($result, '0'), $column);
    }

    static public function wst_query($query) {
        global $wpdb;
        return $result = $wpdb->get_results($query, ARRAY_A);
        //return _set($result, '0');
    }

    static public function wst_get_column_by_name($table, $column, $row_name, $row_value) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . $table;
        $result = $wpdb->get_results("SELECT $column FROM $table_name where $row_name = '.$row_value.'", ARRAY_A);
        return _set(_set($result, '0'), $column);
    }

}
