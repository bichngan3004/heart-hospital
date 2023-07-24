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

        .container1 {
            width: 500px;
            border-radius: 10px;
            background-color: #DDDDDD;
            padding: 20px;
            margin: 20px auto;
        }

        h2 {
            text-align: center;
        }

        #eractor,
        #erten,
        #eremail,
        #erpass,
        #ertentk,
        #eremailtk,
        #erpasstk {
            color: red;
            font-style: italic;
        }
    </style>
    <script>
        // $(document).ready(function()
        // {
        //     function kiemtraten()
        //     {
        //         var ten = $("#txtten").val();
        //         //var reg = /^[A-Za-z0-9_\.]{6,32}$/;
        //         var reg=/^([A-Z]{1}[a-z]*\s)*([A-Z]{1}[a-z]*)$/;
        //         if(reg.test(ten))
        //         {
        //             $("#erten").html("");
        //             return true;
        //         }
        //         else
        //         {
        //             $("#erten").html("Tên tài khoản không hợp lệ! ");
        //             return false;
        //         }
        //     }
        //     $("#txtten").blur(kiemtraten);
        //     function kiemtraemail()
        //     {
        //         var email = $("#txtem").val();
        //         var reg = /^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/;
        //         if(reg.test(email))
        //         {
        //             $("#eremail").html("");
        //             return true;
        //         }
        //         else
        //         {
        //             $("#eremail").html("Email không hợp lệ hoặc tồn tại!");
        //             return false;
        //         }
        //     }
        //     $("#txtem").blur(kiemtraemail);
        //     function kiemtrapass()
        //     {
        //         var pass = $("#txtpass").val();
        //         var reg = /(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}/;
        //         if(reg.test(pass))
        //         {
        //             $("#erpass").html("");
        //             return true;
        //         }
        //         else
        //         {
        //             $("#erpass").html("Mật khẩu không hợp lệ hoặc tồn tại!");
        //             return false;
        //         }
        //     }
        //     $("#txtpass").blur(kiemtrapass);

        // })
        // // hàm điều kiện bắt nhập đầy đủ thoogn tin mới đăng kí được
        // $(function()
        // {
        //     $("#myform").validate(
        //     {
        //         rules: 
        //         {
        //         email: 
        //         {
        //             required: true,
        //             email:true
        //         },
        //         url: 
        //         {
        //             url:true
        //         },
        //         factor:
        //         {
        //             required: true,
        //             number:true  
        //         },
        //         items:
        //         {
        //             required: true,
        //             digits:true
        //         }
        //         }
        //     });    
        // });
    </script>
    <?php
    $chucvu = $ten = $email = $pass = "";
    $error = array('chucvu' => '', 'ten' => '', 'email' => '', 'pass' => '');
    if (isset($_POST['dangky'])) {
        if (!empty($_POST['txtactor'])) {
            $chucvu = mysqli_real_escape_string($p->connect(), $_POST['txtactor']);
        } else {
            $error['chucvu'] = 'Không được để trống';
        }

        if (!empty($_POST['txtten'])) {
            $ten = mysqli_real_escape_string($p->connect(), $_POST['txtten']);
            if (!preg_match("/^([A-Z]{1}[a-z]*\s)*([A-Z]{1}[a-z]*)$/", $ten)) {
                $error['ten'] = 'Họ và tên không hợp lệ!';
            }
        } else {
            $error['ten'] = 'Không được để trống';
        }
        if (!empty($_POST['txtem'])) {
            $email = mysqli_real_escape_string($p->connect(), $_POST['txtem']);
            $existEmail = $q->exist_email($email);
            if ($existEmail) {
                $error['email'] = 'Email đã tồn tại!';
            }
        } else {
            $error['email'] = 'Không được để trống!';
        }

        if (!empty($_POST['txtpass'])) {
            $pass = mysqli_real_escape_string($p->connect(), $_POST['txtpass']);
            if (!preg_match("/^[0-9]{2,}$/", $pass)) {
                $error['pass'] = "Mật khẩu không hợp lệ!";
            } else {
                $pass = md5($pass);
            }
        } else {
            $error['pass'] = 'Không được để trống!';
        }

        if (!array_filter($error)) {
            $link = $p->connect();
            if ($chucvu == 2) {
                $sql2 = "INSERT INTO bacsi(id_bacsi,tenbacsi) values (null,'$ten')";
                if (mysqli_query($link, $sql2)) {
                    $last_id = mysqli_insert_id($link);
                    $sql1 = "INSERT INTO taikhoan (email,password,tentaikhoan,phanquyen,id_user) VALUES (
                                '$email','$pass','$ten','2','$last_id')";
                    if (mysqli_query($link, $sql1)) {
                        echo '<script>alert("Cấp tài khoản cho bác sĩ thành công!")</script>';
                    }
                } else {
                    echo '<script>alert("Cấp tài khoản thất bại!")</script>';
                }
            } elseif ($chucvu == 3) {
                $sql2 = "INSERT INTO nvyt(id_nvyt,tennvyt) values (null,'$ten')";
                if (mysqli_query($link, $sql2)) {
                    $last_id = mysqli_insert_id($link);
                    $sql1 = "INSERT INTO taikhoan (email,password,tentaikhoan,phanquyen,id_user) VALUES (
                                            '$email','$pass','$ten','3','$last_id')";
                    if (mysqli_query($link, $sql1)) {
                        echo '<script>alert("Cấp tài khoản cho nhân viên y tế thành công!")</script>';
                    }
                } else {
                    echo '<script>alert("Cấp tài khoản thất bại!")</script>';
                }
            }
        }
    }
    ?>
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
    <div class="container1">
        <h2>CẤP TÀI KHOẢN</h2>
        <form method="POST" id="myform">
            <div class="form-group">
                <label for="actor">Người dùng: </label><span id="eractor"> *</span>
                <select class="form-control" name="txtactor">
                   
                    <option value="2" selected="selected">Bác sĩ</option>
                    <option value="3">Nhân viên y tế</option>
                </select>
                <span id="erten"><?php echo $error['chucvu']; ?></span>
            </div>
            <div class="form-group">
                <label for="ten">Tên tài khoản: </label><span id="ertentk">*</span>
                <input type="text" class="form-control" id="txtten" name="txtten" value="<?php echo $ten; ?>" placeholder="heathylife123">
                <span id="erten"><?php echo $error['ten']; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email: </label><span id=eremailtk>*</span>
                <input type="email" class="form-control" id="txtem" value="<?php echo $email;  ?>" placeholder="heathylifent@gmail.com" name="txtem">
                <span id=eremail><?php echo $error['email']; ?></span>
            </div>
            <div class="form-group">
                <label for="pass">Mật khẩu: </label> <span id="erpasstk">*</span>
                <input type="password" class="form-control" id="txtpass" value="<?php echo $pass; ?>" placeholder="heathylifent123" name="txtpass">
                <span id="erpass"><?php echo $error['pass']; ?></span>
            </div>
            <br>
            <div class="modal-footer">
                <button type="submit" id="btndk" style=" background-color: green; border-color:#7dff7d" name="dangky" value="Đăng ký" class="btn btn-primary">Đăng ký</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" name="thoat"><a href="helloadmin.php" style="color: white; text-decoration: none;">Thoát</a></button>
            </div>
        </form>
    </div>


    <?php

    // if(isset($_POST['dangky']))
    // {
    //     $actor=$_REQUEST['txtactor'];
    //     $ten=$_REQUEST['txtten'];
    //     $email=$_REQUEST['txtem'];
    //     $pass=md5($_REQUEST['txtpass']);
    //     $link = $p->connect();
    //     if($actor==2){
    //         $sql2 = "INSERT INTO bacsi(id_bacsi,tenbacsi) values (null,'$ten')";
    //         if($ten!='' && $email!='' &&  $pass!='')
    //             {
    //                 if(mysqli_query($link,$sql2))
    //                 {
    //                     $last_id = mysqli_insert_id($link);
    //                     $sql1 = "INSERT INTO taikhoan (email,password,tentaikhoan,phanquyen,id_user) VALUES (
    //                         '$email','$pass','$ten','2','$last_id')";
    //                         if(mysqli_query($link,$sql1))
    //                         {
    //                             echo '<script>alert("Cấp tài khoản cho bác sĩ thành công!")</script>';
    //                         }

    //                 }
    //                 else
    //                 {
    //                     echo '<script>alert("Cấp tài khoản thất bại!")</script>';
    //                 }
    //             }
    //         else
    //         {
    //             echo'<script>alert("Vui lòng nhập đầy đủ thông tin!")</script>';
    //         }
    //     }
    //     elseif($actor==3){
    //         $sql2 = "INSERT INTO nvyt(id_nvyt,tennvyt) values (null,'$ten')";
    //         if($ten!='' && $email!='' &&  $pass!='')
    //             {
    //                 if(mysqli_query($link,$sql2))
    //                 {
    //                     $last_id = mysqli_insert_id($link);
    //                     $sql1 = "INSERT INTO taikhoan (email,password,tentaikhoan,phanquyen,id_user) VALUES (
    //                         '$email','$pass','$ten','3','$last_id')";
    //                         if(mysqli_query($link,$sql1))
    //                         {
    //                             echo '<script>alert("Cấp tài khoản cho nhân viên y tế thành công!")</script>';
    //                         }

    //                 }
    //                 else
    //                 {
    //                     echo '<script>alert("Cấp tài khoản thất bại!")</script>';
    //                 }
    //             }
    //         else
    //         {
    //             echo'<script>alert("Vui lòng nhập đầy đủ thông tin!")</script>';
    //         }
    //     }
    // }
    // if(isset($_POST['thoat']))
    // {
    //     header('location:helloadmin.php');
    // }
    ?>
    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>

</html>