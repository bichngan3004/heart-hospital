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
$layid = 0;
if (isset($_REQUEST['id'])) {
    $layid = $_REQUEST['id'];
}
$layidln = 0;
if (isset($_REQUEST['id_ln'])) {
 $layidln = $_REQUEST['id_ln'];
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

        tr:hover {
            background-color: #d2d2ff;
            cursor: pointer;
        }

        /* Dropdown Button */

        /* The search field */
        #myInput {
            box-sizing: border-box;
            background-image: url('../img/icon/icons8-search-26.png');
            background-position: 10px 5px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 5px 20px 5px 40px;
            border: 1px solid #ddd;
            border-radius: 20px;
            width: auto;

        }

        /* The search field when it gets focus/clicked on */
        #myInput:focus {
            outline: 3px solid #7dff7d;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f6f6f6;
            min-width: 230px;
            border: 1px solid #ddd;
            opacity: .9;
            border-radius: 10px;
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-weight: 400;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #f1f1f1;
            opacity: .9;
            font-weight: 700;
            color: green;
        }

        /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
        .show {
            display: block;
        }
        tr td a{
            text-decoration: none;
        }
        .button{
             width: 50px;
            height: 20px;
            padding: 7px;
            border-radius: 7px;
            background-color: #DD0000;
            color: white;
        }
       .button a:hover
        {
            color: #00661a;
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
        <div class="container" style="margin-left:10px;">
            <div class="row">
                <h4>Đăng ký ngày nghỉ</h4>
                <div class="col-3">
                    <div class="dropdown">
                        <p class="m-0 font-weight-bolder"><b>1. Chọn bác sĩ: </b></p>
                        <div class="search-container">
                            <form action="QuanLyLichNghiBacSi.php">
                                <input type="text" onclick="myFunction()" placeholder="Search.. <?php echo $p->laycot("select tenbacsi from bacsi where id_bacsi='$layid'") ?>" id="myInput" onkeyup="filterFunction()">
                                <?php $p->loadlistdropdowndoctor("SELECT * FROM bacsi order by id_bacsi asc") ?>
                            </form>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="form-group" style="margin-top:10px; margin-bottom:10px">

                            <label class="m-0 font-weight-bolder"><b>2. Chọn ngày nghỉ:</b></label>
                            <label for="txtid"></label>
                            <input name="txtid" type="hidden" id="txtid" value=" <?php echo $layid ?>" />
                            <input type="date" class="form-control" name="ngaynghi" value="<?php echo date('Y-m-j', time()); ?>">
                        </div>
                        <p class="m-0 font-weight-bolder"><b>3. Chọn thời gian nghỉ: </b><i style="color: red">(Lưu ý: nếu nghỉ nguyên ngày chọn tất cả.)</i></p>
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
                        <div class="form-group" style="margin-top:10px; margin-bottom:10px">
                            <label class="m-0 font-weight-bolder"><b>4. Lý do nghỉ:</b></label>
                            <input type="text" class="form-control" name="lydonghi" value="" placeholder="Nhập lý do nghỉ làm">
                        </div>
                        <button style="margin-top: 10px; margin-bottom:10px; background-color: green; border-color:#7dff7d" type="submit" class="btn btn-primary" name="nghilam">Xác nhận</button>
                    </form>
                </div>
                <br><br>
                <div class="col-8" style=" margin-left: 5px; width:70%">
                    <h2 style="text-align: center;">THỜI GIAN NGHỈ LÀM</h2>
                      
                    <?php
                    
                    $link = $p->connect();
                    $sql = "select * from lichnghi";
                    $ketqua = mysqli_query($link, $sql);
                    ?>
                    
                  
                    <table class="table table-bordered">
                        <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                            <td align="center">STT</td>
                            <td align="center">Bác sĩ nghỉ</td>
                            <td align="center">Ngày nghỉ</td>
                            <td align="center">Thời gian nghỉ</td>
                            <td align="center">Lý do nghỉ</td>
                             <td align="center">Thông tin</td>
                        </tr>
                        <?php
                        $dem = 1;
                        while ($row = mysqli_fetch_array($ketqua)) {
                            
                            $id_lichnghi = $row['id_lichnghi'];
                            $array_ngaynghi = explode('_', $row['ngayhen']);
                            
                            $lydo = $row['lydo'];
                            $id_bacsi = $row['id_bacsi'];
                        ?>
                            <tr>
                                <td style="text-align: center;"><?php echo '<a >'.$dem .'</a>' ?></td>
                                <td><?php echo '<a >'. $p->laycot("select tenbacsi from bacsi where id_bacsi ='$id_bacsi'") . '</a>' ?></td>
                                <td style="text-align: left;"><?php echo '<a>' . date('j-m-Y', strtotime($array_ngaynghi[1])) . '</a>'; ?></td>
                                <td><?php
                                    if ($array_ngaynghi[0] == 1) :
                                        echo "7:00 - 9:00";
                                    elseif ($array_ngaynghi[0] == 2) :
                                        echo "9:00 - 11:00";
                                    elseif ($array_ngaynghi[0] == 3) :
                                        echo "13:00 - 15:00";
                                    else :
                                        echo "15:00 - 17:00";
                                    endif; ?>
                                </td>
                                <td><?php echo '<a  >'.$lydo .'</a>' ?></td>
                               <td style="text-align: center;">
                                <?php echo'<a class="button" href="deleteln.php?id='.$id_lichnghi.'">Xóa</a>
                               '
                               ?>
                            </td>
                            </tr>
                          
                        <?php
                        $dem++;
                        }
                        ?>
                    </table>
                    
                </div>

                <?php
                if (isset($_POST['nghilam'])) {
                    if($layid>0){
                        if (isset($_POST['mui_gio_ban1'])) {
                            $ngaynghi = $_REQUEST['mui_gio_ban1'] . '_' . $_REQUEST['ngaynghi'];
                            $lydo = $_REQUEST['lydonghi'];
                            $sql = "INSERT INTO lichnghi (ngayhen, lydo, id_bacsi) VALUES ('$ngaynghi', '$lydo', '$layid')";
                            //// $ketqua = mysqli_query($p->connect(),$sql);
                            if (mysqli_query($p->connect(), $sql) == true) {
                                header("location: QuanLyLichNghiBacSi.php");
                            } else {
                                echo '<script>alert("Đăng ký ngày nghỉ không thành công!")</script>';
                            }
                        }

                        if (isset($_POST['mui_gio_ban2'])) {
                            $ngaynghi = $_REQUEST['mui_gio_ban2'] . '_' . $_REQUEST['ngaynghi'];
                            $lydo = $_REQUEST['lydonghi'];
                            $sql = "INSERT INTO lichnghi (ngayhen, lydo, id_bacsi) VALUES ('$ngaynghi', '$lydo', '$layid')";
                            // $ketqua = mysqli_query($p->connect(),$sql);
                            if (mysqli_query($p->connect(), $sql) == true) {
                                header("location: QuanLyLichNghiBacSi.php");
                            } else {
                                echo '<script>alert("Đăng ký ngày nghỉ không thành công!")</script>';
                            }
                        }

                        if (isset($_POST['mui_gio_ban3'])) {
                            $ngaynghi = $_REQUEST['mui_gio_ban3'] . '_' . $_REQUEST['ngaynghi'];
                            $lydo = $_REQUEST['lydonghi'];
                            $sql = "INSERT INTO lichnghi (ngayhen, lydo, id_bacsi) VALUES ('$ngaynghi', '$lydo', '$layid')";
                            // $ketqua = mysqli_query($p->connect(),$sql);
                            if (mysqli_query($p->connect(), $sql) == true) {
                                header("location: QuanLyLichNghiBacSi.php");
                            } else {
                                echo '<script>alert("Đăng ký ngày nghỉ không thành công!")</script>';
                            }
                        }
                        if (isset($_POST['mui_gio_ban4'])) {
                            $ngaynghi = $_REQUEST['mui_gio_ban4'] . '_' . $_REQUEST['ngaynghi'];
                            $lydo = $_REQUEST['lydonghi'];
                            $sql = "INSERT INTO lichnghi (ngayhen, lydo, id_bacsi) VALUES ('$ngaynghi', '$lydo', '$layid')";
                            // $ketqua = mysqli_query($p->connect(),$sql);
                            if (mysqli_query($p->connect(), $sql) == true) {
                                header("location: QuanLyLichNghiBacSi.php");
                            } else {
                                echo '<script>alert("Đăng ký ngày nghỉ không thành công!")</script>';
                            }
                        }
                        else {
                            echo '<script>alert("Vui lòng chọn và nhập đầy đủ thông tin!")</script>';
                        }
                    }else {
                        echo '<script>alert("Vui lòng chọn bác sĩ cần đăng ký lịch nghỉ!")</script>';
                    }
                    
                    // echo $ngaynghi; exit();
                }
                ?>
            </div>
        </div>
    </section>

    <footer>
        <?php include("footer.php"); ?>
    </footer>

<?php
if (isset($_POST['nutxoa'])) {
      $layidln=$_REQUEST['id_ln'];
      echo $layidln; exit();
    
        if ($p->themxoasua("DELETE FROM lichnghi WHERE `lichnghi`.`id_lichnghi` = '.$layidln.' LIMIT 1") == 1) {
            echo '<script>alert("Xóa lịch thành công!")</script>';
            header("refresh:1;url=QuanLyLichNghiBacSi.php");
        } else {
            echo '<script>alert("Xóa lịch không thành công!")</script>';
        }
   
}


?>
</body>

</html>
<script>
    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
</script>