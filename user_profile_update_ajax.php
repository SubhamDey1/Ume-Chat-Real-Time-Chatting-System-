<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $info = array();
        if(isset($_POST['profile__name']) && isset($_POST['profile__bio']) && isset($_FILES['profile_img'])) {
            $info['error'] = 1;
            require_once "conn.php";
            $conn = connected() or die("Connection Failed");
            $profile__name = mysqli_real_escape_string($conn,trim($_POST['profile__name']));
            $profile__bio = mysqli_real_escape_string($conn,trim($_POST['profile__bio']));

            $profile_image_error = $_FILES['profile_img']['error'];

            $valid_name = 0;
            $valid_bio = 0;
            $valid_profile_image = 0;

            if (!isset($_SESSION)) {
                session_start();
            }
            $login_user_id = $_SESSION['user_id'];

            //profile__name checker
            if($profile__name == "" ) {
                $info['name_e'] = "Enter the Name.";
                $valid_name = 0;
            }
            else if(preg_match_all("/[@_!#$%\^\-+=&,\.\"*\/\(\)\\<>\[\]?\`|}{~:0-9]/m",$profile__name)) {
                // $info['name_e'] = "Sorry, only letters (a-z) or (A-Z) allowed.";
                $info['name_e'] = "Sorry, Your name allowed characters only letters (a-z) or (A-Z).";
                $valid_name = 0;
            }
            else if(preg_match("/^[a-zA-Z ]{3,30}$/",$profile__name)) {
                $info['name_e'] = true;
                $valid_name = 1;
            }
            else {
                $info['name_e'] = "Sorry, your name must be between 3 and 30 characters long.";
                $valid_name = 0;
            }

            // bio checker
            if($profile__bio == "") {
                $info['profile__bio_e'] = "Enter the Bio.";
                $valid_bio = 0;
            }
            else {
                $info['profile__bio_e'] = true;
                $valid_bio = 1;
            }

            $profile_image_name = "";
            $profile_image_tmp_name = "";
            //profile_image checker
            if($profile_image_error == 0) {
                $info['profile_image_select_state'] = true;

                $profile_image_name = mt_rand(100,10000)."_".time()."_".$_FILES['profile_img']['name'];
                $profile_image_extension = pathinfo($_FILES['profile_img']['name'])['extension'];
                $profile_image_tmp_name = $_FILES['profile_img']['tmp_name'];

                $valid_extension = array("jpg","jpeg","png","gif");

                if(in_array($profile_image_extension,$valid_extension)) {
                    $info["profile_image_extension_status"] = true;

                    $valid_profile_image = 1;
                }
                else {
                    $info["profile_image_extension_status"] = "Please choose Allowed Image Type - jpg,jpeg,png,gif";
                    $valid_profile_image = 0;
                }
            }
            else {
                $info['profile_image_select_state'] = false;
                $valid_profile_image = 1;
            }

            $info['success'] = 0;
            if($valid_name == 1 && $valid_bio == 1 && $valid_profile_image == 1) {
                $info['success'] = 1;

                if($info['profile_image_select_state'] == true) {
                    $sql_get_login_user_details = "SELECT profileImage FROM user_c WHERE user_id=$login_user_id";
                    $result_get_login_user_details = mysqli_query($conn,$sql_get_login_user_details) or die("Query Failed get_login_user_details");
                    $arr_get_login_user_details = mysqli_fetch_assoc($result_get_login_user_details);
                    $old_profile_img = $arr_get_login_user_details['profileImage'];

                    $sql_update_user = "UPDATE user_c SET user_name='$profile__name',profileImage='$profile_image_name',bio='$profile__bio' WHERE user_id=$login_user_id";
                    mysqli_query($conn,$sql_update_user) or die("Query Failed update_user");

                    move_uploaded_file($profile_image_tmp_name,"img/profile_img/"."$profile_image_name");
                    unlink("img/profile_img/".$old_profile_img);

                    $info['profile_image_name'] = $profile_image_name;
                }
                else {
                    $sql_update_user = "UPDATE user_c SET user_name='$profile__name',bio='$profile__bio' WHERE user_id=$login_user_id";
                    mysqli_query($conn,$sql_update_user) or die("Query Failed update_user");
                }
                
                $_SESSION['user_name'] = $profile__name;
                $info['user_name'] = $profile__name;

            }
            mysqli_close($conn);
        }
        else {
            $info['error'] = 0;
        }
        echo json_encode($info);
    }
?>