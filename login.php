<?php
ob_start();
session_start();
include("class/config.php");
$p = new connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='img/icon/tittle.jpg' />
    <title>Tam Duc Heart Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <style>
        .card-info {
            width: 600px;
            border-radius: 10px;
            padding: 20px;
            margin: 0 auto;
            margin-top: 30px;
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            padding: .75rem 1.25rem;
            position: relative;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
        }

        .card-title {
            text-align: center;
        }

        .remind {
            font-size: 15px;
            margin-top: 20px;
            text-align: center;
        }

        .card-footer .cancel {
            float: right;
        }
    </style>
</head>

<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Đăng nhập</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="" method="POST">
            <div class="card-body">
                <div class="form-group row">
                    <label for="" class="col-sm-12 col-form-label">Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-12 col-form-label">Password</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" id="txtpass" name="txtpass" placeholder="Password">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="submit" class="btn btn-success" name="nut" value="Đăng nhập" />
                <button type="submit" class="btn btn-outline-success cancel">Thoát</button>
            </div>
            <!-- /.card-footer -->
            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="controller.php" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Đăng nhập Google+
                </a>
            </div>
            <div class="remind">
                <span>Bạn chưa có tài khoản vui lòng đăng kí <a href="register.php">Tại đây!</a> </span>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['nut'])) {
        $user = $_REQUEST['txtemail'];
        $pass = $_REQUEST['txtpass'];
        //var_dump($_POST); exit();
        if ($user != '' && $pass != '') {
            if ($p->login_user($user, $pass) == 1 ) //bệnh nhân
            {
                $_SESSION['bn'] = 1;
                header("location:patient/index.php");
            } else if ($p->login_user($user, $pass) == 2) //bac si
            {
                $_SESSION['bs'] = 2;
                header("location:doctor/XemThongTinCaNhan.php");
            } else if ($p->login_user($user, $pass) == 3) {
                $_SESSION['nvyt'] = 3;
                header("location:healthcare-staff/hello-nvyt.php"); //nvyt
            } else if ($p->login_user($user, $pass) == 4) {
                $_SESSION['admin'] = 4;
                header("location:admin/helloadmin.php"); //admin
            } else {
                echo '<script>alert("Đăng nhập không thành công!")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng nhập đầy đủ thông tin!")</script>';
        }
    }
    ?>
    <?php
    include("footer.php");
    ?>
</body>

</html>