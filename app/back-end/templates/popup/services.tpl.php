<div class="appointment-table">
    <table class="wp-list-table widefat fixed">
        <thead>
            <tr class="head">
                <td><?php _e('Name:', sahill) ?></td>
                <td><input type="text" name="wst_service_name" placeholder="<?php _e('Enter Name', sahill) ?>" /></td>
            </tr>
            <tr class="head">
                <td><?php _e('Description:', sahill) ?></td>
                <td>
                    <textarea name="wst_service_desc"></textarea>
                </td>
            </tr>
            <tr class="head">
                <td><?php _e('Duration (min):', sahill) ?></td>
                <td><input id="wst_service_duration" type="text" name="wst_service_duration" placeholder="<?php _e('Enter Duration in minutes', sahill) ?>" /></td>
            </tr>
            <tr class="head">
                <td><?php _e('Price:', sahill) ?></td>
                <td><input id="wst_service_price" type="text" name="wst_service_price" placeholder="<?php _e('Enter Price', sahill) ?>" /></td>
            </tr>
            <tr class="head">
                <td><?php _e('Image:', sahill) ?></td>
                <td><div class="upload-btn"><button class="btn light" id="wst_service_image" type="text" name="wst_service_image"><i class="dashicons-wp-app-upload"></i><?php echo __('Upload Image', sahill) ?></button></div></td>
            </tr>
            <tr class="head">
                <td></td>
                <td>
                    <div class="new-recors">
                        <div id="save_record" data-action="services" class="btn red center"><i class="dashicons-wp-app-save"></i><?php _e('Save', sahill); ?></div>
                        <div id="pop_close" data-action="services" class="btn green center"><i class="dashicons-wp-app-cancle"></i><?php _e('Cancle', sahill); ?></div>
                    </div>
                </td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>