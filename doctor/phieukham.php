<?php
session_start();
ob_start();
if (isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['id_user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen']) == 2) {
    include('../class/config.php');
    $q = new connect();
    $q->confirm_login($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen'], $_SESSION['id_user']);
} else {
    header('location:../login.php');
}

include("../class/clsdoctor.php");
$p = new doctor();

$layid = $_SESSION['id_user'];
$layidpk = 0;
if (isset($_REQUEST['id'])) {
    $layidpk = $_REQUEST['id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Bệnh Án</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="./../tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#txtnoidung',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
    </script>
    <script>
        $(document).ready(function() {
            var count = 1;
            $("#btndk").click(function() {
                var tenthuoc, soluong, donvi, thoigian, soluongsang, soluongtrua, soluongchieu, dvuong;
                tenthuoc = $("#id_thuoc option:selected").val();
                soluong = $("#soluong").val();
                donvi = $("#donvi").val();
                thoigian = $("#input[type='checkbox']:checked").val();
                soluongsang = $("#slsang").val();
                soluongtrua = $("#sltrua").val();
                soluongchieu = $("#slchieu").val();
                dvuong = $("#dv").val();
                var trnew = "<tr><td>" + count + "</td><td>" + tenthuoc + "</td><td>" + soluong + "</td><td>" + donvi + "</td><td>" + soluongsang + dvuong + "</td><td>" + soluongtrua + dvuong + "</td><td>" + soluongchieu + dvuong + "</td></tr>";
                $("#tbl").append(trnew);
                count++;

            })
        })
    </script>
    <style>
        nav {
            line-height: 45px;
            background-color: #eeeeee;
            height: 100%;
            width: 23%;
            float: left;
            padding: 5px;

        }

        section {
            width: 75%;
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
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ccc;

        }

        td>a {
            text-decoration: none;
            color: black;
        }

        td>a:hover {
            color: green;
        }

        tr:hover {
            background-color: #d2d2ff;
            /* color: white; */
            cursor: pointer;
        }

        .dropbtn {
            background-color: #006bd7;
            color: white;
            padding: 6px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;

        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            color: green;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            margin-top: 30px;
            display: block;
        }

        .dropdown:hover .dropbtn {

            background-color: blue;
        }
    </style>
</head>

<body>

    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>

    <nav>
        <ul>
            <li><a href="XemThongTinCaNhan.php"><i class="fa fa-bars"></i>&emsp;Xem thông tin cá nhân</a></li>
            <li><a href="XemLich.php"><i class="fa fa-calendar-week"></i>&emsp;Xem lịch khám</a></li>
            <li><a href="chidinhxn.php"><i class="fa fa-user"></i>&emsp;Nhận xét nghiệm</a></li>
            <li><a href="QuanLyBenhAn.php"><i class="fa fa-user"></i>&emsp;Quản lý bệnh án bệnh nhân</a></li>
            <li><a href="updateaccount.php"><i class="fa fa-user"></i>&emsp;Cập nhật tài khoản</a></li>
        </ul>
    </nav>

    <section>
        <div class="phieukham">
            <h3 class="text-center">PHIẾU KHÁM BỆNH</h3>
            <div class="phieukham_details">
                <form action="" method="POST">

                    <?php $layid_bn = $p->laycot("SELECT id_benhnhan FROM phieudkkham WHERE id_phieudk ='$layidpk'");
                    $layid_bntoken =  $p->laycot("SELECT token FROM phieudkkham WHERE id_phieudk ='$layidpk'");
                    ?>
                    <label for="txtid"></label>
                    <input type="hidden" name="txtid" id="txtid" value="<?php echo $layid_bn ?>" /></td>
                    <input type="hidden" name="txttoken" id="txttoken" value="<?php echo $layid_bntoken ?>" /></td>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                                <input type="text" class="form-control" name="txttenbn" value="<?php

                                                                                                echo $p->laycot("SELECT tenbenhnhan FROM benhnhan WHERE id_benhnhan='$layid_bn'");
                                                                                                ?>">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Ngày khám: </b></label>
                                <input type="text" class="form-control" name="txtngay" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Giờ khám: </b></label>
                                <input type="time" class="form-control" name="txttime" value="<?php date_default_timezone_set("Asia/Ho_Chi_Minh");
                                                                                                echo date("H:i:s") ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Phòng khám: </b></label>
                                <input type="text" class="form-control" name="txtphongkham" value="<?php echo $p->laycot("SELECT phong FROM bacsi WHERE id_bacsi='$layid'") ?>">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Bác sĩ khám: </b></label>
                                <input type="text" class="form-control" name="txtbsk" value="<?php echo $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi='$layid'"); ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Phí khám: </b></label>
                                <input type="text" class="form-control" name="txtphi" value="<?php echo $p->laycot("SELECT phikham FROM phieudkkham WHERE id_phieudk='$layidpk'"); ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Chuẩn đoán: </b></label>
                                <input type="text" class="form-control" name="txtkq" value="">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Chỉ dẫn: </b></label>
                                <input type="text" class="form-control" name="txtcd" value="">
                            </div>
                            <!-- <input type="hidden" class="form-control" name="txttoken" value=""> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" style="background-color: green; border-color:#7dff7d" class="btn btn-primary" name="nutluu" value="Lưu"></input>
                        <a href="" type="submit" style="background-color: green; border-color:#7dff7d" class="btn btn-primary" name="nutchidinh" value="Chỉ định xét nghiệm">Chỉ định xét nghiệm</a>
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Thoát</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['nutluu'])) {
            $ngay = $_REQUEST['txtngay'];
            $gio = $_REQUEST['txttime'];
            $phikham = $_REQUEST['txtphi'];
            $phongkham = $_REQUEST['txtphongkham'];
            $kq = $_REQUEST['txtkq'];
            $chidan = $_REQUEST['txtcd'];


            //$token = $_REQUEST['txttoken'];
            $id_phieudk = $p->laycot("SELECT id_phieudk FROM phieudkkham WHERE id_phieudk = '$layidpk'");
            $layid_bn = $p->laycot("SELECT id_benhnhan FROM phieudkkham WHERE id_phieudk ='$layidpk'");
            $layid_bntoken = $p->laycot("SELECT token FROM phieudkkham WHERE id_phieudk ='$layidpk'");
            $id_bacsi = $p->laycot("SELECT id_bacsi FROM phieudkkham WHERE id_phieudk = '$layidpk'");
            $sql2 = "INSERT INTO benhan (id_benhan, id_benhnhan) SELECT * FROM (SELECT null, '$layid_bn') AS tmp
                        WHERE NOT EXISTS ( SELECT id_benhan FROM benhan WHERE id_benhnhan = '$layid_bn') LIMIT 1";
            $link = $p->connect();
            if ($layid_bn > 0) {
                if (mysqli_query($link, $sql2)) {
                    // $last_id = mysqli_insert_id($link);
                    $id_benhan = $p->laycot("select id_benhan from benhan where id_benhnhan ='$layid_bn'");
                    $sql1 = "INSERT INTO phieukhambenh (id_phieukham, ngaykham, giokham,xetnghiem, phongkham, ketqua, chidan, phikham, id_benhnhan, id_phieudk, id_bacsi, id_benhan,token) VALUES (NULL, '$ngay', '$gio','$check', '$phongkham', '$kq', '$chidan', '$phikham', '$layid_bn', '$id_phieudk', '$id_bacsi', '$id_benhan','$layid_bntoken')";
                    if (mysqli_query($link, $sql1)) {
                        $sql_update = "UPDATE phieudkkham SET status = '1' WHERE id_phieudk = '$layidpk'";
                        $query = mysqli_query($p->connect(), $sql_update);
                        header('Location:QuanLyBenhAn.php');
                        // echo '<script>alert("Thêm thành công!")</script>';
                    } else {
                        echo '<script>alert("Thêm phiếu khám không thành công!!")</script>';
                    }
                }
            } else {
                echo '<script>alert("Vui lòng chọn bệnh nhân cần nhập phiếu khám!!")</script>';
            }

            // }
        }


        if (isset($_POST['nutchidinh'])) {
            $ngay = $_REQUEST['txtngay'];
            $gio = $_REQUEST['txttime'];
            $phikham = $_REQUEST['txtphi'];
            $phongkham = $_REQUEST['txtphongkham'];
            $kq = $_REQUEST['txtkq'];
            $chidan = $_REQUEST['txtcd'];


            //$token = $_REQUEST['txttoken'];
            $id_phieudk = $p->laycot("SELECT id_phieudk FROM phieudkkham WHERE id_phieudk = '$layidpk'");
            $layid_bn = $p->laycot("SELECT id_benhnhan FROM phieudkkham WHERE id_phieudk ='$layidpk'");
            $layid_bntoken = $p->laycot("SELECT token FROM phieudkkham WHERE id_phieudk ='$layidpk'");
            $id_bacsi = $p->laycot("SELECT id_bacsi FROM phieudkkham WHERE id_phieudk = '$layidpk'");
            $sql2 = "INSERT INTO benhan (id_benhan, id_benhnhan) SELECT * FROM (SELECT null, '$layid_bn') AS tmp
                        WHERE NOT EXISTS ( SELECT id_benhan FROM benhan WHERE id_benhnhan = '$layid_bn') LIMIT 1";
            $link = $p->connect();
            if ($layid_bn > 0) {
                if (mysqli_query($link, $sql2)) {
                    // $last_id = mysqli_insert_id($link);
                    $id_benhan = $p->laycot("select id_benhan from benhan where id_benhnhan ='$layid_bn'");
                    $sql1 = "INSERT INTO phieukhambenh (id_phieukham, ngaykham, giokham,xetnghiem, phongkham, ketqua, chidan, phikham, id_benhnhan, id_phieudk, id_bacsi, id_benhan,token) VALUES (NULL, '$ngay', '$gio','$check', '$phongkham', '$kq', '$chidan', '$phikham', '$layid_bn', '$id_phieudk', '$id_bacsi', '$id_benhan','$layid_bntoken')";
                    if (mysqli_query($link, $sql1)) {
                        $sql_update = "UPDATE phieudkkham SET status = '1' WHERE id_phieudk = '$layidpk'";
                        $query = mysqli_query($p->connect(), $sql_update);
                        header('Location:QuanLyBenhAn.php');
                        // echo '<script>alert("Thêm thành công!")</script>';
                    } else {
                        echo '<script>alert("Thêm phiếu khám không thành công!!")</script>';
                    }
                }
            } else {
                echo '<script>alert("Vui lòng chọn bệnh nhân cần nhập phiếu khám!!")</script>';
            }

            // }
        }

        ?>








    </section>

    <footer>
        <?php include("footer.php"); ?>
    </footer>