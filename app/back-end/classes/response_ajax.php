<?php

class WST_Ajax_response {

    static public function wst_add_new_location_response($data) {
        if (_set($data, 'type') == 'locations') {
            require_once WST_ROOT . 'app/back-end/templates/popup/location.tpl.php';
            exit;
        } elseif (_set($data, 'type') == 'services') {
            require_once WST_ROOT . 'app/back-end/templates/popup/services.tpl.php';
        } elseif (_set($data, 'type') == 'staff') {
            require_once WST_ROOT . 'app/back-end/templates/popup/staff.tpl.php';
        } elseif (_set($data, 'type') == 'connections') {
            require_once WST_ROOT . 'app/back-end/templates/popup/connection-tpl.php';
        } elseif (_set($data, 'type') == 'conn_service') {
            require_once WST_ROOT . 'app/back-end/templates/popup/conn_services.tpl.php';
        }
    }

    static public function wst_edit_location_response($data) {
        if (_set($data, 'type') == 'locations') {
            require_once WST_ROOT . 'app/back-end/templates/popup/location.tpl.update.php';
            exit;
        } elseif (_set($data, 'type') == 'services') {
            require_once WST_ROOT . 'app/back-end/templates/popup/services.tpl.update.php';
            exit;
        } elseif (_set($data, 'type') == 'staff') {
            require_once WST_ROOT . 'app/back-end/templates/popup/staff.tpl.update.php';
            exit;
        } elseif (_set($data, 'type') == 'connections') {
            require_once WST_ROOT . 'app/back-end/templates/popup/connections.tpl.update.php';
            exit;
        }
    }

    static public function wst_save_record_response($data) {
        if (_set($data, 'type') == 'locations') {
            $name = strip_tags(_set($data, 'name'));
            $address = strip_tags(_set($data, 'address'));
            $country = strip_tags(_set($data, 'country'));
            $location = strip_tags(_set($data, 'location'));
            $img = (strip_tags(_set($data, 'img_id')) != 'undefined') ? strip_tags(_set($data, 'img_id')) : '';
            $errors = array();
            $msg = array(__('Name', sahill), __('Address', sahill), __('location', sahill));
            $check = array($name, $address, $location);
            $counter = 0;
            foreach ($check as $c) {
                if (empty($c)) {
                    $m = _set($msg, $counter);
                    $errors[] = '<div class="alert alert-warning">' . __("Please Enter {$m}", sahill) . '</div>';
                }
                $counter++;
            }
            if (empty($errors)) {
                global $wpdb;
                $table_prefix = $wpdb->prefix . 'wst_';
                $table_name = $table_prefix . 'locations';
                $wpdb->show_errors();
                $datum = $wpdb->get_var("SELECT count(*) FROM $table_name WHERE name = '" . $name . "' AND address = '" . $address . "' AND country = '" . $country . "' AND location = '" . $location . "' ");
                if ($datum > 0) {
                    echo '<div class="alert alert-danger">' . __('This Record is already exists.', sahill) . '</div>';
                } else {
                    $result = $wpdb->insert($table_name, array('name' => $name, 'address' => $address, 'country' => $country, 'location' => $location, 'image' => $img), array('%s', '%s', '%s', '%s', '%d'));
                    if ($wpdb->last_error === '') {
                        echo '<div class="alert alert-success">' . __('Successfully Added Record', sahill) . '</div>';
                    }
                }
            } else {
                foreach ($errors as $e) {
                    echo $e;
                }
            }
        } else if (_set($data, 'type') == 'services') {
            $name = strip_tags(_set($data, 'name'));
            $desc = strip_tags(_set($data, 'desc'));
            $duration = strip_tags(_set($data, 'duration'));
            $price = strip_tags(_set($data, 'price'));
            $img = (strip_tags(_set($data, 'img_id')) != 'undefined') ? strip_tags(_set($data, 'img_id')) : '';
            $errors = array();
            $msg = array(__('Enter Name', sahill), __('Enter Description', sahill), __('Enter Duration', sahill), __('Enter Price', sahill), __('Upload Image', sahill));
            $check = array($name, $desc, $duration, $price, $img);
            $counter = 0;
            foreach ($check as $c) {
                if (empty($c)) {
                    $m = _set($msg, $counter);
                    $errors[] = '<div class="alert alert-warning">' . __("Please {$m}", sahill) . '</div>';
                }
                $counter++;
            }
            if (empty($errors)) {
                global $wpdb;
                $table_prefix = $wpdb->prefix . 'wst_';
                $table_name = $table_prefix . 'services';
                $wpdb->show_errors();
                $datum = $wpdb->get_var("SELECT count(*) FROM $table_name WHERE name = '" . $name . "' AND duration = '" . $duration . "' AND price = '" . $price . "'");
                if ($datum > 0) {
                    echo '<div class="alert alert-danger">' . __('This Record is already exists.', sahill) . '</div>';
                } else {
                    $result = $wpdb->insert($table_name, array('name' => $name, 'description' => $desc, 'duration' => $duration, 'price' => $price, 'image' => $img), array('%s', '%s', '%d', '%d', '%d'));
                    if ($wpdb->last_error === '') {
                        echo '<div class="alert alert-success">' . __('Successfully Added Record', sahill) . '</div>';
                    }
                }
            } else {
                foreach ($errors as $e) {
                    echo $e;
                }
            }
        } else if (_set($data, 'type') == 'staff') {
            $name = strip_tags(_set($data, 'name'));
            $desc = strip_tags(_set($data, 'desc'));
            $email = strip_tags(_set($data, 'email'));
            $contact = strip_tags(_set($data, 'contact'));
            $country = strip_tags(_set($data, 'country'));
            $start_time = strip_tags(_set($data, 'start_time'));
            $end_time = strip_tags(_set($data, 'end_time'));
            $interval = strip_tags(_set($data, 'interval'));
            $img = (strip_tags(_set($data, 'img_id')) != 'undefined') ? strip_tags(_set($data, 'img_id')) : '';
            $errors = array();
            $msg = array(__('Name', sahill), __('Description', sahill), __('Email', sahill), __('Contact No', sahill), __('Correct Email', sahill), __('Select Start Time', sahill), __('Select End Time', sahill), __('Select Interval', sahill));
            $check = array($name, $desc, $email, $contact, $start_time, $end_time, $interval);
            $create_period = WST_Common_fun::wst_hoursRange(_set($data, 'start_time'), _set($data, 'end_time'), $interval);
            $st = date("H:i", strtotime(strip_tags(_set($data, 'start_time')))) * 3600;
            $et = date("H:i", strtotime(strip_tags(_set($data, 'end_time')))) * 3600;
            $slots = WST_Common_fun::wst_hoursRange($st, $et, $interval * 60, 'g:i A');
            $clone_solts = array();
            foreach ($slots as $s) {
                $clone_solts[] = $s;
            }
            $counter = 0;
            foreach ($check as $c) {
                if (empty($c)) {
                    $m = _set($msg, $counter);
                    $errors[] = '<div class="alert alert-warning">' . __("Please Enter {$m}", sahill) . '</div>';
                }
                $counter++;
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err = _set($msg, '4');
                $errors[] = '<div class="alert alert-warning">' . __("Please Enter {$err}", sahill) . '</div>';
            }
            if (empty($errors)) {
                global $wpdb;
                $table_prefix = $wpdb->prefix . 'wst_';
                $table_name = $table_prefix . 'staff';
                $wpdb->show_errors();
                $datum = $wpdb->get_var("SELECT count(*) FROM $table_name WHERE name = '" . $name . "' AND description = '" . $desc . "' AND email = '" . $email . "' AND phone = '" . $contact . "'");
                if ($datum > 0) {
                    echo '<div class="alert alert-danger">' . __('This Record is already exists.', sahill) . '</div>';
                } else {
                    $result = $wpdb->insert($table_name, array('name' => $name, 'description' => $desc, 'email' => $email, 'phone' => $contact, 'country' => $country, 'start_time' => $start_time, 'end_time' => $end_time, 'interval_time' => $interval, 'interval_set' => serialize($clone_solts), 'image' => $img), array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%d'));
                    if ($wpdb->last_error === '') {
                        echo '<div class="alert alert-success">' . __('Successfully Added Record', sahill) . '</div>';
                    }
                }
            } else {
                foreach ($errors as $e) {
                    echo $e;
                }
            }
        } else if (_set($data, 'type') == 'connections') {
            $location = strip_tags(_set($data, 'location'));
            $worker = strip_tags(_set($data, 'worker'));
            $services = strip_tags(_set($data, 'service'));
            $start_date = date("Y-m-d", strtotime(strip_tags(_set($data, 'start_date'))));
            $end_date = date("Y-m-d", strtotime(strip_tags(_set($data, 'end_date'))));
            $weekdays = strip_tags(_set($data, 'week_days'));
            $errors = array();
            $msg = array(__('Select Location', sahill), __('Select Worker', sahill), __('Select Service', sahill), __('Select Start Date', sahill), __('Select End Date', sahill), __('Select Week Day\'s', sahill));
            $check = array($location, $worker, $services, $start_date, $end_date, $weekdays);
            $counter = 0;
            foreach ($check as $c) {
                if (empty($c)) {
                    $m = _set($msg, $counter);
                    $errors[] = '<div class="alert alert-warning">' . __("Please {$m}", sahill) . '</div>';
                }
                $counter++;
            }
            if (empty($errors)) {
                global $wpdb;
                $table_prefix = $wpdb->prefix . 'wst_';
                $table_name = $table_prefix . 'connections';
                $wpdb->show_errors();
//$datum = $wpdb->get_var("SELECT count(*) FROM $table_name WHERE location = '" . $location . "' AND worker = '" . $worker . "' AND service = '" . $services . "' AND start_time = '" . $start_time . "' AND end_time = '" . $end_time . "' AND interval_time = '" . $interval . "' AND date_start = '" . $start_date . "' AND date_end = '" . $end_date . "' AND week_of_days = '" . $weekdays . "' ");
                $datum = $wpdb->get_var("SELECT count(*) FROM $table_name WHERE location = '" . $location . "' ");
                if ($datum > 0) {
                    echo '<div class="alert alert-danger">' . __('Record for this location already exists.', sahill) . '</div>';
                } else {
                    $result = $wpdb->insert($table_name, array('location' => $location, 'worker' => $worker, 'service' => $services, 'date_start' => $start_date, 'date_end' => $end_date, 'week_of_days' => $weekdays), array('%d', '%s', '%s', '%s', '%s', '%s'));
                    if ($wpdb->last_error === '') {
                        echo '<div class="alert alert-success">' . __('Successfully Added Record', sahill) . '</div>';
                    }
                }
            } else {
                foreach ($errors as $e) {
                    echo $e;
                }
            }
        }
        exit;
    }

    static public function wst_update_table_response($data) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        if (_set($data, 'type') == 'locations') {
            $table_name = $table_prefix . 'locations';
            $result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1", ARRAY_A);
            if (!empty($result)) {
                $list = WST_Common_fun::wst_country_list();
                foreach ($result as $row) {
                    $country_code = _set($row, 'country');
                    $img_path = '';
                    if (_set($row, 'image') != 0) {
                        $path = wp_get_attachment_image_src(_set($row, 'image'), 'thumbnail');
                        $img_path = _set($path, '0');
                    }
                    if (!empty($img_path)) {
                        $img_preview = '<img src="' . $img_path . '" />';
                    } else {
                        $img_preview = '';
                    }
                    echo '<tr class="head">';
                    echo '<td><strong>' . _set($row, 'id') . '</strong></td>';
                    echo '<td>' . _set($row, 'name') . '</td>';
                    echo '<td>' . _set($row, 'address') . '</td>';
                    echo '<td>' . _set($list, $country_code) . '</td>';
                    echo '<td>' . _set($row, 'location') . '</td>';
                    echo '<td> ' . $img_preview . ' </td>';
                    echo '<td>
                                <div id="edit_record" data-id="' . _set($row, 'id') . '" data-action="locations" class="edit_record btn dark center"><i class="dashicons-wp-app-edit"></i>' . __('Edit', sahill) . '</div>
                                <div id="delete_record" data-id="' . _set($row, 'id') . '" data-action="locations" class="delete_record btn light center"><i class="dashicons-wp-app-delete"></i>' . __('Delete', sahill) . '</div>
                             </td>';
                    echo '</tr>';
                }
            }
        } elseif (_set($data, 'type') == 'services') {
            $table_name = $table_prefix . 'services';
            $result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1", ARRAY_A);
            if (!empty($result)) {
                $list = WST_Common_fun::wst_country_list();
                foreach ($result as $row) {
                    $country_code = _set($row, 'country');
                    $img_path = '';
                    if (_set($row, 'image') != 0) {
                        $path = wp_get_attachment_image_src(_set($row, 'image'), 'thumbnail');
                        $img_path = _set($path, '0');
                    }
                    if (!empty($img_path)) {
                        $img_preview = '<img src="' . $img_path . '" />';
                    } else {
                        $img_preview = '';
                    }
                    echo '<tr class="head">';
                    echo '<td><strong>' . _set($row, 'id') . '</strong></td>';
                    echo '<td>' . _set($row, 'name') . '</td>';
                    echo '<td><div class="desc">' . _set($row, 'description') . '</div></td>';
                    echo '<td> ' . $img_preview . ' </td>';
                    echo '<td>' . _set($row, 'duration') . '</td>';
                    echo '<td>' . _set($row, 'price') . '</td>';
                    echo '<td>
                                <div id="edit_record" data-id="' . _set($row, 'id') . '" data-action="services" class="edit_record btn dark center"><i class="dashicons-wp-app-edit"></i>' . __('Edit', sahill) . '</div>
                                <div id="delete_record" data-id="' . _set($row, 'id') . '" data-action="services" class="delete_record btn light center"><i class="dashicons-wp-app-delete"></i>' . __('Delete', sahill) . '</div>
                             </td>';
                    echo '</tr>';
                }
            }
        } elseif (_set($data, 'type') == 'staff') {
            $table_name = $table_prefix . 'staff';
            $result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1", ARRAY_A);
            if (!empty($result)) {
                $list = WST_Common_fun::wst_country_list();
                foreach ($result as $row) {
                    $country_code = _set($row, 'country');
                    $img_path = '';
                    if (_set($row, 'image') != 0) {
                        $path = wp_get_attachment_image_src(_set($row, 'image'), 'thumbnail');
                        $img_path = _set($path, '0');
                    }
                    if (!empty($img_path)) {
                        $img_preview = '<img src="' . $img_path . '" />';
                    } else {
                        $img_preview = '';
                    }
                    echo '<tr class="head">';
                    echo '<td><strong>' . _set($row, 'id') . '</strong></td>';
                    echo '<td>' . _set($row, 'name') . '</td>';
                    echo '<td><div class="desc">' . _set($row, 'description') . '</div></td>';
                    echo '<td>' . _set($row, 'email') . '</td>';
                    echo '<td>' . _set($row, 'phone') . '</td>';
                    echo '<td>' . _set($list, $country_code) . '</td>';
                    echo '<td>' . "<p class='label-up'>" . __('Starts at :', sahill) . "</p>" . date("h:i A", strtotime(_set($row, 'start_time'))) . "<p class='label-up'>" . __('Ends at :', sahill) . "</p>" . date("h:i A", strtotime(_set($row, 'end_time'))) . '</td>';
                    echo '<td> ' . $img_preview . ' </td>';
                    echo '<td>
                                <div id="edit_record" data-id="' . _set($row, 'id') . '" data-action="staff" class="edit_record btn dark center"><i class="dashicons-wp-app-edit"></i>' . __('Edit', sahill) . '</div>
                                <div id="delete_record" data-id="' . _set($row, 'id') . '" data-action="staff" class="delete_record btn light center"><i class="dashicons-wp-app-delete"></i>' . __('Delete', sahill) . '</div>
                             </td>';
                    echo '</tr>';
                }
            }
        } elseif (_set($data, 'type') == 'connections') {
            $table_name = $table_prefix . 'connections';
            $result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT 1", ARRAY_A);
            if (!empty($result)) {
                $list = WST_Common_fun::wst_country_list();
                foreach ($result as $row) {
                    $worker = explode(',', _set($row, 'worker'));
                    echo '<tr class="head">';
                    echo '<td><strong>' . _set($row, 'id') . '</strong></td>';
                    echo '<td><p><strong>' . WST_DB_Setup::wst_get_column('locations', 'name', _set($row, 'location')) . '</strong></p><p>';
                    foreach ($worker as $w) {
                        $sep = ', ';
                        echo '<strong>' . WST_DB_Setup::wst_get_column('staff', 'name', $w) . $sep . '</strong>';
                    }
                    echo "</p>";
                    if (_set($row, 'service') == 'all') {
                        echo "<div class='btn blue center'><i class='dashicons-wp-app-setting_modern'></i>" . __('All Services', sahill) . "</div></td>";
                    } else {
                        echo "<div data-action='conn_service' data-array='" . _set($row, 'service') . "' class='btn_con_service btn blue center'><i class='dashicons-wp-app-setting_modern'></i>" . __('Services', sahill) . "</div></td>";
                    }
                    echo '<td><strong>';
                    if (_set($row, 'week_of_days')) {
                        $days = explode(',', _set($row, 'week_of_days'));
                        foreach ($days as $d) {
                            echo '<span>' . ucfirst($d) . '</span><br>';
                        }
                    }
                    echo '</strong></td>';
                    echo '<td>' . "<p class='label-up'>" . __('Active From :', sahill) . "</p>" . date("d M Y", strtotime(_set($row, 'date_start'))) . "<p class='label-up'>" . __('To :', sahill) . "</p>" . date("d M Y", strtotime(_set($row, 'date_end'))) . '</td>';
                    echo '<td>
                                <div id="edit_record" data-id="' . _set($row, 'id') . '" data-action="connections" class="edit_record btn dark center"><i class = "dashicons-wp-app-edit"></i>' . __('Edit', sahill) . '</div>
                                <div id="delete_record" data-id="' . _set($row, 'id') . '" data-action="connections" class="delete_record btn light center"><i class = "dashicons-wp-app-delete"></i>' . __('Delete', sahill) . '</div>
                                </td>';
                    echo '</tr>';
                }
            }
        }
    }

    static public function wst_delete_record_response($data) {
        global $wpdb;
        $wpdb->show_errors();
        $table_prefix = $wpdb->prefix . 'wst_';
        $table_name = $table_prefix . _set($data, 'type');
        $id = _set($data, 'id');
        $wpdb->delete($table_name, array('id' => $id), array('%d'));
        echo 1;
        exit;
    }

    static public function wst_update_location_record_response($data) {
        if (_set($data, 'type') == 'locations') {
            $name = strip_tags(_set($data, 'name'));
            $address = strip_tags(_set($data, 'address'));
            $country = strip_tags(_set($data, 'country'));
            $location = strip_tags(_set($data, 'location'));
            $img = (strip_tags(_set($data, 'img')) != 'undefined') ? strip_tags(_set($data, 'img')) : '';
            $id = _set($data, 'id');
            $errors = array();
            $msg = array(__('Name', sahill), __('Address', sahill), __('location', sahill));
            $check = array($name, $address, $location);
            $counter = 0;
            foreach ($check as $c) {
                if (empty($c)) {
                    $m = _set($msg, $counter);
                    $errors[] = '<div class="alert alert-warning">' . __("Please Enter {$m}", sahill) . '</div>';
                }
                $counter++;
            }
            if (empty($errors)) {
                global $wpdb;
                $table_prefix = $wpdb->prefix . 'wst_';
                $table_name = $table_prefix . 'locations';
                $wpdb->show_errors();
                $wpdb->update($table_name, array('name' => $name, 'address' => $address, 'country' => $country, 'location' => $location, 'image' => $img), array('id' => $id), array('%s', '%s', '%s', '%s', '%d'), array('%d'));
                if ($wpdb->last_error === '') {
                    echo '<div class="alert alert-success">' . __('Successfully Updatae Record', sahill) . '</div>';
                }
            } else {
                foreach ($errors as $e) {
                    echo $e;
                }
            }
        } elseif (_set($data, 'type') == 'services') {
            $id = _set($data, 'id');
            $name = strip_tags(_set($data, 'name'));
            $desc = strip_tags(_set($data, 'desc'));
            $duration = strip_tags(_set($data, 'duration'));
            $price = strip_tags(_set($data, 'price'));
            $img = (strip_tags(_set($data, 'img')) != 'undefined') ? strip_tags(_set($data, 'img')) : '';
            $errors = array();
            $msg = array(__('Enter Name', sahill), __('Enter Description', sahill), __('Enter Duration', sahill), __('Enter Price', sahill), __('Upload Image', sahill));
            $check = array($name, $desc, $duration, $price, $img);
            $counter = 0;
            foreach ($check as $c) {
                if (empty($c)) {
                    $m = _set($msg, $counter);
                    $errors[] = '<div class="alert alert-warning">' . __("Please {$m}", sahill) . '</div>';
                }
                $counter++;
            }
            if (empty($errors)) {
                global $wpdb;
                $table_prefix = $wpdb->prefix . 'wst_';
                $table_name = $table_prefix . 'services';
                $wpdb->show_errors();
                $wpdb->update($table_name, array('name' => $name, 'description' => $desc, 'duration' => $duration, 'price' => $price, 'image' => $img), array('id' => $id), array('%s', '%s', '%d', '%d', '%d'), array('%d'));
                if ($wpdb->last_error === '') {
                    echo '<div class="alert alert-success">' . __('Successfully Updatae Record', sahill) . '</div>';
                }
            } else {
                foreach ($errors as $e) {
                    echo $e;
                }
            }
        } elseif (_set($data, 'type') == 'staff') {
            $name = strip_tags(_set($data, 'name'));
            $desc = strip_tags(_set($data, 'desc'));
            $email = strip_tags(_set($data, 'email'));
            $contact = strip_tags(_set($data, 'contact'));
            $start_time = strip_tags(_set($data, 'start_time'));
            $end_time = strip_tags(_set($data, 'end_time'));
            $interval = strip_tags(_set($data, 'interval'));
            $country = strip_tags(_set($data, 'country'));
            $img = (strip_tags(_set($data, 'img')) != 'undefined') ? strip_tags(_set($data, 'img')) : '';
            $id = _set($data, 'id');
            $errors = array();
            $msg = array(__('Enter Name', sahill), __('Enter Description', sahill), __('Enter Email', sahill), __('Enter Contact No', sahill), __('Enter Correct Email', sahill), __('Select Start Time', sahill), __('Select End Time', sahill), __('Select Interval', sahill));
            $check = array($name, $desc, $email, $contact, $start_time, $end_time, $interval);
            $create_period = WST_Common_fun::wst_hoursRange(_set($data, 'start_time'), _set($data, 'end_time'), $interval);
            $st = date("H:i", strtotime(strip_tags(_set($data, 'start_time')))) * 3600;
            $et = date("H:i", strtotime(strip_tags(_set($data, 'end_time')))) * 3600;
            $slots = WST_Common_fun::wst_hoursRange($st, $et, $interval * 60, 'g:i A');
            $clone_solts = array();
            foreach ($slots as $s) {
                $clone_solts[] = $s;
            }
            $counter = 0;
            foreach ($check as $c) {
                if (empty($c)) {
                    $m = _set($msg, $counter);
                    $errors[] = '<div class="alert alert-warning">' . __("Please {$m}", sahill) . '</div>';
                }
                $counter++;
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err = _set($msg, '4');
                $errors[] = '<div class="alert alert-warning">' . __("Please Enter {$err}", sahill) . '</div>';
            }
            if (empty($errors)) {
                global $wpdb;
                $table_prefix = $wpdb->prefix . 'wst_';
                $table_name = $table_prefix . 'staff';
                $wpdb->show_errors();
                $wpdb->update($table_name, array('name' => $name, 'description' => $desc, 'email' => $email, 'phone' => $contact, 'country' => $country, 'start_time' => $start_time, 'end_time' => $end_time, 'interval_time' => $interval, 'interval_set' => serialize($clone_solts), 'image' => $img), array('id' => $id), array('%s', '%s', '%s', '%d', '%s', '%s', '%s', '%d', '%s', '%d'), array('%d'));
                if ($wpdb->last_error === '') {
                    echo '<div class="alert alert-success">' . __('Successfully Updatae Record', sahill) . '</div>';
                }
            } else {
                foreach ($errors as $e) {
                    echo $e;
                }
            }
        } elseif (_set($data, 'type') == 'connections') {
            $id = _set($data, 'id');
            $location = strip_tags(_set($data, 'location'));
            $worker = strip_tags(_set($data, 'worker'));
            $services = strip_tags(_set($data, 'service'));
            $start_date = date("Y-m-d", strtotime(strip_tags(_set($data, 'start_date'))));
            $end_date = date("Y-m-d", strtotime(strip_tags(_set($data, 'end_date'))));
            $weekdays = strip_tags(_set($data, 'week_days'));
            $errors = array();
            $msg = array(__('Select Location', sahill), __('Select Worker', sahill), __('Select Service', sahill), __('Select Start Date', sahill), __('Select End Date', sahill), __('Select Week Day\'s', sahill));
            $check = array($location, $worker, $services, $start_date, $end_date, $weekdays);
            $counter = 0;
            foreach ($check as $c) {
                if (empty($c)) {
                    $m = _set($msg, $counter);
                    $errors[] = '<div class="alert alert-warning">' . __("Please {$m}", sahill) . '</div>';
                }
                $counter++;
            }
            if (empty($errors)) {
                global $wpdb;
                $table_prefix = $wpdb->prefix . 'wst_';
                $table_name = $table_prefix . 'connections';
                $wpdb->show_errors();
                $wpdb->update($table_name, array('location' => $location, 'worker' => $worker, 'service' => $services, 'date_start' => $start_date, 'date_end' => $end_date, 'week_of_days' => $weekdays), array('id' => $id), array('%d', '%d', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s'));
                if ($wpdb->last_error === '') {
                    echo '<div class="alert alert-success">' . __('Successfully Updatae Record', sahill) . '</div>';
                }
            } else {
                foreach ($errors as $e) {
                    echo $e;
                }
            }
        }
        exit;
    }

    static public function wst_save_options_response($data) {
        if (_set($data, 'type') == 'email') {
            global $wpdb;
            $table_prefix = $wpdb->prefix . 'wst_';
            $table_name = $table_prefix . 'options';
            $wpdb->show_errors();
            $sender_name = _set($data, 'sender_name');
            $sender_email = _set($data, 'sender_email');
            $tpl = _set($data, 'template');
            $options = array(
                'from_email' => $sender_email,
                'from_name' => $sender_name,
                'template' => stripslashes($tpl),
            );
            update_option('wst_email_opt', $options);
//            $datum = $wpdb->get_var("SELECT count(*) FROM $table_name WHERE wst_key = 'wst_email_opt' ");
//            if ($datum > 0) {
//                $wpdb->update($table_name, array('wst_key' => 'wst_email_opt', 'wst_value' => maybe_serialize($options)), array('wst_key' => 'wst_email_opt'), array('%s', '%s'), array('%s'));
//            } else {
//                printr(maybe_serialize($options));
//                $wpdb->insert($table_name, array('wst_key' => 'wst_email_opt', 'wst_value' => maybe_serialize($options)), array('%s', '%s'));
//            }
        }
    }

    static public function wst_email_testing_response($data) {
        if (!current_user_can('manage_options'))
            die();

        $opt = get_option('wst_email_opt');
        $preview_email = sanitize_email(_set($data, 'email'));

        if (empty($preview_email))
            die('<div class="error"><p>' . __('Please enter an email', sahill) . '</p></div>');

        if (!is_email($preview_email))
            die('<div class="error"><p>' . __('Please enter a valid email', sahill) . '</p></div>');

// Setup preview message content
        $message = __('Hey !', sahill);
        $message .= "\r\n\r\n";
        $message .= __('This is a sample email to test your HTML template.', sahill);
        $message .= "\r\n\r\n";
        $message .= __('If you\'re not skilled in HTML/CSS email coding, I strongly recommend to leave the default template as it is. It has been tested on various and popular email clients like Gmail, Yahoo Mail, Hotmail/Live, Thunderbird, Apple Mail, Outlook, and many more.', sahill);
        $message .= "\r\n\r\n";
        $message .= __('If you have any problems or any suggestions to improve this plugin, please let me know.', sahill);
        $message .= "\r\n\r\n";

//        $contact_to = esc_attr(_set($opt, 'from_email'));
//        $headers = "From: " . esc_attr(_set($opt, 'from_name')) . "\r\n";
//        $headers .= "Reply-To: " . esc_attr(_set($opt, 'from_email')) . "\r\n";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html";
// Send the preview email


        if (wp_mail($preview_email, '[' . wp_specialchars_decode(get_option('blogname'), ENT_QUOTES) . '] - ' . __('Email Template Preview', sahill), $message, $headers)) {
            die('<div class="updated"><p>' . sprintf(__('An email preview has been successfully sent to %s', sahill), esc_attr($preview_email)) . '</p></div>');
        } else {
            die('<div class="error"><p>' . __('An error occured while sending email. Please check your server configuration.', sahill) . '</p></div>');
        }
    }

    static public function wst_location_getter_response($data) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . 'locations';
        $explode = explode('-', _set($data, 'location'));
        $id = _set($explode, '0');
        $query = "select * from $table_name where id=$id";
        $get_location = WST_DB_Setup::wst_query($query);
        $location = _set($get_location, '0');
        ?>
        <div class="choose-service ajax">
            <?php
            if (!empty($location)) {
                $img = wp_get_attachment_image_src(_set($location, 'image'), array(325, 247, 'bfi_thumb' => true))
                ?>
                <div class="service-item">
                    <div class="service-item-img">
                        <?php
                        if (_set($img, '0') != '') {
                            echo '<img src="' . _set($img, '0') . '" alt="" />';
                        } else {
                            echo '<img src="' . WST_URI . 'app/assets/front-end/images/no-image.png' . '" />';
                        }
                        ?>
                    </div><!-- Service Item Image -->
                    <div class="service-item-text">
                        <h4><?php echo esc_html(_set($location, 'name')) ?></h4>
                        <p><?php echo esc_html(_set($location, 'address')) ?></p>
                        <a data-id="<?php echo esc_attr(_set($location, 'id')) ?>" class="step1 small-btn" href="javascript:void(0)" title=""><?php _e('CHOOSE NOW', sahill) ?></a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        exit;
    }

    static public function wst_service_getter_response($data) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . 'connections';
        $id = _set($data, 'location');
        $query = "SELECT service FROM $table_name where location=$id";
        $location = WST_DB_Setup::wst_query($query);
        ?>
        <div class="choose-service ajax">
            <?php
            if (!empty($location)) {
                $check_service = _set(_set($location, '0'), 'service');
                if ($check_service == 'all') {
                    $data = WST_DB_Setup::wst_table_data('services');
                    foreach ($data as $s) {
                        $img = wp_get_attachment_image_src(_set($s, 'image'), array(325, 247, 'bfi_thumb' => true));
                        ?>
                        <div class="service-item">
                            <div class="service-item-img">
                                <?php
                                if (_set($img, '0') != '') {
                                    echo '<img src="' . _set($img, '0') . '" alt="" />';
                                } else {
                                    echo '<img src="' . WST_URI . 'app/assets/front-end/images/no-image.png' . '" />';
                                }
                                ?>
                                <div class="service-rate">
                                    <?php if (_set($s, 'price')): ?>
                                        <span><?php _e('Per Person', sahill) ?></span>
                                        <strong><?php echo esc_html(_set($s, 'price')) ?></strong>
                                    <?php endif; ?>
                                    <?php if (_set($s, 'duration')): ?>
                                        <span><?php _e('Duration', sahill) ?></span>
                                        <strong><?php echo esc_html(_set($s, 'duration')) ?></strong>
                                    <?php endif; ?>
                                </div>
                            </div><!-- Service Item Image -->
                            <div class="service-item-text">
                                <h4><?php echo esc_html(_set($s, 'name')) ?></h4>
                                <p><?php echo esc_html(_set($s, 'description')) ?></p>
                                <a data-id="<?php echo esc_attr(_set($s, 'id')) ?>" class="step1 small-btn" href="javascript:void(0)" title=""><?php _e('CHOOSE NOW', sahill) ?></a>
                            </div>
                        </div>
                        <?php
                    }
                }elseif ($check_service != 'all') {
                    $selected_services = explode(',', $check_service);
                    foreach ($selected_services as $ss) {
                        global $wpdb;
                        $table_prefix = $wpdb->prefix . 'wst_';
                        $wpdb->show_errors();
                        $table_name = $table_prefix . 'services';
                        $query = "select * from $table_name where id=$ss";
                        $get_service = WST_DB_Setup::wst_query($query);
                        $location = _set($get_service, '0');
                        $img = wp_get_attachment_image_src(_set($location, 'image'), array(325, 247, 'bfi_thumb' => true));
                        ?>
                        <div class="service-item">
                            <div class="service-item-img">
                                <?php
                                if (_set($img, '0') != '') {
                                    echo '<img src="' . _set($img, '0') . '" alt="" />';
                                } else {
                                    echo '<img src="' . WST_URI . 'app/assets/front-end/images/no-image.png' . '" />';
                                }
                                ?>
                                <div class="service-rate">
                                    <?php if (_set($s, 'price')): ?>
                                        <span><?php _e('Per Person', sahill) ?></span>
                                        <strong><?php echo esc_html(_set($location, 'price')) ?></strong>
                                    <?php endif; ?>
                                    <?php if (_set($location, 'duration')): ?>
                                        <span><?php _e('Duration', sahill) ?></span>
                                        <strong><?php echo esc_html(_set($location, 'duration')) ?></strong>
                                    <?php endif; ?>
                                </div>
                            </div><!-- Service Item Image -->
                            <div class="service-item-text">
                                <h4><?php echo esc_html(_set($location, 'name')) ?></h4>
                                <p><?php echo esc_html(_set($location, 'description')) ?></p>
                                <a data-id="<?php echo esc_attr(_set($location, 'id')) ?>" class="step2 small-btn" href="javascript:void(0)" title=""><?php _e('CHOOSE NOW', sahill) ?></a>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                echo '<div class="choose-service ajax"><p>' . __('Sorry! There is no service for this location.', sahill) . '</p></div>';
            }
            exit;
            ?>
        </div>
        <?php
        exit;
    }

    static public function wst_service_load_more_response($data) {
        $get_services = WST_DB_Setup::wst_table_data_offset('services', 5, _set($data, 'offset'));
        if (!empty($get_services)) {
            foreach ($get_services as $service) {
                $img = wp_get_attachment_image_src($service->image, array(325, 247, 'bfi_thumb' => true))
                ?>
                <div class="service-item">
                    <div class="service-item-img">
                        <?php
                        if (_set($img, '0') != '') {
                            echo '<img src="' . _set($img, '0') . '" alt="" />';
                        } else {
                            echo '<img src="' . WST_URI . 'app/assets/front-end/images/no-image.png' . '" />';
                        }
                        ?>
                        <div class="service-rate">
                            <span><?php _e('Per Person', sahill) ?></span>
                            <strong><?php echo esc_html($service->price) ?></strong>
                        </div>
                    </div><!-- Service Item Image -->
                    <div class="service-item-text">
                        <h4><?php echo esc_html($service->name) ?></h4>
                        <p><?php echo esc_html($service->description) ?></p>
                        <a data-id="<?php echo esc_attr($service->id) ?>" class="small-btn" href="javascript:void(0)" title=""><?php _e('CHOOSE NOW', sahill) ?></a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo 'none';
        }
        exit;
    }

    static public function wst_staff_getter_response($data) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . 'connections';
        $explode = explode('-', _set($data, 'location'));
        $id = _set($explode, '0');
        $query = "select worker from $table_name where location=$id";
        $get_workers = WST_DB_Setup::wst_query($query);
        $workers = _set($get_workers, '0');
        ?>
        <div class="step-content" data-id="choose-worker">
            <div class="elegent-title">
                <h2><?php _e('SELECT', sahill) ?> <span><?php _e('YOUR WORKER', sahill) ?></span></h2>
            </div>

            <div class="select-worker">
                <div class="row">
                    <?php
                    if (!empty($workers)) {
                        $exp_worker = explode(',', _set($workers, 'worker'));
                        foreach ($exp_worker as $w) {
                            $table_name = $table_prefix . 'staff';
                            $query = "select * from $table_name where id=$w";
                            $get_worker = WST_DB_Setup::wst_query($query);
                            $worker = _set($get_worker, '0');
                            $img = wp_get_attachment_image_src(_set($worker, 'image'), array(206, 206, 'bfi_thumb' => true))
                            ?>
                            <div class="col-md-4">
                                <div class="worker">
                                    <?php
                                    if (_set($img, '0') != '') {
                                        echo '<img src="' . _set($img, '0') . '" alt="" />';
                                    } else {
                                        echo '<img src="' . WST_URI . 'app/assets/front-end/images/staff.png' . '" />';
                                    }
                                    ?>
                                    <div class="worker-detail">
                                        <h3><?php echo esc_html(_set($worker, 'name')) ?></h3>
                                        <a data-location="<?php echo esc_attr(_set($data, 'location')) ?>" data-service="<?php echo esc_attr(_set($data, 'service')) ?>" data-worker="<?php echo esc_attr(_set($worker, 'id')) ?>" class="step3 small-btn" href="javascript:void(0)" title="<?php echo esc_html($worker->name) ?>"><?php _e('Choose Now', sahill) ?></a>
                                    </div>
                                </div><!-- Worker -->
                            </div>

                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-md-4">
                            <p><?php _e('Sorry No Worker Found!', sahill) ?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    static public function wst_date_time_checker_response($data) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . 'connections';
        $exp = explode('-', _set($data, 'location'));
        $id = _set($exp, '0');
        $query = "select date_end from $table_name where location=$id";
        $get_end_date = WST_DB_Setup::wst_query($query);
        $end_date = _set(_set($get_end_date, '0'), 'date_end');
        $current = new DateTime(date('Y-m-d'));
        $date2 = new DateTime($end_date);
        $days = $date2->diff($current)->format("%a");
        ?>
        <div class="step-content" data-id="date-time">
            <div class="elegent-title">
                <h2><?php _e('SELECT YOUR', sahill) ?> <span><?php _e('DATE & TIME', sahill) ?></span></h2>
            </div>

            <div class="select-date-time">
                <div class="select-date">
                    <div data-location="<?php echo esc_attr(_set($data, 'location')) ?>" data-service="<?php echo esc_attr(_set($data, 'service')) ?>" data-worker="<?php echo esc_attr(_set($data, 'worker')) ?>" id="datetimepicker12"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                jQuery('#datetimepicker12').datepicker({
                    startDate: '-0d',
                    endDate: '+<?php echo esc_js($days) ?>d'
                }).change(dateChanged).on('changeDate', dateChanged);
            });
        </script>
        <?php
    }

    static public function wst_worker_slots_response($data) {
        global $wpdb;
        $table_prefix = $wpdb->prefix . 'wst_';
        $wpdb->show_errors();
        $table_name = $table_prefix . 'staff';
        $id = _set($data, 'worker');
        $query = "select interval_set from $table_name where id=$id";
        $get_slots = WST_DB_Setup::wst_query($query);
        $slots = unserialize(_set(_set($get_slots, '0'), 'interval_set'));

        /* get appointment slots */
        $worker = _set($data, 'worker');
        $date = _set($data, 'date');
        $table = $table_prefix . 'appointments';
        $query = "SELECT worker, date, slot FROM $table WHERE worker='$worker' AND date ='$date'";
        $get_booked_slots = WST_DB_Setup::wst_query($query);
        $booked_slots = array();
        if (!empty($get_booked_slots)) {
            foreach ($get_booked_slots as $slot) {
                $booked_slots[] = _set($slot, 'slot');
            }
        }

        $counter = 0;
        if (!empty($slots)) {
            echo '<div class="time-picker"><div class="select-time">';
            foreach ($slots as $key => $s) {
                $booked_class = '';
                if (in_array($s, $booked_slots)) {
                    $booked_class = 'slot-booked';
                }
                echo '<div class="step4 ' . $booked_class . ' time-box" data-location="' . esc_attr(_set($data, 'location')) . '" data-service="' . esc_attr(_set($data, 'service')) . '" data-worker="' . esc_attr(_set($data, 'worker')) . '" data-date="' . esc_attr(_set($data, 'date')) . '">' . $s . '</div>';
                $counter++;
                if ($counter == 6) {
                    echo '</div><div class="select-time">';
                    $counter = 0;
                }
            }
            echo '</div></div>';
        } else {
            echo '<div class="time-picker"><p>' . __('Sorry This Work is full', sahill) . '</p></div>';
        }
    }

    static public function wst_book_appointment_response($data) {
        ?>
        <div class="step-content" data-id="user-information">
            <div class="elegent-title">
                <h2><?php _e('USER', sahill) ?> <span><?php _e('INFORMATION', sahill) ?></span></h2>
            </div>
            <div class="steps-form">
                <form id="wst_appointment_form">
                    <div id="wst_appointment_msg"></div>
                    <div class="row">
                        <input type="hidden" id="location" value="<?php echo esc_attr(_set($data, 'location')) ?>" />
                        <input type="hidden" id="service" value="<?php echo esc_attr(_set($data, 'service')) ?>" />
                        <input type="hidden" id="worker" value="<?php echo esc_attr(_set($data, 'worker')) ?>" />
                        <input type="hidden" id="slot" value="<?php echo esc_attr(_set($data, 'slot')) ?>" />
                        <input type="hidden" id="date" value="<?php echo esc_attr(_set($data, 'date')) ?>" />

                        <div class="col-md-6"><input id="f_name" type="text" placeholder="<?php _e('First Name', sahill) ?>" /></div>
                        <div class="col-md-6"><input id="l_name" type="text" placeholder="<?php _e('Last Name', sahill) ?>" /></div>
                        <div class="col-md-6"><input id="contact" type="text" placeholder="<?php _e('Mobile Number', sahill) ?>" /></div>
                        <div class="col-md-6"><input id="mail" type="email" placeholder="<?php _e('Email', sahill) ?>" /></div>
                        <div class="col-md-12">
                            <button class="big-btn"><?php _e('Book Now', sahill) ?></button>							
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <?php
    }

    static public function wst_book_appointment_booked_response($data) {
        $f_name = strip_tags(_set($data, 'f_name'));
        $l_name = strip_tags(_set($data, 'l_name'));
        $contact = strip_tags(_set($data, 'contact'));
        $mail = strip_tags(_set($data, 'mail'));
        $date = _set($data, 'date');
        $slot = _set($data, 'slot');
        $location = _set($data, 'location');
        $service = _set($data, 'service');
        $worker = _set($data, 'worker');

        $errors = array();
        $msg = array(__('First Name', sahill), __('Last Name', sahill), __('Contact Number', sahill), __('Email ID', sahill));
        $check = array($f_name, $l_name, $contact, $mail);
        $counter = 0;
        foreach ($check as $c) {
            if (empty($c)) {
                $m = _set($msg, $counter);
                $errors[] = '<div class="alert alert-warning">' . __("Please Enter {$m}", sahill) . '</div>';
            }
            $counter++;
        }
        if (empty($errors)) {
            global $wpdb;
            $table_prefix = $wpdb->prefix . 'wst_';
            $table_name = $table_prefix . 'appointments';
            $wpdb->show_errors();
            $price = WST_DB_Setup::wst_get_column('services', 'price', $service);
            $result = $wpdb->insert($table_name, array('location' => $location, 'service' => $service, 'worker' => $worker, 'name' => $f_name . ' ' . $l_name, 'email' => $mail, 'phone' => $contact, 'date' => $date, 'slot' => $slot, 'status' => 'panding', 'price' => $price, 'ip' => self::wst_get_ip_address()), array('%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s'));
            if ($wpdb->last_error === '') {
                echo '<div class="alert alert-success">' . __('Successfully Appointment created', sahill) . '</div>';
            }
        } else {
            foreach ($errors as $e) {
                echo $e;
            }
        }
    }

    static public function wst_get_ip_address() {
        $clients = array(
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        );
        foreach ($clients as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $IPaddress) {
                    $IPaddress = trim($IPaddress); // Just to be safe
                    if (filter_var($IPaddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {

                        return $IPaddress;
                    }
                }
            }
        }
    }

}
