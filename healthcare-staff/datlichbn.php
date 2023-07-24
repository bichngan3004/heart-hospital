<?php
ob_start();
session_start();
include_once("../class/healthcarestaff.php");
$p = new healthcarestaff();
if (isset($_SESSION["id"]) && isset($_SESSION["user"]) && isset($_SESSION["id_user"]) && isset($_SESSION["pass"]) && isset($_SESSION["phanquyen"])==3) {
    include("../class/config.php");
    $q = new connect();
    $q->confirm_nvyt ($_SESSION["user"], $_SESSION["pass"], $_SESSION["id"],$_SESSION["id_user"], $_SESSION["phanquyen"]);
} 
else 
{
    header("location: ../login.php");
}
$layid= $_SESSION["id_user"];
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
            padding: 5x 12px;
        }

        label {
            padding: 10px 0px;
        }
        nav {
        line-height:30px;
        background-color: #eeeeee;
        height: 300px;
        width:20%;
        float:left;
        padding:5px;
        }
        
        footer {
            clear:both;
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
    </style>
</head>

<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>
 <nav>
         <ul>
            <li><a href="XemThongTinCaNhan.php"><i class="fa fa-user-nurse"></i>&emsp;Xem thông tin cá nhân</a></li>
            <li><a href="datlichbn.php"><i class="fa fa-user-pen"></i>&emsp;Đặt lịch khám</a></li>
            <li><a href="QuanLyBenhNhan.php"><i class="fa fa-address-book"></i>&emsp;Quản lý bệnh nhân</a></li>
            <li><a href="QuanLyTinTuc.php"><i class="fa fa-newspaper"></i>&emsp;Quản lý tin tức</a></li>
            <li><a href="BenhNhanDangKy.php"><i class="fa fa-bell"></i>&emsp;Điều phối bệnh nhân đăng ký</a></li>
            
         </ul>
    </nav>
    <div class="schedule">
        <div class="header">
            <h2>ĐẶT LỊCH KHÁM</h2>
        </div>
        <form action="datlichbn2.php" method="POST">
            <div class="row">
                <div class="form-group col-6">
                    <label for="ten">Họ và tên</label>
                    <input class="form-control" name='txtname'></input>
                </div>
                <div class="col-6">
                    <label for="male">Giới tính</label>
                    <select class="form-control" id="gt" name="txtgioitinh">
                        <option value=""></option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="namsinh">Năm sinh</label>
                    <input class="form-control" name='txtns'></input>
                </div>
                <div class="col-8">
                    <label for="male">Địa chỉ</label>
                    <input class="form-control" name='txtdiachi'></input>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="control-label">Số điện thoại</label>
                        
                <input type="tel" class="form-control" id="txtsdt" name="txtsdt" placeholder="">
                           
                        
            </div>
            <div class="form-group">
                <label for="khoa">Chọn chuyên khoa</label>
                <select class="form-control" name="id_khoa" id="id_khoa">
                    <option value="">Chọn chuyên khoa</option>
                <?php
                        $sql = "SELECT * FROM khoa";
                        $ketqua = mysqli_query($p->connect(),$sql);
                        $i=mysqli_num_rows($ketqua);
                        if($i>0)
                        {
                            while( $row = mysqli_fetch_array($ketqua))
                            {
                                echo '<option value="'.$row['id_khoa'].'">'.$row['tenkhoa'].'</option>';
                            }
                        }
                        
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ten">Triệu chứng</label>
                <textarea class="form-control" name='trieuchung' rows="3" required="required"></textarea>
            </div>
            <div class="form-group">

                <button style="margin-left: 480px; margin-top: 20px;" type="submit" id="" name="nut" value="Next" class="btn btn-success">Next</button>
            </div>
        </form>
    </div>


</body>
<?php include("footer.php") ?>

</html>
