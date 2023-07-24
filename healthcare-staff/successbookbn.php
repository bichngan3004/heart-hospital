<?php
session_start();

include_once "../class/patient.php";
$p = new patient;
if (isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['id_user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen']) == 3) {
    include_once "../class/config.php";
    $q = new connect();
    $q->confirm_nvyt($_SESSION['id'], $_SESSION['user'], $_SESSION['id_user'], $_SESSION['pass'], $_SESSION['phanquyen']);
} else {
    header("location:../login.php");
}

$id_bacsi = $_SESSION['bacsi'];
$doctor = $p->show_info_doctor($_SESSION['bacsi']);
$user = $p->show_info($_SESSION['tentaikhoan']);
$array_ngayhen = explode('_', $_SESSION['ngayhen']);
$id_benhnhan = $_SESSION['benhnhan'];
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
    <style>
        body {
            font-size: 18px;
        }

        p {
            font-weight: bold;
        }

        .details {
            margin-left: 750px;
        }

        input {
            border: none;
        }

        label {
            font-weight: bold;
        }
        .schedule_details {
            width: 600px;
            border-radius: 10px;
            margin: 30px auto;
            border: 1px solid black;
            padding: 20px;
            
        }
        nav {
        line-height:30px;
        background-color: #eeeeee;
        height: 300px;
        width:20%;
        float:left;
        padding:5px;
       
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
    </style>
</head>

<body>
    <?php include("header.php"); ?>
    <?php include("menu.php") ?>
    <nav>
         <ul>
            <li><a href="XemThongTinCaNhan.php"><i class="fa fa-user-nurse"></i>&emsp;Xem thông tin cá nhân</a></li>
            <li><a href="datlichbn.php"><i class="fa fa-user-pen"></i>&emsp;Đặt lịch khám</a></li>
            <li><a href="QuanLyBenhNhan.php"><i class="fa fa-address-book"></i>&emsp;Quản lý bệnh nhân</a></li>
            <li><a href="QuanLyTinTuc.php"><i class="fa fa-newspaper"></i>&emsp;Quản lý tin tức</a></li>
            <li><a href="BenhNhanDangKy.php"><i class="fa fa-bell"></i>&emsp;Điều phối bệnh nhân đăng ký</a></li>
            
         </ul>
    </nav>
    <div class="shedule_details">
        <h2 class="text-center mt-4 mb-4">ĐẶT LỊCH THÀNH CÔNG</h2>
        <div class="use">
            <div class="details font-weight-bolder" style="font-family:tim; font-size:20px;">
                <!--Mã code-->
                <form action="" method="POST">

                    <label for="">Bác sĩ:</label>
                    <input type="text" name="bacsi" value="<?php echo $doctor['tenbacsi'] ?>"><br>
                    <label for="">Tên bệnh nhân:</label>
                    <input type="text" name="benhnhan" value="<?php echo $p->laycot("SELECT tenbenhnhan FROM benhnhan WHERE id_benhnhan = '$id_benhnhan'") ?>"><br>
                    <label for="">Giờ hẹn:</label>
                    <input type="text" name="giohen" value=" <?php

                                                                if ($array_ngayhen[0] == 1) :
                                                                    echo "7:00 - 9:00";
                                                                elseif ($array_ngayhen[0] == 2) :
                                                                    echo "9:00 - 11:00";
                                                                elseif ($array_ngayhen[0] == 3) :
                                                                    echo "13:00 - 15:00";
                                                                else :
                                                                    echo "15:00 - 17:00";
                                                                endif;
                                                                ?>"><br>
                    <label for="">Ngày hẹn:</label>
                    <input type="text" name="nguoidat" value="<?php echo date('j-m-Y', strtotime($array_ngayhen[1]));  ?>"><br>
                    <label for="">Người đặt:</label>
                    <input type="text" name="nguoidat" value="<?php


                                                                echo $user['tentaikhoan'];


                                                                ?>"><br>
                    <label for="">Email:</label>
                    <input type="text" name="email" value="<?php


                                                            echo $user['email'];



                                                            ?>"><br>
                    <label for="">Phí khám:</label>
                    <input type="text" name="phikham" value="150000">
            </div>
        </div>
        <div class="text-center"><a href="hello-nvyt.php" style="margin-left: 150px; margin-top:20px" class="btn btn-success">Thoát</a></div>
        </form>
    </div>
    <?php
    include("footer.php");
    ?>
</body>

</html>