  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1907672512793214',
      xfbml      : true,
      version    : 'v2.6'
    });
	
	 FB.getLoginStatus(function(response) {
        //statusChangeCallback(response);
    });
  };
  
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
        loadProfile();
    } else if (response.status === 'not_authorized') {
        //document.getElementById('status').innerHTML = 'Please log ' +
        //'into this app.';
    } else {
        //document.getElementById('status').innerHTML = 'Please log ' +
        //'into Facebook.';
    }
	}
   
   function loadProfile() {
    var attempted = getParameterByName('attempted');
    //alert(window.location.href);
		if(attempted != true) {
			var plocation = 'fbauth.php';
			window.location.href = plocation;
		}
	}
	
	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}

	
	function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
			results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

function FB_Login(){
    FB.login(function(response) {
	if (response.status === 'connected'){
	FB.api('/me?fields=id,email,name', function(data) {
		console.log( data.email )		
	},{
		scope: 'public_profile,user_friends,email'
		});
	}else if (response.status === 'not_authorized') {
	console.log("This User Has Not Authenticated you for facebook");		  
	} else {
		console.log("This user isn't logged in to Facebook.");		  
		}
    });
}

function FBLogin() {
	var location = 'sociallogin/fblogin/fbconfig.php';
    window.location.href = location;
}

function GoogleLogin() {
	var location = 'sociallogin/gauth/';
    window.location.href = location;
}

function LinkedInLogin() {
	var lklocation = 'sociallogin/linkedin/process.php';
    window.location.href = lklocation;
}