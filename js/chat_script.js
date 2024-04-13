function dark_mode_style() {

    localStorage.setItem("dark_mode","1");

    $("#mess_body").addClass("mess_body_dark_mode_style");
    $("#mess_body_bg_before").addClass("mess_body_bg_before_dark_mode_style");
    $("#mess_header").addClass("mess_header_dark_mode_style");
    $("#user_profile_ele").addClass("user_profile_ele_dark_mode_style");
    $("#user_profile_name").addClass("user_profile_name_dark_mode_style");
    $(".profile-setting1 svg").addClass("svg_dot_dark_mode_style");
    $("#search_ele_inner").addClass("search_ele_inner_dark_mode_style");
    $("label[for='search_input_ele'] i").addClass("search_i_ele_dark_mode_style");
    $("#search_input_ele").addClass("search_input_ele_dark_mode_style");
    $(".other_user_p_style").addClass("other_user_p_style_dark_mode_style");
    $(".other_user_p_style_d").addClass("other_user_p_style_dark_mode_style");
    $("#setting2-mess").addClass("setting2_mess_dark_mode_style");
    $(".sett-pro").addClass("sett_pro_dark_mode_style");
    $("#mess_body_header").addClass("mess_body_header_dark_mode_style");
    $("#back_to_mess_header_btn").addClass("back_to_mess_header_btn_dark_mode_style");
    $("#click_user_profile_name").addClass("click_user_profile_name_dark_mode_style");
    $("#click_user_info").addClass("back_to_mess_header_btn_dark_mode_style");
    $("#message_send_by_input + .emojionearea").addClass("message_send_by_input_c_dark_mode_style");
    $(".message_send_by_input_c .emojionearea-editor").addClass("emojionearea_editor_dark_mode_style");
    $("#all_doc_outer").addClass("all_doc_outer_dark_mode_style");
    $("#send_message_btn_").addClass("send_message_btn__dark_mode_style");
    $(".message_send_by_input_c .emojionearea-picker").addClass("emojionearea_picker_dark_mode_style");
    $(".chat_message_and_time_light_mode_style").addClass("chat_message_and_time_dark_mode_style");
    $(".chat_sent_light_mode_style").addClass("chat_sent_dark_mode_style");
    $(".download_icon").addClass("download_icon_dark_mode_style");
    $(".modal .modal-content").addClass("modal__content__dark_mode_style");
    $(".modal .btn-close").addClass("modal_close_icon_dark_mode_style");
    $("#image_zoom_modal_col").addClass("modal__col__dark_mode_style");
    $(".profile__img_ele_c").addClass("profile__img_ele_c_dark_mode_style");
    $(".profile__item .form-control").addClass("profile__item__dark_mode_style");
    $(".profile__item label").addClass("profile__item__dark_mode_style");
}
function light_mode_style(){

    localStorage.setItem("dark_mode","0");

    $("#mess_body").removeClass("mess_body_dark_mode_style");
    $("#mess_body_bg_before").removeClass("mess_body_bg_before_dark_mode_style");
    $("#mess_header").removeClass("mess_header_dark_mode_style");
    $("#user_profile_ele").removeClass("user_profile_ele_dark_mode_style");
    $("#user_profile_name").removeClass("user_profile_name_dark_mode_style");
    $(".profile-setting1 svg").removeClass("svg_dot_dark_mode_style");
    $("#search_ele_inner").removeClass("search_ele_inner_dark_mode_style");
    $("label[for='search_input_ele'] i").removeClass("search_i_ele_dark_mode_style");
    $("#search_input_ele").removeClass("search_input_ele_dark_mode_style");
    $(".other_user_p_style").removeClass("other_user_p_style_dark_mode_style");
    $(".other_user_p_style_d").removeClass("other_user_p_style_dark_mode_style");
    $("#setting2-mess").removeClass("setting2_mess_dark_mode_style");
    $(".sett-pro").removeClass("sett_pro_dark_mode_style");
    $("#mess_body_header").removeClass("mess_body_header_dark_mode_style");
    $("#back_to_mess_header_btn").removeClass("back_to_mess_header_btn_dark_mode_style");
    $("#click_user_profile_name").removeClass("click_user_profile_name_dark_mode_style");
    $("#click_user_info").removeClass("back_to_mess_header_btn_dark_mode_style");
    $("#message_send_by_input + .emojionearea").removeClass("message_send_by_input_c_dark_mode_style");
    $(".message_send_by_input_c .emojionearea-editor").removeClass("emojionearea_editor_dark_mode_style");
    $("#all_doc_outer").removeClass("all_doc_outer_dark_mode_style");
    $("#send_message_btn_").removeClass("send_message_btn__dark_mode_style");
    $(".message_send_by_input_c .emojionearea-picker").removeClass("emojionearea_picker_dark_mode_style");
    $(".chat_message_and_time_light_mode_style").removeClass("chat_message_and_time_dark_mode_style");
    $(".chat_sent_light_mode_style").removeClass("chat_sent_dark_mode_style");
    $(".download_icon").removeClass("download_icon_dark_mode_style");
    $(".modal .modal-content").removeClass("modal__content__dark_mode_style");
    $(".modal .btn-close").removeClass("modal_close_icon_dark_mode_style");
    $("#image_zoom_modal_col").removeClass("modal__col__dark_mode_style");
    $(".profile__img_ele_c").removeClass("profile__img_ele_c_dark_mode_style");
    $(".profile__item .form-control").removeClass("profile__item__dark_mode_style");
    $(".profile__item label").removeClass("profile__item__dark_mode_style");
}

$(document).ready(function() {
    var video_play_state_in_modal = 0;
    var all_doc_inner_popup = 0;

    var body_width = $("body").css("width");
    body_width = Math.floor(Number(body_width.substr(0,(body_width.length)-2)));
    if(localStorage.getItem("reload_state_1") == null) {
        localStorage.setItem("reload_state_1","0");
    }
    if(localStorage.getItem("reload_state_2") == null) {
        localStorage.setItem("reload_state_2","0");
    }
    function run_script_n1() {
        $(document).on("click",".other_user_p_style",function(){
            $("#mess_header").css("transform","translateX(-100%)");
            $("#mess_body").css("transform","translateX(-100%)");
        });
        $(document).on("click","#back_to_mess_header_btn",function(){
            $("#mess_header").css("transform","translateX(0%)");
            $("#mess_body").css("transform","translateX(0%)");
            if(clear_set_interval_new_message_in_other_user != "") {
                clearInterval(clear_set_interval_new_message_in_other_user);
            }

        });
    }
    if(body_width <= 800) {
        run_script_n1();
    }

    $(window).resize(function(){
        var body_width_ = $("body").css("width");
        body_width_ = Math.floor(Number(body_width_.substr(0,(body_width_.length)-2)));
        if(body_width_ <=800) {
            if(body_width_ == 800) {
                location.reload();
                localStorage.setItem("reload_state_1","1");
                localStorage.setItem("reload_state_2","0");
            }
            else {
                if(localStorage.getItem("reload_state_1") == "0" && body_width_ < 800) {
                    localStorage.setItem("reload_state_1","1");
                    localStorage.setItem("reload_state_2","0");
                    location.reload();
                }
            }
        }
        else if(body_width_ > 800) {
            if(body_width_ == 801) {
                location.reload();
                localStorage.setItem("reload_state_2","1");
                localStorage.setItem("reload_state_1","0");
            }
            else {
                if(localStorage.getItem("reload_state_2") == "0" && body_width_ > 801) {
                    localStorage.setItem("reload_state_2","1");
                    localStorage.setItem("reload_state_1","0");
                    location.reload();
                }
            }
        }
        // console.log(body_width_);
    });

    var setting2_mess_popup = 0;
    document.getElementById("tdot_a").addEventListener("click", function(event) {
        event.stopPropagation();
        if(setting2_mess_popup == 0) {
            this.style.backgroundColor = "#787878cf";
            // document.getElementById("setting2-mess").style.display = "flex";
            $("#setting2-mess").fadeIn("fast");
            setting2_mess_popup = 1;
        }
        else {
            // document.getElementById("setting2-mess").style.display = "none";
            $("#setting2-mess").fadeOut("fast");
            document.getElementById("tdot_a").style.backgroundColor = "";
            setting2_mess_popup = 0;
        }
        if(all_doc_inner_popup == 1) {
            $("#all_doc_inner").fadeOut("fast");
            all_doc_inner_popup = 0;
        }   
    });
    $("#setting2-mess").click(function(event){
        event.stopPropagation();
    });
    window.addEventListener("click", function() {
        if (setting2_mess_popup == 1) {
            $("#setting2-mess").fadeOut("fast");
            document.getElementById("tdot_a").style.backgroundColor = "";
            setting2_mess_popup = 0;
        }
        if(all_doc_inner_popup == 1) {
            $("#all_doc_inner").fadeOut("fast");
            all_doc_inner_popup = 0;
        }
    });

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
                <i class="fas fa-paperclip" id="all_doc_icom"></i>
                <form id="all_doc_inner">
                    <div id='all_doc_inner__in' class='d-flex flex-column align-items-center'>
                        <label for="document_send_m" title="Document">
                            <svg viewBox="0 0 53 53" width="53" height="53" class=""><defs><circle id="document-SVGID_1_" cx="26.5" cy="26.5" r="25.5"></circle></defs><clipPath id="document-SVGID_2_"><use xlink:href="#document-SVGID_1_" overflow="visible"></use></clipPath><g clip-path="url(#document-SVGID_2_)"><path fill="#5157AE" d="M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z"></path><path fill="#5F66CD" d="M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z"></path></g><g fill="#F5F5F5"><path id="svg-document" d="M29.09 17.09c-.38-.38-.89-.59-1.42-.59H20.5c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H32.5c1.1 0 2-.9 2-2V23.33c0-.53-.21-1.04-.59-1.41l-4.82-4.83zM27.5 22.5V18l5.5 5.5h-4.5c-.55 0-1-.45-1-1z"></path></g></svg>
                        </label>
                        <input id="document_send_m" name="document_send_m[]" accept="*" type="file" multiple="" style="display: none;">

                        <label for="image_send_c" title="Photo & Video">
                            <svg viewBox="0 0 53 53" width="53" height="53" class=""><defs><circle id="image-SVGID_1_" cx="26.5" cy="26.5" r="25.5"></circle></defs><clipPath id="image-SVGID_2_"><use xlink:href="#image-SVGID_1_" overflow="visible"></use></clipPath><g clip-path="url(#image-SVGID_2_)"><path fill="#AC44CF" d="M26.5-1.1C11.9-1.1-1.1 5.6-1.1 27.6h55.2c-.1-19-13-28.7-27.6-28.7z"></path><path fill="#BF59CF" d="M53 26.5H-1.1c0 14.6 13 27.6 27.6 27.6s27.6-13 27.6-27.6H53z"></path><path fill="#AC44CF" d="M17 24.5h18v9H17z"></path></g><g fill="#F5F5F5"><path id="svg-image" d="M18.318 18.25h16.364c.863 0 1.727.827 1.811 1.696l.007.137v12.834c0 .871-.82 1.741-1.682 1.826l-.136.007H18.318a1.83 1.83 0 0 1-1.812-1.684l-.006-.149V20.083c0-.87.82-1.741 1.682-1.826l.136-.007h16.364Zm5.081 8.22-3.781 5.044c-.269.355-.052.736.39.736h12.955c.442-.011.701-.402.421-.758l-2.682-3.449a.54.54 0 0 0-.841-.011l-2.262 2.727-3.339-4.3a.54.54 0 0 0-.861.011Zm8.351-5.22a1.75 1.75 0 1 0 .001 3.501 1.75 1.75 0 0 0-.001-3.501Z"></path></g></svg>
                        </label>
                        <input id="image_send_c" accept="image/png, image/jpeg,image/gif,video/mp4" name="image_send_m[]" type="file" multiple="multiple" style="display: none;">
                    <div>
                </form>
            </div>`);
        $(".emojionearea-button").css("order", "-100");

        $("#message_send_by_input + .emojionearea").append(`<svg id='send_message_btn_' viewBox="0 0 24 24" width="24" height="24" class=""><path fill="currentColor" d="M1.101 21.757 23.8 12.028 1.101 2.3l.011 7.912 13.623 1.816-13.623 1.817-.011 7.912z"></path></svg>`);
        $("#message_send_by_input + .emojionearea").addClass("message_send_by_input_c_light_mode_style");
        $(".message_send_by_input_c .emojionearea-editor").addClass("emojionearea_editor_light_mode_style");
        $("#all_doc_outer").addClass("all_doc_outer_light_mode_style");
        $("#send_message_btn_").addClass("send_message_btn__light_mode_style");
        $(".message_send_by_input_c .emojionearea-picker").addClass("emojionearea_picker_light_mode_style");
    },1000);

    if(localStorage.getItem("dark_mode") == null) {
        localStorage.setItem("dark_mode","0");
    }
    else {
        if(localStorage.getItem("dark_mode") == "1") {
            document.getElementById("dark_mode_btn").checked=true
            dark_mode_style();
            setTimeout(function(){
                $("#message_send_by_input + .emojionearea").addClass("message_send_by_input_c_dark_mode_style");
                $(".message_send_by_input_c .emojionearea-editor").addClass("emojionearea_editor_dark_mode_style");
                $("#all_doc_outer").addClass("all_doc_outer_dark_mode_style");
                $("#send_message_btn_").addClass("send_message_btn__dark_mode_style");
                $(".message_send_by_input_c .emojionearea-picker").addClass("emojionearea_picker_dark_mode_style");
            },1000);
        }
    }

    $(document).on("click","#all_doc_outer",function(event) {
        event.stopPropagation();
        if(all_doc_inner_popup == 0) {
            $("#all_doc_inner").fadeIn("fast");
            all_doc_inner_popup = 1;
        }
        else {
            $("#all_doc_inner").fadeOut("fast");
            all_doc_inner_popup = 0;
        }
        if (setting2_mess_popup == 1) {
            $("#setting2-mess").fadeOut("fast");
            document.getElementById("tdot_a").style.backgroundColor = "";
            setting2_mess_popup = 0;
        }
    });
    $(document).on("click", ".mess_img_video_style__set img", function(event) {
        var ele = $(this).clone();
        $("#image_zoom_modal").modal("show");
        $("#image_zoom_modal_col").html(ele);
    });
    $(document).on("click", ".mess_img_video_style__set video", function(event) {
        event.preventDefault();
        // document.querySelectorAll(".img_style_post_set video").pause();
        for (var ele_video of document.querySelectorAll(".img_style_post_set video")) {
            ele_video.pause();
        }
        // $(this).pause();
        // this.currentTime = 0;
        var ele = $(this).clone();
        $("#image_zoom_modal").modal("show");
        $("#image_zoom_modal_col").html(ele);
        document.querySelector("#image_zoom_modal_col video").play();
        video_play_state_in_modal = 1;
    });
    $("#image_zoom_modal_close").click(function() {
        if (video_play_state_in_modal == 1) {
            document.querySelector("#image_zoom_modal_col video").pause();
            document.querySelector("#image_zoom_modal_col video").currentTime = 0;
            video_play_state_in_modal = 0;
        }
    });
    // $(document).on("click",".download_icon",function(){
    //     var document_name = $(this).attr("data-document_src");
    //     var document_name_d = this.previousElementSibling.lastElementChild.innerText;
    //     $("#loading_icon_show").fadeIn("fast");
    //     $.AjaxDownloader({
    //         url: "download_ajax.php",
    //         data:{
    //             document_name_d:document_name_d,
    //             document_name:document_name
    //         },
    //     });
    //     $("#loading_icon_show").fadeOut("fast");
    // });

    // download document
    function download(document_name_d, url) {
        var element_a_t = document.createElement('a');
        element_a_t.setAttribute('href',url);
        element_a_t.setAttribute('download', document_name_d);
        document.body.appendChild(element_a_t);
        element_a_t.click();
        document.body.removeChild(element_a_t);
    }
    $(document).on("click", ".download_icon", function(event) {
        $("#loading_icon_show").fadeIn("fast");
        var click_btn = this;
        var document_name = $(this).attr("data-document_src");
        var url = "message_img_video_or_doc/" + document_name;
        var document_name_d = click_btn.previousElementSibling.lastElementChild.innerText;

        download(document_name_d, url);
        $("#loading_icon_show").fadeOut("fast");
    });

    $(document).on("input","#search_input_ele",function(){
        var search_values = $(this).val().trim();

        if(search_values == "") {
            $("#all_other_user1").css("display","block");
            $("#all_other_user2").css("display","none");
        }
        else {
            $("#all_other_user1").css("display","none");
            $("#all_other_user2").css("display","block");

            var dark_mode = localStorage.getItem("dark_mode");

            $.ajax({
                url: "other_user_search.php",
                type: "POST",
                data: {
                    search_value: search_values,
                    dark_mode:dark_mode
                },
                dataType: "json",
                success: function(data) {
                    if (data.error == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something Went Wrong | Reload The Page'
                        });
                    } 
                    else {
                        $("#all_other_user2 .all_other_user_inner").html(data.search_result);
                    }
                }
            });
        }
    });

    $(document).on("change","#image_send_c",function(event) {
        $("#all_doc_inner").submit();
    });
    $(document).on("change","#document_send_m",function(event) {
        $("#all_doc_inner").submit();
    });
    $(document).on("submit","#all_doc_inner",function(event) {
        event.preventDefault();
        var r_id = $("#click_user_name").attr("data-user_id_selectes").trim();
        var dark_mode = localStorage.getItem("dark_mode");
        var formData = new FormData(this);
        formData.append("r_id", r_id);
        formData.append("dark_mode", dark_mode);
        formData.append("current_user_message_data_id",current_user_message_data_id);
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
                        title: 'Something Went Wrong'
                    });
                    // console.log("hh");
                } 
                else {
                    if(data.current_user_check == true) {
                        if ((data.img_video == 1)) {
                            if (data.file_check_status != true) {
                                Swal.fire({
                                    icon: 'warning',
                                    html: '<span style="color:red;font-size: 20px;font-weight: 600;">' + data.file_check_status + '<span>'
                                });
                            }
                            else {
                                setTimeout(function(){
                                    $("#mess_body_middle").append(data.file_data);
                                    current_user_message_data_id = data.current_user_message_data_id;
                                    $("div[data-userid='"+r_id+"']").find(".user_send_recive_info").html("<img src='img/img2/photo_video.svg'>&nbsp;&nbsp;Photo or Video");
                                    var child_ele = $("#mess_body_middle").children();
                                    var child_ele_height = 0;
                                    for (c_ele of child_ele) {
                                        child_ele_height += Number(($(c_ele).css("height")).split("p")[0]);
                                    }
                                    $("#mess_body_middle").scrollTop(child_ele_height + 100000000000);
                                },1000);
                            }
                        } 
                        else if (data.document == 1) {
                            if (data.file_check_status != true) {
                                Swal.fire({
                                    icon: 'warning',
                                    html: '<span style="color:red;font-size: 20px;font-weight: 600;">' + data.file_check_status + '<span>'
                                });
                            } 
                            else {
                                $("#mess_body_middle").append(data.file_data);
                                current_user_message_data_id = data.current_user_message_data_id;
                                $("div[data-userid='"+r_id+"']").find(".user_send_recive_info").html("<img src='img/img2/document_icon_s.svg'>&nbsp;&nbsp;Document");
                                var child_ele = $("#mess_body_middle").children();
                                var child_ele_height = 0;
                                for (c_ele of child_ele) {
                                    child_ele_height += Number(($(c_ele).css("height")).split("p")[0]);
                                }
                                $("#mess_body_middle").scrollTop(child_ele_height + 100000000000);
                            }
                        }
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: data.current_user_check
                        });
                    }
                }
                $("#image_send_c").val("");
                $("#document_send_m").val("");
                $("#loading_icon_show").fadeOut("fast");

                
            }
        });
    });
});


function get_user_header() {
    var dark_mode = localStorage.getItem("dark_mode");
    $.ajax({
        url: "get_user_header.php",
        type: "POST",
        beforeSend:function(){
            $("#loading_icon_show").fadeIn("fast");
        },
        data:{
            dark_mode:dark_mode
        },
        success: function(data) {
            $("#loading_icon_show").fadeOut("fast");
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
}

var mess_body_click_user_mess_and_info_display_state = 0;
function getMessage(c_userid) {
    var dark_mode = localStorage.getItem("dark_mode");
    $.ajax({
        url: "mess_get.php",
        type: "POST",
        beforeSend:function(){
            $("#loading_icon_show").fadeIn("fast");
            if(clear_set_interval_new_message_in_other_user != "") {
                clearInterval(clear_set_interval_new_message_in_other_user);
            }
        },
        data: {
            c_userid: c_userid,
            dark_mode:dark_mode
        },
        dataType: "json",
        success: function(data) {
            $("#loading_icon_show").fadeOut("fast");
            if (data.error == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Something Went Wrong | Reload The Page'
                });
            }
            else {
                if(data.current_user_check == true) {
                    $("#mess_body_middle").html(data.message__data);
                    // console.log(data);

                    current_user_message_data_id = data.current_user_message_data_id;
                    console.log(current_user_message_data_id);

                    $("#click_user_name").html(data.user_name);
                    $("#click_user_name").attr("data-user_id_selectes", data.user_id);
                    $("#user_set_img_").attr("src", "img/profile_img/" + data.profileImage);
                    $("#click_user_online_offline").html(data.last_login_status);

                    $("#profile__img_ele2 img").attr("src", "img/profile_img/" + data.profileImage);
                    $("#profile__name2").val(data.user_name);
                    $("#profile__email2").val(data.user_email);
                    $("#profile__bio2").html(data.bio);
    
                    if(mess_body_click_user_mess_and_info_display_state == 0) {
                        $("#mess_body_click_user_mess_and_info").fadeIn("fast");
                        mess_body_click_user_mess_and_info_display_state = 1;
                    }

                    check_new_message_in_other_user();
                                    
                    var child_ele = $("#mess_body_middle").children();
                    var child_ele_height = 0;
                    for (c_ele of child_ele) {
                        child_ele_height += Number(($(c_ele).css("height")).split("p")[0]);
                    }
                    // console.log(child_ele_height);
                    $("#mess_body_middle").scrollTop(child_ele_height + 100000000000);
                    // setTimeout(function() {
                    // }, 200);
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
}

function send_message_(mess) {
    var dark_mode = localStorage.getItem("dark_mode");
    var r_id = $("#click_user_name").attr("data-user_id_selectes").trim();
    $.ajax({
        url: "send_message.php",
        type: "POST",
        data: {
            message: mess,
            r_id: r_id,
            dark_mode:dark_mode,
            current_user_message_data_id:current_user_message_data_id
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
                if(data.current_user_check == true) {
                    if(data.message_status == true) {
                        $("#mess_body_middle").append(data.message);
                        $("div[data-userid='"+r_id+"']").find(".user_send_recive_info").html(data.mess);
                        current_user_message_data_id=data.current_user_message_data_id;
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: data.message_status
                        });
                    }
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: data.current_user_check
                    });
                }
            }
            $("#message_send_by_input").val("");
            $(".message_send_by_input_c .emojionearea-editor").html("");


            var child_ele = $("#mess_body_middle").children();
            var child_ele_height = 0;
            for (c_ele of child_ele) {
                child_ele_height += Number(($(c_ele).css("height")).split("p")[0]);
            }
            // console.log(child_ele_height);
            $("#mess_body_middle").scrollTop(child_ele_height + 100000000000);
        }
    });
}