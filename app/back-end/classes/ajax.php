<?php

class WST_Ajax {

    static public function wst_init() {
        $requests = array(
            'wst_add_new_location' => 'wst_add_new_location_response',
            'wst_save_record' => 'wst_save_record_response',
            'wst_update_table' => 'wst_update_table_response',
            'wst_delete_record' => 'wst_delete_record_response',
            'wst_edit_location' => 'wst_edit_location_response',
            'wst_update_location_record' => 'wst_update_location_record_response',
            'wst_save_options' => 'wst_save_options_response',
            'wst_email_testing' => 'wst_email_testing_response',
            'wst_service_load_more' => 'wst_service_load_more_response',
            'wst_location_getter' => 'wst_location_getter_response',
            'wst_service_chose_service' => 'wst_service_chose_service_response',
            'wst_service_getter' => 'wst_service_getter_response',
            'wst_staff_getter' => 'wst_staff_getter_response',
            'wst_date_time_checker' => 'wst_date_time_checker_response',
            'wst_worker_slots' => 'wst_worker_slots_response',
            'wst_book_appointment' => 'wst_book_appointment_response',
            'wst_book_appointment_booked' => 'wst_book_appointment_booked_response',
        );

        foreach ($requests as $name => $request) {
            add_action("wp_ajax_nopriv_{$name}", array(__CLASS__, $request));
            add_action("wp_ajax_{$name}", array(__CLASS__, $request));
        }
    }

    static public function wst_add_new_location_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_add_new_location') {
            WST_Ajax_response::wst_add_new_location_response($_POST);
            exit;
        }
    }

    static public function wst_save_record_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_save_record') {
            WST_Ajax_response::wst_save_record_response($_POST);
            exit;
        }
    }

    static public function wst_update_table_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_update_table') {
            WST_Ajax_response::wst_update_table_response($_POST);
            exit;
        }
    }

    static public function wst_delete_record_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_delete_record') {
            WST_Ajax_response::wst_delete_record_response($_POST);
            exit;
        }
    }

    static public function wst_edit_location_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_edit_location') {
            WST_Ajax_response::wst_edit_location_response($_POST);
            exit;
        }
    }

    static public function wst_update_location_record_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_update_location_record') {
            WST_Ajax_response::wst_update_location_record_response($_POST);
            exit;
        }
    }

    static public function wst_save_options_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_save_options') {
            WST_Ajax_response::wst_save_options_response($_POST);
            exit;
        }
    }

    static public function wst_email_testing_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_email_testing') {
            WST_Ajax_response::wst_email_testing_response($_POST);
            exit;
        }
    }

    static public function wst_service_load_more_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_service_load_more') {
            WST_Ajax_response::wst_service_load_more_response($_POST);
            exit;
        }
    }

    static public function wst_service_chose_service_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_service_chose_service') {
            WST_Ajax_response::wst_service_chose_service_response($_POST);
            exit;
        }
    }

    static public function wst_location_getter_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_location_getter') {
            WST_Ajax_response::wst_location_getter_response($_POST);
            exit;
        }
    }

    static public function wst_service_getter_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_service_getter') {
            WST_Ajax_response::wst_service_getter_response($_POST);
            exit;
        }
    }

    static public function wst_staff_getter_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_staff_getter') {
            WST_Ajax_response::wst_staff_getter_response($_POST);
            exit;
        }
    }

    static public function wst_date_time_checker_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_date_time_checker') {
            WST_Ajax_response::wst_date_time_checker_response($_POST);
            exit;
        }
    }

    static public function wst_worker_slots_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_worker_slots') {
            WST_Ajax_response::wst_worker_slots_response($_POST);
            exit;
        }
    }

    static public function wst_book_appointment_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_book_appointment') {
            WST_Ajax_response::wst_book_appointment_response($_POST);
            exit;
        }
    }

    static public function wst_book_appointment_booked_response() {
        if (isset($_POST['action']) && $_POST['action'] == 'wst_book_appointment_booked') {
            WST_Ajax_response::wst_book_appointment_booked_response($_POST);
            exit;
        }
    }

}
