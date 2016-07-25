
<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.js') }}"></script>

<!-- TEXTEDITOR -->
<!-- <script src="{{ URL::asset('assets/js/jquery.hotkeys.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-wysiwyg.min.js') }}"></script> -->
<script type="text/javascript">

    // DOCUMENT READY
    $(function() {

        $('#user-datatable').dataTable( {
                "aaSorting": [],
                "aoColumns": [
                  null,
                  null, null,null,null,null,null,
                 { "bSortable": false }
                ] } );

    });
    </script>