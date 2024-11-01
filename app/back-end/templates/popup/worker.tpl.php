<div class="appointment-table">
    <table class="wp-list-table widefat fixed">
        <thead>
            <tr class="head">
                <td><?php _e('Name:', sahill) ?></td>
                <td><input type="text" name="wst_location_name" placeholder="<?php _e('Enter Name', sahill) ?>" /></td>
            </tr>
            <tr class="head">
                <td><?php _e('Address:', sahill) ?></td>
                <td><textarea name="wst_location_address" placeholder="<?php _e('Enter Address', sahill) ?>" /></textarea></td>
            </tr>
            <tr class="head">
                <td><?php _e('Country:', sahill) ?></td>
                <td>
                    <?php
                    $list = WST_Common_fun::wst_country_list();
                    if (!empty($list)) {
                        echo '<select class="location_country">';
                        foreach ($list as $k => $c) {
                            echo '<option value="' . $k . '">' . $c . '</option>';
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
                <td><input type="text" name="wst_location_location" placeholder="<?php _e('Enter Location', sahill) ?>" /></td>
            </tr>
            <tr class="head">
                <td></td>
                <td>
        <div class="new-recors">
            <div id="save_record" data-action="locations" class="btn red center"><i class="dashicons-wp-app-save"></i><?php _e('Save', sahill); ?></div>
            <div id="pop_close" data-action="locations" class="btn green center"><i class="dashicons-wp-app-cancle"></i><?php _e('Cancle', sahill); ?></div>
        </div>
        </td>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>