<?php
$get_data = WST_DB_Setup::wst_get_result(_set($data, 'type'), _set($data, 'id'), 'staff');
$data = _set($get_data, '0');
?>
<div class="appointment-table">
    <table class="wp-list-table widefat fixed">
        <thead>
            <tr class="head">
                <td><?php _e('Name:', sahill) ?></td>
                <td>
                    <input type="hidden" name="wst_staff_id" value="<?php echo _set($data, 'id') ?>" />
                    <input type="text" name="wst_staff_name" value="<?php echo _set($data, 'name') ?>" placeholder="<?php _e('Enter Name', sahill) ?>" />
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Description:', sahill) ?></td>
                <td><textarea name="wst_staff_desc" placeholder="<?php _e('Enter Description', sahill) ?>"><?php echo _set($data, 'description') ?></textarea></td>
            </tr>
            <tr class="head">
                <td><?php _e('Email:', sahill) ?></td>
                <td><input type="text" name="wst_staff_email" value="<?php echo _set($data, 'email') ?>" placeholder="<?php _e('Enter Email', sahill) ?>" /></td>
            </tr>
            <tr class="head">
                <td><?php _e('Contact No:', sahill) ?></td>
                <td><input type="text" id="wst_staff_contact" value="<?php echo _set($data, 'phone') ?>" name="wst_staff_contact" placeholder="<?php _e('Enter Contact No', sahill) ?>" /></td>
            </tr>
            <tr class="head">
                <td><?php _e('Country:', sahill) ?></td>
                <td>
                    <?php
                    $list = WST_Common_fun::wst_country_list();
                    if (!empty($list)) {
                        echo '<select class="location_country">';
                        foreach ($list as $k => $c) {
                            $select = (_set($data, 'country') == $k) ? 'selected="selected"' : '';
                            echo '<option ' . $select . ' value="' . $k . '">' . $c . '</option>';
                        }
                        echo '</select>';
                        ?>
                        <script type = "text/javascript">
                            jQuery(document).ready(function ($) {
                                $('.location_country').select2();
                            });
                        </script>
                    <?php } ?>
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Time:', sahill) ?></td>
                <td>
                    <?php
                    $start = WST_Common_fun::wst_hoursRange(32400, 64800, 900);
                    $end = WST_Common_fun::wst_hoursRange(32400, 64800, 900);
                    $interval = range(15, 1500, 15);
                    if (!empty($start)) {
                        echo '<select id="start_time">';
                        foreach ($start as $key => $val) {
                            $selected = (date("H:i", strtotime(strip_tags(_set($data, 'start_time')))) == $key ) ? 'selected="selected"' : '';
                            echo '<option ' . $selected . ' value="' . $key . '">' . $val . '</option>';
                        }
                        echo '</select>';
                    }
                    echo ' - ';
                    if (!empty($end)) {
                        echo '<select id="end_time">';
                        foreach ($end as $key => $val) {
                            $selected = (date("H:i", strtotime(strip_tags(_set($data, 'end_time')))) == $key ) ? 'selected="selected"' : '';
                            echo '<option ' . $selected . ' value="' . $key . '">' . $val . '</option>';
                        }
                        echo '</select>';
                    }
                    echo ' Interval: ';
                    if (!empty($interval)) {
                        echo '<select id="interval">';
                        foreach ($interval as $val) {
                            $selected = (_set($data, 'interval_time') == $val ) ? 'selected="selected"' : '';
                            echo '<option ' . $selected . ' value="' . $val . '">' . $val . '</option>';
                        }
                        echo '</select>';
                    }
                    echo __('Minutes', sahill);
                    ?>
                </td>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('#start_time, #end_time, #interval').select2();
            });
        </script>
        </tr>
        <tr class="head">
            <?php
            $img_path = '';
            if (_set($data, 'image') != 0) {
                $path = wp_get_attachment_image_src(_set($data, 'image'), 'thumbnail');
                $img_path = _set($path, '0');
            }
            if (!empty($img_path)) {
                $img_preview = '<img src="' . $img_path . '" data-id="' . _set($data, 'image') . '" />';
            } else {
                $img_preview = '';
            }
            ?>
            <td><?php _e('Image:', sahill) ?></td>
            <td>
                <div class="upload-btn">
                    <button class="btn light" id="wst_service_image" type="text" name="wst_service_image">
                        <i class="dashicons-wp-app-upload"></i>
                        <?php echo __('Upload Image', sahill) ?>
                    </button>
                </div>
                <div class="img-preview">
                    <div class="close">X</div>
                    <?php echo $img_preview; ?>
                </div>
            </td>
        </tr>
        <tr class="head">
            <td></td>
            <td>
                <div class="new-recors">
                    <div id="update_record" data-action="staff" class="btn red center"><i class="dashicons-wp-app-save"></i><?php _e('Update', sahill); ?></div>
                    <div id="pop_close_refress" data-action="staff" class="btn green center"><i class="dashicons-wp-app-cancle"></i><?php _e('Cancle', sahill); ?></div>
                </div>
            </td>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
