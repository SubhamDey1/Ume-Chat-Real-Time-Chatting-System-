<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $info = array();
        if (isset($_POST["search_value"]) && isset($_POST['dark_mode'])) {
            $info['error'] = 1;
            require_once "conn.php";
            require "time_ago.php";
            $conn = connected() or die("Connection Failed");

            $search_value = mysqli_real_escape_string($conn,trim($_POST['search_value']));
            $dark_mode  = $_POST['dark_mode'];

            if(!isset($_SESSION)) {
                session_start();
            }
            $login_user_id = $_SESSION['user_id'];

            $dark_mode_class = "";
            if($dark_mode == "1") {
                $dark_mode_class = "other_user_p_style_dark_mode_style";
            }

            $q = "SELECT user_id,user_name,profileImage FROM user_c WHERE (user_id!=$login_user_id AND user_name LIKE '%$search_value%');";

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
                            $mess = "<svg viewBox='0 0 53 53' width='25' height='25' class=''><defs><circle id='image-SVGID_1_' cx='26.5' cy='26.5' r='25.5'></circle></defs><clipPath id='image-SVGID_2_'><use xlink:href='#image-SVGID_1_' overflow='visible'></use></clipPath><g clip-path='url(#image-SVGID_2_)'><path fill='#AC44CF' d='M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z'></path><path fill='#BF59CF' d='M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z'></path><path fill='#AC44CF' d='M17 24.5h18v9H17z'></path></g><g fill='#F5F5F5'><path id='svg-image' d='M18.318 18.25h16.364c.863 0 1.727.827 1.811 1.696l.007.137v12.834c0 .871-.82 1.741-1.682 1.826l-.136.007H18.318a1.83 1.83 0 0 1-1.812-1.684l-.006-.149V20.083c0-.87.82-1.741 1.682-1.826l.136-.007h16.364Zm5.081 8.22-3.781 5.044c-.269.355-.052.736.39.736h12.955c.442-.011.701-.402.421-.758l-2.682-3.449a.54.54 0 0 0-.841-.011l-2.262 2.727-3.339-4.3a.54.54 0 0 0-.861.011Zm8.351-5.22a1.75 1.75 0 1 0 .001 3.501 1.75 1.75 0 0 0-.001-3.501Z'></path></g></svg>&nbsp;&nbsp;Photo or Video";
                        }
                        else if($arr2['type'] == "documents") {
                            $mess = "<svg viewBox='0 0 53 53' width='25' height='25' class=''><defs><circle id='document-SVGID_1_' cx='26.5' cy='26.5' r='25.5'></circle></defs><clipPath id='document-SVGID_2_'><use xlink:href='#document-SVGID_1_' overflow='visible'></use></clipPath><g clip-path='url(#document-SVGID_2_)'><path fill='#5157AE' d='M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z'></path><path fill='#5F66CD' d='M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z'></path></g><g fill='#F5F5F5'><path id='svg-document' d='M29.09 17.09c-.38-.38-.89-.59-1.42-.59H20.5c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H32.5c1.1 0 2-.9 2-2V23.33c0-.53-.21-1.04-.59-1.41l-4.82-4.83zM27.5 22.5V18l5.5 5.5h-4.5c-.55 0-1-.45-1-1z'></path></g></svg>&nbsp;&nbsp;Document";
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
                $info['search_result'] = $user_data;
            }
            else {
                $info['search_result'] = "<div class='other_user_p_style_d d-flex justify-content-center align-items-center other_user_p_style_light_mode_style $dark_mode_class'>
                                            No Search User Found.
                                        </div>";
            }
        }
        else {
            $info['error'] = 0;
        }
        echo json_encode($info);
    }
?>