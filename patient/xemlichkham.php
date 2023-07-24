<?php
ob_start();
session_start();
include("../class/patient.php");
$p = new patient();
if (isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"]) == 1) {
    include("../class/config.php");
    $q = new connect();
    $q->confirm_bn($_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
} else if (isset($_SESSION['user_token'])) {
} else {
    header("location: ../login.php");
}
// $setupdate = $p->laycot("SELECT COUNT(id_phieudk)  FROM `phieudkkham`");

// if (isset($_SESSION['phieukham']) == $setupdate) {

//     if (!isset($_COOKIE[$_SESSION['phieukham']])) {

//         $sql1 = "UPDATE `phieudkkham` SET `code_phieu` = 'yes' WHERE `id_benhnhan`=" . $_SESSION['id_user'] . "  AND `phieudkkham`.`id_phieudk` = " . $_SESSION['phieukham'] . "";
//         mysqli_query($p->connect(), $sql1);
//         unset($_SESSION['phieukham']);
//         unset($_SESSION['ngayhen']);
//         header("refresh:1;url=xemlichkham.php");
//     }
// }
//echo    $_COOKIE[$_SESSION['phieukham']]  ; 
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
</head>
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

    td a {
        text-decoration: none;
        color: black;
    }

    table {
        width: 1000px;
    }

    tr:hover {
        background-color: #d2d2ff;
        cursor: pointer;
    }
</style>

<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>

    <?php
    // $username = $_SESSION['user'];
    // $user = $p->show_info($username);
    // $lichkham = $p->showlichhenkham($user['id_benhnhan'],$user['token']);

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
        <div class="container col-7">
            <!-- <marquee behavior="" direction="" style="color: red">Sau khi đặt lịch thành công, khách hàng chỉ có thể đặt lịch khám tiếp theo sau 24h!</marquee> -->
            <h2 style="text-align:center">LỊCH HẸN KHÁM</h2>
            <?php
            //  echo $_COOKIE[$_SESSION['phieukham']]; die();
            $layid = 0;
            if (isset($_REQUEST['id_pk'])) {
                $layid = $_REQUEST['id_pk'];
            }
            if (isset($_SESSION['id_user'])) {
               // $setupdate = $p->laycot("SELECT COUNT(id_phieudk)  FROM `phieudkkham`");    
               $kt_trangthai=$p->laycot("SELECT COUNT(*) FROM `phieudkkham` WHERE `code_phieu`='no' AND `id_benhnhan`=" . $_SESSION['id_user'] . "");
               if($kt_trangthai>0){
                if (!isset($_COOKIE[$kt_trangthai])) {
                    $sql1 = "UPDATE `phieudkkham` SET `code_phieu` = 'yes' WHERE `id_benhnhan`=" . $_SESSION['id_user'] . "  ";
                    mysqli_query($p->connect(), $sql1);
                   // unset($_SESSION['phieukham']);
                    unset($_SESSION['ngayhen']);
                    header("refresh:0.5;url=xemlichkham.php");
                }
            
               }
                
                $sql = "SELECT * FROM phieudkkham WHERE id_benhnhan=" . $_SESSION['id_user'] . " ";

                $ketqua = mysqli_query($p->connect(), $sql);
                $i = mysqli_num_rows($ketqua);
                echo '<form method="POST">';

                echo '<table class="table table-bordered" >
                                <tr style=" border-bottom:1px solid #ccc; background-color:green; color:white">
                                    <td  align="center" style="font-weight:bold">STT</td>
                                    <td  align="center" style="font-weight:bold">Bác sĩ</td>
                                    <td  align="center" style="font-weight:bold">Ngày hẹn</td>
                                    <td align="center" style="font-weight:bold">Ngày đặt lịch</td>
                                    <td  align="center" style="font-weight:bold">Triệu chứng</td>
                                    <td  align="center" style="font-weight:bold">Phí khám</td> 
                                    <td  align="center" style="font-weight:bold">Thông tin</td>
                                </tr>';
                if ($i > 0) {
                    $dem = 1;
                    $status = "";
                    while ($row = mysqli_fetch_array($ketqua)) {
                        $id_phieudk = $row['id_phieudk'];
                        if ($row['code_phieu'] == "yes") {
                            $status = "disabled";
                        } else {
                            $status = "";
                        }
                        echo '
                            <tr>
                                <td align="center"><a>' . $dem . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi='" . $row["id_bacsi"] . "'") . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['ngayhen'] . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['ngaydatlich'] . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['trieuchung'] . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['phikham'] . '</a></td>
                                <td align="center"><a  href="?id_pk=' . $id_phieudk . '"  class="btn btn-danger ' . $status . '" name="nutxoa">Hủy</td>
                            </tr>
                            ';
                        $dem++;
                    }
                    // if (isset($_SESSION['phieukham'])) {
                    // echo "cookie"; die();
                    //if (isset($_COOKIE[$_SESSION['phieukham']])) {

                    //     $new_sig = "SELECT * FROM `phieudkkham` WHERE `id_benhnhan`=" . $_SESSION['id_user'] . " AND `id_phieudk`=" . $_SESSION['phieukham'] . " AND `code_phieu`='no'";
                    //     $kq = mysqli_query($p->connect(), $new_sig);
                    //     echo '<form method="POST">';
                    //     while ($row = mysqli_fetch_array($kq)) {
                    //         $id_phieudk = $row['id_phieudk'];
                    //         echo '
                    //         <tr>
                    //             <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $dem . '</a></td>
                    //             <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi= " . $row['id_bacsi'] . "") . '</a></td>
                    //             <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['ngayhen'] . '</a></td>
                    //             <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['ngaydatlich'] . '</a></td>
                    //             <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['trieuchung'] . '</a></td>
                    //             <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['phikham'] . '</a></td>
                    //             <td align="center"><button onclick="?id_pk=' . $id_phieudk . '" class="btn btn-danger" name="nutxoa">Hủy</td>
                    //         </tr>
                    //         ';
                    //         $dem++;
                    //     }
                    //     echo '</table>';
                    //     echo '</form>';
                    //          } else {


                    //          }
                    //     }
                }

                echo '</table>';
                echo '</form>';
            } else if (isset($_SESSION['user_token'])) { 
                $kt_trangthai=$p->laycot("SELECT COUNT(*) FROM `phieudkkham` WHERE `code_phieu`='no' AND `token`=" . $_SESSION['user_token'] . "");
               if($kt_trangthai>0){
                if (!isset($_COOKIE[$kt_trangthai])) {
                    $sql1 = "UPDATE `phieudkkham` SET `code_phieu` = 'yes' WHERE `token`=" . $_SESSION['user_token'] . "  ";
                    mysqli_query($p->connect(), $sql1);
                   // unset($_SESSION['phieukham']);
                    unset($_SESSION['ngayhen']);
                    header("refresh:0.5;url=xemlichkham.php");
                }
                }

                $sql = "SELECT * FROM phieudkkham WHERE token=" . $_SESSION['user_token'] . "";

                $ketqua = mysqli_query($p->connect(), $sql);
                $i = mysqli_num_rows($ketqua);
                echo '<form method="POST">';

                echo '<table class="table table-bordered">
                                <tr style=" border-bottom:1px solid #ccc; background-color:green; color:white">
                                    <td align="center" style="font-weight:bold">STT</td>
                                    <td align="center" style="font-weight:bold">Bác sĩ</td>
                                    <td align="center" style="font-weight:bold">Ngày hẹn</td>
                                    <td align="center" style="font-weight:bold">Ngày đặt lịch</td>
                                    <td align="center" style="font-weight:bold">Triệu chứng</td>
                                    <td align="center" style="font-weight:bold">Phí khám</td>
                                    <td align="center" style="font-weight:bold">Thông tin</td>
                                </tr>';
                if ($i > 0) {

                    $dem = 1;
                    while ($row = mysqli_fetch_array($ketqua)) {
                        $id_phieudk = $row['id_phieudk'];
                        if ($row['code_phieu'] == "yes") {
                            $status = "disabled";
                        } else {
                            $status = "";
                        }
                        $id_phieudk = $row['id_phieudk'];
                        echo '
                            <tr>
                                <td align="center"><a ">' . $dem . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi='" . $row["id_bacsi"] . "'") . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['ngayhen'] . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['ngaydatlich'] . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['trieuchung'] . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['phikham'] . '</a></td>
                                <td align="center"><a href="?id_pk=' . $id_phieudk . '" class="btn btn-danger ' . $status . '" name="nutxoa">Hủy</td>
                            </tr>
                            ';
                        $dem++;
                    }
                }
                // if (isset($_SESSION['phieukham'])) {
                //     if (isset($_COOKIE[$_SESSION['phieukham']])) {
                //         $dem = 1;
                //         $new_lk = "SELECT * FROM `phieudkkham` WHERE `token`=" . $_SESSION['user_token'] . " AND `id_phieudk`=" . $_SESSION['phieukham'] . " AND `code_phieu`='no'";
                //         $kq1 = mysqli_query($p->connect(), $new_lk);
                //         echo '<form method="POST">';
                //         while ($row = mysqli_fetch_array($kq1)) {
                //             $id_phieudk = $row['id_phieudk'];
                //             echo '
                //             <tr>
                //                 <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $dem . '</a></td>
                //                 <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi= " . $row['id_bacsi'] . "") . '</a></td>
                //                 <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['ngayhen'] . '</a></td>
                //                 <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['ngaydatlich'] . '</a></td>
                //                 <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['trieuchung'] . '</a></td>
                //                 <td align="center"><a href="?id_pk=' . $id_phieudk . '">' . $row['phikham'] . '</a></td>
                //                 <td align="center"><button onclick="?id_pk=' . $id_phieudk . '" class="btn btn-danger" name="nutxoa">Hủy</td>
                //             </tr>
                //             ';
                //             //$dem++;
                //         }
                //         echo '</table>';
                //         echo '</form>';
                //     } else {
                //         $sql = "UPDATE `phieudkkham` SET `code_phieu` = 'yes' WHERE `token`=" . $_SESSION['user_token'] . "  AND `phieudkkham`.`id_phieudk` = " . $_SESSION['phieukham'] . "";
                //         mysqli_query($p->connect(), $sql);
                //         unset($_SESSION['phieukham']);
                //         unset($_SESSION['ngayhen']);
                //         header("refresh:1;url=xemlichkham.php");
                //     }
                // }
                echo '</table>';
                echo '</form>';
            } else {
                echo 'Không có lịch khám!';
            }
            ?>

        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Bạn chắc chắn hủy lịch khám không?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="verify" style="margin-left: 180px;">
                            <input type="submit" class="btn btn-primary" name="delete" value="Có"></input>
                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Không</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['delete'])) {
        $layid = $_REQUEST['id_pk'];
        if ($p->themxoasua("DELETE FROM phieudkkham WHERE id_phieudk = " . $layid . "") == 1) {

            header("refresh:1;url=xemlichkham.php");
        } else {
            echo '<script>alert("Hủy lịch không thành công ")</script>';
        }
    }


    if (isset($_REQUEST['id_pk'])) {
        $layid_pk = $_REQUEST['id_pk'];
        if ($p->themxoasua("DELETE FROM phieudkkham WHERE id_phieudk = " . $layid_pk . "") == 1) {
            echo '<script>alert("Hủy thành công!")</script>';
            header("refresh:1;url=xemlichkham.php");
        } else {
            echo '<script>alert("Hủy lịch không thành công!")</script>';
        }
    }

    ?>


    <?php
    include("footer.php");
    ?>
</body>

</html>