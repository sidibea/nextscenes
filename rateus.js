$(document).ready(function(e) {
	$('.ratings_stars').hover(
		// Handles the mouseover
		function() {
			$(this).prevAll().andSelf().addClass('ratings_over');
			$(this).nextAll().removeClass('ratings_vote');
		},
		// Handles the mouseout
		function(){
			$(this).prevAll().andSelf().removeClass('ratings_over');
			// can't use 'this' because it wont contain the updated data
		}
	);
	$('.ratings_stars').bind('click', function() {
		var star = $(this).attr("id") * 2;
		var userID = $('.usrID').val();
		var scene = $('.rscene').val();
		var pscene = $('.pscene').val();
		$('#note').html('Loading...');
		var note = '';
		var dataString = "scene="+scene+"&score="+star+"&fro="+userID+"&pscene="+pscene;
		// AJAX Code To Submit Form.
		$.ajax({
			type: "POST",
			url: "unit1_rating.php",
			data: dataString,
			cache: false,
            dataType: 'json',
			success: function(result){
				if(result[0] == 5){
					$('#note').html('Your Vote Has Been Counted.');
				}
				if(result[0] == 3){
					$('#note').html('Your Vote Has Been Updated.');
				}
				if(result[0] == 2){
					$('#note').html('Error Updating Your Vote.');
				}
				if(result[0] == 4){
					$('#note').html('Unable To Count Your Vote AT This Time, Please try Again Later.');
				}
				if(result[0] == 1){
					$('#note').html('Invalid User, Please Logout And Login Again To Retry.');
				}
				$('.total_votes').html(''+result[1]);
			}
		});
	});  
});