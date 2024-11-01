<div class="appointment-table">
    <table class="wp-list-table widefat fixed">
        <?php
        $counter = 0;
        if (_set($data, 'data_array') != '') {
            $con_ser = explode(',', _set($data, 'data_array'));
            foreach ($con_ser as $s) {
                if (0 == $counter) {
                    echo '<tr>';
                }
                $get_services = WST_DB_Setup::wst_get_table_data('services', 'name', $s);
                echo '<td><strong>' . ucfirst($get_services) . '</strong></td>';
                $counter++;
                if (2 == $counter) {
                    echo '</tr>';
                    $counter = 0;
                }
            }
        }
        ?>
        <tr class="head">
            <td colspan="2">
                <div class="new-recors center">
                    <div id="pop_close" data-action="locations" class="btn green"><i class="dashicons-wp-app-cancle"></i><?php _e('Cancle', sahill); ?></div>
                </div>
            </td>
        </tr>
    </table>
</div>
