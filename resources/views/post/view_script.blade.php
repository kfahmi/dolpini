
<script>
    $(document).ready(function() {


                $('[class^=hapusReply]').click(function(event){
                    var reply_id = this.className.split('_')[1];

                    if (!confirm('Hapus / Non Aktifkan komentar ini?'))
                    {
                        return false;
                    };


                    $(".loading").show();
                    $(".main-container").hide();
                  $.post("{{url('post/reply/deleteRestoreReply')}}",
                    {
                        id: reply_id,
                        _token : "<?php echo csrf_token(); ?>"
                    },
                    function(data, status){
                        window.location.reload();
                    });
                });


                $('.urlData').each(function(index){
                    $(this).urlive({
                        container: '.urlive-container:eq('+index+')',
                        imageSize: 'small',
//                        render: true,
                        callbacks:{
                            onStart: function(){
                                $('.pureUrl').show();
                                $('.urlive-container').hide();
                                
                            },
                            onLoadEnd: function(){
                                 $('.pureUrl').hide();
                                $('.urlive-container').show();
                            }
                        }
                    });

                });
});
</script>
