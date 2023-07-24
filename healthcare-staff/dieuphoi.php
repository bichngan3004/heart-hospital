<?php
// session_start();
// ob_start();
// if (isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['id_user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen']) == 3) {
//     include('../class/config.php');
//     $q = new connect();
//     $q->confirm_login($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen'], $_SESSION['id_user']);
// } else {
//     header('location:../login.php');
// }
ob_start();
include("../class/clsadmin.php");
$p = new admin();

// $layid_pdk = 0;
// if (isset($_REQUEST['id_pdk'])){
//     $layid_pdk = $_REQUEST['id_pdk'];
// }
$layid = 0;
if (isset($_REQUEST['id_pdk'])) {
    $layid = $_GET['id_pdk'];
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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

        tr:hover {
            background-color: #d2d2ff;
            /* color: white; */
            cursor: pointer;
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
        <?php
        $sql = "SELECT * FROM phieudkkham WHERE id_phieudk = '" . $layid . "'";
        $kq = mysqli_query($p->connect(), $sql);
        $row = mysqli_fetch_array($kq);
        $array_ngayhen = explode('_', $row['ngayhen']);
        ?>
        <div class="information">
            <div class="container" style="width:100%; margin-left:15px;">
                <h3 style="text-align: center;font-weight: bold">ĐIỀU PHỐI LỊCH KHÁM BỆNH NHÂN</h3>
                <form action="" method="POST" id="modal_update">
                    <label for="txtid"></label>
                    <input name="edit_id" type="hidden" id="txtid" value='<?php echo $layid ?> ' />

                    <div class="form-group">
                        <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                        <?php echo $p->laycot("SELECT tenbenhnhan FROM benhnhan WHERE id_benhnhan='" . $row['id_benhnhan'] . "'") ?>
                    </div>

                    <div class="form-group">
                        <p style="padding-top: 10px;"><b>Thời gian đã đăng ký:</b>

                            <?php
                            if ($array_ngayhen[0] == 1) :
                                echo "07:00 - 09:00 / " . date('j-m-Y', strtotime($array_ngayhen[1]));
                            elseif ($array_ngayhen[0] == 2) :
                                echo "09:00 - 11:00 / " . date('j-m-Y', strtotime($array_ngayhen[1]));
                            elseif ($array_ngayhen[0] == 3) :
                                echo "13:00 - 15:00 / " . date('j-m-Y', strtotime($array_ngayhen[1]));
                            else :
                                echo "15:00 - 17:00 / " . date('j-m-Y', strtotime($array_ngayhen[1]));
                            endif;
                            ?>
                        </p>
                        <div class="form-group">
                            <label for="textarea"><b>Ngày hẹn khám:</b></label>
                            <input style="width:300px" type="date" class="form-control" name="ngayhen" value="<?php echo date('Y-m-j', strtotime($array_ngaynghi[1])); //echo $p->laycot("SELECT ngayhen FROM phieudkkham WHERE id_phieudk ='".$layid."'") 
                                                                                            ?>">
                        </div>
                        <label for=""><b>Thời gian hẹn khám:</b></label>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" name="mui_gio_ban1" value="1">
                            <label class="custom-control-label" for="customCheck1">07:00 - 09:00</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck2" name="mui_gio_ban2" value="2">
                            <label class="custom-control-label" for="customCheck2">09:00 - 11:00</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck3" name="mui_gio_ban3" value="3">
                            <label class="custom-control-label" for="customCheck3">13:00 - 15:00</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck4" name="mui_gio_ban4" value="4">
                            <label class="custom-control-label" for="customCheck4">15:00 - 17:00</label>
                        </div>
                    </div>
                    <a href="BenhNhanDangKy.php" class="btn btn-outline-danger">Hủy</a>
                    <button type="submit" name="update" class="btn btn-success">Cập nhật</button>
                </form>
            </div>
        </div>
    </section>

    <?php
    if (isset($_POST['update'])) {
        if ($layid > 0) {
            if (isset($_POST['mui_gio_ban1'])) {
                $ngayhen = $_REQUEST['mui_gio_ban1'] . '_' . $_REQUEST['ngayhen'];
                $ngayhencu = $row['ngayhen'];
                if ($ngayhen == $ngayhencu) {
                    echo '<script>alert("Bác sĩ đã có lịch!")</script>';
                } else {
                    $sql = "UPDATE phieudkkham SET ngayhen = '" . $ngayhen . "' WHERE id_phieudk =" . $layid . "";
                    //// $ketqua = mysqli_query($p->connect(),$sql);
                    if (mysqli_query($p->connect(), $sql) == true) {
                        header("location: BenhNhanDangKy.php");
                    } else {
                        echo '<script>alert("Cập nhật không thành công!")</script>';
                    }
                }
            }

            if (isset($_POST['mui_gio_ban2'])) {
                $ngayhen = $_REQUEST['mui_gio_ban2'] . '_' . $_REQUEST['ngayhen'];
                $ngayhencu = $row['ngayhen'];
                if ($ngayhen == $ngayhencu) {
                    echo '<script>alert("Bác sĩ đã có lịch!")</script>';
                } else {
                    $sql = "UPDATE phieudkkham SET ngayhen = '" . $ngayhen . "' WHERE id_phieudk =" . $layid . "";
                    // $ketqua = mysqli_query($p->connect(),$sql);
                    if (mysqli_query($p->connect(), $sql) == true) {
                        header("location: BenhNhanDangKy.php");
                    } else {
                        echo '<script>alert("Cập nhật không không thành công!")</script>';
                    }
                }
            }

            if (isset($_POST['mui_gio_ban3'])) {
                $ngayhen = $_REQUEST['mui_gio_ban3'] . '_' . $_REQUEST['ngayhen'];
                $ngayhencu = $row['ngayhen'];
                if ($ngayhen == $ngayhencu) {
                    echo '<script>alert("Bác sĩ đã có lịch!")</script>';
                } else {
                    $sql = "UPDATE phieudkkham SET ngayhen = '" . $ngayhen . "' WHERE id_phieudk =" . $layid . "";
                    // $ketqua = mysqli_query($p->connect(),$sql);
                    if (mysqli_query($p->connect(), $sql) == true) {
                        header("location: BenhNhanDangKy.php");
                    } else {
                        echo '<script>alert("Cập nhật không thành công!")</script>';
                    }
                }
            }
            if (isset($_POST['mui_gio_ban4'])) {
                $ngayhen = $_REQUEST['mui_gio_ban4'] . '_' . $_REQUEST['ngayhen'];
                $ngayhencu = $row['ngayhen'];
                if ($ngayhen == $ngayhencu) {
                    echo '<script>alert("Bác sĩ đã có lịch!")</script>';
                } else {
                    $sql = "UPDATE phieudkkham SET ngayhen = '" . $ngayhen . "' WHERE id_phieudk =" . $layid . "";
                    // $ketqua = mysqli_query($p->connect(),$sql);
                    if (mysqli_query($p->connect(), $sql) == true) {
                        header("location: BenhNhanDangKy.php");
                    } else {
                        echo '<script>alert("Cập nhật không thành công!")</script>';
                    }
                }
            }
            else{
                
                    echo '<script>alert("Vui lòng chọn ngày giờ nhập cần cập nhật!")</script>';
                
            }
        }
    }

    ?>


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