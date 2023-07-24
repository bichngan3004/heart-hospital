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
    <link rel='shortcut icon' href='../img/icon/tittle.jpg' />
    <title>Tam Duc Heart Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
            width: 76%;
            float: left;
            padding: 10px;

        }

        footer {
            clear: both;
            position: sticky;

        }

        nav ul {
            margin-bottom: 10px;
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
            color: green;
        }

        tr:hover {
            background-color: #d2d2ff;
            cursor: pointer;
        }

        .huy:hover {

            font-weight: 1000;
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
            <li><a href="chidinhxn.php"><i class="fa fa-id-card"></i>&emsp;Nhận phiếu xét nghiệm</a></li>
            <li><a href="QuanLyBenhAn.php"><i class="fa fa-user"></i>&emsp;Quản lý bệnh án bệnh nhân</a></li>
            <li><a href="updateaccount.php"><i class="fa fa-file-signature"></i>&emsp;Cập nhật tài khoản</a></li>
        </ul>


    </nav>
    <section>
        <div class="xemlich">
            <div class="row">

                <div class="col-md-8">
                    <div style="float:left; ">
                        <h3 style="text-align: center;font-weight: bold;">LỊCH KHÁM</h3>
                        <label for="txtid"></label>
                        <input name="txtid" type="hidden" id="txtid" value="" />
                        

                        
                        <button type="button" style="float:right; margin-bottom: 5px; background-color: green; border-color:#7dff7d" data-toggle="modal" data-target="#chitiet" class="btn btn-primary" name="nut">Nhập phiếu khám</button>

                        <?php
                        $link = $p->connect();
                        $sql = "select * from phieudkkham  where id_bacsi='$layid' order by status and ngayhen asc";
                        $ketqua = mysqli_query($link, $sql);
                        ?>
                        <table class="table table-bordered" style="margin-bottom: 50px; width:102%">
                            <tr style=" border-bottom:1px solid #ccc; background-color:green; color:white">
                                <th>STT</th>
                                <th>BỆNH NHÂN</th>
                                <th>TRIỆU CHỨNG</th>
                                <th>NGÀY HẸN KHÁM</th>
                                <th>GIỜ HẸN</th>
                                <th>TRẠNG THÁI</th>

                            </tr>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($ketqua)) {
                                $i++;
                                // $id_code = $row['code_phieu'];
                                $id_phieudkkham = $row['id_phieudk'];
                                $id_benhnhan = $row['id_benhnhan'];
                                $token = $row['token'];
                                $trieuchung = $row['trieuchung'];
                                $ngayhen = $row['ngayhen'];
                                $id_bacsi = $row['id_bacsi'];
                                $array_ngayhen = explode('_', $row['ngayhen']);
                            ?>
                                <tr>
                                    <td><?php echo '<a href="?id=' . $id_phieudkkham . '">' . $i . '</a>' ?></td>

                                    <td style="text-align:left"><?php echo '<a href="?id=' . $id_phieudkkham . '">' .

                                                                    $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan ='$id_benhnhan' and token='$token'")
                                                                    . '</a>' ?></td>
                                    <td style="text-align:left"><?php echo '<a href="?id=' . $id_phieudkkham . '">' . $trieuchung . '</a>' ?></td>
                                    <td><?php echo '<a href="?id=' . $id_phieudkkham . '">' . date('j-m-Y', strtotime($array_ngayhen[1])) . '</a>' ?></td>
                                    <td><?php
                                        if ($array_ngayhen[0] == 1) :
                                            echo "7:00 - 9:00";
                                        elseif ($array_ngayhen[0] == 2) :
                                            echo "9:00 - 11:00";
                                        elseif ($array_ngayhen[0] == 3) :
                                            echo "13:00 - 15:00";
                                        else :
                                            echo "15:00 - 17:00";
                                        endif; ?>
                                    </td>
                                    <td><?php
                                        if ($row['status'] == 0) {
                                            echo '<a style="color:#009d00">Chờ khám</a>';
                                            echo ' | ';
                                            echo ' <a href="baolich.php?id=' . $id_phieudkkham . '" name="ban" class="huy" style="color:red" >X</a>';
                                        } else {
                                            echo '<a style="color:grey">Đã khám</a>';
                                        }
                                        ?>
                                        <?php //echo ' <a href="baolich.php?id=' . $id_phieudkkham . '" name="ban" class="btn btn-danger"><b>-</b></a>' 
                                        ?>
                                    </td>

                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>


                <div class="col-md-4" style="margin-top:43px;">
                    <div style="float:left; ">
                        <h3 style="text-align: center;font-weight: bold;">LỊCH NGHỈ</h3>

                        <?php
                        $link = $p->connect();
                        $sql = "select * from lichnghi where id_bacsi='$layid'";
                        $ketqua = mysqli_query($link, $sql);
                        ?>
                        <table class="table table-bordered" style="margin-bottom: 50px; width:107%">
                            <tr style=" border-bottom:1px solid #ccc; background-color:green; color:white">
                                <th>STT</th>
                                <th>NGÀY NGHỈ</th>
                                <th>CA NGHỈ</th>
                                <th>LÝ DO</th>
                            </tr>
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($ketqua)) {
                                $i++;

                                $array_ngaynghi = explode('_', $row['ngayhen']);
                                $lydo = $row['lydo'];
                            ?>
                                <tr>
                                    <td><?php echo '<a>' . $i . '</a>' ?></td>
                                    <td><?php echo '<a>' . date('j-m-Y', strtotime($array_ngaynghi[1])) . '</a>' ?></td>
                                    <td><?php
                                        if ($array_ngayhen[0] == 1) :
                                            echo "7:00 - 9:00";
                                        elseif ($array_ngayhen[0] == 2) :
                                            echo "9:00 - 11:00";
                                        elseif ($array_ngayhen[0] == 3) :
                                            echo "13:00 - 15:00";
                                        else :
                                            echo "15:00 - 17:00";
                                        endif; ?>
                                    </td>
                                    <td style="text-align: left;"><?php echo '<a>' . $lydo . '</a>' ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>

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

</body>

</html>
<!--Modal nhập phiếu khám bệnh-->
<div class="modal " id="chitiet" style="margin-top: 20px; border-radius:10px">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">PHIẾU KHÁM BỆNH</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
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
                                <input type="text" class="form-control" name="phongkham" value="<?php echo $p->laycot("SELECT phong FROM bacsi WHERE id_bacsi='$layid'") ?>">
                            </div>
                            <div class="form-check-inline">
                                <label class="font-weight-bolder"><b>Xét nghiệm: </b></label>
                                <input class="form-check-input" type="checkbox" name="xn" value="Có" id="flexCheckChecked">Có
                                <input class="form-check-input" type="checkbox" name="xn" value="Không" id="flexCheckChecked">Không
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Loại xét nghiệm: </b></label>
                                <select name="lxn" id="" class="form-control">
                                    <option value="Huyết học (Hematology Test)">Huyết học (Hematology Test)</option>
                                    <option value="Đông máu (Coagulation Test)">Đông máu (Coagulation Test)</option>
                                    <option value="Sinh hóa (Biochemistry Test)">Sinh hóa (Biochemistry Test)</option>
                                    <option value="Miễn dịch (Immunology Test)">Miễn dịch (Immunology Test)</option>
                                    <option value="Nước tiểu (Urine) - Phân (Stool)">Nước tiểu (Urine) - Phân (Stool)</option>
                                </select>
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
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Thoát</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<?php
if (isset($_POST['nutluu'])) {
    $ngay = $_REQUEST['txtngay'];
    $gio = $_REQUEST['txttime'];
    $phikham = $_REQUEST['txtphi'];
    $phongkham = $_REQUEST['phongkham'];
    $kq = $_REQUEST['txtkq'];
    $chidan = $_REQUEST['txtcd'];
    $xetnghiem = $_REQUEST['xn'];
    $loaixn = $_REQUEST['lxn'];

    //echo $phongkham; die();


    //$token = $_REQUEST['txttoken'];
    $id_phieudk = $p->laycot("SELECT id_phieudk FROM phieudkkham WHERE id_phieudk = '$layidpk'");
    $layid_bn = $p->laycot("SELECT id_benhnhan FROM phieudkkham WHERE id_phieudk ='$layidpk'");
    $layid_bntoken = $p->laycot("SELECT token FROM phieudkkham WHERE id_phieudk ='$layidpk'");
    $id_bacsi = $p->laycot("SELECT id_bacsi FROM phieudkkham WHERE id_phieudk = '$layidpk'");
    $sql2 = "INSERT INTO benhan (id_benhan, id_benhnhan) SELECT * FROM (SELECT null, '$layid_bn') AS tmp
                        WHERE NOT EXISTS ( SELECT id_benhan FROM benhan WHERE id_benhnhan = '$layid_bn') LIMIT 1";
    if ($layid_bn > 0) {
        if (mysqli_query($link, $sql2)) {
            // $last_id = mysqli_insert_id($link);
            $id_benhan = $p->laycot("select id_benhan from benhan where id_benhnhan ='$layid_bn'");
            $sql1 = "INSERT INTO phieukhambenh (id_phieukham, ngaykham, giokham,xetnghiem,loaixetnghiem, phongkham, ketqua, chidan, phikham, id_benhnhan, id_phieudk, id_bacsi, id_benhan,token) VALUES (NULL, '$ngay', '$gio','$xetnghiem','$loaixn', '$phongkham', '$kq', '$chidan', '$phikham', '$layid_bn', '$id_phieudk', '$id_bacsi', '$id_benhan','$layid_bntoken')";
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