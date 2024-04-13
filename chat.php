<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user_email'])) {
    header("Location:index.php");
}
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Ume-Chat</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="shortcut icon" type="image/jpg" href="img/img2/site_logo.png" />
        <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="css/emoji_style.css">
        <link rel="stylesheet" href="css/chat_style.css">
    </head>
    <body>
        <div id="loading_icon_show">
            <div id="loading_icon_sub">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(241, 242, 243); display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <g transform="translate(50 50)">
                    <g>
                        <animateTransform attributeName="transform" type="rotate" values="0;45" keyTimes="0;1" dur="0.2s" repeatCount="indefinite"></animateTransform><path d="M29.491524206117255 -5.5 L37.491524206117255 -5.5 L37.491524206117255 5.5 L29.491524206117255 5.5 A30 30 0 0 1 24.742744050198738 16.964569457146712 L24.742744050198738 16.964569457146712 L30.399598299691117 22.621423706639092 L22.621423706639096 30.399598299691114 L16.964569457146716 24.742744050198734 A30 30 0 0 1 5.5 29.491524206117255 L5.5 29.491524206117255 L5.5 37.491524206117255 L-5.499999999999997 37.491524206117255 L-5.499999999999997 29.491524206117255 A30 30 0 0 1 -16.964569457146705 24.742744050198738 L-16.964569457146705 24.742744050198738 L-22.621423706639085 30.399598299691117 L-30.399598299691117 22.621423706639092 L-24.742744050198738 16.964569457146712 A30 30 0 0 1 -29.491524206117255 5.500000000000009 L-29.491524206117255 5.500000000000009 L-37.491524206117255 5.50000000000001 L-37.491524206117255 -5.500000000000001 L-29.491524206117255 -5.500000000000002 A30 30 0 0 1 -24.742744050198738 -16.964569457146705 L-24.742744050198738 -16.964569457146705 L-30.399598299691117 -22.621423706639085 L-22.621423706639092 -30.399598299691117 L-16.964569457146712 -24.742744050198738 A30 30 0 0 1 -5.500000000000011 -29.491524206117255 L-5.500000000000011 -29.491524206117255 L-5.500000000000012 -37.491524206117255 L5.499999999999998 -37.491524206117255 L5.5 -29.491524206117255 A30 30 0 0 1 16.964569457146702 -24.74274405019874 L16.964569457146702 -24.74274405019874 L22.62142370663908 -30.39959829969112 L30.399598299691117 -22.6214237066391 L24.742744050198738 -16.964569457146716 A30 30 0 0 1 29.491524206117255 -5.500000000000013 M0 -20A20 20 0 1 0 0 20 A20 20 0 1 0 0 -20" fill="#e19c5b"></path></g></g>
                </svg>
            </div>
        </div>
        <div id="mess_main" class="d-flex">
            <div id="mess_header" class="mess_header_light_mode_style">
                <div id="user_profile_ele" class="d-flex justify-content-between align-items-center user_profile_ele_light_mode_style">
                    <div id="user_profile_name" class="d-flex justify-content-center align-items-center user_profile_name_light_mode_style">
                        <div class="user_p_ele">
                        <?php
                            require_once "conn.php";
                            $conn = connected() or die("Connection Failed");
                            $user_id = $_SESSION['user_id'];
                            $p_img = "";
                            $q = "SELECT profileImage FROM user_c WHERE user_id = $user_id";
                            $result = mysqli_query($conn, $q) or die("Query Failed " . mysqli_error($conn));
                            mysqli_close($conn);
                            if (mysqli_num_rows($result) > 0) {
                                $arr = mysqli_fetch_assoc($result);
                                $p_img = $arr['profileImage'];
                            }
                        ?>
                            <img src="<?php echo "img/profile_img/" . $p_img; ?>" alt="">
                        </div>
                        <div id="user__name"><?php echo $_SESSION['user_name']; ?></div>
                    </div>

                    <div class="chat-header-right" id="right-div">
                        <div id="tdot_a" class="profile-setting1 d-flex justify-content-center align-items-center">
                            <svg version="1.1" id="Capa_1" class="svg_dot_light_mode_style" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32.055 32.055" xml:space="preserve">
                                <g><path d="M3.968,12.061C1.775,12.061,0,13.835,0,16.027c0,2.192,1.773,3.967,3.968,3.967c2.189,0,3.966-1.772,3.966-3.967C7.934,13.835,6.157,12.061,3.968,12.061z M16.233,12.061c-2.188,0-3.968,1.773-3.968,3.965c0,2.192,1.778,3.967,3.968,3.967s3.97-1.772,3.97-3.967C20.201,13.835,18.423,12.061,16.233,12.061z M28.09,12.061c-2.192,0-3.969,1.774-3.969,3.967c0,2.19,1.774,3.965,3.969,3.965c2.188,0,3.965-1.772,3.965-3.965S30.278,12.061,28.09,12.061z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                            </svg>
                            <div id="setting2-mess" class="setting2_mess_light_mode_style">
                                <div id="setting2-mess-inner" class="d-flex justify-content-center align-items-center flex-column">
                                    <!-- <div class="sett-pro sett_pro_light_mode_style" id="sett_pro2">Settings</div> -->
                                    <a href="report_user.php" class="sett-pro sett_pro_light_mode_style" id="sett_pro1">Report User</a>
                                    <div class="sett-pro d-flex justify-content-between align-items-center sett_pro_light_mode_style" id="sett_pro4">
                                        <div class="dark_mode_e d-flex align-items-center">
                                            <i class="fas fa-moon"></i>
                                            <div class="dark_mode_name ms-2">Dark Mode</div>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="dark_mode_btn">
                                            <label class="form-check-label" for="dark_mode_btn"></label>
                                        </div>
                                    </div>
                                    <a href="logout.php" class="sett-pro sett_pro_light_mode_style" style="text-decoration: none;" id="sett_pro3">Log out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="search_ele">
                    <div id="search_ele_inner" class="search_ele_inner_light_mode_style">
                        <label for="search_input_ele">
                            <i class="fas fa-search search_i_ele_light_mode_style"></i>
                        </label>
                        <input type="text" placeholder="Search or start new chat" id="search_input_ele" class="search_input_ele_light_mode_style">
                    </div>
                </div>

                <div id="all_other_user1">
                    <div class="all_other_user_inner d-flex align-items-center flex-column">                        

                    </div>
                </div>

                <div id="all_other_user2">
                    <div class="all_other_user_inner d-flex align-items-center flex-column">

                    </div>
                </div>
            </div>
            <div id="mess_body" class="mess_body_light_mode_style">
              <div id="mess_body_bg_before" class="mess_body_bg_before_light_mode_style"></div>
                <div id="mess_body_click_user_mess_and_info">
                    <div id="mess_body_header" class="mess_body_inner_ele_ d-flex justify-content-between align-items-center mess_body_header_light_mode_style">
                        <div id="click_user_info_" class="d-flex align-items-center">
                            <div id="back_to_mess_header_outer_btn">
                                <div id="back_to_mess_header_btn" class="d-flex justify-content-center align-items-center back_to_mess_header_btn_light_mode_style">
                                    <i class="fas fa-arrow-left"></i>
                                </div>
                            </div>
                            <div id="click_user_profile_name" class="d-flex align-items-center click_user_profile_name_light_mode_style">
                                <div id="click_user_profile">
                                    <img src="img/profile_img/purba.jpeg" id="user_set_img_">
                                </div>
                                <div id="click_user_name_online" class="d-flex flex-column">
                                    <div id="click_user_name">Subham Day</div>
                                    <div id="click_user_online_offline">Offline</div>
                                </div>
                            </div>
                        </div>
                        <div id="click_user_info" class="d-flex justify-content-center align-items-center back_to_mess_header_btn_light_mode_style">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    </div>
                    <div id="mess_body_middle" class="mess_body_inner_ele_ d-flex flex-column">                        
            
                    </div>
                    <div id="mess_body_bottom" class="mess_body_inner_ele_">
                        <textarea id="message_send_by_input" class="message_send_by_input_c"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!--image zoom Modal -->
        <div class="modal fade" id="image_zoom_modal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="image_zoom_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modal__content__light_mode_style">
                    <div class="modal-header">
                        <button type="button" class="btn-close modal_close_icon_light_mode_style" id="image_zoom_modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col p-0 modal__col__light_mode_style" id="image_zoom_modal_col">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--login user details Modal -->
        <div class="modal fade" id="login_user_details" tabindex="-1" data-bs-backdrop="static" aria-labelledby="login_user_detailsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modal__content__light_mode_style">
                    <div class="modal-header">
                        <button type="button" class="btn-close modal_close_icon_light_mode_style" id="login_user_details_close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="container_modal_profile" class="container">
                            <div class="row justify-content-center align-items-center">
                                <div id="profile__img_ele" class="p-0 d-flex justify-content-center align-items-center profile__img_ele_c profile__img_ele_c_light_mode_style">
                                    <img id="profile__img_ele_img_profile_" src="img/profile_img/default.jpg">
                                    <label for="signup_profile_img" class="material-symbols-outlined">photo_camera</label>
                                    <input type="file" name="profile_img" id="signup_profile_img" class="form-control" style="display: none;" accept="image/png, image/jpeg,image/gif">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div id="profile__name_ele" class="p-0 profile__item d-flex align-items-center">
                                    <div class="form-floating w-100">
                                        <input type="text" name="profile__name" class="form-control profile__item__light_mode_style" id="profile__name" placeholder="Name">
                                        <label for="profile__name" class="profile__item__light_mode_style">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div id="profile__email_ele" class="p-0 profile__item d-flex align-items-center">
                                    <div class="form-floating w-100">
                                        <input type="email" class="form-control profile__item__light_mode_style" id="profile__email" placeholder="Email ID">
                                        <label for="profile__email" class="profile__item__light_mode_style">Email ID</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div id="profile__bio_ele" class="p-0 profile__item d-flex align-items-center">
                                    <div class="form-floating w-100">
                                        <textarea class="form-control profile__item__light_mode_style" name='profile__bio' placeholder="Bio" id="profile__bio"></textarea>
                                        <label for="profile__bio" class="profile__item__light_mode_style">Bio</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-primary" id="save__profile">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--current user details Modal -->
        <div class="modal fade" id="current_user_details" tabindex="-1" data-bs-backdrop="static" aria-labelledby="current_user_detailsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content modal__content__light_mode_style">
                    <div class="modal-header">
                        <button type="button" class="btn-close modal_close_icon_light_mode_style" id="current_user_details_close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div id="profile__img_ele2" class="p-0 d-flex justify-content-center align-items-center profile__img_ele_c profile__img_ele_c_light_mode_style">
                                    <img src="img/profile_img/default.jpg">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div id="profile__name_ele2" class="p-0 profile__item c_profile__item d-flex align-items-center">
                                    <div class="form-floating w-100">
                                        <input type="text" class="form-control profile__item__light_mode_style" id="profile__name2" placeholder="Name" value="demo">
                                        <label for="profile__name2" class="profile__item__light_mode_style">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div id="profile__email_ele2" class="p-0 profile__item c_profile__item d-flex align-items-center">
                                    <div class="form-floating w-100">
                                        <input type="email" class="form-control profile__item__light_mode_style" id="profile__email2" placeholder="Email ID" value="demo">
                                        <label for="profile__email2" class="profile__item__light_mode_style">Email ID</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div id="profile__bio_ele2" class="p-0 profile__item c_profile__item d-flex align-items-center">
                                    <div class="form-floating w-100">
                                        <textarea class="form-control profile__item__light_mode_style" name='profile__bio' placeholder="Bio" id="profile__bio2">Demo</textarea>
                                        <label for="profile__bio2" class="profile__item__light_mode_style">Bio</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script src="js/emoji_script.js"></script>
        <script src="js/sweetalert2.js"></script>

        <script>
            var clear_set_interval_new_message_in_other_user = "";
            var current_user_message_data_id = "";
            var check_new_message_in_other_user_f_call_status = 0;

            setInterval(function(){
                $.ajax({
                    url:"time_update_user.php",
                    type:"POST",
                    success:function(data) {}
                });
            },1000);

            function check_new_message_in_other_user() {
                var r_id = $("#click_user_name").attr("data-user_id_selectes").trim();
                if(r_id != 0) {
                    clear_set_interval_new_message_in_other_user = setInterval(function(){
                        var dark_mode = localStorage.getItem("dark_mode");
                        $.ajax({
                            url:"get_new__message_in_other_user.php",
                            type:"POST",
                            data:{
                                r_id:r_id,
                                current_user_message_data_id:current_user_message_data_id,
                                dark_mode:dark_mode
                            },
                            dataType:"json",
                            success:function(data) {
                                if (data.error == 0) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Something Went Wrong | Reload The Page'
                                    });
                                }
                                else {
                                    if(data.current_user_check == true) {
                                        setTimeout(function(){
                                            if(data.message__data != "") {
                                                $("#mess_body_middle").append(data.message__data);

                                                var child_ele = $("#mess_body_middle").children();
                                                var child_ele_height = 0;
                                                for (c_ele of child_ele) {
                                                    child_ele_height += Number(($(c_ele).css("height")).split("p")[0]);
                                                }
                                                $("#mess_body_middle").scrollTop(child_ele_height + 100000000000);
                                                
                                            }
                                            current_user_message_data_id = data.current_user_message_data_id;
                                            // console.log(current_user_message_data_id);
                    
                                            $(".user_details_in_message__top_img_text_ele").html(data.friend_profile_image);
                                            $(".user_details_in_message__top_friend_name").html(data.friend_user_name);
                                            // $(".user_details_in_message__top_friend_name").attr("data-current_fid",data.friend_user_id);
                                            $(".user_details_in_message__top_friend_online_status").html(data.last_login_status); 
                                        },1000);
                                        $("#click_user_name").html(data.user_name);
                                        // $("#click_user_name").attr("data-user_id_selectes", data.user_id);
                                        $("#user_set_img_").attr("src", "img/profile_img/" + data.profileImage);
                                        $("#click_user_online_offline").html(data.last_login_status);
                                    }
                                    else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: data.current_user_check
                                        });
                                    }
                                }
                            }
                        });
                    },1500);
                }
            }
        </script>

        <script src="js/chat_script.js"></script>

        <script>
            function call_set_interval_user_header() {
                setInterval(function(){
                    var dark_mode = localStorage.getItem("dark_mode");
                    $.ajax({
                        url: "get_user_header.php",
                        type: "POST",
                        // beforeSend:function(){
                        //     $("#loading_icon_show").fadeIn("fast");
                        // },
                        data:{
                            dark_mode:dark_mode
                        },
                        success: function(data) {
                            // $("#loading_icon_show").fadeOut("fast");
                            if(data == "0") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Something Went Wrong | Reload The Page'
                                });
                            }
                            else {
                                $("#all_other_user1 .all_other_user_inner").html(data);
                            }
                        }
                    });
                },2000);
            }
            $(document).ready(function(){

                $("#sett_pro4").click(function(){
                    var dark_mode_ele = document.getElementById("dark_mode_btn");
                    if (dark_mode_ele.checked == true){
                        dark_mode_ele.checked=false;
                        light_mode_style();
                    }
                    else {
                        dark_mode_ele.checked=true;
                        dark_mode_style();
                    }
                });
                $("#dark_mode_btn").click(function(event){
                    event.stopPropagation();
                    if (this.checked == true){
                        dark_mode_style();
                    }
                    else {
                        light_mode_style();
                    }
                });

                $("#user_profile_name").click(function(){
                    $.ajax({
                        url:"get_login_user__profile___details.php",
                        type:"POST",
                        dataType:"json",
                        success:function(data){
                            $("#profile__img_ele_img_profile_").attr("src",data.profile_img_t);
                            $("#profile__name").val(data.user_name);
                            $("#profile__email").val(data.user_email);
                            $("#profile__bio").val(data.bio);
                            $("#login_user_details").modal("show");
                        }
                    });
                });
                $("#click_user_info").click(function(){
                    $("#current_user_details").modal("show");
                });
                $("#click_user_profile_name").click(function(){
                    $("#current_user_details").modal("show");
                });
            
                
                get_user_header();
                call_set_interval_user_header();
                
                $(document).on("click",".other_user_p_style",function(){
                    var c_userid = $(this).attr("data-userid");
                    getMessage(c_userid);
                });

                $(document).on("keyup", ".message_send_by_input_c .emojionearea-editor", function(event) {
                    var mess = $(".message_send_by_input_c .emojionearea-editor").html();
                    if (mess != "") {
                        if (event.key == "Enter") {
                            send_message_(mess);
                        }
                    }
                });

                $(document).on("click","#send_message_btn_",function(){
                    var mess = $(".message_send_by_input_c .emojionearea-editor").html();
                    send_message_(mess);
                    $(".message_send_by_input_c .emojionearea-editor").focus();
                });

                $("#container_modal_profile").submit(function(event){
                    event.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        url:"user_profile_update_ajax.php",
                        type:"POST",
                        beforeSend: function() {
                            $("#loading_icon_show").fadeIn("fast");
                        },
                        data:formData,
                        dataType:"json",
                        contentType: false,
                        processData: false,
                        success:function(data){
                            $("#loading_icon_show").fadeOut("fast");
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
                                if (data.profile__bio_e != true) {
                                    error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.profile__bio_e + '</div>';
                                }
                                if (data.profile_image_select_state == true) {
                                    if (data.profile_image_extension_status != true) {
                                        error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.profile_image_extension_status + '</div>';
                                    }
                                }
                                if (error_message != "") {
                                    Swal.fire({
                                        icon: 'warning',
                                        html: error_message
                                    });
                                }
                                if (data.success == 1) {
                                    if(data.profile_image_select_state == true) {
                                        $("#user_profile_name .user_p_ele img").attr("src","img/profile_img/"+data.profile_image_name);
                                        $("#profile__img_ele img").attr("src","img/profile_img/"+data.profile_image_name);
                                    }
                                    $("#user_profile_name #user__name").html(data.user_name);
                                    $("#signup_profile_img").val("");
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Profile Update Successfull',
                                        showConfirmButton: false,
                                        timer: 1000
                                    });
                                }
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>