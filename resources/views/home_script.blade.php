
<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.js') }}"></script>


<!-- <!--KEBUTUHAN POST -->
<script src="{{ URL::asset('assets/js/bootstrap-tag.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.inputlimiter.1.3.1.min.js') }}"></script>

<!-- TEXTEDITOR -->
<!-- <script src="{{ URL::asset('assets/js/jquery.hotkeys.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-wysiwyg.min.js') }}"></script> -->
<script type="text/javascript">

    function showMore(id)
    {
        var detail_id = "#details_"+id;
        var btnShow = "#btnShow_"+id;
        var btnHide = "#btnHide_"+id;
        $(detail_id).toggle();
        $(btnShow).toggle();
        $(btnHide).toggle();
    }
   

    // DOCUMENT READY
    $(function() {


        var topicType = $('#topicType').val();

        if(topicType == 'debat')
        {
            $("#kubu").append(' <div class="controls">Kubu 1<input type="text" name="kubuLabel[]" id="kubuLabel1" class="autosize-transition span12" value="Kubu 1" required/></div>');
            $("#kubu").append(' <div class="controls">Kubu 2<input type="text" name="kubuLabel[]" id="kubuLabel2" class="autosize-transition span12" value="Kubu 2" required/></div>');
        }
        else if(topicType == 'rating')
        {
            $("#kubu").append(' <div class="controls">Kubu 1<input type="text" name="kubuLabel[]" id="kubuLabel1" class="autosize-transition span12" value="Positive" required/></div>');
            $("#kubu").append(' <div class="controls">Kubu 2<input type="text" name="kubuLabel[]" id="kubuLabel2" class="autosize-transition span12" value="Negative" required/></div>');
        }
        else
        {
            $("#kubu").append(' <div class="controls"><input type="hidden" name="kubuLabel[]" id="kubuLabel1" class="autosize-transition span12" value="Comments"></div>');;
        }


        $('#topicType').change(function(){
            var topicType = $('#topicType').val();
            $("#kubu").empty();
            if(topicType == 'debat')
            {
                $("#kubu").append(' <div class="controls">Kubu 1<input type="text" name="kubuLabel[]" id="kubuLabel1" class="autosize-transition span12" value="Kubu 1" required/></div>');
                $("#kubu").append(' <div class="controls">Kubu 2<input type="text" name="kubuLabel[]" id="kubuLabel2" class="autosize-transition span12" value="Kubu 2" required/></div>');
            }
            else if(topicType == 'rating')
            {
                $("#kubu").append(' <div class="controls">Kubu 1<input type="text" name="kubuLabelShow[]" class="autosize-transition span12" value="Positive" disabled><input type="hidden" name="kubuLabel[]" id="kubuLabel1" class="autosize-transition span12" value="Positive"></div>');
                $("#kubu").append(' <div class="controls">Kubu 2<input type="text" name="kubuLabelShow[]" class="autosize-transition span12" value="Negative" disabled><input type="hidden" name="kubuLabel[]" id="kubuLabel2" class="autosize-transition span12" value="Negative"></div>');
            }
            else if(topicType == 'artikel')
            {
                $("#kubu").append(' <div class="controls"><input type="hidden" name="kubuLabel[]" id="kubuLabel1" class="autosize-transition span12" value="Comments"></div>');;
            }
        });



        //limit text
        $('textarea[class*=limited]').each(function() {
            var limit = parseInt($(this).attr('data-maxlength')) || 100;
            $(this).inputlimiter({
                "limit": limit,
                remText: '%n character%s remaining...',
                limitText: 'max allowed : %n.'
            });
        });

        //TAGS
        //we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
        var tag_input = $('#form-field-tags');
        if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) ) 
            tag_input.tag({placeholder:tag_input.attr('placeholder')});
        else {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
            //$('#form-field-tags').autosize({append: "\n"});
        }
        //endTAGS

        //TOOLTIP
        $('[data-rel=tooltip]').tooltip({container:'body'});
        $('[data-rel=popover]').popover({container:'body'});
        // ENDTOOLTIP

        // POSTING
           $('#btnNewTopic').click(function(){
                $('#bodyNewTopic').toggle();
            });
           $('#closeBodyNewTopic').click(function(){
                $('#bodyNewTopic').toggle();
            });

        //validate posting
        $('#post-form').validate({
                    errorElement: 'span',
                    errorClass: 'help-inline',
                    focusInvalid: false,
                    rules: {
                        title: {
                            required: true,
                        },
                        header_content: {
                            required: true,
                        },
                        kubu_label1: {
                            required: true,
                        },
                        kubu_label2: {
                            required: true,
                        },
                        
                    },
            
                    messages: {
                        title: {
                            required: "Title / Judul harus di isi",
                        },
                        header_content: {
                            required: "Kontent harus di isi",
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
        // end ValidatePosting

        //imageDropzone
                $('.uploadFile').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change',
                    droppable:false,
                    onchange:null,
                    thumbnail:false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
                });
                

        //Add Image Resize Functionality to Chrome and Safari
                //webkit browsers don't have image resize functionality when content is editable
                //so let's add something using jQuery UI resizable
                //another option would be opening a dialog for user to enter dimensions.
                if ( typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase()) ) {
                    
                    var lastResizableImg = null;
                    function destroyResizable() {
                        if(lastResizableImg == null) return;
                        lastResizableImg.resizable( "destroy" );
                        lastResizableImg.removeData('resizable');
                        lastResizableImg = null;
                    }

                    var enableImageResize = function() {
                        $('.wysiwyg-editor')
                        .on('mousedown', function(e) {
                            var target = $(e.target);
                            if( e.target instanceof HTMLImageElement ) {
                                if( !target.data('resizable') ) {
                                    target.resizable({
                                        aspectRatio: e.target.width / e.target.height,
                                    });
                                    target.data('resizable', true);
                                    
                                    if( lastResizableImg != null ) {//disable previous resizable image
                                        lastResizableImg.resizable( "destroy" );
                                        lastResizableImg.removeData('resizable');
                                    }
                                    lastResizableImg = target;
                                }
                            }
                        })
                        .on('click', function(e) {
                            if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
                                destroyResizable();
                            }
                        })
                        .on('keydown', function() {
                            destroyResizable();
                        });
                    }
                    
                    enableImageResize();

                    /**
                    //or we can load the jQuery UI dynamically only if needed
                    if (typeof jQuery.ui !== 'undefined') enableImageResize();
                    else {//load jQuery UI if not loaded
                        $.getScript($assets+"/js/jquery-ui-1.10.3.custom.min.js", function(data, textStatus, jqxhr) {
                            if('ontouchend' in document) {//also load touch-punch for touch devices
                                $.getScript($assets+"/js/jquery.ui.touch-punch.min.js", function(data, textStatus, jqxhr) {
                                    enableImageResize();
                                });
                            } else  enableImageResize();
                        });
                    }
                    */
                }



    });
//end DOCUMENT READY
</script> 



<script>

 $(function() {

        var i =0;
        var no = 1
        $('#addYoutube').click(function(){
            if(i == 0)
            {
             $("#youtubeContainer").empty();
            }
        
            $("#youtubeContainer").append('<span id="row'+i+'">' +
                '<input type="text" placeholder="https://www.youtube.com/watch?v=6HBtq2OF_mc" name="detail['+i+'][content]" />'+
                '<input type="hidden" value="youtube" name="detail['+i+'][type]" />'+
                ' <a onclick="delRow('+i+')"><i class="icon-remove"></i></a>'+
                '</span><div class="space-6"></div>');

            no++;
            i++;
        });

        $('#addImage').click(function(){
            if(i == 0)
            {
             $("#imageContainer").empty();
            }
        
            $("#imageContainer").append('<span id="row'+i+'">' +
                '<input type="file" placeholder="upload image from your computer" class="uploadFile" name="detail['+i+'][content]" />'+
                '<input type="hidden" value="image" name="detail['+i+'][type]" />'+
                ' <a onclick="delRow('+i+')"><i class="icon-remove"></i></a>'+
                '</span><div class="space-6"></div>');

            no++;
            i++;
        });

        $('#addUrl').click(function(){
            if(i == 0)
            {
             $("#urlContainer").empty();
            }
        
            $("#urlContainer").append('<span id="row'+i+'">' +
                '<input type="text" placeholder="https://www.google.co.id/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=php%20get%20string%20after%20character" name="detail['+i+'][content]" />'+
                '<input type="hidden" value="url" name="detail['+i+'][type]" />'+
                ' <a onclick="delRow('+i+')"><i class="icon-remove"></i></a>'+
                '</span><div class="space-6"></div>');

            no++;
            i++;
        });


 });


        function delRow(j)
        {
            $("#row"+j).remove();
        }


</script>

