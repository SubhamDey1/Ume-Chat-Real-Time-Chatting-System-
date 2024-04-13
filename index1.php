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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <link href="css/signin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <header>Login Form</header>
            <form action="#" id="signin_form">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" id="email" placeholder="E-mail ID">
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" class="pass-key" id="password" placeholder="Password">
                </div>
                <div class="pass">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
                <div class="field" style="background-color: transparent;">
                    <!-- <input type="submit" value="LOGIN" id="login"> -->
                    <button type="submit" value="LOGIN" id="login">LOGIN</button>
                </div>
            </form>

            <br>
            <!-- <div class="login">Or login with</div> -->
            <!-- <div class="links">
        <div class="facebook">
          <i class="fab fa-facebook-f"><span>Facebook</span></i>
        </div>
        <div class="instagram">
          <i class="fab fa-instagram"><span>Instagram</span></i>
        </div>
      </div> -->
            <div class="signup">Don't have account?<br>
                <a href="signup.php" style="color:#fff;margin-top:12px;display: inline-block;">Signup Now</a>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {
            $("#signin_form").on("submit", function(event) {
                event.preventDefault();
                // $(".error-r").fadeOut();
                var email = $("#email").val().trim();
                var password = $("#password").val().trim();

                $.ajax({
                    url: "ajax_signin.php",
                    type: "POST",
                    beforeSend: function() {
                        $("#login").prepend("<span id='sp1'><i class='fas fa-spinner'></i></span>");
                    },
                    data: {
                        email: email,
                        password: password
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data.error == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'something went wrong'
                            });
                        } 
                        else {
                            var err = "";
                            if (data.email_e != true) {
                                err += '<div style="color:red;font-size: 20px;font-weight: 600;margin: 10px 0px;">'+data.email_e+'</div>';
                            }
                            if (data.password_e != true) {
                                err += '<div style="color:red;font-size: 20px;font-weight: 600;margin: 10px 0px;">'+data.password_e+'</div>';
                            }
                            if(err != "") {
                                Swal.fire({
                                    icon: 'warning',
                                    html: err
                                });
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
                            }
                        }
                        $("#login #sp1").remove();
                    }
                });
            });
        });
    </script>

</body>

</html>