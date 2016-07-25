<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Dolpini - Share the Truth - Blast the Opinion</title>

        <meta name="description" content="and Validation" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--basic styles-->

        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ URL::asset('assets/css/bootstrap-responsive.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('fontawesome/css/font-awesome.min.css') }}">
        <!--[if IE 7]>
          <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!--page specific plugin styles-->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery-ui-1.10.3.custom.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/select2.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/chosen.css') }}" />
        <!-- datepicker -->
        <link rel="stylesheet" href="{{ URL::asset('assets/css/datepicker.css') }}" />

        <!--fonts-->

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

        <!--ace styles-->

        <link rel="stylesheet" href="{{ URL::asset('assets/css/ace.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/ace-responsive.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/ace-skins.min.css') }}" />

       <link href="{{ URL::asset('urlive-master/jquery.urlive.css') }}" rel="stylesheet" />
        <!--[if lte IE 8]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

        <!--inline styles related to this page-->
        <style type="text/css">
        .morecontent span {
            display: none;
        }
        .morelink {
            display: block;
        }
        </style>


         <script>
            function submitForm()
            {
              //show
              $(".loading").show();
              $(".main-container").hide();
            }
        </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
    <body>
        @include('layouts.navbar')

        <div class="loading alert alert-info" style="display:none;">
            <span style="margin-left:48%;"><i class="fa fa-spin fa-spinner fa-4x"> </i>Harap tunggu sebentar... </span>
        </div>
        <!-- kalo udah login -->
        @if(Auth::check())
            @if(Auth::user()->level == 'admin')
                <div class="main-container container-fluid">
                    @include('layouts.sidebar')
                    

                    <div class="main-content">
                    @yield('content')
                    <!-- tutupdiv nya ada di content -->
                </div>
            @else
                <div class="main-container container-fluid">
                    <div class="main-content-full">
                    @yield('content')
                    <!-- tutupdiv nya ada di content -->

                </div>
            @endif
        <!-- kalo belom login -->
        @else
            @yield('content')
        @endif



        <script type="text/javascript">
            $(document).ready(function() {
                
            // $('a').click(function () {
            //    localStorage.clear();
            // });

            // $('[id^=replyNotif]').click(function () {
            //     //save the latest tab; use cookies if you like 'em better:
            //     var id = this.id.split('_')[1];
            //     localStorage.setItem('replyNotif', id);
            // });


            // //go to the latest tab, if it exists:
            // var replyNotif = localStorage.getItem('replyNotif');

            // if (replyNotif) {
            //      document.getElementById("replyBody_"+replyNotif).style.border = "1px solid red";
            //      window.location.hash = "replyBody_"+replyNotif;
            // }

            $('#notifBtn').click(function(){
                $.get("/notif/read",function(data){
                    console.log(data);
                });
            });

            var sesReply = "{{Session::get('reply_id')}}";

             if (sesReply) {
                document.getElementById("replyBody_"+sesReply).style.border = "1px solid red";
                window.location.hash = "replyBody_"+sesReply;
            }


            // Configure/customize these variables.
            var showChar = 1000; // How many characters are shown by default
            var ellipsestext = "...";
            var moretext = "<i class='fa fa-chevron-down'></i> Show more";
            var lesstext = "<i class='fa fa-chevron-up'></i> Show less";
            

            $('.hideable').each(function() {
                var content = $(this).html();
         
                if(content.length > showChar) {
         
                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar, content.length - showChar);
         
                    var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">  ' + moretext + '</a></span>';
         
                    $(this).html(html);
                }
         
            });
         
            $(".morelink").click(function(){
                if($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                }
                $(this).parent().prev().toggle(500);
                $(this).prev().toggle(500);
                return false;
            });
        });
        </script>

    </body>
</html>