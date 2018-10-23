$('.delete_user_btn').live('click', function(event) {
	event.preventDefault();
	if (confirm("Are you sure you want to delete this user?")) {
		var id = $(this).attr('id');
		$.ajax({
		  type: 'POST',
		  data: 'id='+id,
		  url: 'listeners/delete_user.php',
		  success: function(msg) {
		  	if(msg!='') alert(msg);
		  	window.location.reload();
		  }
		});
	}
});

$('.approve_user_btn').live('click', function(event) {
	event.preventDefault();
	if (confirm("Are you sure to activate this user?")) {
		var id = $(this).attr('id');
		$.ajax({
		  type: 'POST',
		  data: 'id='+id+'&t=1',
		  url: 'listeners/approve_user.php',
		  success: function(msg) {
		  	if(msg!='') alert(msg);
		  	window.location.reload();
		  }
		});
	}
});

$('.unapprove_user_btn').live('click', function(event) {
	event.preventDefault();
	if (confirm("Are you sure to make inactive this user?")) {
		var id = $(this).attr('id');
		$.ajax({
		  type: 'POST',
		  data: 'id='+id+'&t=2',
		  url: 'listeners/approve_user.php',
		  success: function(msg) {
		  	if(msg!='') alert(msg);
		  	window.location.reload();
		  }
		});
	}
});

/*
Account functions
*/

$('#update_new_password_btn').live('click', function(event) {
	event.preventDefault();
	var serialized_data = jQuery("#reset_form").serialize();
	$.ajax({
	  type: 'POST',
	  data: serialized_data,
	  url: 'listeners/reset_password2.php',
	  success: function(msg) {
	  	if(msg==1) {
	  		window.location = './';
	  	}
	  	else {
	  		alert(msg);
	  	}
	  }
	});
});

$('#reset_password_btn').live('click', function(event) {
	event.preventDefault();
	var serialized_data = jQuery("#login_form").serialize();
	if($('#email').val()!='') {
		$.ajax({
		  type: 'POST',
		  data: serialized_data,
		  dataType: 'json',
		  url: 'listeners/reset_password.php',
		  success: function(msg) {
		  	if(msg.code=='1') {
		  		$('#reset_password_msg').html(msg.display);
		  	}
		  	else {
		  		$('#notification').html(msg.display);
		  	}
		  }
		});		
	}
});

$('#change_password_btn').live('click', function(event) {
	event.preventDefault();
	var serialized_data = jQuery("#change_password_form").serialize();
	$.ajax({
	  type: 'POST',
	  data: serialized_data,
	  dataType: 'json',
	  url: 'listeners/change_password.php',
	  success: function(msg) {
	  	if(msg.code=='1') {
		  	$('#notification').html(msg.display);
		  	$('#existing_password').val('');
		  	$('#new_password').val('');
		  	$('#new_password2').val('');
	  	}
	  	else {
		  	$('#notification').html(msg.display);
	  	}
	  }
	});
});

/*
$('#logout_btn').live('click', function(event) {
	event.preventDefault();
	$.ajax({
	  type: 'POST',
	  url: 'listeners/logout.php',
	  success: function(msg) {
	  	window.location = './';
	  }
	});
});
*/

$('#login_btn').live('click', function(event) {
	event.preventDefault();
	var serialized_data = jQuery("#login_form").serialize();
	$.ajax({
	  type: 'POST',
	  data: serialized_data,
	  dataType: 'json',
	  url: 'listeners/check_login.php',
	  success: function(msg) {
	  	if(msg.code=='0') {
	  		$('#login_notification').html(msg.display);
	  	}
	  	else {
	  		window.location = './';
	  	}
	  }
	});
});

$('#create_account_btn').live('click', function(event) {
	event.preventDefault();
	var serialized_data = jQuery("#create_account_form").serialize();
	$.ajax({
	  type: 'POST',
	  data: serialized_data,
	  url: 'listeners/create_account.php',
	  success: function(msg) {
	  	if(msg!='') {
	  		$('#create_account_notification').html('<div class="alert fade in alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>' + msg + '</div>');
	  		$('.alert-message').alert();
	  	}
	  	else window.location = './';
	  }
	});
});

/*
Geocoding and Map
*/

$('#geocode_address_btn').live('click', function(event) {
	event.preventDefault();
	
	var address = $('#location2geocode').val();
	
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode( {'address': address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK) {
	  	//lat = results[0].geometry.location.Ha;
	  	//lng = results[0].geometry.location.Ia;
	  	
	  	var latLng = String(results[0].geometry.location);
	  	latLng = latLng.substr(1);
	  	var pos = strpos(latLng, ',');
	  	lat = latLng.substr(0,pos);
	  	var pos2 = strpos(latLng, ')');
	  	latLng = latLng.substr(0,pos2);
	  	lng = latLng.substr((pos+2));
	  	
	  	if(lat!=''&&lng!='') {
	  		var img = '<img src="http://maps.google.com/maps/api/staticmap?center='+lat+','+lng+'&zoom=15&size=300x200&markers=color:red|label:P|'+lat+','+lng+'&sensor=false" style="margin-right:20px; vertical-align:middle; margin-bottom:10px;"><a href="#" id="edit_address_btn">Edit address</a>';
	  		$('#address_thumbnail').html(img);
	  		$('#address').val(address);
	  		//$('#address').attr('disabled', 'disabled');
			$('#geocode_section').hide();
			$('#form_section').show();
			$('#lat').val(lat);
			$('#lng').val(lng);
	  	}
	  }
	  else {
	  		alert('Please enter a valid address');
	  }
	});
});

$('#edit_address_btn').live('click', function(event) {
	event.preventDefault();
	$('#form_section').hide();
	$('#geocode_section').show();
	$('#address_thumbnail').html('');
	$('#location2geocode').val($('#address').val());
});

function load_thumbnail_map(lat, lng) {
	var img = '<img src="http://maps.google.com/maps/api/staticmap?center='+lat+','+lng+'&zoom=15&size=300x200&markers=color:red|label:P|'+lat+','+lng+'&sensor=false" style="margin-right:20px; vertical-align:middle; margin-bottom:10px;"><a href="#" id="edit_address_btn">Edit address</a>';
	$('#address_thumbnail').html(img);
}

function strpos(haystack, needle, offset) {
    var i = (haystack + '').indexOf(needle, (offset || 0));
    return i === -1 ? false : i;
}