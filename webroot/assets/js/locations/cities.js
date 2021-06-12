jQuery(document).ready(function() {
    jQuery(document).off('click', '#kt_city_submit');
    jQuery(document).on('click', '#kt_city_submit', function(){
        jQuery( "#cities-form" ).validate({
            // define validation rules
            rules: {
                mst_country_id: {
                    required: true
                },
                mst_state_id: {
                    required: true
                },
                city_name: {
                    required: true
                }
            },
    
            errorPlacement: function(error, element) {
                var group = element.closest('.input-group');
                if (group.length) {
                    group.after(error.addClass('invalid-feedback'));
                } else {
                    element.after(error.addClass('invalid-feedback'));
                }
            },
    
            //display error alert on form submit
            invalidHandler: function(event, validator) {
                swal.fire({
                    "title": "",
                    "text": "There are some errors in your submission. Please correct them.",
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary",
                    "onClose": function(e) {
                        console.log('on close event fired!');
                    }
                });
            },
    
            submitHandler: function (form) {
                //form[0].submit(); // submit the form
                //console.log(form);return false;
                jQuery(form).ajaxSubmit({
                    success: function(data, statusText, xhr, $form) {
                        // The form was successfully submitted
                        var res = jQuery.parseJSON(data);
                        if(res.status == 1){
                            swal.fire({
                                "title": "",
                                "text": res.message,
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            }).then(function(result) {
                                location.reload();
                            });
                        } else {
                            swal.fire({
                                "title": "",
                                "text": res.message,
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            }).then(function(result) {
                                location.reload();
                            });
                        }
                    }
               });
            }
        });
    });
});
function DOSelectAjaxProd(str, $this){
    var url = $this.attr('data-url');
    jQuery.ajax({
        'url': url, 
        'type': 'POST',
        'headers': {
            'X-CSRF-Token': csrfToken
        },
        'data': {'country_id': str[0].id },
        'success': function(result){
            jQuery('#mst-state-id').find('option').remove();
            jQuery('.state').select2({placeholder: "Select State"});
            $('<option>').val('').text('Select States').appendTo(jQuery('#mst-state-id'));
            jQuery.each(JSON.parse(result), function(key, value){
                $('<option>').val(key).text(value).appendTo(jQuery('#mst-state-id'));
            });
        }
    });
}