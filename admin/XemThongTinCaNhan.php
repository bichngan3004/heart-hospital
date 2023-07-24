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
    <title>Hello Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
        nav {
            line-height:45px;
            background-color: #eeeeee;
            height: 100%;
            width:21%;
            float:left;
            padding:5px;
           
        }
        section {
            width: 77%;
            float:left;
            padding:10px;
        }
        footer {
            clear:both;
        }
        nav ul{
            padding-right:30px;
        }
        nav ul li{
            
            border-bottom: 1px solid #cdcdcd;
        }
        nav ul li a{
            color: black;
            text-decoration: none;
        }
        nav ul{
            list-style: none;
        }
        nav ul li a:hover{
            font-weight: 700;
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <?php include ("menu.php"); ?> 
  
    <nav>
         <ul>
            <li><a href="XemThongTinCaNhan.php"><i class="fa fa-bars"></i>&emsp;Xem thông tin cá nhân</a></li>
            <li><a href="QuanLyBacSi.php"><i class="fa fa-user-doctor"></i>&emsp;Quản lý bác sĩ</a></li>
            <li><a href="QuanLyNvyt.php"><i class="fa fa-user-nurse"></i>&emsp;Quản lý nhân viên y tế</a></li>
            <li><a href="QuanLyBenhNhan.php"><i class="fa fa-user"></i>&emsp;Quản lý bệnh nhân</a></li>
            <li><a href="QuanLyKhoa.php"><i class="fa fa-user-doctor"></i>&emsp;Quản lý khoa</a></li>
            <li><a href="CapTaiKhoan.php"><i class="fa fa-address-book"></i>&emsp;Cấp tài khoản</a></li>
            <li><a href="QuanLyLichNghiBacSi.php"><i class="fa fa-user-pen"></i>&emsp;Quản lý lịch nghỉ bác sĩ</a></li>
            <li><a href="QuanLyTinTuc.php"><i class="fa fa-bell"></i>&emsp;Quản lý tin tức</a></li>
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
            <!-- <div class="row" style="width:800px; margin-left:15px;">
                <label for="txtid"></label>
                <input name="txtid"  type="hidden"  id="txtid" value="" />       
                <div class="col-md-3 col-sm-6 col-xs-12" id="bs_anh">
                    <img src="../img/bs-DinhDucHuy.jpg" width="150" height="150" />
                    <p style="width:150px; padding-top:20px; padding-left:30px;"><a href ="#" data-toggle="modal" data-target="#change_image">Thay đổi ảnh</a></p>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12" id="information_detail">
                    <div id="bs_ten"><b>Tên bác sĩ: </b> Đinh Đức Huy</div>
                    <div id="bs_namsinh"><b>Năm sinh: </b> 1985</div>
                    <div id="bs_gioitinh"><b>Giới tính: </b> Nam</div>
                    <div id="bs_chuyenkhoa"><b>Chuyên khoa: </b> Nội tim mạch 1</div>
                    <div id="bs_sdt"><b>Số điện thoại: </b>0778888123</div>
                    <div id="bs_diachi"><b>Địa chỉ: </b> 1 Nguyễn Du</div>
                    <div id="bs_noilv"><b>Mô tả: </b>  kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk</div>
                    <button type="button"  style="margin-top:15px" class="btn btn-primary"  data-toggle="modal" data-target="#capnhat">Cập nhật</button>
                    <button type="button" style="margin-top:15px" class="btn btn-danger" ><a href="" style="color:white;text-decoration: none;">Đăng xuất</a></button>
                </div>
            </div> -->
            <?php $p->loadinfoadmin("SELECT * FROM admin order by id_admin asc"); ?>
        </div>
    </section>
 
     <footer>
     <?php include("footer.php");?>
     </footer> 
</body>
</html>