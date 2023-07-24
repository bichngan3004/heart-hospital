<?php
session_start();
ob_start();
if(isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['id_user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen'])==4)
{
	include('../class/config.php');
	$q=new connect();
    $q->confirm_login($_SESSION['id'], $_SESSION['user'],$_SESSION['pass'], $_SESSION['phanquyen'],$_SESSION['id_user']);
    
}
else
{
	header('location:../login.php');
}

include("../class/clsadmin.php");
$p = new admin();
$layid=$_SESSION['id_user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='../img/icon/tittle.jpg' />
    <title>Tam Duc Heart Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
        nav {
            line-height: 30px;
            background-color: #eeeeee;
            height: 380px;
            width: 21%;
            float: left;
            padding: 5px;
            /* margin-bottom: 80px; */
        }

        section {
            width: auto;
            float: left;
            padding: 10px;
        }

        footer {
            clear: both;
        }

        nav ul {
            padding-right: 30px;
            list-style: none;
        }

        nav ul li {

            border-bottom: 1px solid #cdcdcd;
            padding: 3px 0px;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
        }

        nav ul li a:hover {
            font-weight: 700;
        }
    </style>
</head>

<body>
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>

    <nav>
        <ul>
            <li><a href="XemThongTinCaNhan.php"><i class="fa fa-bars"></i>&emsp;Xem thông tin cá nhân</a></li>
            <li><a href="QuanLyBacSi.php"><i class="fa fa-user-doctor"></i>&emsp;Quản lý bác sĩ</a></li>
            <li><a href="QuanLyNvyt.php"><i class="fa fa-user-nurse"></i>&emsp;Quản lý nhân viên y tế</a></li>
            <li><a href="QuanLyBenhNhan.php"><i class="fa fa-user"></i>&emsp;Quản lý bệnh nhân</a></li>
            <li><a href="QuanLyKhoa.php"><i class="fa fa-user-doctor"></i>&emsp;Quản lý khoa</a></li>
            <li><a href="CapTaiKhoan.php"><i class="fa fa-address-book"></i>&emsp;Cấp tài khoản</a></li>
            <li><a href="QuanLyLichNghiBacSi.php"><i class="fa fa-user-pen"></i>&emsp;Quản lý lịch nghỉ bác sĩ</a></li>
            <li><a href="QuanLyTinTuc.php"><i class="fa fa-newspaper"></i>&emsp;Quản lý tin tức</a></li>
            <li><a href="QuanLyNotice.php"><i class="fa fa-newspaper"></i>&emsp;Quản lý notice</a></li>
            <li><a href="BenhNhanDangKy.php"><i class="fa fa-bell"></i>&emsp;Bệnh nhân đăng ký khám</a></li>

        </ul>
    </nav>
    <section>
        <h3 style="text-align: left;font-weight: bold;">Hello Admin!</h3>
        <h3 style="text-align: left;font-weight: bold;">Chào mừng đến trang quản lý!!!</h3>
        <br>
        <h5 style="font-weight: bold">THÔNG TIN CÁ NHÂN</h5>
        <div class="information">
        
            <?php $p->information("SELECT * FROM admin order by id_admin asc"); ?>
        </div>
    </section>

    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>

</html>