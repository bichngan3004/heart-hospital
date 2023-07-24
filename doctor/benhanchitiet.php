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
        

        <div class="infor-benhan" style="width:100%; margin-left:25px; margin-top:30px">
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
                            $noidung = $row['noidung'];
                        ?>
                            <tr style="text-align: center;font-weight: bold; color:white; background-color:#009726">
                                <th>Phiếu hẹn</th>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <div id="ph_ngayhen"><b>Ngày hẹn: </b> <?php echo $ngayhen ?></div>
                                    <div id="ph_giohen"><b>Giờ hẹn: </b> <?php echo $giohen ?></div>
                                    <div id="ph_giohen"><b>Nội dung: </b> <?php echo $noidung ?></div>
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
                                <div id="pxn_giuong"><b>Loại xét nghiệm: </b><?php echo $p->laycot("select loaixetnghiem from phieukhambenh where id_phieukham='$layidpk'") //echo $sogiuong 
                                                                            ?></div>
                                <div id="pxn_chuandoan"><b>Chuẩn đoán: </b> <?php echo $chuandoan ?></div>
                                <div id="pxn_trangthai"><b>Trạng thái: </b> <?php echo $trangthai ?></div>
                                <div id="pxn_noidung"><b>Nội dung: </b><?php echo $noidung ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </section>

    <footer>
        <?php include("footer.php"); ?>
    </footer>


  
  
  


   
    
  

  
    


   
    
  

    
   

   
  

</body>

</html>