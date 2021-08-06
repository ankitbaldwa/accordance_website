function loadINIT(){
    
}
jQuery(document).ready(function() {
    jQuery(document).off('click', '#kt_product_feature_submit');
    jQuery(document).on('click', '#kt_product_feature_submit', function(){
        jQuery( "#product-feature-form" ).validate({
            // define validation rules
            rules: {
                name: {
                    required: true
                },
                /* description: {
                    required: true
                }, */
                image: {
                    extension: "jpg|jpeg|png|JPG|JPEG|PNG"
                }
            },
            messages: {
                image: {
                    extension: "Please select valid image format as jpg, jpeg or png.",
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