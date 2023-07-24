<?php
ob_start();
session_start();
    include("../class/patient.php");
    $p = new patient();
    if (isset($_SESSION["id"]) && isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"])==1) {
        include("../class/config.php");
        $q = new connect();
        $q->confirm_bn($_SESSION["id"],$_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
    } 
    else 
    {
        header("location: ../login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../img/icon/tittle.jpg' />
    <title>Tam Duc Heart Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
      nav {
            line-height: 30px;
            background-color: #eeeeee;
            height: auto;
            width: auto;
            float: left;
            padding: 4px;
        }

        footer {
            clear: both;
        }

        nav ul {
            padding-right: 30px;
        }

        nav ul li {
            padding: 10px 0px;
            border-bottom: 1px solid #cdcdcd;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
        }

        nav ul {
            list-style: none;
        }

        nav ul li a:hover {
            font-weight: 700;
        }
        form {
            margin-left: 380px;
        }

        label {
            padding: 10px 0px;
        }
    </style>
</head>

<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>
    <div class="row" style="margin: 0px;">
        <nav class="col-3">
            <ul>
                <li><a href="showinformation.php"><i class="fa fa-bars"></i>&emsp;Xem thông tin cá nhân</a></li>
                <li><a href="xembenhan.php"><i class="fa fa-calendar-week"></i>&emsp;Xem bệnh án</a></li>
                <li><a href="xemlichkham.php"><i class="fa fa-calendar-week"></i>&emsp;Xem lịch khám</a></li>
                <li><a href="updateaccount.php"><i class="fa fa-user"></i>&emsp;Cập nhật tài khoản</a></li>
            </ul>
        </nav>
        <div class="information col-9">
            <h2 class="text-center pt-3 pb-5">Thông tin tài khoản</h2>
            <div class="row">
                <div class="col-6" style="padding-left: 350px;">
                    <p>Email:</p>
                    <p>Mật khẩu:</p>
                </div>
                <div class="col-6">
                    <?php 
                       $sql = "SELECT * FROM taikhoan WHERE id = '".$_SESSION["id"]."'"; 
                       $kq = mysqli_query($p->connect(),$sql);
                       $row = mysqli_fetch_array($kq);
                    
                    ?>
                    <p><?php echo $row['email'];  ?></p>
                    <p>******</p>
                    <p><a href="changepass.php" style="text-decoration: none;color:#00bb00">Cập Nhật&emsp;<img src="../img/icon/update.png" width="20px" class="ml-1"></a></p>
                </div>
            </div>
        </div>
    </div>



    <?php
    include("footer.php");
    ?>
</body>

</html>