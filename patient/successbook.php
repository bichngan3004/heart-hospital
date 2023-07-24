<?php
session_start();
include("../class/patient.php");
$p = new patient();

include_once "../mail/sendlichkham.php";
$h = new Mailer();
if (isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"])) {
    include("../class/config.php");
    $q = new connect();
    $q->confirm_bn($_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
} else if (isset($_SESSION['user_token'])) 
{
} else {
    header("location: ../login.php");
}

if (!empty($_SESSION['user_token'])) {
    //echo $_SESSION['user_token'];
    $link = $p->connect();
    $g = "SELECT * FROM `taikhoan` WHERE token =" . $_SESSION['user_token'] . "";

    $result = mysqli_query($link, $g);

    $row  = @mysqli_fetch_array($result);
    // var_dump($row['id_user']); exit;
    //$user1 = $p->show_info($row['tentaikhoan']);
    $id_bacsi = $_SESSION['bacsi'];
    $doctor = $p->show_info_doctor($_SESSION['bacsi']);
} else {
    $id_bacsi = $_SESSION['bacsi'];
    $doctor = $p->show_info_doctor($_SESSION['bacsi']);
    $user = $p->show_info($_SESSION['tentaikhoan']);
}

$array_ngayhen = explode('_', $_SESSION['ngayhen']);
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
    <style>
        body {
            font-size: 18px;
        }

        p {
            font-weight: bold;
        }

        .details {
            margin-left: 500px;
        }

        input {
            border: none;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include("header.php"); ?>
    <?php include("menu.php") ?>
    <div class="container">
        <h2 class="text-center mt-4 ">ĐẶT LỊCH THÀNH CÔNG</h2>
        <marquee behavior="" direction="" style="color:red;">Nhấn nút Xác nhận để nhận được mail xác nhận lịch khám từ chúng tôi!</marquee>
        <div class="use">
            <div class="details font-weight-bolder" style="font-family:tim; font-size:20px;">
                <!--Mã code-->
                <form action="" method="POST">

                    <!-- <p>Bác sĩ: <?php //$p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi = ".$_SESSION['bacsi']."")
                                    echo $doctor['tenbacsi'];


                                    ?></p>
                            <p>Ngày hẹn: <?php echo date('j-m-Y', strtotime($array_ngayhen[1])); ?></p>
                            <p>Giờ hẹn: <?php

                                        if ($array_ngayhen[0] == 1) :
                                            echo "7:00 - 9:00";
                                        elseif ($array_ngayhen[0] == 2) :
                                            echo "9:00 - 11:00";
                                        elseif ($array_ngayhen[0] == 3) :
                                            echo "13:00 - 15:00";
                                        else :
                                            echo "15:00 - 17:00";
                                        endif;
                                        ?></p>
                            <p>Người đặt: <?php echo $user['tentaikhoan'] ?></p>
                            <p>Triệu chứng: <?php echo $trieuchung['trieuchung']; ?></p> 
                    <p>Email:<?php echo $user['email'] ?></p>-->
                    <!-- <p>Phí khám: 150.000vnđ</p>!-->
                    <label for="">Bác sĩ:</label>
                    <input type="text" name="bacsi" value="<?php echo $doctor['tenbacsi'] ?>"><br>
                    <label for="">Giờ hẹn:</label>
                    <input type="text" name="giohen" value=" <?php

                                                                if ($array_ngayhen[0] == 1) :
                                                                    echo "7:00 - 9:00";
                                                                elseif ($array_ngayhen[0] == 2) :
                                                                    echo "9:00 - 11:00";
                                                                elseif ($array_ngayhen[0] == 3) :
                                                                    echo "13:00 - 15:00";
                                                                else :
                                                                    echo "15:00 - 17:00";
                                                                endif;
                                                                ?>"><br>
                    <label for="">Ngày hẹn:</label>
                    <input type="text" name="ngayhen" value="<?php echo date('j-m-Y', strtotime($array_ngayhen[1]));  ?>"><br>
                    <label for="">Người đặt:</label>
                    <input type="text" name="nguoidat" value="<?php
                                                                if (!empty($_SESSION['user_token'])) {

                                                                    echo $row['tentaikhoan'];
                                                                } else {
                                                                    echo $user['tentaikhoan'];
                                                                }

                                                                ?>"><br>
                    <label for="">Email:</label>
                    <input type="text" name="txtemail" value="<?php
                                                                if (!empty($_SESSION['user_token'])) {
                                                                    echo $row['email'];
                                                                } else {
                                                                    echo $user['email'];
                                                                }


                                                                ?>"><br>
                    <label for="">Phí khám:</label>
                    <input type="text" name="phikham" value="150000">
            </div>
        </div>
         
        <div>
        <a href="index.php" style="margin-left: 550px; margin-top:20px" class="btn btn-outline-success">Thoát</a>
            <button style=" margin-top:20px" class="btn btn-success" name="nut"> Xác nhận</button></div>
        </form>
    </div>

    <?php
    if (isset($_POST['nut'])) {
        $title = 'Thông báo đặt lịch khám tại Bệnh viện Tim Tâm Đức thành công.';
        $gio = $_REQUEST['giohen'];
        $ngay = $_REQUEST['ngayhen'];
        $nguoidat = $_REQUEST['nguoidat'];
        $bacsi = $_REQUEST['bacsi'];
        $addressMail = $_POST['txtemail'];
        $content = "Chào <b>" . $nguoidat . "</b>!<br> Bạn đã đặt lịch khám với bác sĩ<b> " . $bacsi . "</b> tại bệnh viện chúng tôi vào lúc<b>" . $gio . "</b> giờ ngày<b> " . $ngay . "</b>. Địa chỉ: 4 Nguyễn Lương Bằng, phường Tân Phú, quận 7, TP.Hồ Chí Minh. Liên lạc với chúng tôi qua số điện thoại 028 5411 0036 hoặc 0903 052 432 để được tư vấn và giải đáp thắc mắc trực tiếp. ";
        
        // var_dump($_POST);
        // exit();
        $h->sendmail($title, $content, $addressMail);
    }
    ?>
    <?php
    include("footer.php");
    ?>
</body>

</html>