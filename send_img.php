<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // echo "</pre>";

        // changing the upload limits
        ini_set('upload_max_filesize', '500M');
        ini_set('post_max_size', '550M');
        ini_set('memory_limit', '1024M');
        ini_set('max_input_time', 300);
        ini_set('max_execution_time', 300);
        $info = array();
        if(((isset($_FILES['image_send_m'])) ||(isset($_FILES['document_send_m']))) && (isset($_POST['r_id'])) && (isset($_POST['dark_mode'])) && (isset($_POST['current_user_message_data_id']))) {
            $info['error'] = 1;
            $file_name = [];
            $file_type = [];
            $tmp_name = [];
            $files_name_s = "";
            $file_check_status = 0;

            require "time_ago.php";
            require_once "conn.php";
            $conn = connected() or die("Connection Failed");

            if(!isset($_SESSION)) {
                session_start();
            }
            $login_user_id = $_SESSION['user_id'];
            $receiver_id = $_POST['r_id'];
            $dark_mode = $_POST['dark_mode'];
            $current_user_message_data_id = trim($_POST['current_user_message_data_id']);

            // current_user_check
            $sql_check = "SELECT user_name FROM user_c WHERE (user_id!=$login_user_id AND user_id = $receiver_id)";
            $mysqli_result_check = mysqli_query($conn,$sql_check) or die("Query Failed check");
            if(mysqli_num_rows($mysqli_result_check) == 1) {
                $info["current_user_check"] = true;

                $dark_mode_class_chat_send = "";
                $download_icon_class = "";
                if($dark_mode == "1") {
                    $dark_mode_class_chat_send = "chat_sent_dark_mode_style";
                    $download_icon_class = "download_icon_dark_mode_style";
                }
                
                date_default_timezone_set("Asia/Kolkata");
                $timestamp = time();
                $date = time_ago($timestamp);
                $info["img_video"] = 0;
                $info["document"] = 0;

                if($_FILES['image_send_m']['error'][0] != 4) {
                    $no_of_file = count($_FILES["image_send_m"]["error"]);
                    $info["img_video"] = 1;
                    foreach($_FILES["image_send_m"] as $key => $inner_arr) {
                        if($key == "name") {
                            $file_name = $inner_arr;
                        }
                        else if($key == "type") {
                            $file_type = $inner_arr;
                        }
                        else if($key == "tmp_name") {
                            $tmp_name = $inner_arr;
                        }
                    }
    
                    for($i = 0;$i<$no_of_file;$i++) {
                        $filename = $file_name[$i];
                        $extension = pathinfo($filename)['extension'];
                        $valid_extension = array("jpg","jpeg","png","gif","mp4");
                        if(in_array($extension,$valid_extension)) {
                            $file_check_status = 1;
                            $files_name_s .= time()."_".mt_rand(1,10000)."_".$file_name[$i].",";
                            $info["file_check_status"] = true;   
                        }
                        else {
                            $file_check_status = 0;
                            $info["file_check_status"] = "Please choose Allowed File Type(Photo/Video) - jpg,jpeg,png,gif,mp4";
                            break;
                        }
                    }
                    if($file_check_status == 1) {
                        $files_name_s = substr($files_name_s,0,(strlen($files_name_s)-1));

                        $message_id = time() . "_" . mt_rand(100, 100000) . "_" . mt_rand(200, 90000)."_".date("s");

                        $current_user_message_data_id = sha1($message_id)."/".$current_user_message_data_id;

                        $sql = "INSERT INTO message(message_id,img_video_or_doc_name_s,type,date,sender_id,receiver_id,mess_status) VALUES('$message_id','$files_name_s','images_videos','$timestamp',$login_user_id,$receiver_id,1)";
                        mysqli_set_charset($conn,'utf8mb4');
                        mysqli_query($conn,$sql) or die("Query Failed");
    
                        $file_name = explode(",",$files_name_s);
                        $file_ele = "";
                        $inner_post_file_set = "";
    
                        for($i = 0;$i<$no_of_file;$i++) {
                            move_uploaded_file($tmp_name[$i],("message_img_video_or_doc/".$file_name[$i]));
                            $file_extension = pathinfo($file_name[$i])['extension'];
                            $img_extension = array("jpg","jpeg","png","gif");
    
                            if(in_array($file_extension,$img_extension)) {
                                $file_ele .= "<img src='message_img_video_or_doc/$file_name[$i]'>";
                            }
                            else {
                                $file_ele .= "<video preload='auto' src='message_img_video_or_doc/$file_name[$i]' controls></video>";
                            }
                        }
                        $info["file_data"] = "<div class='chat_message_and_time img_video_outer_ele_ chat_sent chat_sent_light_mode_style $dark_mode_class_chat_send'>
                                                    <div class='mess_img_video_style__set'>
                                                        $file_ele
                                                    </div>
                                                    <span class='chat-timestamp'>$date</span>
                                                </div>";
                    }
                }
    
                if($_FILES['document_send_m']['error'][0] != 4) {
                    $no_of_file = count($_FILES["document_send_m"]["error"]);
                    $info["document"] = 1;
                    $document_name = "";
    
                    foreach($_FILES["document_send_m"] as $key => $inner_arr) {
                        if($key == "name") {
                            $file_name = $inner_arr;
                        }
                        else if($key == "type") {
                            $file_type = $inner_arr;
                        }
                        else if($key == "tmp_name") {
                            $tmp_name = $inner_arr;
                        }
                    }
    
                    for($i = 0;$i<$no_of_file;$i++) {
                        $filename = $file_name[$i];
                        $extension = pathinfo($filename)['extension'];
                        $invalid_extension = array("js");
    
                        if(in_array($extension,$invalid_extension)) {
                            $file_check_status = 0;
                            $info["file_check_status"] = "Don't Allowed .js File";
                            break;
                        }
                        else {
                            $file_check_status = 1;
                            $files_name_s .= time()."_".mt_rand(1,10000)."_".$file_name[$i].",";
                            $document_name .= $file_name[$i].",";
                            $info["file_check_status"] = true;
                        }
                    }
    
                    if($file_check_status == 1) {
                        $files_name_s = substr($files_name_s,0,(strlen($files_name_s)-1));
                        $document_name = substr($document_name,0,(strlen($document_name)-1));

                        $message_id = time() . "_" . mt_rand(100, 100000) . "_" . mt_rand(200, 90000)."_".date("s");

                        $current_user_message_data_id = sha1($message_id)."/".$current_user_message_data_id;
    
                        $sql = "INSERT INTO message(message_id,img_video_or_doc_name_s,type,document_name,date,sender_id,receiver_id,mess_status) VALUES('$message_id','$files_name_s','documents','$document_name','$timestamp',$login_user_id,$receiver_id,1)";
                        mysqli_set_charset($conn,'utf8mb4');
                        mysqli_query($conn,$sql) or die("Query Failed");
    
                        $file_name = explode(",",$files_name_s);
                        $document_name_arr = explode(",",$document_name);
                        $document__ele = "";
    
                        for($i = 0;$i<$no_of_file;$i++) {
                            move_uploaded_file($tmp_name[$i],("message_img_video_or_doc/".$file_name[$i]));
                            
                            $document__ele .= "<div class='chat_message_and_time img_video_outer_ele_ chat_sent chat_sent_light_mode_style $dark_mode_class_chat_send'>
                                                    <div class='document_style_post_set d-flex justify-content-center align-items-center'>
                                                        <div class='doc_content d-flex align-items-center'>
                                                            <div class='document_icon d-flex align-items-center'>
                                                                <span class='material-symbols-outlined'>
                                                                    description
                                                                </span>
                                                            </div>
                                                            <div class='document_name'>{$document_name_arr[$i]}</div>
                                                        </div>
                                                        <button data-document_src='{$file_name[$i]}' class='download_icon download_icon_light_mode_style $download_icon_class'>
                                                            <i class='fas fa-download'></i>
                                                        </button>
                                                    </div>
                                                    <span class='chat-timestamp'>$date</span>
                                                </div>";
                        }
                        $info["file_data"] = $document__ele;
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