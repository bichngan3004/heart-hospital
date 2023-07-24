<?php
session_start();
ob_start();
if (isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['id_user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen']) == 4) {
    include('../class/config.php');
    $q = new connect();
    $q->confirm_login($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen'], $_SESSION['id_user']);
} else {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        nav {
            line-height: 45px;
            background-color: #eeeeee;
            height: 100%;
            width: 21%;
            float: left;
            padding: 5px;

        }

        section {
            width: 77%;
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

        table,
        tr {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;

        }

        td>a {
            text-decoration: none;
            color: black;
        }

        td>a:hover {
            color: #00a600;
        }

        tr:hover {
            background-color: #d2d2ff;
            cursor: pointer;
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
        <div class="information">
            <div class="container" style="width:100%; margin-left:25px;">
                <h3 style="text-align: center;font-weight: bold">DANH SÁCH BỆNH NHÂN</h3>
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
                <button style="margin-bottom: 5px;background-color: green; border-color:#7dff7d" class="btn btn-primary " data-toggle="modal" data-target="#them">Thêm bệnh nhân</button>
                <button style="float: right;margin-left: 5px; margin-bottom: 5px;background-color: green; border-color:#7dff7d" type="button" class="btn btn-primary" data-toggle="modal" data-target="#sua">Cập nhật</button>
                <button style="float: right; margin-bottom: 5px;background-color: green; border-color:#7dff7d" type="button" class="btn btn-primary" data-toggle="modal" data-target="#xem">Xem</button>

                <?php
                if (isset($_POST['nut'])) {
                    $k = $_POST['txtsearch'];
                    if ($k == "") {
                        echo '<script>alert("Vui lòng nhập vào thanh tìm kiếm!")</script>';
                    } else {
                        $p->timkiem("SELECT * FROM benhnhan WHERE tenbenhnhan LIKE '%$k%' ORDER BY tenbenhnhan ASC");
                    }
                } else {

                    $p->loadlistpatient("SELECT * FROM nvyt order by id_nvyt asc");
                }

                //$p->loadlistpatient("SELECT * FROM nvyt order by id_nvyt asc"); 
                ?>
            </div>
        </div>
    </section>
    <!-- Back to top -->
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
    <style>
        #myBtn {
            width: 50px;
            height: 50px;
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: green;
            color: white;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
        }

        #myBtn:hover {
            background-color: #555;
        }
    </style>
    <script>
        // Get the button
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <footer>
        <?php include("footer.php"); ?>
    </footer>

    <!--Modal nút XEM thông tin-->
    <div class="modal" id="xem">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">THÔNG TIN BỆNH NHÂN</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <?php $p->loadinfopatient("SELECT * FROM benhnhan order by id_benhnhan asc"); ?>
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
                    <h4 class="modal-title">CẬP NHẬT THÔNG TIN BỆNH NHÂN</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <?php $p->updateinfopatient("SELECT * FROM benhnhan order by id_benhnhan asc"); ?>
            </div>
        </div>
    </div>

    <!--Modal nút THÊM THÔNG TIN-->
    <div class="modal" id="them">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">THÊM THÔNG TIN BỆNH NHÂN</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                            <input type="text" class="form-control" name="txtten" placeholder="Nhập họ tên bệnh nhân">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Giới tính: </b></label>
                            <select class="form-control" name="txtgioitinh">
                                <option value="Nữ">Nữ</option>
                                <option value="Nam">Nam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Năm sinh: </b></label>
                            <input type="text" class="form-control" name="txtns" placeholder="Nhập năm sinh">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Số điện thoại: </b></label>
                            <input type="text" class="form-control" name="txtsdt" minlength="8" maxlength="10" required="required" placeholder="Nhập số điện thoại">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Địa chỉ: </b></label>
                            <input type="text" class="form-control" name="txtdiachi" minlength="8" maxlength="80" required="required" placeholder="Nhập địa chỉ">
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" style="background-color: green; border-color:#7dff7d" id="nut" name="them" value="Thêm" class="btn btn-primary">Thêm</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['them'])) {
        $ten = $_REQUEST['txtten'];
        $gioitinh = $_REQUEST['txtgioitinh'];
        $namsinh = $_REQUEST['txtns'];
        $sdt = $_REQUEST['txtsdt'];
        $diachi = $_REQUEST['txtdiachi'];


        if ($p->themxoasua("INSERT INTO benhnhan(tenbenhnhan,gioitinh,namsinh,sdt,diachi) VALUES ('$ten', '$gioitinh', '$namsinh', '$sdt', '$diachi')") == 1) {

            header('location:QuanLyBenhNhan.php');
        } else {
            echo '<script>alert("Thêm bệnh nhân không thành công!")</script>';
        }
    }
    if (isset($_POST['xoa'])) {
        $idxoa = $_REQUEST['txtid'];
        if ($idxoa > 0) {
            if ($p->themxoasua("DELETE benhnhan, benhan, phieukhambenh from benhnhan, benhan, phieukhambenh where id_benhnhan='$idxoa' limit 1") == 1) {

                header("refresh:0;url=QuanLyBenhNhan.php");
            } else {
                echo '<script>alert("Xóa không thành công!")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn bác sĩ cần xóa!")</script>';
        }
    }
    if (isset($_POST['capnhat'])) {
        $idsua = $_REQUEST['txtid'];
        $ten = $_REQUEST['txtten'];
        $gioitinh = $_REQUEST['txtgioitinh'];
        $namsinh = $_REQUEST['txtns'];
        $sdt = $_REQUEST['txtsdt'];
        $diachi = $_REQUEST['txtdiachi'];
        if ($idsua > 0) {
            if ($p->themxoasua("UPDATE benhnhan SET tenbenhnhan = '$ten', gioitinh = '$gioitinh', namsinh = '$namsinh', sdt = '$sdt', diachi = '$diachi'  WHERE id_benhnhan ='$idsua' LIMIT 1 ;") == 1) {
                header('location:QuanLyBenhNhan.php');
            } else {
                echo '<script>alert("Cập nhật thông tin không thành công!")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn bác sĩ cần cập nhật thông tin!")</script>';
        }
    }
    ?>
</body>

</html>