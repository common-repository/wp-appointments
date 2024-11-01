(function ($) {
    jQuery(document).ready(function ($) {

// add new record popup
        $('.add_new_').on('click', function () {
            jQuery('.modal-head > h2').html(location_add_new);
            var type = $(this).data('action');
            var data = 'type=' + type + '&action=wst_add_new_location';
            jQuery.ajax({
                type: "post",
                url: ajax_url,
                data: data,
                beforeSend: function () {
                    jQuery('#wp-appointment-overlap').fadeIn('slow');
                    jQuery('#wp-appointment-overlap .loader').fadeIn('slow');
                },
                success: function (response) {
                    jQuery('#wp-appointment-overlap .loader').fadeOut('slow');
                    jQuery('#modal').fadeIn('slow');
                    jQuery('#modal div#response-message').nextAll().remove();
                    jQuery(response).insertAfter('#modal div#response-message');
                }

            });
            return false;
        });
        // add new record popup
        $('.wst_save_options').live('click', function () {
            var type = $(this).data('action');
            var sender_name = $('input#wst_from_name').val();
            var sender_email = $('input#wst_from_email').val();
            var template;
            if (typeof (tinyMCE) != 'undefined') {
                if (tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden())
                    template = tinyMCE.activeEditor.getContent();
                else
                    template = $('.wpbe_template').val();
            }
            var data = 'sender_name=' + sender_name + '&sender_email=' + sender_email + '&template=' + encodeURIComponent(template) + '&type=' + type + '&action=wst_save_options';
            jQuery.ajax({
                type: "post",
                url: ajax_url,
                data: data,
                contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
                dataType: 'json',
                beforeSend: function () {
                    jQuery('#wp-appointment-overlap').fadeIn('slow');
                    jQuery('#wp-appointment-overlap .loader').fadeIn('slow');
                },
                success: function (response) {
                    jQuery('#wp-appointment-overlap .loader').fadeOut('slow');
                    jQuery('#wp-appointment-overlap').fadeOut('slow');
                }

            });
            return false;
        });
        $('.btn_con_service').on('click', function () {
            jQuery('.modal-head > h2').html(conn_all_services);
            var type = $(this).data('action');
            var data_array = $(this).data('array');
            var data = 'type=' + type + '&data_array=' + data_array + '&action=wst_add_new_location';
            jQuery.ajax({
                type: "post",
                url: ajax_url,
                data: data,
                beforeSend: function () {
                    jQuery('#wp-appointment-overlap').fadeIn('slow');
                    jQuery('#wp-appointment-overlap .loader').fadeIn('slow');
                },
                success: function (response) {
                    jQuery('#wp-appointment-overlap .loader').fadeOut('slow');
                    jQuery('#modal').fadeIn('slow');
                    jQuery('#modal div#response-message').nextAll().remove();
                    jQuery(response).insertAfter('#modal div#response-message');
                }

            });
            return false;
        });
        $('#save_record').live('click', function () {
            var type = $(this).data('action');
            var parent = $(this).parents('table.wp-list-table');
            jQuery('div#response-message').empty();
            if (type === 'locations') {
                var name = $(parent).find('input[name="wst_location_name"]').val();
                var address = $(parent).find('textarea[name="wst_location_address"]').val();
                var country = $(parent).find("select.location_country").val();
                var location = $(parent).find('input[name="wst_location_location"]').val();
                var img_id = $(parent).find('div.img-preview > img').data('id');
                var data = 'type=' + type + '&name=' + name + '&address=' + address + '&country=' + country + '&location=' + location + '&img_id=' + img_id + '&action=wst_save_record';
                var after_success = 'type=' + type + '&action=wst_update_table';
            } else if (type === 'services') {
                var name = $(parent).find('input[name="wst_service_name"]').val();
                var desc = $(parent).find('textarea[name="wst_service_desc"]').val();
                var duration = $(parent).find('input[name="wst_service_duration"]').val();
                var price = $(parent).find('input[name="wst_service_price"]').val();
                var img_id = $(parent).find('div.img-preview > img').data('id');
                var data = 'type=' + type + '&name=' + name + '&desc=' + desc + '&duration=' + duration + '&price=' + price + '&img_id=' + img_id + '&action=wst_save_record';
                var after_success = 'type=' + type + '&action=wst_update_table';
            } else if (type === 'staff') {
                var name = $(parent).find('input[name="wst_staff_name"]').val();
                var desc = $(parent).find('textarea[name="wst_staff_desc"]').val();
                var email = $(parent).find('input[name="wst_staff_email"]').val();
                var contact = $(parent).find('input[name="wst_staff_contact"]').val();
                var country = $(parent).find("select.location_country").val();
                var start_time = $(parent).find("select#start_time").val();
                var end_time = $(parent).find("select#end_time").val();
                var interval = $(parent).find("select#interval").val();
                var img_id = $(parent).find('div.img-preview > img').data('id');
                var data = 'type=' + type + '&name=' + name + '&desc=' + desc + '&email=' + email + '&contact=' + contact + '&country=' + country + '&start_time=' + start_time + '&end_time=' + end_time + '&interval=' + interval + '&img_id=' + img_id + '&action=wst_save_record';
                var after_success = 'type=' + type + '&action=wst_update_table';
            } else if (type === 'connections') {
                var location = $(parent).find("select#locations").val();
                var worker = $(parent).find("select#workers").val();
                if ($('#wst_con_all_services').is(":checked")) {
                    var service = 'all';
                } else {
                    var service = $(parent).find("select#services").val();
                }
                var start_date = $(parent).find('input[name="start_date"]').val();
                var end_date = $(parent).find('input[name="end_date"]').val();
                var week_days = $(parent).find("select#weeks").val();
                var data = 'type=' + type + '&location=' + location + '&worker=' + worker + '&service=' + service + '&start_time=' + start_time + '&end_time=' + end_time + '&interval=' + interval + '&start_date=' + start_date + '&end_date=' + end_date + '&week_days=' + week_days + '&action=wst_save_record';
                var after_success = 'type=' + type + '&action=wst_update_table';
            }
            jQuery.ajax({
                type: "post",
                url: ajax_url,
                data: data,
                beforeSend: function () {
                    jQuery('#wp-appointment-overlap').css({
                        'z-index': 999999999
                    });
                    jQuery('#wp-appointment-overlap .loader').fadeIn('slow');
                },
                success: function (response) {
                    jQuery('#wp-appointment-overlap').css({
                        'z-index': 99999999
                    });
                    jQuery('#wp-appointment-overlap .loader').fadeOut('slow');
                    jQuery('div#response-message').fadeIn('slow');
                    jQuery('div#response-message').html(response);
                    if (response.indexOf("Successfully") >= 0) {
                        jQuery.ajax({
                            type: "post",
                            url: ajax_url,
                            data: after_success,
                            success: function (response) {
                                var loc = jQuery('section#section_' + type).find('tbody');
                                var len = (loc).children().length;
                                if ($(loc).find('tr td').hasClass('no-record')) {
                                    jQuery(loc).html(response);
                                } else if (len < 2) {
                                    jQuery(loc).prepend(response);
                                } else {
                                    jQuery(loc).children().last().remove();
                                    jQuery(loc).prepend(response);
                                }
                            }
                        });
                    }
                }
            });
            setTimeout(function () {
                jQuery('div#response-message').fadeOut('slow');
            }, 5000);
            return false;
        });
        $('.delete_record').live('click', function ($) {
            var type = jQuery(this).data('action');
            var record_id = jQuery(this).data('id');
            var record = jQuery(this).parent().parent();
            var data = 'id=' + record_id + '&type=' + type + '&action=wst_delete_record';
            jQuery.ajax({
                type: "post",
                url: ajax_url,
                data: data,
                beforeSend: function () {
                    jQuery('#wp-appointment-overlap').fadeIn('slow');
                    jQuery('#wp-appointment-overlap .loader').fadeIn('slow');
                },
                success: function (response) {
                    jQuery('#wp-appointment-overlap .loader').fadeOut('slow');
                    jQuery('#wp-appointment-overlap').fadeOut('slow');
                    console.log(response);
                    if (response == 1) {
                        setTimeout(function () {
                            jQuery(record).css({
                                'background': 'red'
                            }).fadeOut('slow');
                        }, 1000);
                        setTimeout(function () {
                            location.reload();
                        }, 400);
                    }
                }

            });
            return false;
        });
        $('.edit_record').live('click', function () {
            jQuery('.modal-head > h2').html(location_update_record);
            var type = $(this).data('action');
            var record_id = jQuery(this).data('id');
            var data = 'id=' + record_id + '&type=' + type + '&action=wst_edit_location';
            jQuery.ajax({
                type: "post",
                url: ajax_url,
                data: data,
                beforeSend: function () {
                    jQuery('#wp-appointment-overlap').fadeIn('slow');
                    jQuery('#wp-appointment-overlap .loader').fadeIn('slow');
                },
                success: function (response) {
                    jQuery('#wp-appointment-overlap .loader').fadeOut('slow');
                    jQuery('#modal').fadeIn('slow');
                    jQuery('#modal div#response-message').nextAll().remove();
                    jQuery(response).insertAfter('#modal div#response-message');
                    $('html, body').animate({
                        scrollTop: $(".modal-head").offset().top - 50
                    }, 1000);
                }

            });
            return false;
        });
        $('#update_record').live('click', function () {
            var type = $(this).data('action');
            var parent = $(this).parents('table.wp-list-table');
            jQuery('div#response-message').empty();
            if (type === 'locations') {
                var id = $(parent).find('input[name="wst_location_id"]').val();
                var name = $(parent).find('input[name="wst_location_name"]').val();
                var address = $(parent).find('textarea[name="wst_location_address"]').val();
                var country = $(parent).find("select.location_country").val();
                var location = $(parent).find('input[name="wst_location_location"]').val();
                var img_id = $(parent).find('div.img-preview > img').data('id');
                var data = 'id=' + id + '&type=' + type + '&name=' + name + '&address=' + address + '&country=' + country + '&location=' + location + '&img=' + img_id + '&action=wst_update_location_record';
                var after_success = 'type=' + type + '&action=wst_update_table';
            } else if (type === 'services') {
                var id = $(parent).find('input[name="wst_service_id"]').val();
                var name = $(parent).find('input[name="wst_service_name"]').val();
                var desc = $(parent).find('textarea[name="wst_service_desc"]').val();
                var duration = $(parent).find('input[name="wst_service_duration"]').val();
                var price = $(parent).find('input[name="wst_service_price"]').val();
                var img_id = $(parent).find('div.img-preview > img').data('id');
                var data = 'id=' + id + '&type=' + type + '&name=' + name + '&desc=' + desc + '&duration=' + duration + '&price=' + price + '&img=' + img_id + '&action=wst_update_location_record';
                var after_success = 'type=' + type + '&action=wst_update_table';
            } else if (type === 'staff') {
                var id = $(parent).find('input[name="wst_staff_id"]').val();
                var name = $(parent).find('input[name="wst_staff_name"]').val();
                var desc = $(parent).find('textarea[name="wst_staff_desc"]').val();
                var email = $(parent).find('input[name="wst_staff_email"]').val();
                var contact = $(parent).find('input[name="wst_staff_contact"]').val();
                var country = $(parent).find("select.location_country").val();
                var start_time = $(parent).find("select#start_time").val();
                var end_time = $(parent).find("select#end_time").val();
                var interval = $(parent).find("select#interval").val();
                var img_id = $(parent).find('div.img-preview > img').data('id');
                var data = 'id=' + id + '&type=' + type + '&name=' + name + '&desc=' + desc + '&email=' + email + '&contact=' + contact + '&country=' + country + '&start_time=' + start_time + '&end_time=' + end_time + '&interval=' + interval + '&img=' + img_id + '&action=wst_update_location_record';
                var after_success = 'type=' + type + '&action=wst_update_table';
            } else if (type === 'connections') {
                var id = $(parent).find('input[name="wst_connection_id"]').val();
                var location = $(parent).find("select#locations").val();
                var worker = $(parent).find("select#workers").val();
                if ($('#wst_con_all_services').is(":checked")) {
                    var service = 'all';
                } else {
                    var service = $(parent).find("select#services").val();
                }
                var start_date = $(parent).find('input[name="start_date"]').val();
                var end_date = $(parent).find('input[name="end_date"]').val();
                var week_days = $(parent).find("select#weeks").val();
                var data = 'id=' + id + '&type=' + type + '&location=' + location + '&worker=' + worker + '&service=' + service + '&start_date=' + start_date + '&end_date=' + end_date + '&week_days=' + week_days + '&action=wst_update_location_record';
                var after_success = 'type=' + type + '&action=wst_update_table';
            }
            jQuery.ajax({
                type: "post",
                url: ajax_url,
                data: data,
                beforeSend: function () {
                    jQuery('#wp-appointment-overlap').css({
                        'z-index': 999999999
                    });
                    jQuery('#wp-appointment-overlap .loader').fadeIn('slow');
                },
                success: function (response) {
                    jQuery('#wp-appointment-overlap').css({
                        'z-index': 99999999
                    });
                    jQuery('#wp-appointment-overlap .loader').fadeOut('slow');
                    jQuery('div#response-message').fadeIn('slow');
                    jQuery('div#response-message').html(response);
                }
            });
            setTimeout(function () {
                jQuery('div#response-message').fadeOut('slow');
            }, 5000);
            return false;
        });
        $('#close, #pop_close').live('click', function ($) {
            jQuery('#modal').fadeOut('slow');
            jQuery('#wp-appointment-overlap').fadeOut('slow');
        });
        $('#pop_close_refress, .btn_refresh').live('click', function ($) {
            jQuery('#modal').fadeOut('slow');
            jQuery('#wp-appointment-overlap').fadeOut('slow');
            location.reload();
        });
    });
    $('#wst_con_all_services').live('click', function () {
        if ($(this).prop('checked') === false) {
            $('.modal-inner td .all_services').show();
        } else {
            $('.modal-inner td .all_services').hide();
        }
    });
    $("#wst_service_duration, #wst_service_price, #wst_staff_contact").live('keydown', function (e) {
// Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                        (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
    $('.wst_help').on('click', this, function (e) {
        e.preventDefault();
        $('button#contextual-help-link').trigger('click');
    });
    // Thickbox preview
    $('#wst_preview_template').on('click', this, function (e) {
        e.preventDefault();
        var $this = $(this),
                title = $this.attr('title'),
                href = $this.attr('href');
        // Open TB
        tb_show(title, href);
        var $previewIframe = $('#TB_iframeContent');
        if (!$previewIframe.length)
            return;
        var template;
        if (typeof (tinyMCE) != 'undefined') {
            if (tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden())
                template = tinyMCE.activeEditor.getContent();
            else
                template = $('.wst_template').val();
        }

        $previewIframe = $previewIframe[$previewIframe.length - 1].contentWindow || frame[$previewIframe.length - 1];
        $previewIframe.document.open();
        $previewIframe.document.write(template);
        $previewIframe.document.close();
    });
    $('#wst_send_preview').on('click', this, function (e) {
        e.preventDefault();
        var email = 'email=' + $('#wst_email_preview_field').val() + '&action=wst_email_testing', message = $('#wst_preview_message'), loading = $('#wst_ajax_loading');
        jQuery.ajax({
            type: "post",
            url: ajax_url,
            data: email,
            beforeSend: function () {
                loading.css('visibility', 'visible');
            },
            complete: function () {
                loading.css('visibility', 'hidden');
            },
            success: function (data) {
                message.append(data);
            }
        });

    });

    $('#wst_service_image').live('click', function (evt) {
        evt.preventDefault();
        renderMediaUploader();
    });

    $('div.img-preview > div.close').live('click', function () {
        jQuery('div.upload-btn').nextAll().fadeOut('slow').remove();
    });
}(jQuery));

function renderMediaUploader() {
    'use strict';
    var file_frame, image_data;
    if (undefined !== file_frame) {
        file_frame.open();
        return;
    }
    file_frame = wp.media.frames.file_frame = wp.media({
        title: upload_title,
        button: {
            text: btn_title
        }
    });
    file_frame.on('select', function () {
        var state = file_frame.state();
        var selection = state.get('selection');
        if (!selection)
            return;
        selection.each(function (attachment) {
            var attr = attachment.attributes;
            var preview = '<div class="img-preview"><div class="close">X</div><img data-id="' + attr.id + '" src="' + attr.sizes.thumbnail.url + '" alt="' + attr.alt + '" /></div>';
            jQuery(preview).insertAfter('div.upload-btn').fadeIn('slow');
        });
    });
    file_frame.open();
}
