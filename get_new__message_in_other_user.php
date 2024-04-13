<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $info = array();
        
        if(isset($_POST['r_id']) && isset($_POST['current_user_message_data_id']) && isset($_POST['dark_mode'])) {
            $info['error'] = 1;
            require_once "conn.php";
            require "time_ago.php";

            $conn = connected() or die("Connection Failed");

            $current_user_id = mysqli_real_escape_string($conn,trim($_POST['r_id']));
            $dark_mode  = $_POST['dark_mode'];
            $current_user_message_data_id =  $_POST['current_user_message_data_id'];

            if(!isset($_SESSION)) {
                session_start();
            }
            $login_user_id = $_SESSION['user_id'];

            // current_user_check
            $sql_check = "SELECT user_name,user_id,user_email,profileImage,bio,last_login FROM user_c WHERE (user_id!=$login_user_id AND user_id = $current_user_id)";
            mysqli_set_charset($conn,'utf8mb4');
            $mysqli_result_check = mysqli_query($conn,$sql_check) or die("Query Failed check");

            if(mysqli_num_rows($mysqli_result_check) == 1) {
                $info["current_user_check"] = true;

                $arr_check = mysqli_fetch_assoc($mysqli_result_check);

                date_default_timezone_set("Asia/Kolkata");

                $info['user_name'] = $arr_check['user_name'];
                // $info['user_id'] = $arr_check['user_id'];
                $info['profileImage'] = $arr_check['profileImage'];
                $info['user_email'] = $arr_check['user_email'];
                $info['bio'] = $arr_check['bio'];

                $last_login_time =  $arr_check['last_login'];
                $last_login_status = "";

                $current_timestamp_ = time();
                if($last_login_time == 0) {
                    $last_login_status = "Offline";
                }
                else if($last_login_time > $current_timestamp_) {
                    $last_login_status = "Online";
                }
                else {
                    $last_login_status = "last seen at ".time_ago($last_login_time - 2);

                }
                $info['last_login_status'] = $last_login_status;

                $dark_mode_class_chat_send = "";
                $dark_mode_class_chat_recive = "";
                $download_icon_class = "";
                if($dark_mode == "1") {
                    $dark_mode_class_chat_send = "chat_sent_dark_mode_style";
                    $dark_mode_class_chat_recive = "chat_message_and_time_dark_mode_style";
                    $download_icon_class = "download_icon_dark_mode_style";
                }

                $q = "SELECT message_id,message,img_video_or_doc_name_s,type,document_name,date,sender_id,receiver_id,mess_status FROM message WHERE (sender_id = $login_user_id AND receiver_id = $current_user_id) OR (sender_id = $current_user_id AND receiver_id = $login_user_id) ORDER BY date";
                mysqli_set_charset($conn,'utf8mb4');
                $result = mysqli_query($conn,$q) or die("Query Failed");
                $info['message__data'] = "";
                if(mysqli_num_rows($result)>0) {
                    $current_user_message_data_id_arr = explode("/",$current_user_message_data_id);

                    while($arr = mysqli_fetch_assoc($result)) {
                        $current_mess_user_id_enc = sha1($arr['message_id']);

                        $sender_id = $arr['sender_id'];
                        $receiver_id = $arr['receiver_id'];

                        if(in_array($current_mess_user_id_enc,$current_user_message_data_id_arr)) {
                            continue;
                        }
                        else {
                            if($login_user_id == $sender_id && $current_user_id == $receiver_id) {
                                continue;
                            }
                            else {
                                $timestamp = $arr['date'];

                                $date = time_ago($timestamp);

                                $current_user_message_data_id = sha1($arr['message_id'])."/".$current_user_message_data_id;

                                if($arr['type'] == "message") {
                                    $info['message__data'] .= "<div class='chat_message_and_time chat_message_and_time_light_mode_style $dark_mode_class_chat_recive'>
                                                                    <div class='chat_message_ d-flex align-items-center'>
                                                                        {$arr['message']}
                                                                    </div>
                                                                    <span class='chat-timestamp'>$date</span>
                                                                </div>";
                                }
                                else if($arr['type'] == "images_videos") {
                                    $set_post_img_video = explode(",",$arr["img_video_or_doc_name_s"]);
                                    $image_video__ele = "";
                                    foreach($set_post_img_video as $image_video_name__s) {
                                        $file_extension = explode(".",$image_video_name__s)[1];
                                        
                                        $img_extension = array("jpg","jpeg","png","gif");
                
                                        if(in_array($file_extension,$img_extension)) {
                                            $image_video__ele .= "<img src='message_img_video_or_doc/$image_video_name__s'>";
                                        }
                                        else {
                                            $image_video__ele .= "<video src='message_img_video_or_doc/$image_video_name__s' controls></video>";
                                        }
                                    }
                                    $info['message__data'] .= "<div class='chat_message_and_time img_video_outer_ele_ chat_message_and_time_light_mode_style $dark_mode_class_chat_recive'>
                                                                <div class='mess_img_video_style__set'>
                                                                    $image_video__ele
                                                                </div>
                                                                <span class='chat-timestamp'>$date</span>
                                                            </div>";
                                }
                                else if($arr['type'] == "documents") {
                                    $set_post_document = explode(",",$arr["img_video_or_doc_name_s"]);
                                    $document_name_arr = explode(",",$arr["document_name"]);
                                    $document__ele = "";
                                    $i = 0;
                                    foreach($set_post_document as $document_name__s) {
                                        $document__ele .= "<div class='chat_message_and_time img_video_outer_ele_ chat_message_and_time_light_mode_style $dark_mode_class_chat_recive'>
                                                            <div class='document_style_post_set d-flex justify-content-center align-items-center'>
                                                                <div class='doc_content d-flex align-items-center'>
                                                                    <div class='document_icon d-flex align-items-center'>
                                                                        <span class='material-symbols-outlined'>
                                                                            description
                                                                        </span>
                                                                    </div>
                                                                    <div class='document_name'>{$document_name_arr[$i]}</div>
                                                                </div>
                                                                <button data-document_src='$document_name__s' class='download_icon download_icon_light_mode_style $download_icon_class'>
                                                                    <i class='fas fa-download'></i>
                                                                </button>
                                                            </div>
                                                            <span class='chat-timestamp'>$date</span>
                                                        </div>";
                                        $i++;
                                    }
                                    $info['message__data'] .= $document__ele;
                                }
                            }
                        }
                    }
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