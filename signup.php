<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user_email'])) {
    header("Location:chat.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- style.css -->
    <link rel="stylesheet" href="css/signup.css">

    <title>Sign up</title>
</head>

<body>
    <div class="main"></div>
    <form action="#" class="container main2" id="signup_form">
        <div class="row justify-content-center">
            <div class="col-md-5 sub-main-m py-3">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <h2>Sign up</h2>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter the Name">
                        <span class="error-r" id="error1">Error text</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="email" class="form-label">E-mail ID</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter the E-mail ID">
                        <span class="error-r" id="error2">Error text</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter the Password">
                        <span class="error-r" id="error3">Error text</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" id="dob" style="user-select: none;">
                        <span class="error-r" id="error4">Error text</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="phone" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option selected value="1">Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span class="error-r" id="error5">Error text</span>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn" id="signup">Sign up</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col d-flex justify-content-center">
                        <a href="index.php" style="color:#fff;">Already Member?</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark bg-gradient">
                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <button type="button" id="close_modal1" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <h5 class="modal-title text-white" id="modal1Label">Enter the OTP from your email</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="otp_input" class="form-label">Verification OTP</label>
                                <input type="text" class="form-control" name="dob" id="otp_input">
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

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {
            $("#signup_form").on("submit", function(event) {
                event.preventDefault();
                $(".error-r").fadeOut();
                var name = $("#name").val().trim();
                var email = $("#email").val().trim();
                var password = $("#password").val().trim();
                var dob = $("#dob").val().trim();
                var gender = $("#gender").val().trim();

                $.ajax({
                    url: "ajax_signup.php",
                    type: "POST",
                    data: {
                        name: name,
                        email: email,
                        password: password,
                        dob: dob,
                        gender: gender
                    },
                    beforeSend: function() {
                        $("#signup").prepend("<span id='sp1' class='spinner-border spinner-border-sm me-2' role='status' aria-hidden='true'></span>");
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#signup #sp1").remove();
                        // console.log(data);
                        if (data.error == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'something went wrong'
                            });
                        } else {
                            if (data.name_e != true) {
                                $("#error1").fadeIn();
                                $("#error1").html(data.name_e);
                            }
                            if (data.email_e != true) {
                                $("#error2").fadeIn();
                                $("#error2").html(data.email_e);
                            }
                            if (data.password_e != true) {
                                $("#error3").fadeIn();
                                $("#error3").html(data.password_e);
                            }
                            if (data.age_e != true) {
                                $("#error4").fadeIn();
                                $("#error4").html(data.age_e);
                            }
                            if (data.gender_e != true) {
                                $("#error5").fadeIn();
                                $("#error5").html(data.gender_e);
                            }
                            if (data.success == 1) {
                                $(".error-r").fadeOut();
                                $("#name").val("");
                                $("#email").val("");
                                $("#password").val("");
                                $("#dob").val("");
                                $("#gender").val(1);
                                $("#modal1").modal("show");
                                // $("#email_content").html(data.email_content);
                            }
                        }
                    }
                });
            });
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
                        $("#verify_otp_btn").prepend("<span id='sp2' class='spinner-border spinner-border-sm me-2' role='status' aria-hidden='true'></span>");
                    },
                    success: function(data) {
                        $("#verify_otp_btn #sp2").remove();
                        if (data.error == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'something went wrong'
                            });
                        } 
                        else {
                            if (data.otp_info != true) {
                                $("#email_otp_error").text(data.otp_info);
                                $("#email_otp_error").css("color", "rgb(255,55,55)");
                            } else {
                                $("#otp_input").val("");
                                $("#email_otp_error").css("color","#0d6efd");
                                $("#modal1").modal("hide");
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Account Creatrd Successfully',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                        }
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
        });
    </script>
</body>

</html>