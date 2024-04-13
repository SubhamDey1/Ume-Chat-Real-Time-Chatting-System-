<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div {
            margin: 10px 0px;
        }
    </style>
</head>

<body>
    <div style="color:red;font-size: 20px;font-weight: 600;">Enter The E-mail ID</div>
    <div style="color:red;font-size: 20px;font-weight: 600;">Enter The Password</div>

    <script src="js/sweetalert2.js"></script>

    <script>
        Swal.fire({
            icon: 'warning',
            // html: '<span style="color:red;font-size: 20px;font-weight: 600;">Invalid email id or password<span>'
            html : '<div style="color:red;font-size: 20px;font-weight: 600;margin: 10px 0px;">Enter The E-mail ID</div><div style="color:red;font-size: 20px;font-weight: 600;margin: 10px 0px;">Enter The Password</div>'
        });
    </script>
</body>

</html>