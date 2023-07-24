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
            <li><a href="chidinhxn.php"><i class="fa fa-id-card"></i>&emsp;Nhận xét nghiệm</a></li>
            <li><a href="QuanLyBenhAn.php"><i class="fa fa-user"></i>&emsp;Quản lý bệnh án bệnh nhân</a></li>
            <li><a href="updateaccount.php"><i class="fa fa-file-signature"></i>&emsp;Cập nhật tài khoản</a></li>
        </ul>
    </nav>

    <section>
        <div class="infor-history">
            <div class="container" style="width:100%; margin-left:15px;">
                <h3 style="text-align: center;font-weight: bold">LỊCH SỬ CHỮA BỆNH</h3>
                <label for="txtid"></label>
                <input name="txtid" type="hidden" id="txtid" value="" /></td>
                <div class="dropdown">
                    <button style="float: right; margin-bottom: 5px; margin-right:5px;background-color: green; border-color:#7dff7d" class="dropbtn">Thêm phiếu</button>
                    <div class="dropdown-content">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_hen">Phiếu hẹn</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_xetnghiem">Phiếu xét nghiệm</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#add_toathuoc">Toa thuốc</a>
                    </div>
                </div>
                <div class="dropdown">
                    <button style="float: right; margin-bottom: 5px; background-color: green; border-color:#7dff7d" class="dropbtn">Cập nhật phiếu</button>
                    <div class="dropdown-content">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#update_khambenh">Phiếu khám bệnh</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#update_hen">Phiếu hẹn</a>
                        <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#update_xetnghiem">Phiếu xét nghiệm</a> -->
                        <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#update_toathuoc">Toa thuốc</a> -->
                    </div>
                </div>

                <?php
                $link = $p->connect();
                $sql = "select * from phieukhambenh where id_bacsi='$layid' order by id_phieukham desc";
                $ketqua = mysqli_query($link, $sql);
                ?>
                <table class="table table-bordered">

                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color:white">
                        <th>STT</th>
                        <th>BỆNH NHÂN</th>
                        <th>NĂM SINH</th>
                        <th>ĐỊA CHỈ</th>
                        <th>NGÀY KHÁM</th>
                        <th></th>
                    </tr>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($ketqua)) {
                        $i++;
                        $id_phieukham = $row['id_phieukham'];
                        $id_benhnhan = $row['id_benhnhan'];
                        $tenbn = $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$id_benhnhan'");
                        $namsinhbn = $p->laycot("select namsinh from benhnhan where id_benhnhan='$id_benhnhan'");
                        '<a href="?id=' . $id_phieukham . '">' . $diachibn = $p->laycot("select diachi from benhnhan where id_benhnhan='$id_benhnhan'");
                        '<a href="?id=' . $id_phieukham . '">' . $ngaykham = $row['ngaykham'];
                    ?>
                        <tr>
                            <td style="text-align: center;"><?php echo '<a href="?id=' . $id_phieukham . '">' . $i . '</a>' ?></td>
                            <td><?php echo '<a href="?id=' . $id_phieukham . '">' . $tenbn . '</a>' ?></td>
                            <td style="text-align: center;"><?php echo '<a href="?id=' . $id_phieukham . '">' . $namsinhbn . '</a>' ?></td>
                            <td><?php echo '<a href="?id=' . $id_phieukham . '">' . $diachibn . '</a>' ?></td>
                            <td style="text-align: center;"><?php echo '<a href="?id=' . $id_phieukham . '">' . $ngaykham . '</a>' ?></td>
                            <td style="text-align: center;">
                              <?php echo' <a href="benhanchitiet.php?id='. $id_phieukham . '" class="btn btn-success">Xem</a>' ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <!-- <div class="infor-benhan" style="width:100%; margin-left:25px; margin-top:30px">
            <h4 style="text-align: center; font-weight: bold;">THÔNG TIN BỆNH ÁN</h4>
            <div class="row" style="margin-bottom:10px">

                <?php
                $link = $p->connect();
                $sql = "select * from phieukhambenh where id_phieukham='$layidpk'";
                $ketqua = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_array($ketqua)) {
                    $id_benhnhan = $row['id_benhnhan'];
                    $ngaykham = $row['ngaykham'];

                ?>
                    <div id="bn_ten"><b>Tên bệnh nhân: </b> <?php echo $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$id_benhnhan'") ?></div>
                    <div id="bn_namsinh"><b>Năm sinh: </b> <?php echo $p->laycot("select namsinh from benhnhan where id_benhnhan='$id_benhnhan'") ?></div>
                    <div id="bn_gioitinh"><b>Giới tính: </b> <?php echo $p->laycot("select gioitinh from benhnhan where id_benhnhan='$id_benhnhan'") ?></div>
                    <div id="bn_sdt"><b>Số điện thoại: </b><?php echo $p->laycot("select sdt from benhnhan where id_benhnhan='$id_benhnhan'") ?></div>
                    <div id="bn_ngaykham"><b>Ngày khám: </b> <?php echo $ngaykham ?></div>
                    <div id="bn_diachi"><b>Địa chỉ: </b> <?php echo $p->laycot("select diachi from benhnhan where id_benhnhan='$id_benhnhan'") ?></div>
                    <div id="bs_tên"><b>Bác sĩ khám: </b> <?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?></div>
                <?php } ?>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php
                    $link = $p->connect();
                    $sql = "select * from phieukhambenh where id_phieukham='$layidpk'";
                    $result = mysqli_query($link, $sql);
                    ?>
                    <table class="table table-bordered" id="information_phieukham" style="width:100%;">
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            $ngaykham = $row['ngaykham'];
                            $giokham = $row['giokham'];
                            $phikham = $row['phikham'];
                            $phongkham = $row['phongkham'];
                            $ketqua = $row['ketqua'];
                            $chidan = $row['chidan'];
                            $chidinhxn = $row['xetnghiem'];
                            $loaixetnghiem = $row['loaixetnghiem'];
                        ?>
                            <tr style="text-align: center;font-weight: bold; color:white; background-color:#009726">
                                <th>Phiếu khám bệnh</th>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <div id="pk_ngaykham"><b>Ngày khám: </b> <?php echo $ngaykham ?></div>
                                    <div id="pk_giokham"><b>Giờ khám: </b> <?php echo $giokham ?></div>
                                    <div id="pk_phi"><b>Phí khám: </b> <?php echo $phikham ?></div>
                                    <div id="pk_phongkham"><b>Phòng khám: </b> <?php echo $phongkham ?></div>
                                    <div id="bn_ngaykham"><b>Chỉ định xét nghiệm: </b> <?php echo $chidinhxn ?></div>
                                    <div id="bn_ngaykham"><b>Loại xét nghiệm: </b> <?php echo $loaixetnghiem ?></div>
                                    <div id="pk_ketqua"><b>Chuẩn đoán: </b> <?php echo $ketqua ?></div>
                                    <div id="pk_diachi"><b>Chỉ dẫn: </b> <?php echo $chidan ?></div>
                                    <div id="pk_tenbs"><b>Bác sĩ khám: </b> <?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?></div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                </div>
                <div class="col-md-6">
                    <?php
                    $link = $p->connect();
                    $sql = "select * from phieuhen where id_phieukham='$layidpk'";
                    $ketqua = mysqli_query($link, $sql);
                    ?>
                    <table class="table table-bordered" id="information_phieukham" style="width:100%;">
                        <?php
                        while ($row = mysqli_fetch_array($ketqua)) {
                            $ngayhen = $row['ngayhen'];
                            $giohen = $row['giohen'];
                            $diadiem = $row['diadiem'];
                        ?>
                            <tr style="text-align: center;font-weight: bold; color:white; background-color:#009726">
                                <th>Phiếu hẹn</th>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <div id="ph_ngayhen"><b>Ngày hẹn: </b> <?php echo $ngayhen ?></div>
                                    <div id="ph_giohen"><b>Giờ hẹn: </b> <?php echo $giohen ?></div>
                                    <div id="ph_diadiem"><b>Địa điểm: </b> <?php echo $diadiem ?></div>
                                    <div id="ph_tenbs"><b>Bác sĩ hẹn: </b><?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?></div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="row" style="margin: 2px;">
                <?php
                $link = $p->connect();
                $sql = "select * from toathuoc where id_phieukham='$layidpk'";
                $ketqua = mysqli_query($link, $sql);
                ?>
                <table class="table table-bordered" id="information_phieukham" style="width:100%">
                    <?php
                    while ($row = mysqli_fetch_array($ketqua)) {
                        $id_phieukham = $row['id_phieukham'];
                        // $chuandoan = $row['chuandoan'];
                        // $sothebhyt = $row['sothebhyt'];
                        //$noidung = $row['noidung'];
                        $tenthuoc = $row['tenthuoc'];
                        $sang = $row['sang'];
                        $trua = $row['trua'];
                        $chieu = $row['chieu'];
                        $sl = 'Viên';
                    ?>
                        <tr style="text-align: center;font-weight: bold; color:white; background-color:#009726">
                            <th>Toa thuốc</th>
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                <div id="tt_chuandoan"><b>Họ tên bệnh nhân: </b> <?php echo $p->laycot("SELECT tenbenhnhan FROM benhnhan WHERE id_benhnhan ='$id_benhnhan'") //echo $chuandoan 
                                                                                    ?></div>
                                <div id="tt_chuandoan"><b>Chuẩn đoán: </b> <?php echo $p->laycot("SELECT ketqua FROM phieukhambenh WHERE id_phieukham ='$id_phieukham'") //echo $chuandoan 
                                                                            ?></div>
                                <div id="tt_chuandoan"><b>Địa chỉ: </b> <?php echo $p->laycot("SELECT diachi FROM benhnhan WHERE id_benhnhan ='$id_benhnhan'") //echo $chuandoan 
                                                                        ?></div>
                                <div id="tt_bhyt"><b>Số thẻ BHYT: </b> <?php //echo $sothebhyt 
                                                                        ?></div>
                                <div id="tt_bs"><b>Bác sĩ điều trị: </b> <?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?></div>
                                <div id="tt_noidung"><b>Đơn thuốc: <br> </b>

                                    <div class="row text-center" style="border-bottom:solid 1px #e5e5e5;border-top:solid 1px #e5e5e5;padding-top: 8px;">
                                        <div class="col" style="border-right:solid 1px #e5e5e5;">
                                            <p><b> Tên thuốc</b></p>
                                        </div>
                                        <div class="col" style="border-right:solid 1px #e5e5e5;">
                                            <p><b> Số lượng</b></p>
                                        </div>
                                        <div class="col" style="border-right:solid 1px #e5e5e5;">
                                            <p><b> Sáng</b></p>
                                        </div>
                                        <div class="col" style="border-right:solid 1px #e5e5e5;">
                                            <p><b>Trưa</b> </p>
                                        </div>
                                        <div class="col" style="border-right:solid 1px #e5e5e5;">
                                            <p><b>Chiều</b> </p>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                if (!empty($ketqua)) :
                                    foreach ($ketqua as $key => $val1) :

                                ?>
                                        <div class="row text-center">
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['tenthuoc']; ?></div>
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['soluong'];
                                                                                                                                        echo "&ensp;";
                                                                                                                                        echo $sl; ?></div>
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['sang'];
                                                                                                                                        echo "&ensp;";
                                                                                                                                        echo $sl; ?></div>
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['trua'];
                                                                                                                                        echo "&ensp;";
                                                                                                                                        echo $sl; ?></div>
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['chieu'];
                                                                                                                                        echo "&ensp;";
                                                                                                                                        echo $sl; ?></div>
                                        </div>
                                <?php
                                    endforeach;
                                else :
                                    "Không có toa thuốc nào.";
                                endif;
                                ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="row" style="margin: 2px;">
                <?php
                $link = $p->connect();
                $sql = "select * from phieuxetnghiem where id_phieukham='$layidpk'";
                $ketqua = mysqli_query($link, $sql);
                ?>
                <table class="table table-bordered" id="information_phieukham" style="width:100%">
                    <?php
                    while ($row = mysqli_fetch_array($ketqua)) {
                        $id_khoa = $row['id_khoa'];
                        $phong = $row['phong'];
                        $sogiuong = $row['sogiuong'];
                        $chuandoan = $row['chuandoan'];
                        $trangthai = $row['trangthai'];
                        $noidung = $row['noidung'];
                        $bacsixn = $row['id_bacsi'];
                    ?>
                        <tr style="text-align: center;font-weight: bold; color:white; background-color:#009726">
                            <th>Phiếu xét nghiệm</th>
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                <div id="pxn_tenbs"><b>Bác sĩ điều trị: </b> <?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?></div>
                                <div id="pxn_khoa"><b>Khoa: </b> <?php echo $p->laycot("select tenkhoa from khoa where id_khoa='$id_khoa'") ?></div>
                                <div id="pxn_phong"><b>Bác sĩ xét nghiệm: </b> <?php echo $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi='$bacsixn'") ?></div>
                               <div id="pxn_giuong"><b>Số giường: </b><?php //echo $sogiuong 
                                                                            ?></div> 
                                <div id="pxn_chuandoan"><b>Chuẩn đoán: </b> <?php echo $chuandoan ?></div>
                                <div id="pxn_trangthai"><b>Trạng thái: </b> <?php echo $trangthai ?></div>
                                <div id="pxn_noidung"><b>Nội dung: </b><?php echo $noidung ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div> -->
    </section>

    <footer>
        <?php include("footer.php"); ?>
    </footer>


    <!--Modal nhập PHIẾU HẸN-->
    <div class="modal " id="add_hen" style="margin-top: 20px; border-radius:10px">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">PHIẾU HẸN</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $link = $p->connect();
                    $sql = "select * from phieukhambenh where id_phieukham='$layidpk'";
                    $ketqua = mysqli_query($link, $sql);
                    ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <?php
                            $i = 0;
                            while ($row = mysqli_fetch_array($ketqua)) {
                                $id_benhnhan = $row['id_benhnhan'];
                                $tenbn = $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$id_benhnhan'");
                            ?>
                                <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                                <input type="text" class="form-control" name="txttenbn" value="<?php echo $tenbn ?>">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Ngày hẹn: </b></label>
                            <input type="date" class="form-control" name="txtngayhen" value="">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Giờ hẹn: </b></label>
                            <input type="time" class="form-control" name="txtgiohen" value="">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Nội dung: </b></label>
                            <input type="text" class="form-control" name="txtnoidung" placeholder="Hẹn tái khám">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Phòng: </b></label>
                            <input type="text" class="form-control" name="txtdiadiem" value="<?php echo $p->laycot("SELECT phong FROM bacsi WHERE id_bacsi='$layid'") ?>">
                        </div><br>
                        <!-- <input type="hidden" class="form-control" name="txttoken"  value=""> -->
                        <div class="modal-footer">
                            <input type="submit" style="background-color: green; border-color:#7dff7d" class="btn btn-primary" name="luuphen" value="Lưu"></input>
                            <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</a>
                        </div> <?php } ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['luuphen'])) {
        $ten = $_REQUEST['txttenbn'];
        $ngay = $_REQUEST['txtngayhen'];
        $gio = $_REQUEST['txtgiohen'];
        $nd = $_REQUEST['txtnoidung'];
        $dd = $_REQUEST['txtdiadiem'];
        if ($layidpk > 0) {
            if ($p->themxoasua("INSERT INTO phieuhen(id_phieuhen,ngayhen,giohen,noidung,diadiem,id_phieukham) VALUES (null, '$ngay', '$gio', '$nd', '$dd', '$layidpk')") == 1) {

                header('location:QuanLyBenhAn.php');
            } else {
                echo '<script>alert("Thêm phiếu hẹn không thành công!")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn phiếu khám bệnh cần thêm phiếu hẹn!")</script>';
        }
    }
    ?>

    <!--Modal nhập PHIẾU XÉT NGHIỆM-->
    <div class="modal " id="add_xetnghiem" style="margin-top: 20px; border-radius:10px;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:1000px">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">PHIẾU XÉT NGHIỆM</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $layid_khoa = $p->laycot("select id_khoa from bacsi where id_bacsi='$layid' limit 1");
                    $layid_bacsi = $p->laycot("select id_bacsi from bacsi where id_bacsi='$layid' limit 1");
                    $link = $p->connect();
                    $sql = "select * from phieukhambenh where id_phieukham='$layidpk'";
                    $ketqua = mysqli_query($link, $sql);
                    ?>
                    <form action="" method="POST">
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($ketqua)) {
                            $id_benhnhan = $row['id_benhnhan'];
                            $id_bacsi = $row['id_bacsi'];
                            $tenbn = $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$id_benhnhan'");
                            $tenkhoa = $p->laycot("SELECT tenkhoa FROM khoa WHERE id_khoa ='$layidpk'");
                            $ngaykham = $row['ngaykham'];
                        ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                                        <input type="text" class="form-control" name="txttenbn" value="<?php echo $tenbn ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Ngày khám: </b></label>
                                        <input type="date" class="form-control" name="txtngaykham" value="<?php echo $ngaykham ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Khoa: </b></label>
                                        <select class="form-control" name="txtkhoa" id="id_khoa">
                                            <option value="" selected="selected">
                                                Chọn chuyên khoa
                                            </option>
                                            <?php
                                            $sql = "SELECT * FROM khoa";
                                            $ketqua = mysqli_query($p->connect(), $sql);
                                            $i = mysqli_num_rows($ketqua);
                                            if ($i > 0) {
                                                while ($row = mysqli_fetch_array($ketqua)) {
                                                    echo '<option value="' . $row['id_khoa'] . '">' . $row['tenkhoa'] . '</option>';
                                                }
                                            }

                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group">

                                        <label class="font-weight-bolder"><b>Bác sĩ xét nghiệm: </b></label>
                                        <select class="form-control" name="txtbacsi" id="id_bacsi">
                                            <!-- <option value="<?php //echo $p->laycot("SELECT id_bacsi FROM bacsi WHERE id_khoa='$layid_bacsi'") 
                                                                ?>">
                                            <?php //echo $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_khoa='$layid_bacsi'") 
                                            ?>
                                            </option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- <label class="font-weight-bolder"><b>Số giường: </b></label>
                                    <input type="number" class="form-control" name="txtgiuong" placeholder="Số giường"> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Bác sĩ khám: </b></label>
                                        <input type="text" class="form-control" name="txtbsk" value="<?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Loại xét nghiệm: </b></label>
                                        <input type="text" class="form-control" name="txtbsk" value="<?php echo $p->laycot("select loaixetnghiem from phieukhambenh where id_phieukham='$layidpk'") ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Chuẩn đoán: </b></label>
                                        <input type="text" class="form-control" name="txtchuandoan" placeholder="Nhập kết quả chuẩn đoán">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Trạng thái: </b></label>
                                        <input type="text" class="form-control" name="txttrangthai" placeholder="Thường hay Cấp cứu?">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textarea"><b>Nội dung: </b></label>
                                <textarea name="txtnoidung" id="txtnoidung">
                                <table class="table table-bordered" border="1">
                                    <tr>
                                        <td>
                                            <table class="table table-bordered" style="border: 1px solid grey;" ><colgroup><col style="width: 94%;"><col style="width: 6%;"></colgroup>
                                                
                                                    <tr>
                                                        <th colspan="2"><b>HUYẾT HỌC <i>(Hematology Test)</i></b></th>
                                                    </tr>
                                                    <tr>
                                                        <td>Tổng phân tích tế bào máu bằng máy đếm tự động (CBC)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phết máu ngoại biên tìm tế bào lạ (Peripheral blood smear)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hematocrit (Hct)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nhuộm hồng cầu lưới trên máy tự động (Reticulocyte)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Máu lắng bằng máy tự động (ESR)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định nhóm máu (Blood group): ABO RhD</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tìm ký sinh trùng sốt rét trong máu (Malaria Parasites)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Điện di Hemoglobin (Hb Electrophoresis)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Xét nghiệm hòa hợp trong phát máu (Cross-match)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Test Coombs - gelcard</td>
                                                        <td></td>
                                                    </tr>
                    
                                            </table>
                                            <br>
                                            <table class="table table-bordered" style="border: 1px solid grey;" ><colgroup><col style="width: 94%"><col style="width: 6%"></colgroup>
                                                
                                                    <tr>
                                                        <th colspan="2"><b>ĐÔNG MÁU <i>(Coagulation Test)</i></b></th>
                                                    </tr>
                                                    <tr>
                                                        <td>Thời gian Prothombin: PT% PTs INR</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thời gian Thromboplastin hoạt hóa từng phần (APTT)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Fibrinogen</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thời gian máu chảy (Bleeding time)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thời gian máu đông (Clotting time)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Co cục máu (Clot retraction)</td>
                                                        <td></td>
                                                    </tr>
                                                
                                            </table>
                                            <br>
                                            <table class="table table-bordered" style="border: 1px solid grey;" ><colgroup><col style="width: 94%;"><col style="width: 6%;"></colgroup>
                                                
                                                    <tr>
                                                        <th colspan="2"><b>SINH HÓA <i>(Biochemistry Test)</i></b></th>
                                                    </tr>
                                                    <tr>
                                                        <td>Glucose: Lúc đói (Fasting) Sau ăn (Post prandial)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>HbA1C</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Creatinine</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Urea</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Acid Uric</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td> SGOT(AST) SGPT(ALT)  GamaGT</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bilirubin:  TP (Total) ; TT (Direct)  GT (Indirect)</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alkaline phosphatase</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Cholesterol toàn phần (Total Cholesterol)</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng HDL - Cholesterol</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng LDL - Cholesterol</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Triglycerides</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Albumine</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Protein (Total Protein)</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Amylase</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Sắt huyết thanh (Serum Iron)</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ferritin</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng Mg<sup>2+</sup> huyết thanh</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Điện giải đồ: Na<sup>+</sup>  K<sup>+</sup>  Cl<sup>-</sup>  Ca<sup>2+</sup></td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>LDH</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lactate</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CK - MB</td>
                                                        <td> </td>
                                                    </tr>
                                                
                                            </table>

                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="border: 1px solid grey;" ><colgroup><col style="width: 96%;"><col style="width: 4%;"></colgroup>
                                                
                                                    <tr>
                                                        <td>CRP hs</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>RF</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ASLO</td>
                                                        <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Khí máu (Blood gas)</td>
                                                        <td> </td>
                                                    </tr>
                                                
                                            </table>
                                            <br>
                                            <table class="table table-bordered" style="border: 1px solid grey;" ><colgroup><col style="width: 94%;"><col style="width: 6%;"></colgroup>
                                                
                                                    <tr>
                                                        <th colspan="2"><b>MIỄN DỊCH <i>(Immunology Test)</i></b></th>
                                                    </tr>
                                                    <tr>
                                                        <td> TSH  FT3   FT4</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td> PSA  AFP  CEA CA19-9</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Troponin T()hs  Troponin I</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Định lượng D - Dimer</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Anti HAV:  IgM   IgG</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>  HBsAg  Anti HBs (Elisa)  HBeAg (Elisa)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Anti - HIV:  Elisa  Test nhanh</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Anti - HCV (ELisa)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>  Digoxin  Vitamin D</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>  Cortisol  ACTH</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Catecholamin:  Máu (Blood)  Nước tiểu (Urine)</td>
                                                        <td></td>
                                                    </tr>
                                            </table>
                                            <br>
                                            <table class="table table-bordered"style="border: 1px solid grey;" ><colgroup><col style="width: 94%;"><col style="width: 6%;"></colgroup>
                                                
                                                    <tr>
                                                        <th colspan="2"><b>NƯỚC TIỂU <i>(Urine)</i> - PHÂN <i>(Stool)</i></b></th>
                                                    </tr>
                                                    <tr>
                                                        <td>Nước tiểu 10 thông số (Urine analysis) (máy)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td> Tế bào cặn nước tiểu (Urine sediment)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tế bào cặn Addis (Addis sediment)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Micro albumin</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Creatinin</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tỷ lệ Micro albumin / Creatinin</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Amylase</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Các test xác định: Na<sup>+</sup>  K<sup>+</sup>  Cl<sup>-</sup>  Ca<sup>2+</sup></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Protein / nước tiểu 24h (24h urine protein)</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Xác định máu trong phân (FOB)</td>
                                                        <td></td>
                                                    </tr>
                                                    
                                            </table>
                                            <br>
                                            <table class="table table-bordered"style="border: 1px solid grey;" ><colgroup><col style="width: 94%;"><col style="width: 6%;"></colgroup>
                                                
                                                    <tr>
                                                        <th colspan="2"><b>XÉT NGHIỆM KHÁC <i>(Other Test)</i></b></h>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </textarea>
                            </div><br>
                            <!-- <input type="hidden" class="form-control" name="txttoken"  value=""> -->
                            <div class="modal-footer">
                                <input type="submit" style="background-color: green; border-color:#7dff7d" class="btn btn-primary" name="luupxn" value="Lưu"></input>
                                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</a>
                            </div> <?php } ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['luupxn'])) {
        $khoa = $_REQUEST['txtkhoa'];
        $phong = $_REQUEST['txtphong'];
        $giuong = $_REQUEST['txtgiuong'];
        $chuandoan = $_REQUEST['txtchuandoan'];
        $trangthai = $_REQUEST['txttrangthai'];
        $noidung = $_REQUEST['txtnoidung'];
        $bacsixn = $_REQUEST['txtbacsi'];
        if ($layidpk > 0) {
            if ($p->themxoasua("INSERT INTO phieuxetnghiem(id_phieuxetnghiem,id_khoa,id_bacsi,phong,sogiuong,chuandoan,trangthai,noidung,id_phieukham) VALUES (null, '$khoa','$bacsixn', '$phong', '$giuong', '$chuandoan','$trangthai','$noidung', '$layidpk')") == 1) {

                header('location:QuanLyBenhAn.php');
            } else {
                echo '<script>alert("Thêm phiếu xét nghiệm không thành công!")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn phiếu khám cần thêm phiếu xét nghiệm!")</script>';
        }
    }
    ?>

    <!--Modal nhập TOA THUỐC-->
    <div class="modal " id="add_toathuoc" style="margin-top: 20px; border-radius:10px">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:900px">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">TOA THUỐC</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $link = $p->connect();
                    $sql = "select * from phieukhambenh where id_phieukham='$layidpk'";
                    $ketqua = mysqli_query($link, $sql);
                    ?>
                    <form action="" method="POST">
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($ketqua)) {
                            $id_benhnhan = $row['id_benhnhan'];
                            $tenbn = $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$id_benhnhan'");
                            $ngaykham = $row['ngaykham'];
                        ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Tên bệnh nhân: </b> <?php echo $tenbn ?></label>
                                        <!-- <input type="text" class="form-control" name="txttenbn" value="<?php //echo $tenbn 
                                                                                                            ?>"> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Ngày khám: </b><?php echo $ngaykham ?></label>
                                        <!-- <input type="date" class="form-control" name="txtngaykham" value="<?php //echo $ngaykham 
                                                                                                                ?>"> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Bác sĩ khám: </b><?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?></label>
                                        <!-- <input type="text" class="form-control" name="txtbsk" value="<?php //echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") 
                                                                                                            ?>"> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <div class="form-group">
                                        <label class="font-weight-bolder"><b>Số thẻ BHYT: </b></label>
                                        <input type="text" class="form-control" name="txtBHYT" placeholder="GD555555555555">
                                    </div> -->
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Chuẩn đoán: </b><?php echo $row['ketqua']; ?></label>
                                        <!-- <input type="text" class="form-control" name="txtchuandoan" value="<?php //echo $row['ketqua']; 
                                                                                                                ?>"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""><b>Đơn thuốc:</b></label>

                                <div class="row">
                                    <div class="container" id="toathuoc">
                                        <?php for ($i = 0; $i <= 3; $i++) : ?>
                                            <div class="row">
                                                <div class="col-3">

                                                    <select class="custom-select custom-select-sm form-control" style="margin: 5px 0px;" name="name<?php echo $i; ?>">
                                                        <option value="" selected>Chọn thuốc</option>
                                                        <option value="Apixaban">Apixaban</option>
                                                        <option value="Dabigatran">Dabigatran</option>
                                                        <option value="Aspirin">Aspirin</option>
                                                        <option value="Clopidogrel">Clopidogrel</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <!-- <label class="font-weight-bolder">Số lượng:</label> -->
                                                        <input type="number" class="form-control " name="sl<?php echo $i; ?>" placeholder="Số lượng">
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <!-- <label class="font-weight-bolder">Số lượng:</label> -->
                                                        <input type="number" class="form-control " name="sang<?php echo $i; ?>" placeholder="Sáng">
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <!-- <label class="font-weight-bolder">Số lượng:</label> -->
                                                        <input type="number" class="form-control " name="trua<?php echo $i; ?>" placeholder="Trưa">
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <!-- <label class="font-weight-bolder">Số lượng:</label> -->
                                                        <input type="number" class="form-control " name="chieu<?php echo $i; ?>" placeholder="Chiều">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endfor;
                                        ?>
                                    </div>
                                    <div class="text-center"><a class="btn btn-outline-info px-2 py-0" id="them">+</a></div>
                                </div>
                            </div>
                            <!-- <input type="hidden" class="form-control" name="txttoken"  value=""> -->
                            <div class="modal-footer">
                                <input type="submit" style="background-color: green; border-color:#7dff7d" class="btn btn-primary" name="luutt" value="Lưu"></input>
                                <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</a>
                            </div> <?php } ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['luutt'])) {
        // $chuandoan = $_REQUEST['txtchuandoan'];
        // $bhyt = $_REQUEST['txtBHYT'];
        //$noidung = $_REQUEST['txtnoidung'];
        //$noidung = $_REQUEST['noidung'];
        if ($layidpk > 0) {
            for ($i = 0; $i <= 10; $i++) {
                if (!empty($_POST["name" . "$i"])) {
                    $name = $_POST["name" . "$i"];
                    $soluong = $_POST["sl" . "$i"];
                    $sang = $_POST["sang" . "$i"];
                    $trua = $_POST["trua" . "$i"];
                    $chieu = $_POST["chieu" . "$i"];
                    if ($p->themxoasua("INSERT INTO toathuoc(id_toathuoc,tenthuoc,soluong,sang,trua,chieu,id_phieukham) VALUES (null,'$name','$soluong','$sang','$trua','$chieu','$layidpk')") == 1) {

                        header('location:QuanLyBenhAn.php');
                    } else {
                        echo '<script>alert("Thêm toa thuốc không thành công!")</script>';
                    }
                }
            }
        } else {
            echo '<script>alert("Vui lòng chọn toa thuốc cần thêm phiếu khám!")</script>';
        }
    }
    ?>

    <!--Modal update PHIẾU KHÁM BỆNH-->
    <div class="modal " id="update_khambenh" style="margin-top: 20px; border-radius:10px">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">PHIẾU KHÁM BỆNH</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $link = $p->connect();
                    $sql = "select * from phieukhambenh where id_phieukham='$layidpk'";
                    $ketqua = mysqli_query($link, $sql);
                    ?>
                    <form action="" method="POST">
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($ketqua)) {
                            $id_benhnhan = $row['id_benhnhan'];
                            $tenbn = $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$id_benhnhan'");
                            $ngaykham = $row['ngaykham'];
                            $giokham = $row['giokham'];
                            $phongkham = $row['phongkham'];
                            $kq = $row['ketqua'];
                            $chidan = $row['chidan'];
                            $phikham = $row['phikham'];
                            $xn = $row['xetnghiem'];
                            $loaixn = $row['loaixetnghiem']
                        ?>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="txtid"></label>
                                    <input name="txtid" type="hidden" id="txtid" value="<?php echo $layidpk ?>" />
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                                        <input type="text" class="form-control" name="txttenbn" value="<?php echo $tenbn ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Ngày khám: </b></label>
                                        <input type="date" class="form-control" name="txtngay" value="<?php echo $ngaykham ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Giờ khám: </b></label>
                                        <input type="time" class="form-control" name="txttime" value="<?php echo $giokham ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Phòng khám: </b></label>
                                        <input type="text" class="form-control" name="phongkham" value="<?php echo $p->laycot("SELECT phong FROM bacsi WHERE id_bacsi='$layid' ") ?>">
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="font-weight-bolder"><b>Xét nghiệm: </b></label>
                                        <input class="form-check-input" type="checkbox" name="xn" value="<?php echo $xn; ?>" id="flexCheckChecked" checked>Có
                                        <input class="form-check-input" type="checkbox" name="xn" value="<?php echo $xn; ?>" id="flexCheckChecked">Không
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Loại xét nghiệm: </b></label>
                                        <select name="lxn" id="" class="form-control">
                                            <option value="<?php echo $loaixn ?>"><?php echo $loaixn ?></option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Bác sĩ khám: </b></label>
                                        <input type="text" class="form-control" name="txtbsk" value="<?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Phí khám: </b></label>
                                        <input type="text" class="form-control" name="txtphi" value="<?php echo $phikham ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Kết quả: </b></label>
                                        <input type="text" class="form-control" name="txtkq" value="<?php echo $kq  ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Chỉ dẫn: </b></label>
                                        <input type="text" class="form-control" name="txtcd" value="<?php echo $chidan ?>">
                                    </div>
                                    <!-- <input type="hidden" class="form-control" name="txttoken"  value=""> -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" style="background-color: green; border-color:#7dff7d" id="nut" name="capnhatpk" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                                <button type="submit" id="nut" name="xoapk" value="Xóa" class="btn btn-danger">Xóa</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div><?php } ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['capnhatpk'])) {
        $idsua = $_REQUEST['txtid'];
        $ngaykham = $_REQUEST['txtngay'];
        $giokham = $_REQUEST['txttime'];
        $phongkham = $_REQUEST['phongkham'];
        $kq = $_REQUEST['txtkq'];
        $chidan = $_REQUEST['txtcd'];
        $phikham = $_REQUEST['txtphi'];
        if ($idsua > 0) {
            if ($p->themxoasua("UPDATE phieukhambenh SET ngaykham = '$ngaykham', giokham = '$giokham', phongkham = '$phongkham', ketqua = '$kq', chidan = '$chidan', phikham = '$phikham'  WHERE id_phieukham ='$idsua' LIMIT 1 ;") == 1) {
                header('location:QuanLyBenhAn.php');
            } else {
                echo '<script>alert("Cập nhật phiếu khám không thành công!")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn phiếu khám cần cập nhật thông tin!")</script>';
        }
    }
    ?>

    <!--Modal update PHIẾU XÉT NGHIỆM-->
    <div class="modal " id="update_xetnghiem" style="margin-top: 20px; border-radius:10px">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:1000px">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">PHIẾU XÉT NGHIỆM</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $layid_khoa = $p->laycot("select id_khoa from bacsi where id_bacsi='$layid' limit 1");
                    $layid_bacsi = $p->laycot("select id_bacsi from bacsi where id_bacsi='$layid' limit 1");
                    $link = $p->connect();
                    $sql = "select * from phieuxetnghiem where id_phieukham='$layidpk'";
                    $ketqua = mysqli_query($link, $sql);
                    ?>
                    <form action="" method="POST">
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($ketqua)) {
                            $id_benhnhan = $p->laycot("select id_benhnhan from phieukhambenh where id_phieukham='$layidpk'");
                            $tenbn = $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$id_benhnhan'");
                            $ngaykham = $p->laycot("select ngaykham from phieukhambenh where id_phieukham='$layidpk'");
                            $id_khoa = $row['id_khoa'];
                            $phong = $row['phong'];
                            $sogiuong = $row['sogiuong'];
                            $chuandoan = $row['chuandoan'];
                            $trangthai = $row['trangthai'];
                            $noidung = $row['noidung'];
                            $id_bacsixn = $row['id_bacsi'];
                        ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="txtid"></label>
                                    <input name="txtid" type="hidden" id="txtid" value="<?php echo $layidpk ?>" />
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                                        <input type="text" class="form-control" name="txttenbn" value="<?php echo $tenbn ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Ngày khám: </b></label>
                                        <input type="date" class="form-control" name="txtngay" value="<?php echo $ngaykham ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Khoa: </b></label>
                                        <select class="form-control" name="txtkhoa" id="id_khoaup">
                                            <option value="<?php echo $p->laycot("select id_khoa from khoa where id_khoa ='$id_khoa'") ?>" selected="selected" style="color:white;"><?php echo $p->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") ?></option>
                                            <?php
                                            $sql = "SELECT * FROM khoa";
                                            $ketqua = mysqli_query($p->connect(), $sql);
                                            $i = mysqli_num_rows($ketqua);
                                            if ($i > 0) {
                                                while ($row = mysqli_fetch_array($ketqua)) {
                                                    echo '<option value="' . $row['id_khoa'] . '">' . $row['tenkhoa'] . '</option>';
                                                }
                                            }

                                            ?>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Bác sĩ xét nghiệm: </b></label>
                                        <select class="form-control" name="txtbacsi" id="id_bacsiup">
                                            <option value="<?php echo $p->laycot("SELECT id_bacsi FROM bacsi WHERE id_bacsi='$id_bacsixn'") ?>" selected="selected">
                                                <?php echo $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi='$id_bacsixn'") ?>
                                            </option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- <label class="font-weight-bolder"><b>Số giường: </b></label>
                                    <input type="number" class="form-control" name="txtgiuong" value="<?php //echo $sogiuong 
                                                                                                        ?>"> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Bác sĩ khám: </b></label>
                                        <input type="text" class="form-control" name="txtbsk" value="<?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Chuẩn đoán: </b></label>
                                        <input type="text" class="form-control" name="txtchuandoan" value="<?php echo $chuandoan ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Trạng thái: </b></label>
                                        <input type="text" class="form-control" name="txttrangthai" value="<?php echo $trangthai ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textarea"><b>Nội dung: </b></label>
                                <textarea name="txtnoidung" id="txtnoidung">
                                <?php echo $noidung ?>
                            </textarea>
                            </div>
                            <!-- <input type="hidden" class="form-control" name="txttoken"  value=""> -->
                            <div class="modal-footer">
                                <button type="submit" style="background-color: green; border-color:#7dff7d" id="nut" name="capnhatpxn" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                                <button type="submit" id="nut" name="xoa" value="Xóa" class="btn btn-danger">Xóa</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div><?php } ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['capnhatpxn'])) {
        $idsua = $_REQUEST['txtid'];
        $khoa = $_REQUEST['txtkhoa'];
        $phong = $_REQUEST['txtphong'];
        $sogiuong = $_REQUEST['txtgiuong'];
        $chuandoan = $_REQUEST['txtchuandoan'];
        $trangthai = $_REQUEST['txttrangthai'];
        $noidung = $_REQUEST['txtnoidung'];
        $bacsixnup = $_REQUEST['txtbacsi'];
        if ($idsua > 0) {
            if ($p->themxoasua("UPDATE phieuxetnghiem SET id_khoa = '$khoa',id_bacsi='$bacsixnup', phong = '$phong', sogiuong = '$sogiuong', chuandoan = '$chuandoan', trangthai = '$trangthai', noidung = '$noidung' WHERE id_phieukham = '$idsua' LIMIT 1 ;") == 1) {
                header('location:QuanLyBenhAn.php');
            } else {
                echo '<script>alert("Cập nhật phiếu xét nghiệm không thành công!")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn phiếu xét nghiệm cần cập nhật thông tin!")</script>';
        }
    }
    ?>

    <!--Modal update TOA THUỐC-->
    <div class="modal " id="update_toathuoc" style="margin-top: 20px; border-radius:10px">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:900px">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">TOA THUỐC</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $link = $p->connect();
                    $sql = "select * from toathuoc where id_phieukham='$layidpk'";
                    $ketqua = mysqli_query($link, $sql);
                    ?>
                    <form action="" method="POST">
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($ketqua)) {
                            $id_benhnhan = $p->laycot("select id_benhnhan from phieukhambenh where id_phieukham='$layidpk'");
                            $tenbn = $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$id_benhnhan'");
                            $ngaykham = $p->laycot("select ngaykham from phieukhambenh where id_phieukham='$layidpk'");
                            $sothebhyt = $row['sothebhyt'];
                            $chuandoan = $row['chuandoan'];
                            $noidung = $row['noidung'];
                        ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="txtid"></label>
                                    <input name="txtid" type="hidden" id="txtid" value="<?php echo $layidpk ?>" />
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                                        <input type="text" class="form-control" name="txttenbn" value="<?php echo $tenbn ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Ngày khám: </b></label>
                                        <input type="date" class="form-control" name="txtngay" value="<?php echo $ngaykham ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Bác sĩ khám: </b></label>
                                        <input type="text" class="form-control" name="txtbsk" value="<?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Số thẻ BHYT: </b></label>
                                        <input type="text" class="form-control" name="txtBHYT" value="<?php echo $sothebhyt ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bolder"><b>Chuẩn đoán: </b></label>
                                        <input type="text" class="form-control" name="txtchuandoan" value="<?php echo $chuandoan ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textarea"><b>Đơn thuốc: </b></label>
                                <textarea name="txtnoidung" id="txtnoidung">
                                <?php echo $noidung ?>
                            </textarea>
                            </div>
                            <!-- <input type="hidden" class="form-control" name="txttoken" value=""> -->
                            <div class="modal-footer">
                                <button type="submit" style="background-color: green; border-color:#7dff7d" id="nut" name="capnhattt" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                                <button type="submit" id="nut" name="xoa" value="Xóa" class="btn btn-danger">Xóa</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div><?php } ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['capnhattt'])) {
        $idsua = $_REQUEST['txtid'];
        $sothebhyt = $_REQUEST['txtBHYT'];
        $chuandoan = $_REQUEST['txtchuandoan'];
        $noidung = $_REQUEST['txtnoidung'];
        if ($idsua > 0) {
            if ($p->themxoasua("UPDATE toathuoc SET sothebhyt = '$sothebhyt', chuandoan = '$chuandoan', noidung = '$noidung' WHERE id_phieukham = '$idsua' LIMIT 1 ;") == 1) {
                header('location:QuanLyBenhAn.php');
            } else {
                echo '<script>alert("Cập nhật toa thuốc không thành công!")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn toa thuốc cần cập nhật thông tin!")</script>';
        }
    }
    ?>

    <!--Modal update PHIẾU HẸN-->
    <div class="modal" id="update_hen" style="margin-top: 20px; border-radius:10px">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">PHIẾU HẸN</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php
                    $link = $p->connect();
                    $sql = "select * from phieuhen where id_phieukham='$layidpk'";
                    $ketqua = mysqli_query($link, $sql);
                    ?>
                    <form action="" method="POST">
                        <?php
                        $i = 0;
                        while ($row = mysqli_fetch_array($ketqua)) {
                            $id_benhnhan = $p->laycot("select id_benhnhan from phieukhambenh where id_phieukham='$layidpk'");
                            $tenbn = $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$id_benhnhan'");
                            $ngayhen = $row['ngayhen'];
                            $giohen = $row['giohen'];
                            $noidung = $row['noidung'];
                            $diadiem = $row['diadiem'];
                        ?>
                            <label for="txtid"></label>
                            <input name="txtid" type="hidden" id="txtid" value="<?php echo $layidpk ?>" />
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                                <input type="text" class="form-control" name="txttenbn" value="<?php echo $tenbn ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Ngày hẹn: </b></label>
                                <input type="date" class="form-control" name="txtngayhen" value="<?php echo $ngayhen ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Giờ hẹn: </b></label>
                                <input type="time" class="form-control" name="txttimehen" value="<?php echo $giohen ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Nội dung: </b></label>
                                <input type="text" class="form-control" name="txtnoidung" value="<?php echo $noidung ?>">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Địa điểm: </b></label>
                                <input type="text" class="form-control" name="txtdiadiem" value="<?php echo $diadiem ?>">
                            </div>
                            <!-- <input type="hidden" class="form-control" name="txttoken"  value=""> -->
                            <div class="modal-footer">
                                <button type="submit" style="background-color: green; border-color:#7dff7d" id="nut" name="capnhatph" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                                <button type="submit" id="nut" name="xoahen" value="Xóa" class="btn btn-danger">Xóa</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div><?php } ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['capnhatph'])) {
        $idsua = $_REQUEST['txtid'];
        $ngayhen = $_REQUEST['txtngayhen'];
        $giohen = $_REQUEST['txttimehen'];
        $noidung = $_REQUEST['txtnoidung'];
        $diadiem = $_REQUEST['txtdiadiem'];
       // echo $ngayhen; die();
        if ($idsua > 0) {
            if ($p->themxoasua("UPDATE phieuhen SET ngayhen = '$ngayhen', giohen = '$giohen', noidung = '$noidung', diadiem = '$diadiem'  WHERE id_phieukham ='$idsua' LIMIT 1 ;") == 1) {
                header('location:QuanLyBenhAn.php');
            } else {
                echo '<script>alert("Cập nhật phiếu hẹn không thành công!")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn phiếu hẹn cần cập nhật thông tin!")</script>';
        }
    }
    ?>

    <!--Xóa phiếu-->
    <?php
    if (isset($_POST['xoapk'])) {
        $idxoa = $_REQUEST['txtid'];
      
        if ($p->themxoasua("DELETE from phieukhambenh where id_phieukham='$idxoa' limit 1") == 1) {

            header('location:QuanLyBenhAn.php');
        } else {
            echo '<script>alert("Xóa không thành công!")</script>';
        }
    }

    if (isset($_POST['xoahen'])) {
        $idxoa = $_REQUEST['txtid'];
      
        if ($p->themxoasua("DELETE from phieuhen where id_phieukham='$idxoa' limit 1") == 1) {

            header('location:QuanLyBenhAn.php');
        } else {
            echo '<script>alert("Xóa không thành công!")</script>';
        }
    }
    ?>
    <script>
        jQuery(document).ready(function($) {
            $("#id_khoa").change(function(event) {
                khoaId = $("#id_khoa").val();
                $.post('bacsi.php', {
                    "khoaid": khoaId
                }, function(data) {
                    $("#id_bacsi").html(data);
                });
            });
            $("#id_khoaup").change(function(event) {
                khoaId = $("#id_khoaup").val();
                $.post('bacsi.php', {
                    "khoaid": khoaId
                }, function(data) {
                    $("#id_bacsiup").html(data);
                });
            });
        });

        var count = 1;
        $('#them').on('click', function() {
            $('#toathuoc').append("<div class='row'><div class='col-3'><select style='margin: 5px 0px;' class='custom-select custom-select-sm form-control' name='name'><option selected>Chọn thuốc</option><option value='Apixaban>Apixaban</option><option value='Dabigatran'>Dabigatran</option><option value='Aspirin'>Aspirin</option><option value='Clopidogrel'>Clopidogrel</option></select></div><div class='col-2'><div class='form-group'><input type='number' class='form-control form-control' name='sl' placeholder='Số lượng'></div></div><div class='col-2'><div class='form-group'><input type='number' class='form-control form-control' name='sang' placeholder='Sáng'></div></div><div class='col-2'><div class='form-group'><input type='number' class='form-control form-control' name='trua'  placeholder='Trưa'></div></div><div class='col-2'><div class='form-group'><input type='number' class='form-control form-control' name='chieu'  placeholder='Chiều'></div></div></div>");
            count++;

        })
    </script>

</body>

</html>