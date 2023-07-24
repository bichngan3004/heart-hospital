<?php
ob_start();
session_start();
    include("../class/patient.php");
    $p = new patient();
    if (isset($_SESSION["id"]) && isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"])==1) {
        include("../class/config.php");
        $q = new connect();
        $q->confirm_bn($_SESSION["id"],$_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
    } 
    else 
    {
        header("location: ../login.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        nav {
            line-height: 30px;
            background-color: #eeeeee;
            height: auto;
            width: auto;
            float: left;
            padding: 4px;
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
        form {
            margin-left: 380px;
        }

        label {
            padding: 10px 0px;
        }
    </style>
    <script>
        $(function() {
            $("#myform").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    url: {
                        url: true
                    },
                    factor: {
                        required: true,
                        number: true
                    },
                    items: {
                        required: true,
                        digits: true
                    }
                }
            });
        });
    </script>
</head>

<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>
    <div class="row" style="margin: 0px;">
        <nav class="col-3">
            <ul>
                <li><a href=""><i class="fa fa-bars"></i>&emsp;Xem thông tin cá nhân</a></li>
                <li><a href=""><i class="fa fa-calendar-week"></i>&emsp;Xem bệnh án</a></li>
                <li><a href="xemlichkham.php"><i class="fa fa-calendar-week"></i>&emsp;Xem lịch khám</a></li>
                <li><a href=""><i class="fa fa-user"></i>&emsp;Cập nhật tài khoản</a></li>
            </ul>
        </nav>
        <div class="information-account col-9" style="margin-left: 0px;">
            <h2 class="text-center pt-3 pb-2">Thay đổi mật khẩu</h2>

            <form action="" method="post" style="width:500px" id="myform">
                <div class="form-group">
                    <label for="">Nhập mật khẩu cũ</label>
                    <input type="password" name="oldpass" id="oldpass" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Nhập mật khẩu mới</label>
                    <input type="password" name="newpass" id="newpass" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Nhập lại mật khẩu mới</label>
                    <input type="password" name="repass" id="repass" class="form-control">
                </div>
                <a href="updateaccount.php" button style="margin-top: 10px;" class="btn btn-outline-success">Quay lại</button></a>
                <button type="submit" name="nut" style="margin-top: 10px;" class="btn btn-success">Xác nhận</button>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['nut']))
    {
        // $oldpass = md5($_REQUEST["oldpass"]);
        // $newpass = md5($_REQUEST["newpass"]);
        // $repass = md5($_REQUEST["repass"]);
        $old_password = mysqli_real_escape_string($p->connect(), $_POST['oldpass']);
		$old_password = md5( $old_password);
        $new_password= mysqli_real_escape_string($p->connect(), $_POST['newpass']);
		$confirm_new_password = mysqli_real_escape_string($p->connect(), $_POST['repass']);
        $sql = "SELECT * FROM taikhoan WHERE id ='".$_SESSION['id']."'";
        $ketqua = mysqli_query($p->connect(),$sql);
        $row = mysqli_fetch_array($ketqua);
        $pass = $row["password"];
        if($old_password!=$pass)
        {
            echo "<script>alert('Mật khẩu cũ không chính xác!')</script>";
        }
        else if($new_password!=$confirm_new_password)
        {
            echo "<script>alert('Nhập lại mật khẩu không khớp!')</script>";
        }
        elseif($new_password =='' && $confirm_new_password =='')
        {
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin vào!')</script>";
        }
        else
        {
            $new_pass = md5($new_password);
                if($p->themxoasua("UPDATE taikhoan SET password='$new_pass' WHERE id ='".$_SESSION['id']."'"))
                    {
                        header("location:updateaccount.php");
                        echo "<script>alert('Cập nhật thành công!')</script>";
                    }
                    else
                    {
                        echo "<script>alert('Cập nhật không thành công!')</script>";
                    }

        }
        // if( $old_password !='' &&  $new_password!='' && $confirm_new_password!='')
        // {
        //     // if( $new_password == $confirm_new_password)
        //     // {
        //     //     $final_pass = md5($new_password);
        //     //     if($p->themxoasua("UPDATE taikhoan SET password='$final_pass' WHERE id ='".$_SESSION['id']."'"))
        //     //     {
        //     //         header("location:updateaccount.php");
        //     //     }
        //     //     else
        //     //     {
        //     //         echo "<script>alert('Cập nhật không thành công!')</script>";
        //     //     }
        //     // }
        //     // else
        //     // {
        //     //     echo "<script>alert('Hai mật khẩu không trùng khớp!')</script>";
        //     // }
        // }
        // else
        // {
        //     echo "<script>alert('Vui lòng nhập đầy đủ thông tin!')</script>";
        // }
    }
   
       

    ?>


    <?php
    include("footer.php");
    ?>
</body>

</html>