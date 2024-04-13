<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $info = array();

        require_once "conn.php";
        $conn = connected() or die("Connection Failed");

        if (!isset($_SESSION)) {
            session_start();
        }
        $login_user_id = $_SESSION["user_id"];

        $sql = "SELECT user_name,user_email,bio,profileImage FROM user_c WHERE user_id=$login_user_id";
        mysqli_set_charset($conn,'utf8mb4');
        $result_details = mysqli_query($conn,$sql) or die(mysqli_error($conn)." Query Failed get user details");

        $arr_get = mysqli_fetch_assoc($result_details);

        $info['profile_img_t'] = "img/profile_img/".$arr_get['profileImage'];
        $info["user_name"] = $arr_get['user_name'];
        $info["user_email"] = $arr_get['user_email'];
        $info["bio"] = $arr_get['bio'];

        mysqli_close($conn);
        echo json_encode($info);
    }
?>