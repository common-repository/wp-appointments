<div id="wp-appointment-overlap">
    <div class="loader"><?php _e('Loading...', sahill) ?></div>
</div>

<div id="modal">
    <div class="head">
        <h2><?php _e('Add New Appointment', sahill) ?></h2>
        <a id="close">X</a>
    </div>
</div>
<div class="wrap">
    <h2><?php echo '<i class="dashicons-wp-app-appointments"></i>' . __('Appointments', sahill); ?></h2>

    <?php WST_Medias::wst_enq(array(PLUGIN_PREFIX . 'select2')); ?>
<!--    <table class="search-filter">
        <tbody>
            <tr>
                <td>
                    <label for="wp-app-location"><strong><?php _e('Location: ', sahill); ?></strong></label>
                </td>
                <td>
                    <select id="wp-app-location">
                        <option>-</option>
                    </select>
                </td>

                <td>
                    <label for="wp-app-service"><strong><?php _e('Service: ', sahill); ?></strong></label>
                </td>
                <td>
                    <select id="wp-app-service">
                        <option>-</option>
                    </select>
                </td>
                <td>
                    <label for="wp-app-from-date"><strong><?php _e('From: ', sahill); ?></strong></label>
                </td>
                <td>
                    <input id="wp-app-from-date" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="wp-app-worker"><strong><?php _e('Worker: ', sahill); ?></strong></label>
                </td>
                <td>
                    <select id="wp-app-worker">
                        <option>-</option>
                    </select>
                </td>

                <td>
                    <label for="wp-app-status"><strong><?php _e('Status: ', sahill); ?></strong></label>
                </td>
                <td>
                    <select id="wp-app-status">
                        <option>-</option>
                    </select>
                </td>
                <td>
                    <label for="wp-app-to-date"><strong><?php _e('To: ', sahill); ?></strong></label>
                </td>
                <td>
                    <input id="wp-app-to-date" type="text">
                </td>
            </tr>
            <tr>
                <td class="content-center" colspan="6">
                    <div class="edit_record btn dark " data-action="appointment" data-id="6" id="edit_record"><?php _e('Filter', sahill) ?></div>
                </td>
            </tr>
        </tbody>
    </table>-->
    <!--    <div class="new-recors">
            <div id="add_new_" data-action="appointment" class="btn red center"><i class="dashicons-wp-app-plusicon"></i><?php _e('Add New Appointment', sahill); ?></div>
            <div id="btn_refresh" data-action="appointment" class="btn green center"><i class="dashicons-wp-app-refresh"></i><?php _e('Refresh', sahill); ?></div>
        </div>-->
    <div class="appointment-table">
        <table class="wp-list-table widefat fixed">
            <thead>
                <tr class="head">
                    <th><?php _e('Location / Service / Worker', sahill) ?></th>
                    <th><?php _e('Customer', sahill) ?></th>
                    <th><?php _e('Date & time', sahill) ?></th>
                    <th><?php _e('Contact No', sahill) ?></th>
<!--                    <th><?php _e('Status', sahill) ?></th>-->
                    <th><?php _e('Price', sahill) ?></th>
<!--                    <th><?php _e('Action', sahill) ?></th>-->
                </tr>
            </thead>
            <tbody>
                <?php
                $data = WST_DB_Setup::wst_get_result('appointments', '', 'appointments');
                //pr($data);
                if (!empty($data)) {
                    foreach ($data as $row) {
                        echo '<tr class="head">';
                        echo '<td><p><strong>' . WST_DB_Setup::wst_get_column('locations', 'name', _set($row, 'location')) . '</strong></p><p><strong>' . WST_DB_Setup::wst_get_column('services', 'name', _set($row, 'service')) . '</strong></p><p><strong>' . WST_DB_Setup::wst_get_column('staff', 'name', _set($row, 'worker')) . '</strong></p></td>';
                        echo '<td>' . _set($row, 'email') . ' </td>';
                        echo '<td><p><strong>' . _set($row, 'date') . '</strong></p><p><strong>' . _set($row, 'slot') . '</strong></p></td>';
                        echo '<td>' . _set($row, 'phone') . ' </td>';
//                        echo '<td>' . ucfirst(_set($row, 'status')) . ' </td>';
                        echo '<td>' . _set($row, 'price') . ' </td>';
//                        echo '<td>
//                                <div id="edit_record" data-id="' . _set($row, 'id') . '" data-action="appointment" class="edit_record btn dark center"><i class="dashicons-wp-app-edit"></i>' . __('Edit', sahill) . '</div>
//                             </td>';
        echo '</tr>';
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5" class="no-record"><strong><?php _e('No Record Found', sahill) ?></strong></td>
                    </tr>
                <?php } ?>
            </tbody>
            <thead>
                <tr class="head">
                    <th><?php _e('Location / Service / Worker', sahill) ?></th>
                    <th><?php _e('Customer', sahill) ?></th>
                    <th><?php _e('Date & time', sahill) ?></th>
                    <th><?php _e('Contact No', sahill) ?></th>
<!--                    <th><?php _e('Status', sahill) ?></th>-->
                    <th><?php _e('Price', sahill) ?></th>
<!--                    <th><?php _e('Action', sahill) ?></th>-->
                </tr>
            </thead>
        </table>
        <?php
        $user = get_current_user_id();
        $screen = get_current_screen();
        $pagenum = isset($_GET['paged']) ? (int) $_GET['paged'] : 1;
        $screen_option = $screen->get_option('wst_per_page', 'option');
        $per_page = get_user_meta($user, $screen_option, true);
        $get_per_page = _set($per_page, 'wst_per_page');
        $limit = (_set($get_per_page, '0') != '') ? _set($get_per_page, '0') : 10;
        $total = WST_DB_Setup::wst_get_row_count('appointments');
        $num_of_pages = ceil($total / $limit);
        $page_links = paginate_links(array(
            'base' => add_query_arg('&paged', '%#%'),
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
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('table.search-filter select').select2();
        });
    </script>
</div>
