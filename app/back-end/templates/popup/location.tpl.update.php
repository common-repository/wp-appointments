<?php
$get_data = WST_DB_Setup::wst_get_result(_set($data, 'type'), _set($data, 'id'), 'locations');
$data = _set($get_data, '0');
?>
<div class="appointment-table">
    <table class="wp-list-table widefat fixed">
        <thead>
            <tr class="head">
                <td><?php _e('Name:', sahill) ?></td>
                <td>
                    <input type="hidden" name="wst_location_id" value="<?php echo _set($data, 'id') ?>" />
                    <input type="text" name="wst_location_name" value="<?php echo _set($data, 'name') ?>" placeholder="<?php _e('Enter Name', sahill) ?>" />
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Address:', sahill) ?></td>
                <td><textarea name="wst_location_address" placeholder="<?php _e('Enter Address', sahill) ?>"><?php echo _set($data, 'address') ?></textarea></td>
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
                <td><?php _e('Location:', sahill) ?></td>
                <td><input type="text" name="wst_location_location" value="<?php echo _set($data, 'location') ?>" placeholder="<?php _e('Enter Location', sahill) ?>" /></td>
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
                        <div id="update_record" data-action="locations" class="btn red center"><i class="dashicons-wp-app-save"></i><?php _e('Update', sahill); ?></div>
                        <div id="pop_close_refress" data-action="locations" class="btn green center"><i class="dashicons-wp-app-cancle"></i><?php _e('Cancle', sahill); ?></div>
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>