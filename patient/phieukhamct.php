<?php
// ob_start();
// session_start();
// include("../class/patient.php");
// $p = new patient();
// if (isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"]) == 1) {
//     include("../class/config.php");
//     $q = new connect();
//     $q->confirm_bn($_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
// } else if (isset($_SESSION['user_token'])) {
// } else {
//     header("location: ../login.php");
// }
include("../class/patient.php");
$p = new patient();
$id_phieukham = $_GET['id'];
$link = $p->connect();
$sql = "SELECT * FROM phieukhambenh WHERE id_phieukham = '$id_phieukham'";
$ketqua = mysqli_query($link, $sql);
$row1 = mysqli_fetch_array($ketqua);

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
            height: 300px;
            width: auto;
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

        table {
            margin-left: 50px;
        }

        tr td a {
            text-decoration: none;
            color: black;
        }

        .information-patient {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        /* .information-phieukb,.information-ph
        {
           width: 200px;
            height: 340px; */
        /* border: 1px solid black; 
           margin: 50px;
           border-radius: 5px;
           box-shadow:
                0 0 10px 4px #EEEEEE;
              
       
        }
       .information-tt
        {
            width: 200px;
            height: 500px;
           /* border: 1px solid black; 
           margin: 50px;
           border-radius: 5px;
           box-shadow:
                0 0 10px 4px #EEEEEE
        }
        /* .phieu{
            padding-left: 20px;
        } */
        table{
            margin-left: 0px;
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

            <div class="row information-patient">
                <div class="col-3">
                    <?php $p->showimg("SELECT * FROM phieukhambenh WHERE id_phieukham = '$id_phieukham' ") ?>
                </div>
                <div class="col-8">
                    <?php
                    $p->showthongtinbenhan("SELECT * FROM phieukhambenh WHERE id_phieukham = '$id_phieukham' ")
                    ?>
                </div>

            </div>
            <div class="row phieu">
                <div class="information-phieukb col-6">
                    <?php
                    $link = $p->connect();
                    $sql = "select * from phieukhambenh where id_phieukham='$id_phieukham'";
                    $result = mysqli_query($link, $sql);
                    ?>
                    <table class="table table-bordered" id="information_phieukham" style="width:80%;">
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            $ngaykham = $row['ngaykham'];
                            $giokham = $row['giokham'];
                            $phikham = $row['phikham'];
                            $phongkham = $row['phongkham'];
                            $ketqua = $row['ketqua'];
                            $chidan = $row['chidan'];
                            $id_bacsi = $row['id_bacsi'];
                            $xetnghiem = $row['xetnghiem'];
                            $loaixn = $row['loaixetnghiem'];
                        ?>
                            <tr style="text-align: center;font-weight: bold; color:white; background-color:green">
                                <th>Phiếu khám bệnh</th>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <div id="pk_ngaykham"><b>Ngày khám: </b> <?php echo $ngaykham ?></div>
                                    <div id="pk_giokham"><b>Giờ khám: </b> <?php echo $giokham ?></div>
                                    <div id="pk_phi"><b>Phí khám: </b> <?php echo $phikham ?></div>
                                    <div id="pk_phongkham"><b>Phòng khám: </b> <?php echo $phongkham ?></div>
                                    <div id="pk_phongkham"><b>Xét nghiệm: </b> <?php echo $xetnghiem; ?></div>
                                    <div id="pk_phongkham"><b>Loại xét nghiệm: </b> <?php echo $loaixn; ?></div>
                                    <div id="pk_ketqua"><b>Chuẩn đoán: </b> <?php echo $ketqua ?></div>
                                    <div id="pk_diachi"><b>Chỉ dẫn: </b> <?php echo $chidan ?></div>
                                    <div id="pk_tenbs"><b>Bác sĩ khám: </b> <?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$id_bacsi'") ?></div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>

                </div>
                <div class="information-ph col-6">

                    <?php
                    $link = $p->connect();
                    $sql = "SELECT * FROM phieuhen WHERE id_phieukham='$id_phieukham'";
                    $ketqua = mysqli_query($link, $sql);

                    ?>
                    <table class="table table-bordered" id="information_phieukham" style="width:80%; height:80%;  margin-top:5px">
                        <?php
                        while ($row = mysqli_fetch_array($ketqua)) {
                            $ngayhen = $row['ngayhen'];
                            $giohen = $row['giohen'];
                            $diadiem = $row['diadiem'];
                            $noidung = $row['noidung'];
                        ?>
                            <tr style="text-align: center;font-weight: bold; color:white; background-color:green">
                                <th style="height: 20px">Phiếu hẹn</th>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <div id="ph_ngayhen"><b>Ngày hẹn: </b> <?php echo $ngayhen ?></div>
                                    <div id="ph_giohen"><b>Giờ hẹn: </b> <?php echo $giohen ?></div>
                                    <div id="ph_giohen"><b>Nội dung: </b> <?php echo $noidung ?></div>
                                    <div id="ph_diadiem"><b>Địa điểm: </b> <?php echo $diadiem ?></div>
                                    <div id="ph_tenbs"><b>Bác sĩ hẹn: </b><?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='" . $row1['id_bacsi'] . "'") ?></div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>



                </div>
            </div>
            <div class="row ">
                <?php
                $link = $p->connect();
                $sql = "select * from phieuxetnghiem where id_phieukham='$id_phieukham'";
                $ketqua = mysqli_query($link, $sql);
                ?>
                <table class="table table-bordered" id="information_phieukham" style="width:80%">
                    <?php
                    while ($row = mysqli_fetch_array($ketqua)) {
                        $id_khoa = $row['id_khoa'];
                        // $phong = $row['phong'];
                        // $sogiuong = $row['sogiuong'];
                        $chuandoan = $row['chuandoan'];
                        $trangthai = $row['trangthai'];
                        $noidung = $row['noidung'];
                        $id_bacsixn = $row['id_bacsi'];
                        // $hinhanh = $row['hinhanh'];
                    ?>
                        <tr style="text-align: center;font-weight: bold; color:white; background-color:green">
                            <th>Phiếu xét nghiệm</th>
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                <div id="pxn_tenbs"><b>Bác sĩ điều trị: </b> <?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='" . $row1['id_bacsi'] . "'") ?></div>
                                <div id="pxn_khoa"><b>Khoa: </b> <?php echo $p->laycot("select tenkhoa from khoa where id_khoa='$id_khoa'") ?></div>
                                 <div id="pxn_phong"><b>Bác sĩ xét nghiệm: </b> <?php echo $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi = '$id_bacsixn' ") ?></div> 
                                <!--<div id="pxn_giuong"><b>Số giường: </b><?php //echo $sogiuong ?></div> -->
                                <div id="pxn_chuandoan"><b>Chuẩn đoán: </b> <?php echo $chuandoan ?></div>
                                <div id="pxn_trangthai"><b>Trạng thái: </b> <?php echo $trangthai ?></div>
                                <!-- <div id="pxn_anh"><b>Ảnh phiếu xét nghiệm: </b>
                                        <img src="../img/img_bieu-mau-benh-an/<?php echo $hinhanh ?>" width="200" height="200" />
                                    </div> -->
                                <div id="pxn_noidung"><b>Nội dung: </b><?php echo $noidung ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div class="row">

                <?php
                  $sql1 = "select * from phieukhambenh where id_phieukham='$id_phieukham'";
                  $ketqua1 = mysqli_query($link, $sql1);
                  $rowbn = mysqli_fetch_array($ketqua1);
                  $id_benhnhan = $rowbn['id_benhnhan'];
                $link = $p->connect();
                $sql = "SELECT * FROM toathuoc WHERE id_phieukham='$id_phieukham'";
                $ketqua = mysqli_query($link, $sql);

                ?>
                <table class="table table-bordered" style="width:80%">
                    <?php
                    while ($row = mysqli_fetch_array($ketqua)) {
                        $id_phieukham = $row['id_phieukham'];
                        $tenthuoc = $row['tenthuoc'];
                        $sang = $row['sang'];
                        $trua = $row['trua'];
                        $chieu = $row['chieu'];
                        $sl = 'Viên';
                        // $chuandoan = $row['chuandoan'];
                        // $sothebhyt = $row['sothebhyt'];
                        // $noidung = $row['noidung'];
                        // $hinhanh = $row['hinhanh'];

                    ?>
                        <tr style="text-align: center;font-weight: bold; color:white; background-color:green">
                            <th>Toa thuốc</th>
                        </tr>
                        <td>
                        <div id="tt_chuandoan"><b>Họ tên bệnh nhân: </b> <?php echo $p->laycot("SELECT tenbenhnhan FROM benhnhan WHERE id_benhnhan ='$id_benhnhan'") //echo $chuandoan 
                                                                                    ?></div>
                                <div id="tt_chuandoan"><b>Chuẩn đoán: </b> <?php echo $p->laycot("SELECT ketqua FROM phieukhambenh WHERE id_phieukham ='$id_phieukham'") //echo $chuandoan 
                                                                            ?></div>
                                <div id="tt_chuandoan"><b>Địa chỉ: </b> <?php echo $p->laycot("SELECT diachi FROM benhnhan WHERE id_benhnhan ='$id_benhnhan'") //echo $chuandoan 
                                                                        ?></div>
                                <div id="tt_bhyt"><b>Số thẻ BHYT: </b> <?php //echo $sothebhyt 
                                                                        ?></div>
                                <div id="tt_bs"><b>Bác sĩ điều trị: </b> <?php echo$p->laycot("select tenbacsi from bacsi where id_bacsi='" . $row1['id_bacsi'] . "'")  //$p->laycot("select tenbacsi from bacsi where id_bacsi='$id_phieukham'") ?></div>
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
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['tenthuoc'];?></div>
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['soluong']; echo "&ensp;"; echo $sl; ?></div>
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['sang']; echo "&ensp;"; echo $sl; ?></div>
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['trua']; echo "&ensp;"; echo $sl; ?></div>
                                            <div class="col" style="border-right:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;"><?php echo $val1['chieu']; echo "&ensp;"; echo $sl; ?></div>
                                        </div>
                                <?php
                                    endforeach;
                                else :
                                    "Không có toa thuốc nào.";
                                endif;
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>


            </div>

        </div>
    </div>
    </div>


    <?php
    include("footer.php");
    ?>
</body>

</html>