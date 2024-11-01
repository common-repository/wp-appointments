<?php
$get_data = WST_DB_Setup::wst_get_result(_set($data, 'type'), _set($data, 'id'), 'services');
$data = _set($get_data, '0');
?>
<div class="appointment-table">
    <table class="wp-list-table widefat fixed">
        <thead>
            <tr class="head">
                <td><?php _e('Name:', sahill) ?></td>
                <td>
                    <input type="hidden" name="wst_service_id" value="<?php echo _set($data, 'id') ?>" />
                    <input type="text" name="wst_service_name" value="<?php echo _set($data, 'name') ?>" placeholder="<?php _e('Enter Name', sahill) ?>" />
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Description:', sahill) ?></td>
                <td>
                    <textarea name="wst_service_desc"><?php echo _set($data, 'description') ?></textarea>
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Duration (min):', sahill) ?></td>
                <td><input id="wst_service_duration" type="text" value="<?php echo _set($data, 'duration') ?>" name="wst_service_duration" placeholder="<?php _e('Enter Duration in minutes', sahill) ?>" /></td>
            </tr>
            <tr class="head">
                <td><?php _e('Price:', sahill) ?></td>
                <td><input id="wst_service_price" type="text" value="<?php echo _set($data, 'price') ?>" name="wst_service_price" placeholder="<?php _e('Enter Price', sahill) ?>" /></td>
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
                        <div id="update_record" data-action="services" class="btn red center"><i class="dashicons-wp-app-save"></i><?php _e('Update', sahill); ?></div>
                        <div id="pop_close_refress" data-action="services" class="btn green center"><i class="dashicons-wp-app-cancle"></i><?php _e('Cancle', sahill); ?></div>
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>