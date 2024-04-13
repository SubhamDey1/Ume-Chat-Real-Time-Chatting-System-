<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $info = array();
        if(isset($_POST['message']) && isset($_POST['r_id']) && isset($_POST['dark_mode']) && isset($_POST['current_user_message_data_id'])) {
            $info['error'] = 1;
            require_once "conn.php";
            require "time_ago.php";
            $conn = connected() or die("Connection Failed");
            $message = trim($_POST['message']);
            $receiver_id = mysqli_real_escape_string($conn,trim($_POST['r_id']));
            $dark_mode = $_POST['dark_mode'];
            $current_user_message_data_id = trim($_POST['current_user_message_data_id']);
            

            if(!isset($_SESSION)) {
                session_start();
            }
            $login_user_id = $_SESSION['user_id'];

            // current_user_check
            $sql_check = "SELECT user_name FROM user_c WHERE (user_id!=$login_user_id AND user_id = $receiver_id)";
            $mysqli_result_check = mysqli_query($conn,$sql_check) or die("Query Failed check");
            if(mysqli_num_rows($mysqli_result_check) == 1) {
                $info["current_user_check"] = true;
                

                if($message == "<div><br></div><div><br></div>" || $message == "<div><br></div>" || $message == "") {
                    $info['message_status'] = "type a message";
                }
                else {
                    $info['message_status'] = true;
                    if(str_ends_with($message,"<div><br></div>")) {
                        $em = strlen($message) - strlen("<div><br></div>");
        
                        $message = substr($message,0,$em);
                    }
    
                    $dark_mode_class_chat_send = "";
                    if($dark_mode == "1") {
                        $dark_mode_class_chat_send = "chat_sent_dark_mode_style";
                    }
        
                    date_default_timezone_set("Asia/Kolkata");
                    $timestamp = time();
                    $date = time_ago($timestamp);

                    $message_id = time() . "_" . mt_rand(100, 100000) . "_" . mt_rand(200, 90000)."_".date("s");

                    $current_user_message_data_id = sha1($message_id)."/".$current_user_message_data_id;
        
                    $q = "INSERT INTO message(message_id,message,type,date,sender_id,receiver_id,mess_status) VALUES('$message_id','$message','message','$timestamp',$login_user_id,$receiver_id,1)";
                    mysqli_set_charset($conn,'utf8mb4');
                    mysqli_query($conn,$q) or die(mysqli_error($conn)." Query Failed");
                    $info['message'] =  "<div class='chat_message_and_time chat_sent chat_sent_light_mode_style $dark_mode_class_chat_send'>
                                            <div class='chat_message_ d-flex align-items-center'>
                                                $message
                                            </div>
                                            <span class='chat-timestamp'>$date</span>
                                        </div>";
                    $info['mess'] = $message;
                }

            }
            else {
                $info["current_user_check"] = "Something Went Wrong | No User Found | Reload The Page";
            }
            $info['current_user_message_data_id'] = $current_user_message_data_id;
            mysqli_close($conn);
        }
        else {
            $info['error'] = 0;
        }
        echo json_encode($info);
    }
?>