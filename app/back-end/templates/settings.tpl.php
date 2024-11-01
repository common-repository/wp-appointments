<div id="wp-appointment-overlap">
    <div class="loader"><?php _e('Loading...', sahill) ?></div>
</div>

<div id="modal">
    <div class="modal-head">
        <h2></h2>
        <a id="close">X</a>
    </div>
    <div class="modal-inner">
        <div id="response-message" style="display: none;"></div>
    </div>
</div>
<div class="wrap">
    <h2><?php echo '<i class="dashicons-wp-app-setting_modern"></i>' . __('Settings', sahill); ?></h2>
    <?php WST_Medias::wst_enq(array(PLUGIN_PREFIX . 'tabs', PLUGIN_PREFIX . 'select2', PLUGIN_PREFIX . 'moment', PLUGIN_PREFIX . 'date_picker', PLUGIN_PREFIX . 'jquery_date_picker')); ?>
    <section class="settings_tabs">
        <div class="tabs tabs-style-bar">
            <nav>
                <ul>
                    <li><a href="#section_locations" class="icon dashicons-wp-app-location"><span><?php _e('Locations', sahill) ?></span></a></li>
                    <li><a href="#section_services" class="icon dashicons-wp-app-service"><span><?php _e('Services', sahill) ?></span></a></li>
                    <li><a href="#section_staff" class="icon dashicons-wp-app-worker"><span><?php _e('Workers', sahill) ?></span></a></li>
                    <li><a href="#section_connections" class="icon dashicons-wp-app-connection"><span><?php _e('Linking', sahill) ?></span></a></li>
                    <li><a href="#options_settings" class="icon dashicons-wp-app-mailbox"><span><?php _e('EMail', sahill) ?></span></a></li>
                </ul>
            </nav>
            <div class="content-wrap">
                <section id="section_locations">
                    <div class="new-recors">
                        <div data-action="locations" class="add_new_ btn red center"><i class="dashicons-wp-app-plusicon"></i><?php _e('Add New Location', sahill); ?></div>
                        <div data-action="locations" class="btn_refresh btn green center"><i class="dashicons-wp-app-refresh"></i><?php _e('Refresh', sahill); ?></div>
                    </div>
                    <div class="appointment-table">
                        <table class="wp-list-table widefat fixed">
                            <thead>
                                <tr class="head">
                                    <th><?php _e('ID', sahill) ?></th>
                                    <th><?php _e('Name', sahill) ?></th>
                                    <th><?php _e('Address', sahill) ?></th>
                                    <th><?php _e('Country', sahill) ?></th>
                                    <th><?php _e('Location', sahill) ?></th>
                                    <th><?php _e('Image', sahill) ?></th>
                                    <th><?php _e('Action', sahill) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = WST_DB_Setup::wst_get_result('locations', '', 'locations');
                                if (!empty($data)) {
                                    $list = WST_Common_fun::wst_country_list();
                                    foreach ($data as $row) {
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
                                } else {
                                    echo '<tr><td colspan="7" class="no-record"><strong>' . __('No Record Found', sahill) . '</strong></td></tr>';
                                }
                                ?>

                            </tbody>
                            <thead>
                                <tr class="head">
                                    <th><?php _e('ID', sahill) ?></th>
                                    <th><?php _e('Name', sahill) ?></th>
                                    <th><?php _e('Address', sahill) ?></th>
                                    <th><?php _e('Country', sahill) ?></th>
                                    <th><?php _e('Location', sahill) ?></th>
                                    <th><?php _e('Image', sahill) ?></th>
                                    <th><?php _e('Action', sahill) ?></th>
                                </tr>
                            </thead>
                        </table>
                        <?php
                        $user = get_current_user_id();
                        $screen = get_current_screen();
                        $pagenum = isset($_GET['location-paged']) ? (int) $_GET['location-paged'] : 1;
                        $screen_option = $screen->get_option('wst_per_page', 'option');
                        $per_page = get_user_meta($user, $screen_option, true);
                        $get_per_page = _set($per_page, 'wst_per_page');
                        $limit = (_set($get_per_page, '0') != '') ? _set($get_per_page, '0') : 10;
                        $total = WST_DB_Setup::wst_get_row_count('locations');
                        $num_of_pages = ceil($total / $limit);
                        $page_links = paginate_links(array(
                            'base' => add_query_arg('&section=locations&location-paged', '%#%'),
                            'format' => '',
                            'prev_text' => __('&laquo;', 'aag'),
                            'next_text' => __('&raquo;', 'aag'),
                            'total' => $num_of_pages,
                            'current' => $pagenum
                        ));

                        if ($page_links) {
                            echo '<div class="tablenav"><div class="tablenav-pages" >' . $page_links . '</div></div>';
                        }
                        ?>
                    </div>
                </section>
                <section id="section_services">
                    <div class="new-recors">
                        <div data-action="services" class="add_new_ btn red center"><i class="dashicons-wp-app-plusicon"></i><?php _e('Add New Service', sahill); ?></div>
                        <div data-action="services" class="btn_refresh btn green center"><i class="dashicons-wp-app-refresh"></i><?php _e('Refresh', sahill); ?></div>
                    </div>
                    <div class="appointment-table">
                        <table class="wp-list-table widefat fixed">
                            <thead>
                                <tr class="head">
                                    <th><?php _e('ID', sahill) ?></th>
                                    <th><?php _e('Name', sahill) ?></th>
                                    <th><?php _e('Description', sahill) ?></th>
                                    <th><?php _e('Image', sahill) ?></th>
                                    <th><?php _e('Duration(min)', sahill) ?></th>
                                    <th><?php _e('Price', sahill) ?></th>
                                    <th><?php _e('Action', sahill) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = WST_DB_Setup::wst_get_result('services', '', 'services');
                                if (!empty($data)) {
                                    $list = WST_Common_fun::wst_country_list();
                                    foreach ($data as $row) {
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
                                } else {
                                    echo '<tr><td colspan="7" class="no-record"><strong>' . __('No Record Found', sahill) . '</strong></td></tr>';
                                }
                                ?>
                            </tbody>
                            <thead>
                                <tr class="head">
                                    <th><?php _e('ID', sahill) ?></th>
                                    <th><?php _e('Name', sahill) ?></th>
                                    <th><?php _e('Description', sahill) ?></th>
                                    <th><?php _e('Image', sahill) ?></th>
                                    <th><?php _e('Duration(min)', sahill) ?></th>
                                    <th><?php _e('Price', sahill) ?></th>
                                    <th><?php _e('Action', sahill) ?></th>
                                </tr>
                            </thead>
                        </table>
                        <?php
                        $user = get_current_user_id();
                        $screen = get_current_screen();
                        $pagenum = isset($_GET['services-paged']) ? (int) $_GET['services-paged'] : 1;
                        $screen_option = $screen->get_option('wst_per_page', 'option');
                        $per_page = get_user_meta($user, $screen_option, true);
                        $get_per_page = _set($per_page, 'wst_per_page');
                        $limit = (_set($get_per_page, '0') != '') ? _set($get_per_page, '0') : 10;
                        $total = WST_DB_Setup::wst_get_row_count('services');
                        $num_of_pages = ceil($total / $limit);
                        $page_links = paginate_links(array(
                            'base' => add_query_arg('&section=services&services-paged', '%#%'),
                            'format' => '',
                            'prev_text' => __('&laquo;', 'aag'),
                            'next_text' => __('&raquo;', 'aag'),
                            'total' => $num_of_pages,
                            'current' => $pagenum
                        ));

                        if ($page_links) {
                            echo '<div class="tablenav"><div class="tablenav-pages" >' . $page_links . '</div></div>';
                        }
                        ?>
                    </div>
                </section>
                <section id="section_staff">
                    <div class="new-recors">
                        <div data-action="staff" class="add_new_ btn red center"><i class="dashicons-wp-app-plusicon"></i><?php _e('Add New Worker', sahill); ?></div>
                        <div data-action="staff" class="btn_refresh btn green center"><i class="dashicons-wp-app-refresh"></i><?php _e('Refresh', sahill); ?></div>
                    </div>
                    <div class="appointment-table">
                        <table class="wp-list-table widefat fixed">
                            <thead>
                                <tr class="head">
                                    <th><?php _e('ID', sahill) ?></th>
                                    <th><?php _e('Name', sahill) ?></th>
                                    <th><?php _e('Description', sahill) ?></th>
                                    <th><?php _e('Email', sahill) ?></th>
                                    <th><?php _e('Contact No', sahill) ?></th>
                                    <th><?php _e('Country', sahill) ?></th>
                                    <th><?php _e('Time', sahill) ?></th>
                                    <th><?php _e('Image', sahill) ?></th>
                                    <th><?php _e('Action', sahill) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = WST_DB_Setup::wst_get_result('staff', '', 'staff');
                                if (!empty($data)) {
                                    $list = WST_Common_fun::wst_country_list();
                                    foreach ($data as $row) {
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
                                        echo '<td>' . "<p class = 'label-up'>" . __('Starts at :', sahill) . "</p>" . date("h:i A", strtotime(_set($row, 'start_time'))) . "<p class = 'label-up'>" . __('Ends at :', sahill) . "</p>" . date("h:i A", strtotime(_set($row, 'end_time'))) . '</td>';
                                        echo '<td> ' . $img_preview . ' </td>';
                                        echo '<td>
                                        <div id = "edit_record" data-id = "' . _set($row, 'id') . '" data-action = "staff" class = "edit_record btn dark center"><i class = "dashicons-wp-app-edit"></i>' . __('Edit', sahill) . '</div>
                                        <div id = "delete_record" data-id = "' . _set($row, 'id') . '" data-action = "staff" class = "delete_record btn light center"><i class = "dashicons-wp-app-delete"></i>' . __('Delete', sahill) . '</div>
                                        </td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan = "9" class = "no-record"><strong>' . __('No Record Found', sahill) . '</strong></td></tr>';
                                }
                                ?>
                            </tbody>
                            <thead>
                                <tr class="head">
                                    <th><?php _e('ID', sahill) ?></th>
                                    <th><?php _e('Name', sahill) ?></th>
                                    <th><?php _e('Description', sahill) ?></th>
                                    <th><?php _e('Email', sahill) ?></th>
                                    <th><?php _e('Contact No', sahill) ?></th>
                                    <th><?php _e('Country', sahill) ?></th>
                                    <th><?php _e('Time', sahill) ?></th>
                                    <th><?php _e('Image', sahill) ?></th>
                                    <th><?php _e('Action', sahill) ?></th>
                                </tr>
                            </thead>
                        </table>
                        <?php
                        $user = get_current_user_id();
                        $screen = get_current_screen();
                        $pagenum = isset($_GET['staff-paged']) ? (int) $_GET['staff-paged'] : 1;
                        $screen_option = $screen->get_option('wst_per_page', 'option');
                        $per_page = get_user_meta($user, $screen_option, true);
                        $get_per_page = _set($per_page, 'wst_per_page');
                        $limit = (_set($get_per_page, '0') != '') ? _set($get_per_page, '0') : 10;
                        $total = WST_DB_Setup::wst_get_row_count('staff');
                        $num_of_pages = ceil($total / $limit);
                        $page_links = paginate_links(array(
                            'base' => add_query_arg('&section = staff&services-paged', '%#%'),
                            'format' => '',
                            'prev_text' => __('&laquo;', 'aag'),
                            'next_text' => __('&raquo;', 'aag'),
                            'total' => $num_of_pages,
                            'current' => $pagenum
                        ));

                        if ($page_links) {
                            echo '<div class="tablenav"><div class="tablenav-pages" >' . $page_links . '</div></div>';
                        }
                        ?>
                    </div>
                </section>
                <section id="section_connections">
                    <div class="new-recors">
                        <div data-action="connections" class="add_new_ btn red center"><i class="dashicons-wp-app-plusicon"></i><?php _e('Add New Connection', sahill); ?></div>
                        <div data-action="connections" class="btn_refresh btn green center"><i class="dashicons-wp-app-refresh"></i><?php _e('Refresh', sahill); ?></div>
                    </div>
                    <div class="appointment-table">
                        <table class="wp-list-table widefat fixed">
                            <thead>
                                <tr class="head">
                                    <th><?php _e('ID', sahill) ?></th>
                                    <th><?php _e('Location / Worker / Services', sahill) ?></th>
                                    <th><?php _e('Days of week', sahill) ?></th>
                                    <th><?php _e('Date', sahill) ?></th>
                                    <th><?php _e('Action', sahill) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = WST_DB_Setup::wst_get_result('connections', '', 'connections');
                                if (!empty($data)) {
                                    foreach ($data as $row) {
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
                                            echo "<div class='btn blue center'><i class = 'dashicons-wp-app-setting_modern'></i>" . __('All Services', sahill) . "</div></td>";
                                        } else {
                                            echo "<div data-action='conn_service' data-array = '" . _set($row, 'service') . "' class='btn_con_service btn blue center'><i class = 'dashicons-wp-app-setting_modern'></i>" . __('Services', sahill) . "</div></td>";
                                        }
                                        echo '<td><strong>';
                                        if (_set($row, 'week_of_days')) {
                                            $days = explode(',', _set($row, 'week_of_days'));
                                            foreach ($days as $d) {
                                                echo '<span>' . ucfirst($d) . '</span><br>';
                                            }
                                        }
                                        echo '</strong></td>';
                                        echo '<td>' . "<p class = 'label-up'>" . __('Active From :', sahill) . "</p>" . date("d M Y", strtotime(_set($row, 'date_start'))) . "<p class = 'label-up'>" . __('To :', sahill) . "</p>" . date("d M Y", strtotime(_set($row, 'date_end'))) . '</td>';
                                        echo '<td>
                                        <div id="edit_record" data-id="' . _set($row, 'id') . '" data-action="connections" class="edit_record btn dark center"><i class = "dashicons-wp-app-edit"></i>' . __('Edit', sahill) . '</div>
                                        <div id="delete_record" data-id="' . _set($row, 'id') . '" data-action="connections" class="delete_record btn light center"><i class = "dashicons-wp-app-delete"></i>' . __('Delete', sahill) . '</div>
                                        </td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan = "5" class = "no-record"><strong>' . __('No Record Found', sahill) . '</strong></td></tr>';
                                }
                                ?>
                            </tbody>
                            <thead>
                                <tr class="head">
                                    <th><?php _e('ID', sahill) ?></th>
                                    <th><?php _e('Location / Worker / Services', sahill) ?></th>
                                    <th><?php _e('Days of week', sahill) ?></th>
                                    <th><?php _e('Date', sahill) ?></th>
                                    <th><?php _e('Action', sahill) ?></th>
                                </tr>
                            </thead>
                        </table>
                        <?php
                        $user = get_current_user_id();
                        $screen = get_current_screen();
                        $pagenum = isset($_GET['conn-paged']) ? (int) $_GET['conn-paged'] : 1;
                        $screen_option = $screen->get_option('wst_per_page', 'option');
                        $per_page = get_user_meta($user, $screen_option, true);
                        $get_per_page = _set($per_page, 'wst_per_page');
                        $limit = (_set($get_per_page, '0') != '') ? _set($get_per_page, '0') : 10;
                        $total = WST_DB_Setup::wst_get_row_count('connections');
                        $num_of_pages = ceil($total / $limit);
                        $page_links = paginate_links(array(
                            'base' => add_query_arg('&section = connections&conn-paged', '%#%'),
                            'format' => '',
                            'prev_text' => __('&laquo;', 'aag'),
                            'next_text' => __('&raquo;', 'aag'),
                            'total' => $num_of_pages,
                            'current' => $pagenum
                        ));

                        if ($page_links) {
                            echo '<div class="tablenav"><div class="tablenav-pages" >' . $page_links . '</div></div>';
                        }
                        ?>
                    </div>
                </section>
                <section id="options_settings">
                    <?php
                    global $wp_version;
                    add_filter('mce_external_plugins', array('WST_Panel_options', 'wst_tinymce_plugins'));
                    add_filter('mce_buttons', array('WST_Panel_options', 'wst_tinymce_buttons'));
                    add_filter('tiny_mce_before_init', array('WST_Panel_options', 'wst_tinymce_config'));
                    ob_start();
                    require WST_ROOT . 'app/back-end/templates/tpl-email.php';
                    $tpl_file = ob_get_contents();
                    ob_end_clean();
                    //$get_tpl = WST_DB_Setup::wst_get_column_by_name('options', 'wst_value', 'wst_key', 'wst_email_opt');
                    $template_opt = get_option('wst_email_opt');
                    //pr($template_opt);
                    $template = (get_option('wst_email_opt') === false) ? $tpl_file : _set($template_opt, 'template');
                    //$template = (!empty($get_tpl))?$get_tpl:$tpl_file;
                    ?>
                    <h3><?php _e('Sender Options', sahill); ?></h3>
                    <p style="margin-bottom: 0;
                       ">
                           <?php _e('Set your own sender name and email address. Default WordPress values will be used if empty.', sahill); ?>
                    </p>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <label for="wst_from_name"><?php _e('Name :', sahill); ?></label>
                            </th>
                            <td>
                                <input type="text" id="wst_from_name" class="regular-text" value="<?php echo esc_attr(_set($template_opt, 'from_name'))
                           ?>" name="wst_from_name"/>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                <label for="wst_from_email"><?php _e('Email Address:', sahill); ?></label>
                            </th>
                            <td>
                                <input type="text" id="wst_from_email" class="regular-text" value="<?php echo esc_attr(_set($template_opt, 'from_email')) ?>" name="wst_from_email" />
                            </td>
                        </tr>
                    </table>
                    <h3 class="wst_title"><?php _e('HTML Template', sahill); ?>
                        <?php if (version_compare($wp_version, '3.1', '>')): ?>
                            <a class="button" title="<?php esc_attr_e('Live Template Preview', sahill); ?>" id="wst_preview_template" href="<?php echo WST_URI . 'preview.html?keepThis=true&TB_iframe=true&height=400&width=700'; ?>"><?php _e('Live preview', sahill); ?></a>
                        <?php endif; ?>
                    </h3>
                    <p><?php _e('Edit the HTML template if you want to customize it. You might have a look at the <a href="#" class="wst_help">help tab</a> for further information.', sahill); ?></p>
                    <div id="wst_template_container">
                        <?php
                        $settings = array(
                            'wpautop' => false,
                            'editor_class' => 'wst_template',
                            'quicktags' => false,
                            'textarea_name' => 'wst_mail_template'
                        );
                        //pr($template);
                        wp_editor($template, 'wst_template', $settings);
                        ?>
                    </div>

                    <!-- Preview -->
                    <h3 class="wst_title"><?php _e('Preview', sahill); ?></h3>
                    <div id="wst_preview_message"></div>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">
                                <label for="wst_email_preview_field"><?php _e('Send an email preview to', sahill); ?></label>
                            </th>
                            <td>
                                <input type="text" id="wst_email_preview_field" name="wst_preview_email" class="regular-text" value="<?php esc_attr_e(get_option('admin_email')); ?>" />
                                <a href="javascript:void(0);" class="button" id="wst_send_preview"><?php _e('Send', sahill); ?></a>
                                <span id="wst_loading"></span>
                                <img src="<?php echo admin_url('images/wpspin_light.gif'); ?>" id="wst_ajax_loading" style="visibility: hidden;" alt="Loading" />
                                <br />
                                <span class="description"><?php _e('You must save your template before sending an email preview.', sahill); ?></span>
                            </td>
                        </tr>
                    </table>
                    <p class="submit">
                    <div data-action="email" class="wst_save_options btn red center"><i class="dashicons-wp-app-save"></i><?php _e('Save Changes', sahill); ?></div>
                    </p>
                </section>
            </div><!-- /content -->
        </div><!-- /tabs -->
    </section>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            (function () {
                [].slice.call(document.querySelectorAll('.tabs')).forEach(function (el) {
                    new CBPFWTabs(el);
                });
            })();
        });
    </script>
</div>
