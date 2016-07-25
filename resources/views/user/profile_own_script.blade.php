<script type="text/javascript">

$(function(){

	$('#editProfileBtn').click(function(){
		$("#profileShow").toggle();
		$("#profileEdit").toggle();

		$('.editbtn').hide();
		$('.showbtn').show();
	});

	$('#showProfileBtn').click(function(){
		$("#profileShow").toggle();
		$("#profileEdit").toggle();

		$('.editbtn').show();
		$('.showbtn').hide();
	});

});

</script>