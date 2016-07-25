 <!--inline scripts related to this page-->
        <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript">
            function show_box(id) {
             $('.widget-box.visible').removeClass('visible');
             $('#'+id).addClass('visible');
             }


  $(function() {
$('#birth_date').datepicker();


            $.mask.definitions['~']='[+-]';
            $('#mobile_phone').mask('999999999999');
            
            $('#register-form').validate({
                    errorElement: 'span',
                    errorClass: 'help-inline',
                    focusInvalid: false,
                    rules: {
                        real_name: {
                            required: true,
                        },
                        nick_name: {
                            required: true,
                        },
                        birth_date: {
                            required: true,
                        },
                        gender: {
                            required: true,
                        },
                        mobile_phone: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email:true
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                        password_confirmation: {
                            required: true,
                            minlength: 5,
                            equalTo: "#password"
                        },
                        agree: 'required'
                    },
            
                    messages: {
                        email: {
                            required: "Please provide a valid email.",
                            email: "Please provide a valid email."
                        },
                        password: {
                            required: "Please specify a password.",
                            minlength: "Please specify a secure password."
                        },
                        password: {
                            required: "Please specify a password.",
                            minlength: "Please specify a secure password."
                        },
                        subscription: "Please choose at least one option",
                        gender: "Please choose gender",
                        agree: "Please accept our policy"
                    },
            
                    invalidHandler: function (event, validator) { //display error alert on form submit   
                        $('.alert-error', $('.register-form')).show();
                    },
            
                    highlight: function (e) {
                        $(e).closest('.control-group').removeClass('info').addClass('error');
                    },
            
                    success: function (e) {
                        $(e).closest('.control-group').removeClass('error').addClass('info');
                        $(e).remove();
                    },
            
                    errorPlacement: function (error, element) {
                        if(element.is(':checkbox') || element.is(':radio')) {
                            var controls = element.closest('.controls');
                            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                        }
                        else if(element.is('.select2')) {
                            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                        }
                        else if(element.is('.chzn-select')) {
                            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
                        }
                        else error.insertAfter(element);
                    },
            
                    submitHandler: function (form) {
                        submitForm();
                        form.submit();
                    },
                    invalidHandler: function (form) {
                    }
                });


                $('#forget-form').validate({
                    errorElement: 'span',
                    errorClass: 'help-inline',
                    focusInvalid: false,
                    rules: {
                        email: {
                            required: true,
                            email:true
                        },
                    },
            
                    messages: {
                        email: {
                            required: "Please provide a valid email.",
                            email: "Please provide a valid email."
                        },
                    },
            
                    invalidHandler: function (event, validator) { //display error alert on form submit   
                        $('.alert-error', $('.forget-form')).show();
                    },
            
                    highlight: function (e) {
                        $(e).closest('.control-group').removeClass('info').addClass('error');
                    },
            
                    success: function (e) {
                        $(e).closest('.control-group').removeClass('error').addClass('info');
                        $(e).remove();
                    },
            
                    errorPlacement: function (error, element) {
                        if(element.is(':checkbox') || element.is(':radio')) {
                            var controls = element.closest('.controls');
                            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                        }
                        else if(element.is('.select2')) {
                            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                        }
                        else if(element.is('.chzn-select')) {
                            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
                        }
                        else error.insertAfter(element);
                    },
            
                    submitHandler: function (form) {
                        submitForm();
                        form.submit();
                    },
                    invalidHandler: function (form) {
                    }
                });


            $('#login-form').validate({
                    errorElement: 'span',
                    errorClass: 'help-inline',
                    focusInvalid: false,
                    rules: {
                        email: {
                            required: true,
                            email:true
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                    },
            
                    messages: {
                        email: {
                            required: "Please provide a valid email.",
                            email: "Please provide a valid email."
                        },
                        password: {
                            required: "Please specify a password.",
                            minlength: "Please specify a secure password."
                        },
                    },
            
                    invalidHandler: function (event, validator) { //display error alert on form submit   
                        $('.alert-error', $('.login-form')).show();
                    },
            
                    highlight: function (e) {
                        $(e).closest('.control-group').removeClass('info').addClass('error');
                    },
            
                    success: function (e) {
                        $(e).closest('.control-group').removeClass('error').addClass('info');
                        $(e).remove();
                    },
            
                    errorPlacement: function (error, element) {
                        if(element.is(':checkbox') || element.is(':radio')) {
                            var controls = element.closest('.controls');
                            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                        }
                        else if(element.is('.select2')) {
                            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                        }
                        else if(element.is('.chzn-select')) {
                            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
                        }
                        else error.insertAfter(element);
                    },
            
                    submitHandler: function (form) {
                        submitForm();
                        form.submit();
                    },
                    invalidHandler: function (form) {
                    }
                });
  });
            
</script>