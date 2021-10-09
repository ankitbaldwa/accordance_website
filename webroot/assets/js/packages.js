function loadINIT(){
    $('[data-switch=true]').bootstrapSwitch();
}
  jQuery(document).ready(function() {
    jQuery(document).on('change.bootstrapSwitch', '#is_monthly', function(e){
      if(jQuery(this).prop('checked') == true){
          //do something
          jQuery('.is_monthly').show();
      } else {
        jQuery('.is_monthly').hide();
      }
    });
    jQuery('#discount-per').val(0);
    jQuery('#tax_par').val(0);
    jQuery(document).on('keyup','#price, #discount-per, #tax_par', function(e){
        var price = jQuery('#price').val();
        var dis_per = jQuery('#discount-per').val();
        var tax_per = jQuery('#tax_par').val();
        var discount_amt; var tax_amt; var net_amount;
        if(dis_per != ""){
            discount_amt = price * (dis_per/100);
        }
        if(tax_per != ""){
            tax_amt = price * (tax_per/100);
        }
        net_amount = price - discount_amt + tax_amt;
        jQuery('#discount-per').val(dis_per);
        jQuery('#tax_par').val(tax_per);
        jQuery('#discount_amt').val(discount_amt);
        jQuery('#tax_amount').val(tax_amt);
        jQuery('#net_amount').val(net_amount);
    });
    jQuery(document).off('click', '#kt_package_submit');
    jQuery(document).on('click', '#kt_package_submit', function(){
        jQuery( "#package-form" ).validate({
            // define validation rules
            rules: {
                product_id: {
                    required: true
                },
                name: {
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
    /** For submiting package benefits form */
    jQuery(document).off('click', '#kt_package_benefit_submit');
    jQuery(document).on('click', '#kt_package_benefit_submit', function(){
        jQuery( "#package-benefits-form" ).validate({
            // define validation rules
            rules: {
                title: {
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
