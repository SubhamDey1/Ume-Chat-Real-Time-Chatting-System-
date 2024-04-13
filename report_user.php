<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user_email'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Admin | Ume-Chat</title>
    <link rel="stylesheet" href="css/report_style.css" />
    <link rel="shortcut icon" type="image/jpg" href="img/img2/site_logo.png" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <style>
        #sp1 i {
            animation: rotate_ani 1s linear 0s infinite normal;
            font-size: 22px;
            margin-right: 10px;
            color: #000;
        }

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
        <span class="big-circle"></span>
        <img src="img/img2/shape.png" class="square" alt="" />
        <div class="form">
            <div class="contact-info">
                <h3 class="title">Let's get in touch</h3>
                <p class="text">
                    Bengal College of Engineering and Technology
                </p>

                <div class="info">
                    <div class="information">
                        <img src="img/img2/location.png" class="icon" alt="" />
                        <p>Sahid Sukumar Banerjee Sarani, Bidhannagar, Durgapur, West Bengal 713212</p>
                    </div>
                    <div class="information">
                        <img src="img/img2/email.png" class="icon" alt="" />
                        <p>rupamsubham.16@gmail.com</p>
                    </div>
                    <div class="information">
                        <img src="img/img2/phone.png" class="icon" alt="" />
                        <p>123-456-789</p>
                    </div>
                </div>

                <div class="social-media">
                    <p>Connect with us :</p>
                    <div class="social-icons">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <span class="circle one"></span>
                <span class="circle two"></span>

                <form action="#" autocomplete="off" id="report_form">
                    <h3 class="title">Contact To Admin</h3>
                    <div class="input-container">
                        <input type="text" name="name" id="user_name" class="input" />
                        <label for="">Report Username</label>
                        <span>Report Username</span>
                    </div>
                    <div class="input-container">
                        <input type="email" name="email" id="email" class="input" />
                        <label for="">Email</label>
                        <span>Email</span>
                    </div>
                    <div class="input-container">
                        <input type="tel" name="phone" id="phone" class="input" />
                        <label for="">Phone</label>
                        <span>Phone</span>
                    </div>
                    <div class="input-container textarea">
                        <textarea name="message" id="message" class="input"></textarea>
                        <label for="">Message</label>
                        <span>Message</span>
                    </div>
                    <!-- <input type="submit" value="Send" class="btn" /> -->
                    <button type="submit" class="btn" id="send_form">Send</button>
                    <a href="chat.php" class="btn" style="padding: 6.4px 17px; text-decoration: none;margin-left: 10px;">Back</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="js/report_script.js"></script>
    <script src="js/sweetalert2.js"></script>

    <script>
        $(document).ready(function() {

            $("#report_form").on("submit", function(event) {
                event.preventDefault();
                var user_name = $("#user_name").val().trim();
                var email = $("#email").val().trim();
                var phone = $("#phone").val().trim();
                var message = $("#message").val().trim();

                $.ajax({
                    url: "report_send_ajax.php",
                    type: "POST",
                    data: {
                        user_name: user_name,
                        email: email,
                        phone: phone,
                        message: message
                    },
                    beforeSend: function() {
                        $("#send_form").prepend("<span id='sp1'><i class='fas fa-spinner'></i></span>");
                        document.getElementById("send_form").disabled = true;
                    },
                    dataType: "json",
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
                            }
                            if (data.email_e != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.email_e + '</div>';
                            }
                            if (data.phone != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.phone + '</div>';
                            }
                            if (data.message != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.message + '</div>';
                            }
                            if (error_message != "") {
                                Swal.fire({
                                    icon: 'warning',
                                    html: error_message
                                });
                            }
                            if (data.success == 1) {
                                $("#user_name").val("");
                                $("#email").val("");
                                $("#phone").val("");
                                $("#message").val("");

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Report Send Successfully',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            }
                        }
                        $("#send_form #sp1").remove();
                        document.getElementById("send_form").disabled = false;
                    }
                });


            });

        });
    </script>
</body>

</html>