<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        <style>
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
        </style>
</head>

<body>
    <div class='chat-message chat-sent document_send_m'>
        <div class='col-12 p-2 document_style_post_set'>
            <div class='doc_content'>
                <div class='document_icon'>
                    <span class='material-symbols-outlined'>
                        description
                    </span>
                </div>
                <div class='document_name'>demo demo.mp4</div>
            </div>
            <button data-document_src='1650893445_4906_Asphalt 9_ Legends 2022-02-06 19-34-46.mp4' class='download_icon'>
                <img src='img/img2/download_icon.svg'>
            </button>
        </div>
        <span class='chat-timestamp img_s_t'>25/04/2022 07:21 pm</span>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).on("click",".download_icon",function(event){
            var click_btn = this;
            var click_btn_child_img = click_btn.firstElementChild;
            var document_name = $(this).attr("data-document_src");
            var url = "message_img_video_or_doc/"+document_name;
            var document_name_d = click_btn.previousElementSibling.lastElementChild.innerText;
            console.log(document_name_d);

            $.ajax({
                url: url,
                cache: false,
                xhr: function () {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
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
                beforeSend:function() {
                    click_btn.disabled = true;
                    $(click_btn).css("border-width","1px");
                    click_btn_child_img.src = "img/img2/download_loading_icon.svg";
                },
                success: function (data) {
                    //Convert the Byte Data to BLOB object.
                    var blob = new Blob([data], { type: "application/octetstream" });
 
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
                    $(click_btn).css("border-width","0px");
                }
            });
        });
    </script>
</body>

</html>
