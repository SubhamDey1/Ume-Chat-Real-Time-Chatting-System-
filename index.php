<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user_email'])) {
    header("Location:chat.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_index.css" />
    <link rel="shortcut icon" type="image/jpg" href="img/img2/site_logo.png" />
    <title>Sign in & Sign up Form | Ume-Chat</title>
    <style>
        #sp1 i {
            animation: rotate_ani 1s linear 0s infinite normal;
            font-size: 22px;
            margin-right: 10px;
            color: #fff;
        }
        #profile_label_img_name {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }
        #captcha_code_name {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            user-select: none;
        }
        #captcha_code {
            width: 148px;
            letter-spacing: 11px;
            background-color: #000;
            color: #fff;
            /* padding: 5px 2px 5px 10px; */
            padding: 5px 0px;
            border-radius: 6px;
        }
        #reload_captcha_code {
            width: 30px;
            height: 30px;
            margin: 0px 0px 0px 14px;
            box-shadow: 0px 0px 4px 2px #000;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.08s linear 0s;
        }
        #reload_captcha_code:active {
            transform: scale(1.1);
        }
        #reload_captcha_code i {
            line-height: 0px;
            color: #000000ba;
        }
        /* .input-field #login_show_password {
            background-color: ;
            outline: none;
            border: 1px solid rgba(0,0,0,.25);
            line-height: 1;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }
        .input-field_s {
            background-color: transparent;
        } */
        @keyframes rotate_ani {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">


                <form action="#" class="sign-in-form" id="signin_form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <!-- <input type="text" placeholder="Username" /> -->
                        <input type="text" id="email" placeholder="E-mail ID">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <!-- <input type="password" placeholder="Password" /> -->
                        <input type="password" class="pass-key" id="password" placeholder="Password">
                    </div>
                    <div class="input-field_s">
                        <div class="input-field_s_inner d-flex justify-content-end align-items-center">
                            <input type="checkbox" class="form-check-input m-0 me-2" id="login_show_password">
                            <label for="login_show_password">Show password</label>
                        </div>
                    </div>
                    <div class="input-field" style="grid-template-columns: 100%;">
                        <div id="captcha_code_name">
                            <div id="captcha_c_name">Captcha Code :</div>
                            <div id="captcha_code_and_reload" class="d-flex align-items-center">
                                <div id="captcha_code" class="d-flex justify-content-center"></div>
                                <div id="reload_captcha_code" class="d-flex justify-content-center align-items-center">
                                    <i class="fas fa-redo"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-closed-captioning"></i>
                        <input type="password" class="pass-key" id="captcha_code_ele" placeholder="Enter The Captcha Code">
                    </div>
                    <!-- <input type="submit" value="Login" class="btn solid" /> -->
                    <button type="submit" value="LOGIN" class="btn solid" id="login">LOGIN</button>
                    <a href="forgot_password.php" class="login__forgot">Forgot password?</a>
                </form>


                <form action="#" class="sign-up-form" id="signup_form">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <!-- <input type="text" placeholder="Username" /> -->
                        <input type="text" id="signup_name" placeholder="Enter the Name">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <!-- <input type="email" placeholder="Email" /> -->
                        <input type="email" id="signup_email" placeholder="Enter the E-mail ID">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <!-- <input type="password" placeholder="Password" /> -->
                        <input type="password" id="signup_password" placeholder="Enter the Password">
                    </div>
                    <div class="input-field_s">
                        <div class="input-field_s_inner d-flex justify-content-end align-items-center">
                            <input type="checkbox" class="form-check-input m-0 me-2" id="signup_show_password">
                            <label for="signup_show_password">Show password</label>
                        </div>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-calendar"></i>
                        <input type="date" id="signup_dob" class="form-control">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-check-circle"></i>
                        <select id="signup_gender" class="form-select">
                            <option selected value="1">Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user-circle"></i>
                        <label for="signup_profile_img" id="profile_label_img_name">Choose Your Profile Image</label>
                        <input type="file" name="profile_img" id="signup_profile_img" class="form-control" style="display: none;" accept="image/png, image/jpeg,image/gif">
                    </div>
                    <!-- <input type="submit" class="btn" value="Sign up" /> -->
                    <button type="submit" class="btn" id="signup">Sign up</button>
                </form>


            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Create An Account,</h3>
                    <p>
                        Signup to get Started !
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/img2/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Welcome Member,</h3>
                    <p>
                        Now you can signIn to
                        Continue.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="img/img2/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light bg-gradient">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col d-flex justify-content-end p-0">
                                <button type="button" id="close_modal1" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <h5 class="modal-title" id="modal1Label">Enter the OTP from your email</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="otp_input" class="form-label">Verification OTP</label>
                                <input type="text" class="form-control mb-2" name="dob" id="otp_input" autocomplete="off" placeholder="Enter The Verification OTP">
                                <span id="email_otp_error">OTP has been sent to Your E-mail ID(Check the email in the Inbox or Spam category)</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <button id="verify_otp_btn" class="btn">Verify OTP</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    <script src="js/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {
            var captcha_code = "";

            $("#login_show_password").click(function() {
                var password = document.getElementById("password");
                if (password.type == "password") {
                    password.type = "text";
                } else {
                    password.type = "password";
                }
            });

            $("#signup_show_password").click(function() {
                var password = document.getElementById("signup_password");
                if (password.type == "password") {
                    password.type = "text";
                } else {
                    password.type = "password";
                }
            });

            //captcha_code_generator
            function captcha_code_generator_() {
                $.ajax({
                    url:"captcha_code_generator.php",
                    type:"POST",
                    success:function(data) {
                        captcha_code = data;
                        $("#captcha_code").html(captcha_code);
                    }
                })
            }
            captcha_code_generator_();

            $("#reload_captcha_code").click(function(){
                captcha_code_generator_();
            });

            // login --------------
            $("#signin_form").on("submit", function(event) {
                event.preventDefault();
                // $(".error-r").fadeOut();
                var email = $("#email").val().trim();
                var password = $("#password").val().trim();
                var captcha_code_ele = $("#captcha_code_ele").val().trim();
                
                $.ajax({
                    url: "ajax_signin.php",
                    type: "POST",
                    beforeSend: function() {
                        $("#login").prepend("<span id='sp1'><i class='fas fa-spinner'></i></span>");
                        document.getElementById("login").disabled = true;
                    },
                    data: {
                        email: email,
                        password: password,
                        captcha_code:captcha_code,
                        captcha_code_ele:captcha_code_ele
                    },
                    dataType: "json",
                    success: function(data) {
                        // console.log(data);
                        if (data.error == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Something Went Wrong'
                            });
                        } else {
                            var err = "";
                            if (data.email_e != true) {
                                err += '<div style="color:red;font-size: 20px;font-weight: 600;margin: 10px 0px;">' + data.email_e + '</div>';
                            }
                            if (data.password_e != true) {
                                err += '<div style="color:red;font-size: 20px;font-weight: 600;margin: 10px 0px;">' + data.password_e + '</div>';
                            }
                            if (data.captcha_code_e != true) {
                                err += '<div style="color:red;font-size: 20px;font-weight: 600;margin: 10px 0px;">' + data.captcha_code_e + '</div>';
                            }
                            if (err != "") {
                                Swal.fire({
                                    icon: 'warning',
                                    html: err
                                });
                                captcha_code_generator_();
                            }
                            if (data.success == 1) {
                                $("#email").val("");
                                $("#password").val("");
                                location.replace("chat.php");
                            } 
                            else if (data.success == 0) {
                                Swal.fire({
                                    icon: 'warning',
                                    html: '<span style="color:red;font-size: 20px;font-weight: 600;">Invalid email id or password<span>'
                                });
                                captcha_code_generator_();
                            }
                        }
                        $("#login #sp1").remove();
                        document.getElementById("login").disabled = false;
                    }
                });
            });
            // ////////////// login --------------





            // signup ------------

            $("#signup_form").on("submit", function(event) {
                event.preventDefault();
                // $(".error-r").fadeOut();
                var name = $("#signup_name").val().trim();
                var email = $("#signup_email").val().trim();
                var password = $("#signup_password").val().trim();
                var dob = $("#signup_dob").val().trim();
                var gender = $("#signup_gender").val().trim();

                var formData = new FormData(this);
                formData.append("name", name);
                formData.append("email", email);
                formData.append("password", password);
                formData.append("dob", dob);
                formData.append("gender", gender);

                $.ajax({
                    url: "ajax_signup.php",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        $("#signup").prepend("<span id='sp1' class='spinner-border spinner-border-sm me-2' role='status' aria-hidden='true'></span>");
                        document.getElementById("signup").disabled = true;
                    },
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.error == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'something went wrong'
                            });
                        }
                        else {
                            var error_message = "";
                            if (data.name_e != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.name_e + '</div>';
                                // $("#error1").fadeIn();
                                // $("#error1").html(data.name_e);
                            }
                            if (data.email_e != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.email_e + '</div>';
                                // $("#error2").fadeIn();
                                // $("#error2").html(data.email_e);
                            }
                            if (data.password_e != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.password_e + '</div>';
                                // $("#error3").fadeIn();
                                // $("#error3").html(data.password_e);
                            }
                            if (data.age_e != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.age_e + '</div>';
                                // $("#error4").fadeIn();
                                // $("#error4").html(data.age_e);
                            }
                            if (data.gender_e != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.gender_e + '</div>';
                                // $("#error5").fadeIn();
                                // $("#error5").html(data.gender_e);
                            }
                            if (data.profile_img_select_state != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.profile_img_select_state + '</div>';
                            }
                            else {
                                if (data.profile_image_extension_status != true) {
                                    error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.profile_image_extension_status + '</div>';
                                }
                            }
                            if (error_message != "") {
                                Swal.fire({
                                    icon: 'warning',
                                    html: error_message
                                });
                            }
                            if (data.success == 1) {
                                // $(".error-r").fadeOut();
                                $("#signup_name").val("");
                                $("#signup_email").val("");
                                $("#signup_password").val("");
                                $("#signup_dob").val("");
                                $("#signup_gender").val(1);
                                $("#signup_profile_img").val("");
                                $("#modal1").modal("show");
                                // $("#email_content").html(data.email_content);
                            }
                        }
                        $("#signup #sp1").remove();
                        document.getElementById("signup").disabled = false;
                    }
                });
            });

            // /////////// signup ----------



            // otp -------------
            $("#verify_otp_btn").on("click", function() {
                var otp_get = $("#otp_input").val().trim();
                $.ajax({
                    url: "otp_verify.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        otp: otp_get
                    },
                    beforeSend: function() {
                        $("#verify_otp_btn").prepend("<span id='sp1' class='spinner-border spinner-border-sm me-2' role='status' aria-hidden='true'></span>");
                        document.getElementById("verify_otp_btn").disabled = true;
                    },
                    success: function(data) {
                        $("#verify_otp_btn #sp1").remove();
                        if (data.error == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'something went wrong'
                            });
                        } 
                        else {
                            if (data.otp_info != true) {
                                // $("#email_otp_error").text(data.otp_info);
                                var error_message = '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.otp_info + '</div>';
                                Swal.fire({
                                    icon: 'warning',
                                    html: error_message
                                });
                                // $("#email_otp_error").css("color", "rgb(255,55,55)");
                            } 
                            else {
                                $("#otp_input").val("");
                                // $("#email_otp_error").css("color","#0d6efd");
                                $("#modal1").modal("hide");
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Account Creatrd Successfully',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                        }
                        document.getElementById("verify_otp_btn").disabled = false;
                    }
                });
            });
            $("#close_modal1").click(function() {
                $.ajax({
                    url: "session_delete.php",
                    type: "POST",
                    success: function(data) {
                        // console.log(data);
                    }
                });
            });
            // ///////////// otp -----------
        });
    </script>
</body>

</html>