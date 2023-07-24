<?php
ob_start();
session_start();
include_once("../class/healthcarestaff.php");
$p = new healthcarestaff();
if (isset($_SESSION["id"]) && isset($_SESSION["user"]) && isset($_SESSION["id_user"]) && isset($_SESSION["pass"]) && isset($_SESSION["phanquyen"])==3) {
    include("../class/config.php");
    $q = new connect();
    $q->confirm_nvyt ($_SESSION["user"], $_SESSION["pass"], $_SESSION["id"],$_SESSION["id_user"], $_SESSION["phanquyen"]);
} 
else 
{
    header("location: ../login.php");
}

 $layid= $_SESSION["id_user"]; 
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        nav {
            line-height: 30px;
            background-color: #eeeeee;
            height: 300px;
            width: 300px;
            float: left;
            padding: 5px;
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
    <?php include("menu.php"); ?>
    <nav>
        <ul>
            <li><a href="XemThongTinCaNhan.php"><i class="fa fa-user-nurse"></i>&emsp;Xem thông tin cá nhân</a></li>
            <li><a href="datlichbn.php"><i class="fa fa-user-pen"></i>&emsp;Đặt lịch khám</a></li>
            <li><a href="QuanLyBenhNhan.php"><i class="fa fa-address-book"></i>&emsp;Quản lý bệnh nhân</a></li>
            <li><a href="QuanLyTinTuc.php"><i class="fa fa-newspaper"></i>&emsp;Quản lý tin tức</a></li>
            <li><a href="BenhNhanDangKy.php"><i class="fa fa-bell"></i>&emsp;Điều phối bệnh nhân đăng ký</a></li>
        </ul>
    </nav>

    <section>
        <h4 style="font-weight: bold " class="text-center">THÔNG TIN CÁ NHÂN</h4>
        <div class="information">
            <div class="row" style="width:800px; margin-left:15px;">

                <label for="txtid"></label>
                <input name="txtid" type="hidden" id="txtid" value="<?php echo $layid; ?>" />
                <?php  $layid_khoa = $p->laycot("SELECT id_khoa FROM nvyt WHERE id_nvyt='$layid' LIMIT 1"); ?>

                <div class="col-md-3 col-sm-6 col-xs-12" id="bs_anh">
                    <img src="../img/<?php echo $p->laycot("SELECT hinhanh FROM nvyt WHERE id_nvyt='$layid'") ?>" width="150" height="150" />
                    <p style="width:150px; padding-top:20px; padding-left:30px;"><a style="color: #00bb00;" href="#" data-toggle="modal" data-target="#change_image">Thay đổi ảnh</a></p>
                </div>

                <div class="col-md-5 col-sm-6 col-xs-12" id="information_detail">
                    <div id="bs_ten"><b>Tên nhân viên y tế: </b> <?php echo  $p->laycot("SELECT tennvyt FROM nvyt WHERE id_nvyt='$layid' LIMIT 1") ?> </div>
                    <div id="bs_namsinh"><b>Năm sinh: </b> <?php echo $p->laycot("SELECT namsinh FROM nvyt WHERE id_nvyt='$layid' LIMIT 1") ?></div>
                    <div id="bs_gioitinh"><b>Giới tính: </b> <?php echo $p->laycot("SELECT gioitinh FROM nvyt WHERE id_nvyt='$layid' LIMIT 1")  ?></div>
                    <div id="bs_chuyenkhoa"><b>Chuyên khoa: </b><?php echo $p->laycot("SELECT tenkhoa FROM khoa WHERE id_khoa='$layid_khoa'LIMIT 1") ?></div>
                    <div id="bs_sdt"><b>Số điện thoại: </b><?php echo $p->laycot("SELECT sdt FROM nvyt WHERE id_nvyt='$layid' LIMIT 1") ?></div>
                    <div id="bs_diachi"><b>Địa chỉ: </b><?php echo $p->laycot("SELECT diachi FROM nvyt WHERE id_nvyt='$layid' LIMIT 1")?></div>
                    <button type="button" style="margin-top:15px" class="btn btn-success" data-toggle="modal" data-target="#capnhat">Cập nhật</button>
                    <button type="button" style="margin-top:15px" class="btn btn-danger"><a href="../logout.php" style="color:white;text-decoration: none;">Đăng xuất</a></button>
                </div>
            </div>
        </div>


    </section>

    <!--Modal nút SỬA thông tin-->
    <div class="modal" id="capnhat">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">CẬP NHẬT THÔNG TIN CÁ NHÂN </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="font-weight-bolder">Tên nhân viên y tế: </label>
                            <input type="text" class="form-control" name="txtten" value="<?php echo $p->laycot("SELECT tennvyt FROM nvyt WHERE id_nvyt='$layid' LIMIT 1") ?>">
                        </div>
                        <label for="txtid"></label>
                        <input name="txtid" type="hidden" id="txtid" value="<?php echo $layid; ?>" />
                        <div class="form-group">
                            <label class="font-weight-bolder">Giới tính: </label>
                            <select class="form-control" name="txtgioitinh">
                                <option value="<?php  echo $p->laycot("SELECT gioitinh from nvyt where id_nvyt='$layid' limit 1")?>" selected="selected" style="color:white;">
                                <?php  echo $p->laycot("SELECT gioitinh FROM nvyt WHERE id_nvyt='$layid' LIMIT 1")?>
                                </option>
                                <option value="Nữ">Nữ</option>
                                <option value="Nam">Nam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder">Năm sinh: </label>
                            <input type="text" class="form-control" name="txtns" value="<?php echo $p->laycot("SELECT namsinh FROM nvyt WHERE id_nvyt='$layid'")  ?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bolder">Chuyên khoa:</label>
                      <select class="form-control" name="txtck" id="txtck">
                      <option value="<?php  echo $p->laycot("SELECT id_khoa FROM khoa WHERE id_khoa='$layid_khoa' LIMIT 1")?>" selected="selected" style="color:white;">
                      <?php  echo $p->laycot("SELECT tenkhoa FROM khoa WHERE id_khoa='$layid_khoa'LIMIT 1")?>
                    </option>
                
                      <?php
                        $sql = "SELECT * FROM khoa";
                        $ketqua = mysqli_query($p->connect(),$sql);
                        $i=mysqli_num_rows($ketqua);
                        if($i>0)
                        {
                            while( $row = mysqli_fetch_array($ketqua))
                            {
                                echo '<option value="'.$row['id_khoa'].'">'.$row['tenkhoa'].'</option>';
                            }
                        }
                        
                    ?>
                      </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder">Số điện thoại: </label>
                            <input type="text" class="form-control" name="txtsdt" minlength="8" maxlength="10" value="<?php echo $p->laycot("SELECT sdt FROM nvyt WHERE id_nvyt='$layid'") ?>">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder">Địa chỉ: </label>
                            <input type="text" class="form-control" name="txtdiachi" value="<?php echo $p->laycot("SELECT diachi FROM nvyt WHERE id_nvyt='$layid'") ?>">
                        </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" id="nut" name="capnhat" value="Cập nhật" class="btn btn-success">Cập nhật</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php 
        if(isset($_POST['capnhat']))
        {
            $idsua=$_REQUEST['txtid'];
            $ten = $_REQUEST["txtten"];
            $gioitinh = $_REQUEST["txtgioitinh"];
            $namsinh = $_REQUEST['txtns'];
            $chuyenkhoa = $_REQUEST['txtck'];
            $sdt = $_REQUEST['txtsdt'];
            $diachi = $_REQUEST['txtdiachi'];
           // var_dump($_POST); exit();
            
                if($idsua>0)
                {
                    if($p->themxoasua("UPDATE nvyt SET tennvyt = '$ten', `gioitinh` = '$gioitinh', `namsinh` = '$namsinh', `sdt` = '$sdt', `diachi` = '$diachi', `id_khoa` = '$chuyenkhoa' WHERE `id_nvyt` = '$idsua' LIMIT 1;")==1)
                        {
                            header("location:XemThongTinCaNhan.php");
                        }
                    else
                    {
                        echo '<script>alert("Cập nhật không thành công")</script>';
                    }
                }
                else
                {
                    echo'<script>alert("Lỗi!");</script>';
                }
               
                
        }
           
        
    ?>
    <!--Modal sửa hình-->
    <div class="modal" id="change_image">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <label for="myimg"></label>
                        <input type="file" name="myimg" id="myimg" />
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" name="hinh" value="Lưu"></input>
                            <a href='#' class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php 
        if(isset($_POST['hinh']))
        {
            $name = $_FILES["myimg"]["name"];
            $tmp_name = $_FILES["myimg"]["tmp_name"];
            $size = $_FILES["myimg"]["size"];
            $type = $_FILES["myimg"]["type"];
            if($name !='')
            {
                $name = time().'_'. $name;
                if($p->myupfile($name,$tmp_name, "../img")==1)
                {
                    if($p->themxoasua("UPDATE nvyt SET hinhanh = '$name' WHERE id_nvyt = '$layid'")==1)
                    {
                        header("location:XemThongTinCaNhan.php");
                    }
                    else
                    {
                        echo'<script>alert("Cập nhật không thành công!")</script>';
                    }
                }
                else
                {
                    echo '<script>alert("Upload hình không thành công!")</script>';
                }
            }
            else
            {
                echo '<script>alert("Vui lòng chọn hình!");</script>';
            }
        }
    ?>
    <footer>
        <?php include("footer.php"); ?>
    </footer>

</body>

</html>