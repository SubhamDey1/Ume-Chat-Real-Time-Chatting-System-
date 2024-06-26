<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $info = array();
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['captcha_code']) && isset($_POST['captcha_code_ele'])) {
            require_once "conn.php";
            $conn = connected() or die("Connection Failed");
            $email = mysqli_real_escape_string($conn,trim($_POST['email']));
            $password = mysqli_real_escape_string($conn,trim($_POST['password']));
            $captcha_code = mysqli_real_escape_string($conn,trim($_POST['captcha_code']));
            $captcha_code_ele = mysqli_real_escape_string($conn,trim($_POST['captcha_code_ele']));

            $valid_email = 0;
            $valid_pass = 0;
            $valid_captcha_code = 0;

            // email checker
            if($email == "" ) {
                $info['email_e'] = "Enter the Email ID.";
                $valid_email = 0;
            }
            else if(preg_match("/^[a-z][a-z0-9_\.]+\@[a-z]{2,}(\.[a-z]{2,5}){1,2}$/",$email)) {
                $info['email_e'] = true;
                $valid_email = 1;
            }
            else {
                $info['email_e'] = "Enter the valid Email ID.";
                $valid_email = 0;
            }

            // password checker
            if($password == "") {
                $info['password_e'] = "Enter the Password.";
                $valid_pass = 0;
            }
            else {
                $info['password_e'] = true;
                $valid_pass = 1;
            }

            //captcha_code validation check
            if($captcha_code_ele == "") {
                $valid_captcha_code = 0;
                $info['captcha_code_e'] = "Enter The Captcha Code.";
            }
            else if($captcha_code == $captcha_code_ele) {
                $valid_captcha_code = 1;
                $info['captcha_code_e'] = true;
            }
            else {
                $valid_captcha_code = 0;
                $info['captcha_code_e'] = "Enter The Valid Captcha Code.";
            }

            if($valid_email == 1 && $valid_pass == 1 && $valid_captcha_code == 1) {
                $password = md5($password);
                $q = "SELECT user_id,user_name,user_email from user_c WHERE BINARY user_email='$email' and BINARY password='$password'";
                $result = mysqli_query($conn,$q) or die("Query Failed");
                if(mysqli_num_rows($result)>0) {
                    while($arr = mysqli_fetch_assoc($result)) {
                        if(!isset($_SESSION)) {
                            session_start();
                            session_regenerate_id();
                        }
                        $_SESSION['user_id'] = $arr['user_id'];
                        $_SESSION['user_name'] = $arr['user_name'];
                        $_SESSION['user_email'] = $arr['user_email'];
                    }
                    $info['success'] = 1;
                }
                else {
                    $info['success'] = 0;
                }
            }
            mysqli_close($conn);
        }
        else {
            $info["error"] = 0;
        }
        echo json_encode($info);
    }
?>