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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> 
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
        table, tr{
            border-top:1px solid #ccc;
            border-bottom:1px solid #ccc;
        }
        table{
            border-collapse:collapse;
            width:100%;
            text-align:center;
        }
        th, td{
            text-align:center;
            padding:10px;
            border-bottom:1px solid #ccc;
        }
        td > a{
            text-decoration: none;
            color: black;
        }
        td>a:hover{
            color: #00a600;
        }
        tr:hover{
            background-color:#d2d2ff;
            cursor:pointer;
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
            <li><a href="QuanLyTinTuc.php"><i class="fa fa-newspaper"></i>&emsp;Quản lý tin tức</a></li>
            <li><a href="QuanLyNotice.php"><i class="fa fa-newspaper"></i>&emsp;Quản lý notice</a></li>
            <li><a href="BenhNhanDangKy.php"><i class="fa fa-bell"></i>&emsp;Bệnh nhân đăng ký khám</a></li>
            
         </ul>
    </nav>
    <section>
        <div class="information">
            <div class="container" style="width:100%; margin-left:25px;">
                <h3 style="text-align: center;font-weight: bold">DANH SÁCH NHÂN VIÊN Y TẾ</h3> 
                <div class="search">
                    <form action="" method="POST" style="padding-left:50px;padding-top: 5px;" value="<?php //echo (isset($_POST['tim'])) ? $_POST['tim'] : '' 
                                                                                                        ?>">

                        <label for="txtsearch"></label>
                        <div class="search" style="display:flex; margin-bottom: 10px">
                            <input style="width:400px; margin-right: 10px;" class="form-control" type="text" name="txtsearch" id="txtsearch" placeholder="Tìm kiếm bệnh nhân" />
                            <input class="btn btn-success" type="submit" name="nut" id="nut" value="Tìm kiếm" />
                        </div>
                    </form>
                </div>
                <button style="float: right;margin-left: 5px; margin-bottom: 5px;background-color: green; border-color:#7dff7d" type="button" class="btn btn-primary"  data-toggle="modal" data-target="#sua">Cập nhật</button> 
                <button style="float: right; margin-bottom: 5px;background-color: green; border-color:#7dff7d" type="button" class="btn btn-primary"  data-toggle="modal" data-target="#xem">Xem thông tin</button>
                

                <?php 
                if (isset($_POST['nut'])) {
                    $k = $_POST['txtsearch'];
                    if ($k == "") {
                        echo '<script>alert("Vui lòng nhập vào thanh tìm kiếm!")</script>';
                    } else {
                        $p->timkiemnvyt("SELECT * FROM nvyt WHERE tennvyt LIKE '%$k%' ORDER BY tennvyt ASC");
                    }
                } else {

                    $p->loadliststaff("SELECT * FROM nvyt order by id_nvyt asc"); 
                }
                //$p->loadliststaff("SELECT * FROM nvyt order by id_nvyt asc"); 
                ?>
            </div>
        </div>
    </section>
 
    <footer>
        <?php include("footer.php");?>
    </footer> 

    <!--Modal nút XEM thông tin-->
    <div class="modal" id="xem">
        <div class="modal-dialog">
            <div class="modal-content">

      <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">THÔNG TIN NHÂN VIÊN Y TẾ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

      <!-- Modal body -->
                <div class="modal-body">
                    
                    <?php $p->loadinfostaff("SELECT * FROM nvyt order by id_nvyt asc"); ?>
                </div>

      <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>    
    
    <!--Modal nút SỬA thông tin-->

    <div class="modal" id="sua">
        <div class="modal-dialog">
            <div class="modal-content">

  <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">CẬP NHẬT THÔNG TIN NHÂN VIÊN Y TẾ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

  <!-- Modal body -->
                
                    <?php $p->updateinfostaff("SELECT * FROM nvyt order by id_nvyt asc"); ?>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['xoa']))
        {
            $idxoa=$_REQUEST['txtid'];
            if($idxoa>0)
            {
            
                if($p->themxoasua("DELETE from nvyt where id_nvyt='$idxoa' limit 1")==1)
                {
                    
                        header('location:QuanLyNvyt.php'); 
                }
                else
                {
                    echo'<script>alert("Xóa không thành công!")</script>';
                }
            }
            else
            {
                echo'<script>alert("Vui lòng chọn bác sĩ cần xóa!")</script>';	
            }
        }
        if(isset($_POST['capnhat']))
        {
            $idsua=$_REQUEST['txtid'];
            $ten = $_REQUEST['txtten'];
            $gioitinh = $_REQUEST['txtgioitinh'];
            $namsinh = $_REQUEST['txtns'];
            $chuyenkhoa = $_REQUEST['txtck'];
            $sdt = $_REQUEST['txtsdt'];
            $diachi = $_REQUEST['txtdiachi'];
            $chucvu = $_REQUEST['txtchucvu'];
            if($idsua>0)
            {
                if($p->themxoasua("UPDATE nvyt SET tennvyt = '$ten', gioitinh = '$gioitinh', namsinh = '$namsinh',chucvu ='$chucvu' , id_khoa = '$chuyenkhoa', diachi = '$diachi', sdt = '$sdt' WHERE id_nvyt ='$idsua' LIMIT 1 ;")==1)
                {  
                    header('location:QuanLyNvyt.php');
                }
                else
                {
                    echo'<script>alert("Cập nhật thông tin không thành công!")</script>';	
                }
            }
            else
            {
                echo'<script>alert("Vui lòng chọn bác sĩ cần cập nhật thông tin!")</script>';	
            }
        }
    ?>
</body>
</html>
