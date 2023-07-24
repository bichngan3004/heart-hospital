<?php
session_start();
include("../class/patient.php");
$p = new patient();
if (isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"])) {
    include("../class/config.php");
    $q = new connect();
    $q->confirm_bn($_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
    //$kt_trangthai = 0;
    //$kt_trangthai = $p->laycot("SELECT COUNT(*) FROM `phieudkkham` WHERE `code_phieu`='no' AND `id_benhnhan`=" . $_SESSION['id_user'] . "");
} else if (isset($_SESSION['user_token'])) {
    //$kt_trangthaitoken = 0;
    //$kt_trangthaitoken = $p->laycot("SELECT COUNT(*) FROM `phieudkkham` WHERE `code_phieu`='no' AND `token`=" . $_SESSION['user_token'] . "");
} else {
    header("location: ../login.php");
}
//echo $_SESSION['user_token']; die();
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
        .header {
            text-align: center;
        }

        .schedule {
            width: 600px;
            border-radius: 10px;
            margin: 30px auto;
            border: 1px solid black;
            padding: 20px;
        }

        select.form-control {
            padding: 0px 12px;
        }

        label {
            padding: 10px 0px;
        }
    </style>
</head>

<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>

    <div class="schedule">
        <div class="header">
            <h2>ĐẶT LỊCH KHÁM</h2>
        </div>
        <?php
        //kiểm tra không được đặt lịch trong thời gian chưa xác nhận hủy lịch ?

       
        // if (isset($kt_trangthai)!= 0 && $kt_trangthai>0 ) {

        //     if (!isset($_COOKIE[$kt_trangthai])) {
        //         $sql1 = "UPDATE `phieudkkham` SET `code_phieu` = 'yes' WHERE `id_benhnhan`=" . $_SESSION['id_user'] . "  ";
        //         mysqli_query($p->connect(), $sql1);
        //     }
        //     echo '<script>alert("Bạn vừa đặt lịch khám, phải đợi 30p mới đặt tiếp được !");</script>';
        //     die();
        // }
        
        // if (isset($kt_trangthaitoken)!= 0 && $kt_trangthaitoken>0 ) {
        //     if (!isset($_COOKIE[$kt_trangthaitoken])) {
        //         $sql2 = "UPDATE `phieudkkham` SET `code_phieu` = 'yes' WHERE `token`=" . $_SESSION['user_token'] . "  ";
        //         mysqli_query($p->connect(), $sql2);
        //     }
        //     echo '<script>alert("Bạn vừa đặt lịch khám, phải đợi 30p mới đặt tiếp được !");</script>';
        //     die();
        // }
        ?>
        <?php

        ?>
        <form action="datlich2.php" method="POST">
            <div class="form-group">
                <label for="khoa">Chọn chuyên khoa</label>
                <select class="form-control" name="id_khoa" id="id_khoa">
                    <option value="">Chọn chuyên khoa</option>
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
                <label for="ten">Triệu chứng</label>
                <textarea class="form-control" style="resize:none" name='trieuchung' rows="3" required="required"></textarea>
            </div>
            <div class="form-group">
                <button style="margin-left: 480px; margin-top: 20px;" type="submit" id="" name="nut" value="Next" class="btn btn-success">Next</button>
            </div>
        </form>
    </div>


</body>
<?php include("footer.php") ?>

</html>