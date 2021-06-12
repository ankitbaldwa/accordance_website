jQuery(document).ready(function() {
    jQuery(document).off('click', '#kt_countries_submit');
    jQuery(document).on('click', '#kt_countries_submit', function(){
        jQuery( "#countries-form" ).validate({
            // define validation rules
            rules: {
                country_name: {
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