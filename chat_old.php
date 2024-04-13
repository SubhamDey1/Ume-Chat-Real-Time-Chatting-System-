<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user_email'])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">

    <!-- <link rel="shortcut icon" type="image/jpg" href="img/img2/chat.png" /> -->
    <link rel="shortcut icon" type="image/jpg" href="img/img2/site_logo.png" />
    <link rel="stylesheet" href="css/emoji_style.css">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Ume-Chat</title>

    <style>
        .emojionearea {
            /* background-color: skyblue !important; */
            background: #80808000 !important;
            padding: 0px !important;
        }

        #all_doc_outer img {
            width: 20px;
            height: 20px;
        }

        .emojionearea-editor {
            /* max-height: 52px !important; */
            /* max-height: 41.43px !important; */
            height: 48px !important;
            background-color: #fff !important;
            padding: 10px !important;
            /* border-radius: 18px !important; */
            border-radius: 6px !important;
            width: 88% !important;
            caret-color: #000 !important;
            color: #000 !important;
            box-shadow: 0px 0px 4px 2px #0000008c !important;
            word-break: break-word !important;
        }

        .emojionearea .emojionearea-editor:before {
            color: #787878;
        }

        .emojionearea-picker.emojionearea-picker-position-top {
            top: -10px !important;
            /* background: #426978 !important; */
            background: gray !important;
        }

        .chat-message .emojioneemoji {
            width: 24px;
            height: 24px;
            margin: 0px 1px;
        }

        .chat-info .emojioneemoji {
            width: 24px;
            height: 24px;
            margin: 0px 1px;
        }

        .document_send_m {
            width: 36%;
            user-select: none;
        }

        .document_style_post_set {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .doc_content {
            display: flex;
            align-items: center;
        }

        .document_icon span {
            font-size: 36px;
            font-weight: 900;
        }

        .document_name {
            margin-left: 4px;
        }

        .download_icon {
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 0px solid #787878;
            width: 36px;
            height: 36px;
            border-radius: 50%;
        }

        #loading_icon_show {
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0px;
            left: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            /* z-index: 1000; */
            z-index: 100000000;
            display: none;
        }

        #loading_icon_sub {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #user_profile_name {
            display: flex;
            align-items: center;
            justify-content: center;
            user-select: none;
        }

        #user__name {
            margin-left: 12px;
            font-weight: bold;
            font-size: 18px;
        }

        #sett_pro1 {
            text-decoration: none;
        }

        #profile_modal {
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0px;
            left: 0px;
            /* background-color: #787878; */
            /* z-index: 10000000; */
            z-index: 100;
            display: none;
        }

        #modal_profile_con {
            width: 100%;
            height: 100vh;
            background-color: #78787752;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #container_modal_profile {
            width: 600px;
            /* height: 200px; */
            background-color: #808080e6;
            border-radius: 16px;
        }

        #user_profile_name {
            background: #70666638;
            padding: 6px 10px;
            border-radius: 24px;
            cursor: pointer;
        }

        #profile_modal_close {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px;
        }

        #profile_modal_close span {
            background-color: #ffffffb5;
            border-radius: 50%;
            padding: 3px;
            cursor: pointer;
            user-select: none;
            transition: background-color 0.2s linear 0s;
        }

        #profile_modal_close span:hover {
            background-color: #ffffffde;
        }

        #profile__img_ele {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #user__profile {
            width: 90px;
            height: 90px;
            position: relative;
        }

        #profile__img_ele img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            user-select: none;
        }

        #user__profile span,#user__profile label {
            position: absolute;
            bottom: 0px;
            right: 0px;
            background-color: #000000eb;
            color: #fff;
            padding: 5px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            user-select: none;
        }

        #profile__details {
            margin: 10px;
        }

        .profile__item {
            display: flex;
            margin: 16px 0px;
            align-items: center;
            justify-content: center;
        }

        .profile__item label {
            width: 18%;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
        }

        .profile__item input {
            padding: 8px 10px;
            border-radius: 10px;
            border: 1px solid #000;
            outline: none;
            width: 66%;
            font-size: 18px;
            font-weight: 600;
        }
        .profile__item #profile__bio {
            resize: none;
            padding: 8px 10px;
            font-size: 18px;
            font-weight: 500;
            width: 66%;
            height: 130px;
            border-radius: 10px;
            border: 1px solid #000;
            outline: none;
        }
        #save_ele {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0px;
        }
        #save__profile {
            padding: 10px 15px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 14px;
            border: 2px solid #000;
            background-color: #2c2cd5d9;
            color: #fff;
            cursor: pointer;
        }
        .chat-message {
            word-break: break-word;
        }
    </style>
</head>

<body>
    <div id="loading_icon_show">
        <div id="loading_icon_sub">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#0a0a0a" stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round">
                    <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
                </circle>
                <circle cx="50" cy="50" r="23" stroke-width="8" stroke="#28292f" stroke-dasharray="36.12831551628262 36.12831551628262" stroke-dashoffset="36.12831551628262" fill="none" stroke-linecap="round">
                    <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 50;-360 50 50"></animateTransform>
                </circle>
            </svg>
        </div>
    </div>
    <div class="sidebar">
        <div class="header">
            <div id="user_profile_name">
                <div class="avatar">
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
                <!-- <div id="status" class="profile-setting1">
                    <img src="img/img2/circle-notch-solid.svg" alt="">
                </div>
                <div id="chat1" class="profile-setting1">
                    <img src="img/img2/chat.svg" alt="">
                </div> -->
                <div id="tdot_a" class="profile-setting1">
                    <img src="img/img2/more.svg" alt="">
                    <div id="setting2-mess">
                        <!-- <div class="sett-pro" id="sett_pro2">Settings</div> -->
                        <a href="report_user.php" class="sett-pro" id="sett_pro1">Report User</a>
                        <a href="logout.php" class="sett-pro" style="text-decoration: none;" id="sett_pro3">Log out</a>
                        <!-- <div class="sett-pro" id="sett_pro3">Log out</div> -->
                    </div>
                </div>
            </div>
        </div>

        

        <div class="sidebar-search">
            <div class="sidebar-search-container">
                <img src="img/img2/search-solid.svg" alt="">
                <input type="text" placeholder="Search or start new chat">
            </div>
        </div>


        <div class="sidebar-chats" id="chat_insert">
            <!-- <div class="sidebar-chat">
                <div class="chat-avatar">
                    <img src="avatar4.jpg" alt="">
                </div>
                <div class="chat-info">
                    <h4>Purba Ghosh</h4>
                    <p>How are you?</p>
                </div>
                <div class="time">
                    <p>2:44 pm</p>
                </div>
            </div> -->



            <!-- <div class="sidebar-chat chat_header">
                <div class="chat-avatar">
                    <img src="img/img2/avatar3.jpg" alt="">
                </div>
                <div class="chat-info">
                    <h4>Subham Dey</h4>
                    <p>Please reply</p>
                </div>
                <div class="time">
                    <p>2:44 pm</p>
                </div>
            </div> -->


            <!-- <div class='sidebar-chat chat_header' data-userid=''>
                <div class='chat-avatar'>
                    <img src='img/img2/avatar3.jpg' alt=''>
                </div>
                <div class='chat-info'>
                    <h4>Subham Dey</h4>
                    <p>Please reply</p>
                </div>
                <div class='time'>
                    <p>2:44 pm</p>
                </div>
            </div> -->

        </div>
    </div>
    <div class="message-container" id="color_ele">
        <div class="header hide_item_ele">
            <div class="chat-title">
                <!--Hide-->
                <div class="avatar">
                    <img src="img/img2/avatar3.jpg" id="user_set_img_">
                </div>
                <div class="message-header-content">
                    <h4 id="user_name_set" data-user_id_selectes=''>Subham Dey</h4>
                    <p>online</p>
                </div>
            </div>
            <div class="chat-header-right">
                <img src="img/img2/more.svg" alt="">
                <!-- <img src="search-solid.svg" alt=""> -->
            </div>
        </div>
        <div class="message-content hide_item_ele" id="message_c">
            <!-- <p class='chat-message'>Hey John! What are you doing now?<span class='chat-timestamp'>11:33 pm</span></p>
            <p class='chat-message chat-sent'>Waiting for the bus <span class='chat-timestamp'>11:34 pm</span></p>
            <p class="chat-message">Shall I come and pickup you?<span class='chat-timestamp'>11:35 pm</span></p>
            <p class="chat-message">I Have a new bike <span class='chat-timestamp'>11:38 pm</span></p>
            <p class="chat-message chat-sent">Wow very nice. Who gave it to you? <span class='chat-timestamp'>11:40 pm</span></p>
            <p class="chat-message">It is a gift from my uncle <span class='chat-timestamp'>11:41 pm</span></p>
            <p class="chat-message">Black color <span class='chat-timestamp'>11:41 pm</span></p>
            <p class="chat-message">Japan make. Brand new and very beautiful than your fathers' one <span class='chat-timestamp'>11:33 pm</span></p>
            <p class="chat-message chat-sent">This is a message <span class='chat-timestamp'>11:33 pm</span></p>
            <p class="chat-message chat-sent">This is a message <span class='chat-timestamp'>11:33 pm</span></p> -->
        </div>
        <div class="message-footer hide_item_ele">
            <textarea id="message_send_by_input" cols="30" rows="10"></textarea>
        </div>
    </div>

    <!--image zoom Modal -->
    <div id="image_zoom_modal">
        <div id="modal_con">
            <div id="close_modal">
                <span class="material-icons">clear</span>
            </div>
            <div id="image_modal">

            </div>
        </div>
    </div>


    <div id="profile_modal">
        <div id="modal_profile_con">
            <form id="container_modal_profile">
                <div id="profile_modal_close">
                    <span class="material-icons">clear</span>
                </div>
                <div id="profile__img_ele">
                    <div id="user__profile">

                        <?php
                        require_once "conn.php";
                        $conn = connected() or die("Connection Failed");
                        $user_id = $_SESSION['user_id'];
                        $p_img = "";
                        $user_bio = "";
                        $q = "SELECT profileImage,bio FROM user_c WHERE user_id = $user_id";
                        $result = mysqli_query($conn, $q) or die("Query Failed " . mysqli_error($conn));
                        mysqli_close($conn);
                        if (mysqli_num_rows($result) > 0) {
                            $arr = mysqli_fetch_assoc($result);
                            $p_img = $arr['profileImage'];
                            $user_bio = $arr['bio'];
                        }
                        ?>
                        <img src="<?php echo "img/profile_img/" . $p_img; ?>" alt="">
                        <label for="signup_profile_img" class="material-symbols-outlined">
                            photo_camera
                        </label>
                        <input type="file" name="profile_img" id="signup_profile_img" class="form-control" style="display: none;" accept="image/png, image/jpeg,image/gif">
                    </div>
                </div>
                <div id="profile__details">
                    <div id="profile__name_ele" class="profile__item">
                        <label for="profile__name">Name : </label>
                        <input type="text" name="profile__name" id="profile__name" value="<?php echo $_SESSION['user_name']; ?>">
                    </div>
                    <div id="profile__email_ele" class="profile__item">
                        <label for="profile__email">Email ID : </label>
                        <input type="email" id="profile__email" value="<?php echo $_SESSION['user_email']; ?>" disabled>
                    </div>
                    <div id="profile__name_ele" class="profile__item">
                        <label for="profile__bio">Bio : </label>
                        <textarea id="profile__bio" name='profile__bio'><?php echo $user_bio; ?></textarea>
                    </div>
                    <div id="save_ele">
                        <button type="submit" id="save__profile">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="js/emoji_script.js"></script>
    <script src="js/sweetalert2.js"></script>

    <script>
        var setting2_mess_popup = 0;
        document.getElementById("tdot_a").addEventListener("click", function(event) {
            event.stopPropagation();
            if(setting2_mess_popup == 0) {
                this.style.backgroundColor = "rgba(0, 0, 0, 0.267)";
                document.getElementById("setting2-mess").style.display = "flex";
                setting2_mess_popup = 1;
            }
            else {
                document.getElementById("setting2-mess").style.display = "none";
                document.getElementById("tdot_a").style.backgroundColor = "";
                setting2_mess_popup = 0;
            }     
        });
        window.addEventListener("click", function() {
            if (setting2_mess_popup == 1) {
                document.getElementById("setting2-mess").style.display = "none";
                document.getElementById("tdot_a").style.backgroundColor = "";
                setting2_mess_popup = 0;
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var video_play_state_in_modal = 0;
            var all_doc_inner_popup = 0;

            $("#message_send_by_input").emojioneArea({
                tonesStyle: "radio",
                // searchPosition: "bottom",
                pickerPosition: 'top',
                // filtersPosition: "bottom",
                placeholder: "type message",
                // useInternalCDN: true,
            });
            setTimeout(function() {
                // $("#text_input + .emojionearea").prepend("<div id='ma' class='me-2'></div>");

                $("#message_send_by_input + .emojionearea").prepend(`<div id="all_doc_outer">
                        <img src="img/img2/paper-clip.svg" alt="" id="all_doc_img">
                        <form id="all_doc_inner">
                            <label for="document_send_m" title="Document">
                                <svg viewBox="0 0 53 53" width="53" height="53" class=""><defs><circle id="document-SVGID_1_" cx="26.5" cy="26.5" r="25.5"></circle></defs><clipPath id="document-SVGID_2_"><use xlink:href="#document-SVGID_1_" overflow="visible"></use></clipPath><g clip-path="url(#document-SVGID_2_)"><path fill="#5157AE" d="M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z"></path><path fill="#5F66CD" d="M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z"></path></g><g fill="#F5F5F5"><path id="svg-document" d="M29.09 17.09c-.38-.38-.89-.59-1.42-.59H20.5c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H32.5c1.1 0 2-.9 2-2V23.33c0-.53-.21-1.04-.59-1.41l-4.82-4.83zM27.5 22.5V18l5.5 5.5h-4.5c-.55 0-1-.45-1-1z"></path></g></svg>
                            </label>
                            <input id="document_send_m" name="document_send_m[]" accept="*" type="file" multiple="" style="display: none;">

                            <label for="image_send_c" title="Photo & Video">
                                <svg viewBox="0 0 53 53" width="53" height="53" class=""><defs><circle id="image-SVGID_1_" cx="26.5" cy="26.5" r="25.5"></circle></defs><clipPath id="image-SVGID_2_"><use xlink:href="#image-SVGID_1_" overflow="visible"></use></clipPath><g clip-path="url(#image-SVGID_2_)"><path fill="#AC44CF" d="M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z"></path><path fill="#BF59CF" d="M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z"></path><path fill="#AC44CF" d="M17 24.5h18v9H17z"></path></g><g fill="#F5F5F5"><path id="svg-image" d="M18.318 18.25h16.364c.863 0 1.727.827 1.811 1.696l.007.137v12.834c0 .871-.82 1.741-1.682 1.826l-.136.007H18.318a1.83 1.83 0 0 1-1.812-1.684l-.006-.149V20.083c0-.87.82-1.741 1.682-1.826l.136-.007h16.364Zm5.081 8.22-3.781 5.044c-.269.355-.052.736.39.736h12.955c.442-.011.701-.402.421-.758l-2.682-3.449a.54.54 0 0 0-.841-.011l-2.262 2.727-3.339-4.3a.54.54 0 0 0-.861.011Zm8.351-5.22a1.75 1.75 0 1 0 .001 3.501 1.75 1.75 0 0 0-.001-3.501Z"></path></g></svg>
                            </label>
                            <input id="image_send_c" accept="image/png, image/jpeg,image/gif,video/mp4" name="image_send_m[]" type="file" multiple="multiple" style="display: none;">
                        </form>
                    </div>`);
                $(".emojionearea-button").css("order", "-100");
                $(".emojionearea-button").css("margin-right", "8px");

                $("#message_send_by_input + .emojionearea").append(`<div id='audio_record' class='ms-3 me-2'><svg viewBox="0 0 24 24" width="24" height="24" class=""><path fill="currentColor" d="M11.999 14.942c2.001 0 3.531-1.53 3.531-3.531V4.35c0-2.001-1.53-3.531-3.531-3.531S8.469 2.35 8.469 4.35v7.061c0 2.001 1.53 3.531 3.53 3.531zm6.238-3.53c0 3.531-2.942 6.002-6.237 6.002s-6.237-2.471-6.237-6.002H3.761c0 4.001 3.178 7.297 7.061 7.885v3.884h2.354v-3.884c3.884-.588 7.061-3.884 7.061-7.885h-2z"></path></svg></div>`);
                $("#all_doc_outer").click(function(event) {
                    event.stopPropagation();
                    if(all_doc_inner_popup == 0) {
                        $("#all_doc_inner").fadeIn("fast");
                        all_doc_inner_popup = 1;
                    }
                    else {
                        $("#all_doc_inner").fadeOut("fast");
                        all_doc_inner_popup = 0;
                    }
                });
                $("#image_send_c").change(function(event) {
                    $("#all_doc_inner").submit();
                });
                $("#document_send_m").change(function(event) {
                    $("#all_doc_inner").submit();
                });
                $("#all_doc_inner").submit(function(event) {
                    event.preventDefault();
                    var r_id = $("#user_name_set").attr("data-user_id_selectes").trim();
                    var formData = new FormData(this);
                    formData.append("r_id", r_id);
                    $.ajax({
                        url: "send_img.php",
                        type: "POST",
                        beforeSend: function() {
                            $("#loading_icon_show").fadeIn("fast");
                        },
                        dataType: "json",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            // console.log(data);
                            if (data.error == 0) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'something went wrong'
                                });
                                // console.log("hh");
                            } 
                            else {
                                if ((data.img_video == 1)) {
                                    if (data.file_check_status != true) {
                                        Swal.fire({
                                            icon: 'warning',
                                            html: '<span style="color:red;font-size: 20px;font-weight: 600;">' + data.file_check_status + '<span>'
                                        });
                                    } else {
                                        $("#message_c").append(data.file_data);
                                    }
                                } 
                                else if (data.document == 1) {
                                    if (data.file_check_status != true) {
                                        Swal.fire({
                                            icon: 'warning',
                                            html: '<span style="color:red;font-size: 20px;font-weight: 600;">' + data.file_check_status + '<span>'
                                        });
                                    } else {
                                        $("#message_c").append(data.file_data);
                                    }
                                }
                            }
                            $("#image_send_c").val("");
                            $("#document_send_m").val("");
                            $("#loading_icon_show").fadeOut("fast");

                            var child_ele = $("#message_c").children();
                            var child_ele_height = 0;
                            for (c_ele of child_ele) {
                                child_ele_height += Number(($(c_ele).css("height")).split("p")[0]);
                            }
                            // console.log(child_ele_height);
                            $("#message_c").scrollTop(child_ele_height + 100000000000);
                        }
                    });
                });
            }, 1000);

            // $("#image_zoom_modal").click(function() {
            //     $("#image_zoom_modal").fadeOut(400);
            // });
            $("#modal_con").click(function(event) {
                event.stopPropagation();
            })
            $("#close_modal span").click(function() {
                $("#image_zoom_modal").fadeOut(400);
                if (video_play_state_in_modal == 1) {
                    document.querySelector("#image_modal video").pause();
                    document.querySelector("#image_modal video").currentTime = 0;
                    video_play_state_in_modal = 0;
                }
            });

            $(document).on("click", ".img_style_post_set img", function(event) {
                var ele = $(this).clone();
                $("#image_zoom_modal").fadeIn(400);
                $("#image_modal").html(ele);
            });
            $(document).on("click", ".img_style_post_set video", function(event) {
                event.preventDefault();
                // document.querySelectorAll(".img_style_post_set video").pause();
                for (var ele_video of document.querySelectorAll(".img_style_post_set video")) {
                    ele_video.pause();
                }
                // $(this).pause();
                // this.currentTime = 0;
                var ele = $(this).clone();
                $("#image_zoom_modal").fadeIn(400);
                $("#image_modal").html(ele);
                document.querySelector("#image_modal video").play();
                video_play_state_in_modal = 1;
            });

            function get_user_header() {
                $.ajax({
                    url: "get_user_header.php",
                    type: "POST",
                    success: function(data) {
                        $("#chat_insert").html(data);
                    }
                });
            }
            $(window).click(function() {
                if(all_doc_inner_popup == 1) {
                    $("#all_doc_inner").fadeOut("fast");
                    all_doc_inner_popup = 0;
                }
            });




            function getMessage(c_userid) {
                $.ajax({
                    url: "mess_get.php",
                    type: "POST",
                    data: {
                        c_userid: c_userid
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#message_c").html(data.message__data);
                        // console.log(data);
                        $("#user_name_set").html(data.user_name);
                        $("#user_name_set").attr("data-user_id_selectes", data.user_id);
                        $("#user_set_img_").attr("src", "img/profile_img/" + data.profileImage);
                    }
                });
            }
            get_user_header();
            getMessage(1);

            // setInterval(get_user_header, 10000);
            // setInterval(function() {
            //     var c_userid = $("#user_name_set").attr("data-user_id_selectes");
            //     $.ajax({
            //         url: "mess_get.php",
            //         type: "POST",
            //         data: {
            //             c_userid: c_userid
            //         },
            //         dataType: "json",
            //         success: function(data) {
            //             $("#message_c").html(data.message__data);
            //             // console.log(data);
            //             // $("#user_name_set").html(data.user_name);
            //             // $("#user_name_set").attr("data-user_id_selectes",data.user_id);
            //             // $("#user_set_img_").attr("src","img/profile_img/"+data.profileImage);
            //             // var st = $("#message_c").height() + 1000;
            //             // $("#message_c").animate({
            //             //     scrollTop: st
            //             // }, 100);
            //             // $("#message_c").scrollTop(st);

            //         }
            //     });
            // }, 10000);

            $(document).on("click", ".chat_header", function() {
                var c_userid = $(this).attr("data-userid");
                getMessage(c_userid);
                $("div").removeClass("hide_item_ele");
                setTimeout(function() {
                    var child_ele = $("#message_c").children();
                    var child_ele_height = 0;
                    for (c_ele of child_ele) {
                        child_ele_height += Number(($(c_ele).css("height")).split("p")[0]);
                    }
                    console.log(child_ele_height);
                    $("#message_c").scrollTop(child_ele_height + 100000000000);
                }, 200);
            });

            $(document).on("mousedown", ".chat_header", function() {
                $(this).css("background-color", "#46dadf");

            });
            $(document).on("mouseup", ".chat_header", function() {
                $(this).css("background-color", "#00000030");
            });


            $(document).on("keyup", ".message-footer .emojionearea-editor", function(event) {
                var mess = $(".message-footer .emojionearea-editor").html();
                if (mess != "") {
                    var r_id = $("#user_name_set").attr("data-user_id_selectes").trim();
                    if (event.key == "Enter") {
                        mess = mess.substr(0, (mess.length - 15));
                        $.ajax({
                            url: "send_message.php",
                            type: "POST",
                            data: {
                                message: mess,
                                r_id: r_id
                            },
                            dataType:"json",
                            success: function(data) {
                                if (data.error == 0) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Something Went Wrong | Reload The Page'
                                    });
                                }
                                else {
                                    if(data.message_status == true) {
                                        $("#message_c").append(data.message);
                                    }
                                    else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: data.message_status
                                        });
                                    }
                                }
                                $("#message_send_by_input").val("");
                                $(".message-footer .emojionearea-editor").html("");

                                // var st = $("#message_c").height() + 100;
                                // $("#message_c").animate({
                                //     scrollTop: st
                                // }, 300);
                                // $("#message_c").scrollTop(st);
                                var child_ele = $("#message_c").children();
                                var child_ele_height = 0;
                                for (c_ele of child_ele) {
                                    child_ele_height += Number(($(c_ele).css("height")).split("p")[0]);
                                }
                                // console.log(child_ele_height);
                                $("#message_c").scrollTop(child_ele_height + 100000000000);
                            }
                        });
                    }
                }
            });
            var st = $("#message_c").height() + 100;
            // $("#message_c").animate({
            //     scrollTop: st
            // }, 100);
            $("#message_c").scrollTop(st);



            $(document).on("click", ".download_icon", function(event) {
                var click_btn = this;
                var click_btn_child_img = click_btn.firstElementChild;
                var document_name = $(this).attr("data-document_src");
                var url = "message_img_video_or_doc/" + document_name;
                var document_name_d = click_btn.previousElementSibling.lastElementChild.innerText;
                // console.log(document_name_d);

                $.ajax({
                    url: url,
                    cache: false,
                    xhr: function() {
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 2) {
                                if (xhr.status == 200) {
                                    xhr.responseType = "blob";
                                } else {
                                    xhr.responseType = "text";
                                }
                            }
                        };
                        return xhr;
                    },
                    beforeSend: function() {
                        click_btn.disabled = true;
                        $(click_btn).css("border-width", "1px");
                        click_btn_child_img.src = "img/img2/download_loading_icon.svg";
                    },
                    success: function(data) {
                        //Convert the Byte Data to BLOB object.
                        var blob = new Blob([data], {
                            type: "application/octetstream"
                        });

                        //Check the Browser type and download the File.
                        var isIE = false || !!document.documentMode;
                        if (isIE) {
                            window.navigator.msSaveBlob(blob, document_name_d);
                        } else {
                            var url = window.URL || window.webkitURL;
                            link = url.createObjectURL(blob);
                            var a = $("<a />");
                            a.attr("download", document_name_d);
                            a.attr("href", link);
                            $("body").append(a);
                            a[0].click();
                            $("body").remove(a);
                        }
                        click_btn.disabled = false;
                        click_btn_child_img.src = "img/img2/download_icon.svg";
                        $(click_btn).css("border-width", "0px");
                    }
                });
            });

            $("#user_profile_name").click(function() {
                $("#profile_modal").fadeIn(400);
            });
            $("#profile_modal_close span").click(function() {
                $("#profile_modal").fadeOut(400);
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
                        // console.log(data);
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
                            if (data.profile_image_select_state != true) {
                                error_message += '<div style="color:red;font-size: 18px;font-weight: 600;margin: 10px 0px;">' + data.profile_image_select_state + '</div>';
                            }
                            else {
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
                                $("#user_profile_name .avatar img").attr("src","img/profile_img/"+data.profile_image_name);
                                $("#user_profile_name #user__name").html(data.user_name);
                                $("#user__profile img").attr("src","img/profile_img/"+data.profile_image_name);
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