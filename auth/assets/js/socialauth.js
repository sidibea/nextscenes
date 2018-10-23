/**
 Core script to handle the entire theme and core functions
 **/
var SA = function ($) {
    var signinPopup = null;
    var emailPattern = /^([\w\.-]{1,64}@[\w\.-]{1,252}\.\w{2,4})$/i;

    var openSignupForm = function () {
        $(".signup-open").on("click", function() {
            $(".sa-form").hide();
            $("#signup-form").slideDown("slow");

        });
    }

    var openSigninForm = function () {
        $(".signin-open").on("click", function() {
            $(".sa-form").hide();
            $("#signin-form").slideDown("slow");

        });
    }

    var openForgotPasswordForm = function () {
        $(".open-forgot-password").on("click", function() {
            $(".sa-form").hide();
            $("#forgot-password-form").slideDown("slow");

        });
    }

    var openSigninPopup = function(url) {
        signinPopup = window.open(url, "sa_signin_pupop",
            "location=0,status=0,scrollbars=0,width=1000,height=600");
        signinPopup.focus();
        return;
    }

    var openSigninUrl = function(url) {
        window.location.href = url;
        return;
    }

    var openSigninPage = function() {
        $(".btn-social-icon").on("click", function(e) {
            e.preventDefault();
            var isPopup = $(this).closest(".popup");
            var pageType = (isPopup.length > 0)? "popup": "inpage";
            var url = $(this).attr("href");
            if (pageType === "popup") {
                openSigninPopup(url);
            } else {
                openSigninUrl(url);
            }
        })
    }

    var closePopupAndRefresh = function(url) {
        window.opener.location.href = url;
        window.close();
    }

    var initSignup = function() {
        $("#btn-signup").on("click", function() {
            var username = $("#signup-username").val();
            var email = $("#signup-email").val();
            var pass1 = $("#signup-password").val();
            var pass2 = $("#signup-password-2").val();
            if (!emailPattern.test(email)) {
                message("Invalid email!", "danger");
                return false;
            }

            if(pass1.length < 1 || pass2.length < 1 || pass1 != pass2) {
                message("Passwords must match or password length greater than 0", "danger");
                return false;
            }

            $.post("finish-signup.php", {username: username, signup_email: email, password1: pass1, password2: pass2, signup: true})
                .done(function(response) {
                    var response = JSON.parse(response);
                    if (response.result == true) {
                        message(response.response, "success");
                    } else {
                        message(response.response, "danger");
                    }
                });
        });
    }

    var initSignin = function() {
        $("#btn-signin").on("click", function() {
            var _email = $("#signin-email").val();
            var _password = $("#signin-password").val();
            $.post("finish-signup.php", {email: _email, password: _password, login: true})
                .done(function(response) {
                    var response = JSON.parse(response);
                    if (response.result == true) {
                        message(response.response, "success");
                    } else {
                        message(response.response, "danger");
                    }
                });
        })
    }

    var initResetPassword = function() {
        $("#btn-reset-password").on("click", function() {
            var email = $("#forgot-email").val();
            if (emailPattern.test(email)) {
                $.post("finish-signup.php", {forgot_password: true, forgot_email: email})
                    .done(function(response) {
                        var response = JSON.parse(response);
                        if (response.result == true) {
                            message(response.response, "success");
                        } else {
                            message(response.response, "danger");
                        }
                    });
            } else {
                message("Invalid email!", "danger");
                return false;
            }
        });
    }

    var message = function(message, type) {
        $("#sa-message-body").html("");
        $("#sa-message-body").html('<p class="text-' + type + '">' + message + '</p>');
        $("#sa-message").modal();
    }

    return {
        init: function () {
            openSignupForm();
            openSigninForm();
            openForgotPasswordForm();
            openSigninPage();
            initSignup();
            initSignin();
            initResetPassword();
        }
    };

}(jQuery);