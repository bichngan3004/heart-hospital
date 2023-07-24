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



        <!--Modal update PHIẾU XÉT NGHIỆM-->
      

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">PHIẾU XÉT NGHIỆM</h4>
                      
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
                                $id_bacsi = $p->laycot("select id_bacsi from phieukhambenh where id_phieukham='$layidpk'");
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
                                            <input type="text" class="form-control" name="txtbsk" value="<?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$id_bacsi'") ?>">
                                        </div>
                                        <div class="form-group">
                                        <label class="font-weight-bolder"><b>Loại xét nghiệm: </b></label>
                                        <input type="text" class="form-control" name="txtbsk" value="<?php echo $p->laycot("select loaixetnghiem from phieukhambenh where id_phieukham='$layidpk'") ?>">
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
                                    <a href="chidinhxn.php" class="btn btn-outline-success">Thoát</a>
                                    
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
                // if ($p->themxoasua("UPDATE phieuxetnghiem SET id_khoa = '$khoa',id_bacsi='$bacsixnup', phong = '$phong', sogiuong = '$sogiuong', chuandoan = '$chuandoan', trangthai = '$trangthai', noidung = '$noidung' WHERE id_phieukham = '$idsua' LIMIT 1 ;") == 1) {
                //     header('location:chidinhxn.php');
                // } else {
                //     echo '<script>alert("Cập nhật phiếu xét nghiệm không thành công!")</script>';
                // }
                $sql1= "UPDATE phieuxetnghiem SET id_khoa = '$khoa',id_bacsi='$bacsixnup', phong = '$phong', sogiuong = '$sogiuong', chuandoan = '$chuandoan', trangthai = '$trangthai', noidung = '$noidung' WHERE id_phieukham = '$idsua' LIMIT 1 ";
                if(mysqli_query($p->connect(),$sql1))
                {
                    $sql_update = "UPDATE phieuxetnghiem SET status = '1' WHERE id_phieukham = '$layidpk'";
                    $query = mysqli_query($p->connect(), $sql_update);
                    header('Location:chidinhxn.php');
                }
            } else {
                echo '<script>alert("Vui lòng chọn phiếu xét nghiệm cần cập nhật thông tin!")</script>';
            }
        }
        ?>
    </section>





</body>

</html>