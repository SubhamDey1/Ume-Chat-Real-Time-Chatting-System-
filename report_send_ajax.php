<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $info = array();
        if(isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['message'])) {
            $info["error"]=1;
            require_once "conn.php";
            $conn = connected() or die("Connection Failed");
            $user_name = mysqli_real_escape_string($conn,trim($_POST['user_name']));
            $email = mysqli_real_escape_string($conn,trim($_POST['email']));
            $phone = mysqli_real_escape_string($conn,trim($_POST['phone']));
            $message = mysqli_real_escape_string($conn,trim($_POST['message']));

            $valid_user_name = 0;
            $valid_email = 0;
            $valid_phone = 0;
            $valid_message = 0;

            //user_name checker
            if($user_name == "" ) {
                $info['name_e'] = "Enter the Report UserName.";
                $valid_user_name = 0;
            }
            else if(preg_match_all("/[@_!#$%\^\-+=&,\.\"*\/\(\)\\<>\[\]?\`|}{~:0-9]/m",$user_name)) {
                $info['name_e'] = "Sorry, Report Username allowed characters only letters (a-z) or (A-Z).";
                $valid_user_name = 0;
            }
            else if(preg_match("/^[a-zA-Z ]{3,30}$/",$user_name)) {
                $info['name_e'] = true;
                $valid_user_name = 1;
            }
            else {
                $info['name_e'] = "Sorry, Report Username must be between 3 and 30 characters long.";
                $valid_user_name = 0;
            }

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

            // phone checker
            if($phone == "" ) {
                $info['phone'] = "Enter the Phone No.";
                $valid_phone = 0;
            }
            else if(preg_match("/^[6-9]{1}[0-9]{9}$/",$phone)) {
                $info['phone'] = true;
                $valid_phone = 1;
            }
            else {
                $info['phone'] = "Enter The Valid Phone No OR Phone No. Not Include +91.";
                $valid_phone = 0;
            }

            // message checker
            if($message == "" ) {
                $info['message'] = "Enter the Message.";
                $valid_message = 0;
            }
            else {
                $info['message'] = true;
                $valid_message = 1;
            }

            $info['success'] = 0;
            if($valid_user_name==1 && $valid_email==1 && $valid_phone==1 && $valid_message==1) {
                $sql = "INSERT INTO report_user(report_username,email,phone,message) VALUES('$user_name','$email','$phone','$message')";

                mysqli_query($conn,$sql) or die("Query Failed");

                include('smtp/PHPMailerAutoload.php');
                $msg = "<h1 style=margin-bottom:0;text-align:center;background:#0d6efd;color:#fff;font-family:Arial,Helvetica,sans-serif;padding:10px>WebChat Report Form</h1><h3 style='margin:0;padding:15px 10px;text-align:center;background:#198754;color:#fff;font-family:Arial,Helvetica,sans-serif'>Report Username : $user_name</h3><h3 style='margin:0;padding:15px 10px;text-align:center;background:#198754;color:#fff;font-family:Arial,Helvetica,sans-serif'>Email : $email</h3><h3 style='margin:0;padding:15px 10px;text-align:center;background:#198754;color:#fff;font-family:Arial,Helvetica,sans-serif'>Phone No. : $phone</h3><h3 style='margin:0;padding:15px 10px;text-align:center;background:#198754;color:#fff;font-family:Arial,Helvetica,sans-serif'>Message : $message</h3>";

                $subject = "WebChat Report Form";
                $to = "rupamsubham.16@gmail.com";

                $mail = new PHPMailer(); 
                $mail->SMTPDebug  = 0;
                $mail->IsSMTP(); 
                $mail->SMTPAuth = true; 
                $mail->SMTPSecure = 'tls'; 
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587; 
                $mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Username = "";
                $mail->Password = "";
                $mail->SetFrom("");
                $mail->Subject = $subject;
                $mail->Body =$msg;
                $mail->AddAddress($to);
                $mail->SMTPOptions=array('ssl'=>array(
                    'verify_peer'=>false,
                    'verify_peer_name'=>false,
                    'allow_self_signed'=>false
                ));
                if(!$mail->Send()){
                    echo $mail->ErrorInfo;
                }
                else{
                    // echo "<br>send e-mail";
                    // $otp_modal_show = true;
                    $info['success'] = 1;
                    // $info['email_content'] = "Let us know that this email address belongs to you. Enter the code from the email sent to <b>".$email."</b>";
                }
            }
            mysqli_close($conn);
        }
        else {
            $info["error"]=0;
        }
        echo json_encode($info);
    }
?>