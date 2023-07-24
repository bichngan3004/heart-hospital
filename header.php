<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='img/icon/tittle.jpg' />
    <link rel='shortcut icon' href='img/icon/tittle.jpg' />
    <title>Tam Duc Heart Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
    <header class="row form-group" style="margin: 0; height: 65px;">
        <div class="col-md-4" id="logo">
            <a href="index.php"><img class="img-reponsive" style="width:45%; margin: 8px 80px; " src="./img/icon/logo.png" alt="LogoBVTimTamDuc"></a>
        </div>

        <div class="col-md-3" id="call-telephone" style=" margin-top: 20px; ">
            <span><i class="fa fa-phone-square" style="color: #003e00;"></i></span>&ensp;
            <span><a href="tel: 02854110036"><b>028 5411 0036</b></a></span>&nbsp; –&nbsp;
            <span><a href="tel:0903052432"><b>0903 052 432</b></a></span>
        </div>

        <div class="col-md-3" id="email" style=" margin-top: 20px;">
            <span><i class="fa fa-envelope" style="color: #003e00;"></i></span>&ensp;
            <span class="iconemail"><a href="mailto:bichngan12a11@gmail.com"><b>hospital@tamduchearthospital.com</b></a></span>
        </div>

        <div class="col-md-2" id="account">
            <ul class="parent" style="list-style: none; margin-top: 20px;">
                <li><i class="fa fa-user" style="color: #003e00;"></i>&ensp;<a href=""><b>Tài khoản</b></a>
                    <ul class="children">
                        <!-- <li><a href="patient/showinformation.php">Thông tin chung</a></li> -->
                        <li><a href="login.php">Đăng nhập</a></li>
                        <li><a href="register.php">Đăng ký</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
</body>
<style>
     #account {
        padding-left: 20px;
    }

    ul .parent {
        list-style: none;
    }

    ul .children {
        list-style: none;
        display: none;
    }

    .children {
        padding: 5px;
    }

    .children li {
        width: 150px;
        height: 25px;
        /* margin-top: 2px; */
        background-color: white;
        opacity: .95;
    }

    .col-md-3 a,
    .children a,
    .parent a {
        text-decoration: none;
    }

    .parent:hover .children {
        display: block;
    }

    .children:hover {
        background-color: white;
        opacity: .95;
    }

    .children li:hover {
        width: 150px;
        height: 30px;
        background-color: white;
    }

    li>a {
        color: #00bb00;
    }

    li>a:hover {
        color: #00661a;
        font-weight: 600;
    }

    span>a {
        color:  #00bb00;
    }

    span>a:hover {
        color: #00661a;
    }
</style>

</html>