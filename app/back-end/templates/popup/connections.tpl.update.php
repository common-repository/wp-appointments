<?php
$services_count = WST_DB_Setup::wst_get_row_count('services');
$location_count = WST_DB_Setup::wst_get_row_count('locations');
$staff_count = WST_DB_Setup::wst_get_row_count('staff');
if ($services_count > 0) {
    $get_services = WST_DB_Setup::wst_table_data('services');
}
if ($location_count > 0) {
    $get_location = WST_DB_Setup::wst_table_data('locations');
}
if ($staff_count > 0) {
    $get_staff = WST_DB_Setup::wst_table_data('staff');
}
$get_data = WST_DB_Setup::wst_get_result(_set($data, 'type'), _set($data, 'id'), 'connections');
$data = _set($get_data, '0');
?>
<div class="appointment-table">
    <table class="wp-list-table widefat fixed">
        <thead>
            <tr class="head">
                <td><?php _e('Location:', sahill) ?></td>
                <td>
                    <input type="hidden" name="wst_connection_id" value="<?php echo _set($data, 'id') ?>" />
                    <?php
                    $weeks = WST_Common_fun::wst_weekdays();
                    if (isset($get_location) && !empty($get_location)) {
                        echo '<select id="locations">';
                        foreach ($get_location as $l) {
                            $selected = (_set($data, 'location') == _set($l, 'id') ) ? 'selected="selected"' : '';
                            echo '<option ' . $selected . ' value="' . _set($l, 'id') . '">' . _set($l, 'name') . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Worker:', sahill) ?></td>
                <td>
                    <?php
                    $weeks = WST_Common_fun::wst_weekdays();
                    if (isset($get_staff) && !empty($get_staff)) {
                        $all_workers = explode(',', _set($data, 'worker'));
                        
                        echo '<select id="workers" name="workers[]" multiple>';
                        foreach ($get_staff as $s) {
                            $selected = (in_array(_set($s, 'id'), $all_workers)) ? 'selected="selected"' : '';
                            echo '<option ' . $selected . ' value="' . _set($s, 'id') . '">' . _set($s, 'name') . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Services:', sahill) ?></td>
                <td>
                    <?php
                    $checkd = (_set($data, 'service') == 'all') ? 'checked="checked"' : "";
                    $display = (_set($data, 'service') == 'all') ? 'style="display: none"' : "";
                    ?>
                    <input type="checkbox" id="wst_con_all_services" <?php echo $checkd ?> name="wst_con_all_services" value="all"><?php _e('All', sahill) ?>
                    <div class="all_services" <?php echo $display ?>>
                        <?php
                        if (isset($get_services) && !empty($get_services)) {
                            echo '<select name="services[]" id="services" multiple>';
                            foreach ($get_services as $s) {
                                $all_services = explode(',', _set($data, 'service'));
                                $selected = (in_array(_set($s, 'id'), $all_services)) ? 'selected="selected"' : '';
                                echo '<option ' . $selected . '  value="' . _set($s, 'id') . '">' . _set($s, 'name') . '</option>';
                            }
                            echo '</select>';
                        }
                        ?>
                    </div> 
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Date:', sahill) ?></td>
                <td>
                    <?php _e('Start: ') ?><input type="text" name="start_date" class="small" id="start_date" value="<?php echo date("d M Y", strtotime(strip_tags(_set($data, 'date_start')))) ?>" />
                    <?php _e('End: ') ?><input type="text" name="end_date" class="small" id="end_date" value="<?php echo date("d M Y", strtotime(strip_tags(_set($data, 'date_end')))) ?>" />
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Weekdays:', sahill) ?></td>
                <td>
                    <?php
                    $weeks = WST_Common_fun::wst_weekdays();
                    if (!empty($weeks)) {
                        echo '<select name="weeks[]" id="weeks" multiple>';
                        foreach ($weeks as $key => $val) {
                            $selected = (in_array($key, explode(',', _set($data, 'week_of_days')))) ? 'selected="selected"' : '';
                            echo '<option ' . $selected . ' value="' . $key . '">' . $val . '</option>';
                        }
                        echo '</select>';
                    }
                    ?>
                </td>
            </tr>
            <tr class="head">
                <td></td>
                <td>
                    <div class="new-recors">
                        <div id="update_record" data-action="connections" class="btn red center"><i class="dashicons-wp-app-save"></i><?php _e('Save', sahill); ?></div>
                        <div id="pop_close_refress" data-action="connections" class="btn green center"><i class="dashicons-wp-app-cancle"></i><?php _e('Cancle', sahill); ?></div>
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#services, #locations, #workers, #start_time, #end_time, #interval, #weeks').select2();
            (function () {
                var startDate,
                        endDate,
                        updateStartDate = function () {
                            startPicker.setStartRange(startDate);
                            endPicker.setStartRange(startDate);
                            endPicker.setMinDate(startDate);
                        },
                        updateEndDate = function () {
                            startPicker.setEndRange(endDate);
                            startPicker.setMaxDate(endDate);
                            endPicker.setEndRange(endDate);
                        },
                        startPicker = new Pikaday({
                            field: document.getElementById('start_date'),
                            minDate: new Date(),
                            maxDate: new Date(2020, 12, 31),
                            format: 'D MMM YYYY',
                            onSelect: function () {
                                startDate = this.getDate();
                                var date = document.createTextNode(this.getMoment().format('Do MMMM YYYY') + ' ');
                                updateStartDate();
                            }
                        }),
                        endPicker = new Pikaday({
                            field: document.getElementById('end_date'),
                            minDate: new Date(),
                            maxDate: new Date(2020, 12, 31),
                            format: 'D MMM YYYY',
                            onSelect: function () {
                                endDate = this.getDate();
                                var date = document.createTextNode(this.getMoment().format('Do MMMM YYYY') + ' ');
                                updateEndDate();
                            }
                        }),
                        _startDate = startPicker.getDate(),
                        _endDate = endPicker.getDate();

                if (_startDate) {
                    startDate = _startDate;
                    updateStartDate();
                }

                if (_endDate) {
                    endDate = _endDate;
                    updateEndDate();
                }
            })();
        });
    </script>
</div>
