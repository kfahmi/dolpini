
<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.js') }}"></script>

<!-- TEXTEDITOR -->
<!-- <script src="{{ URL::asset('assets/js/jquery.hotkeys.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-wysiwyg.min.js') }}"></script> -->
<script type="text/javascript">

    // DOCUMENT READY
    $(function() {

        $('#badwords-datatable').dataTable( {
                "aaSorting": [],
                "aoColumns": [
                  null,
                  null,null,
                 { "bSortable": false }
                ] } );

    });

    //validate posting
        $('#badwords-form').validate({
                    errorElement: 'span',
                    errorClass: 'help-inline',
                    focusInvalid: false,
                    rules: {
                        word: {
                            required: true,
                        },
                        replace_to: {
                            required: true,
                        },
                    },
            
                    messages: {
                        word: {
                            required: "Please provide a forbidden word.",
                        },
                         replace_to: {
                            required: "Please provide a Replacement word.",
                        },
                    },
            
                    invalidHandler: function (event, validator) { //display error alert on form submit   
                        $('.alert-error', $('#badwords-form')).show();
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
                        form.submit();
                    },
                    invalidHandler: function (form) {
                    }
                });
        // end ValidatePosting


</script>