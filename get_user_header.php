<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['dark_mode'])) {
            $dark_mode  = $_POST['dark_mode'];
            require_once "conn.php";
            require "time_ago.php";
            $conn = connected() or die("Connection Failed");
            if(!isset($_SESSION)) {
                session_start();
            }
            $login_user_id = $_SESSION['user_id'];

            $dark_mode_class = "";
            if($dark_mode == "1") {
                $dark_mode_class = "other_user_p_style_dark_mode_style";
            }

            $q = "SELECT user_id,user_name,profileImage FROM user_c WHERE user_id != $login_user_id";
            $result = mysqli_query($conn,$q) or die("Query Failed");
            if(mysqli_num_rows($result)>0) {
                $user_data = "";
                while($arr = mysqli_fetch_assoc($result)) {
                    $current_user_id = $arr['user_id'];
                    $q2 = "SELECT message,type,date,sender_id,receiver_id,mess_status FROM message WHERE (sender_id = $login_user_id AND receiver_id = $current_user_id) OR (sender_id = $current_user_id AND receiver_id = $login_user_id) ORDER BY date DESC";
                    $result2 = mysqli_query($conn,$q2) or die("Query Failed");
                    $mess = ""; 
                    $date = "";
                    if(mysqli_num_rows($result2)>0) {
                        $arr2 = mysqli_fetch_assoc($result2);
                        
                        if($arr2['type'] == "message") {
                            $mess = $arr2['message'];
                        }
                        else if($arr2['type'] == "images_videos") {
                            $mess = "<img src='img/img2/photo_video.svg'>&nbsp;&nbsp;Photo or Video";
                        }
                        else if($arr2['type'] == "documents") {
                            $mess = "<img src='img/img2/document_icon_s.svg'>&nbsp;&nbsp;Document";
                        }
    
                        date_default_timezone_set("Asia/Kolkata");
                        $timestamp = $arr2['date'];
                        $date = time_ago($timestamp);
                    }

                    
                    $user_data .= "<div class='other_user_p_style d-flex justify-content-between align-items-center other_user_p_style_light_mode_style $dark_mode_class' data-userid='{$arr['user_id']}'>
                                        <div class='other_user_p_style_inner d-flex align-items-center'>
                                            <div class='other_user_p'>
                                                <img src='img/profile_img/{$arr['profileImage']}' alt=''>
                                            </div>
                                            <div class='chat-info d-flex flex-column'>
                                                <div class='other_user_name'>{$arr['user_name']}</div>
                                                <div class='user_send_recive_info'>
                                                    $mess
                                                </div>
                                            </div>
                                        </div>
                                        <div class='send_recive_time d-flex align-items-center'>$date</div>
                                    </div>";
                }
                echo $user_data;
            }
            else {
                echo "<div class='other_user_p_style_d d-flex justify-content-center align-items-center other_user_p_style_light_mode_style $dark_mode_class'>
                            No Record Found
                        </div>";
            }
            mysqli_close($conn);
        }
        else {
            echo "0";
        }
    }
?>