<?php
ob_start();
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .register {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #DDDDDD;
            border-radius: 10px;
        }

        #myform {
            margin: 20px;
        }

        label {
            padding: 10px 0px;
        }

        .signin {
            margin-top: 10px;
            margin-left: 240px;
        }

        h2 {
            padding-top: 10px;
        }

        #erten,
        #erema,
        #erpass,
        #errepass,
        #ernamsinh,
        #erdiachi,
        #ersdt {
            color: red;
            font-style: italic;
        }

        #ten,
        #email,
        #mk,
        #xnmk,
        #ns,
        #dc,
        #sdt,
        #male {
            color: red;
        }
    </style>

    <?php
    //định nghĩa các biến và set giá trị mặc định là blank(trống)
    // $tenErr = $emailErr = $passErr = $repassErr = $gioitinhErr = $namsinhErr=$diachiErr = $sdtErr ="";
    // $ten=$email=$pass=$repass=$gioitinh=$namsinh=$diachi=$sdt="";

    // // xác thực qua form
    // if($_SERVER["REQUEST_METHOD"] == "POST")
    // {
    //     //check họ và tên
    //     if(empty($_POST["txtten"]))
    //     {
    //         $tenErr ="Họ và tên bắt buộc!";
    //     }
    //     else
    //     {
    //         $ten = input_data($_POST["txtten"]);
    //         if(!preg_match("/^[A-Za-z0-9_\.]{6,32}$/",$ten))
    //         {
    //             $tenErr ="Họ và tên không hợp lệ!";
    //         }
    //     }
    //     //check email
    //     if(empty($_POST["txtemail"]))
    //     {
    //         $emailErr ="Email bắt buộc!";
    //     }
    //     else
    //     {
    //         $email = input_data($_POST["txtemail"]);
    //         if(!preg_match("/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/",$email))
    //         {
    //             $emailErr="Email không hợp lệ!";
    //         }
    //     }

    //     //password
    //     if(empty($_POST["txtpass"]))
    //     {
    //         $passErr ="Mật khẩu bắt buộc!";
    //     }
    //     else
    //     {
    //         $pass = input_data($_POST["txtpass"]);
    //         if(!preg_match("/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}/",$pass))
    //         {
    //            $passErr="Mật khẩu không hợp lệ!";
    //         }
    //     }
    //     //repass
    //     if(empty($_POST["txtrepass"]))
    //     {
    //         $repassErr="Nhập lại mật khẩu!";
    //     }
    //     else
    //     {
    //         $repass = input_data($_POST["txtrepass"]);
    //         if($pass!=$repass)
    //         {
    //            $repassErr="Mật khẩu không trùng khớp!";
    //         }
    //     }
    //     //gioi tinh
    //     if(empty($_POST["txtgioitinh"]))
    //     {
    //         $gioitinhErr="Giới tính bắt buộc!";
    //     }
    //     else
    //     {
    //         $gioitinhErr = input_data($_POST["txtgioitinh"]);

    //     }
    //     //date
    //     if (empty($_POST["txtns"])) {
    //         $namsinhErr = "Bắt buộc!";
    //     } else {
    //         $namsinh = input_data($_POST["txtns"]);
    //     }

    //     //diachi
    //     if (empty($_POST["txtdiachi"])) {
    //         $diachiErr = "Địa chỉ là bắt buộc!";
    //     } else {
    //         $diachi = input_data($_POST["txtdiachi"]);
    //         // check if name only contains letters and whitespace  
    //         if (!preg_match("/[A-Za-z0-9'\.\-\s\,]/", $diachi)) {
    //             $diachiErr = "Địa chỉ không hợp lệ!";
    //         }
    //     }
    //     //sdt
    //     if (empty($_POST["txtsdt"])) {
    //         $sdtErr = "SĐT là bắt buộc!";
    //     } else {
    //         $sdt = input_data($_POST["txtsdt"]);
    //         // check if mobile no is well-formed  
    //         if (!preg_match("/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im", $sdt)) {
    //             $sdtErr = "SĐT Không hợp lệ!";
    //         }
    //         //check mobile no length should not be less and greator than 10  
    //         if (strlen($sdt) != 10) {
    //             $sdtErr = "SĐT gồm 10 số!";
    //         }
    //     }
    // }
    // function input_data($data)
    // {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    // }

    $ten = $email = $pass = $repass = $gioitinh = $namsinh = $diachi = $sdt = "";
    $error = array('ten' => '', 'email' => '', 'pass' => '', 'repass' => '', 'gioitinh' => '', 'namsinh' => '', 'diachi' => '', 'sdt' => '');
    if (isset($_POST['nut'])) {

        if (!empty($_POST['txtten'])) {
            $ten = mysqli_real_escape_string($p->connect(), $_POST['txtten']);
            if (!preg_match("/^([A-Z]{1}[a-z]*\s)*([A-Z]{1}[a-z]*)$/", $ten)) {
                $error['ten'] = 'Họ và tên không hợp lệ!';
            } 
                $existUser = $p->exist_user($ten);
                if ($existUser) {
                    $error['ten'] = 'Họ và tên người dùng đã tồn tại!';
                }
            
        } else {
            $error['ten'] = 'Không được để trống!';
        }

        if (!empty($_POST['txtemail'])) {
            $email = mysqli_real_escape_string($p->connect(), $_POST['txtemail']);
            $existEmail = $p->exist_email($email);
            if ($existEmail) {
                $error['email'] = 'Email người dùng đã tồn tại!';
            }
        } else {
            $error['email'] = 'Không được để trống!';
        }

        if (!empty($_POST['txtpass'])) {
            $pass = mysqli_real_escape_string($p->connect(), $_POST['txtpass']);
            if (!preg_match("/(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}/", $pass)) {
                $error['pass'] = "Mật khẩu không hợp lệ!";
            } else {
                //$pass = md5($pass);
            }
        } else {
            $error['pass'] = 'Không được để trống!';
        }
        if (!empty($_POST['txtrepass'])) {
            $repass = mysqli_real_escape_string($p->connect(), $_POST['txtrepass']);
            if ($pass != $repass) {
                $error['repass'] = 'Mật khẩu không trùng khớp!';
            }
        } else {
            $error['repass'] = 'Không được để trống!';
        }
        if (!empty($_POST['txtns'])) {
            $namsinh = mysqli_real_escape_string($p->connect(), $_POST['txtns']);
        } else {
            $error['namsinh'] = 'Không được để trống!';
        }
        if (!empty($_POST['txtdiachi'])) {
            $diachi = mysqli_real_escape_string($p->connect(), $_POST['txtdiachi']);
        } else {
            $error['diachi'] = 'Không được để trống!';
        }
        if (!empty($_POST['txtsdt'])) {
            $sdt = mysqli_real_escape_string($p->connect(), $_POST['txtsdt']);
            if (!preg_match("/^[0-9]{10}$/", $sdt)) {
                $error['sdt'] = 'Số điện thoại không hợp lệ!';
            }
        } else {
            $error['sdt'] = 'Không được để trống!';
        }
        if (!empty($_POST['txtgioitinh'])) {
            $gioitinh = mysqli_real_escape_string($p->connect(), $_POST['txtgioitinh']);
        } else {
            $error['gioitinh'] = 'Không được để trống!';
        }
        if (!array_filter($error)) {
            $link = $p->connect();
            $sql2 = "INSERT INTO `benhnhan` (`id_benhnhan`, `tenbenhnhan`, `gioitinh`, `namsinh`, `diachi`, `sdt`) VALUES (NULL, '" . $ten . "', '" . $gioitinh . "', '" . $namsinh . "', '" . $diachi . "', '" . $sdt . "')";
            if (mysqli_query($link, $sql2)) {
                $last_id = mysqli_insert_id($link);
                $sql1 = "INSERT INTO `taikhoan` (`tentaikhoan`, `email`, `password`, `phanquyen`, `id_user`) VALUES 
                            ('" . $ten . "', '" . $email . "', '" . md5($pass) . "', '1', '" . $last_id . "')";
                if (mysqli_query($link, $sql1)) {
                    header("location:login.php");
                } else {
                    echo "<script>alert('Đăng ký không thành công!')</script>";
                }
            }
        }
    }

    ?>
</head>

<body>
    <?php
    include("header.php");
    include("menu.php");

    ?>
    <div class="container">
        <div class="register">
            <h2 class="text-center" style="color:#00bb00">ĐĂNG KÝ</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="myform">
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="ten" class="control-label">Họ và tên <span id="ten">*</span></label>
                        <div class="col">
                            <input type="text" class="form-control" id="txtten" name="txtten" placeholder="" value="<?php echo $ten //(isset($ten)) ? $ten : ''; 
                                                                                                                    ?>">
                            <span id="erten"><?php echo $error['ten']; ?></span>
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label for="email" class="control-label">Email<span id="email">*</span></label>
                        <div class="col">
                            <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="" value="<?php echo $email; //(isset($email)) ? $email: '' 
                                                                                                                            ?>">
                            <span id=erema><?php echo $error['email']; //echo $emailErr; 
                                            ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="password" class="control-label">Mật khẩu<span id="mk">*</span></label>
                        <div class="col">
                            <input type="password" class="form-control" id="txtpass" name="txtpass" placeholder="" value="<?php echo $pass; //(isset($pass)) ? $pass : ''; 
                                                                                                                            ?>">
                            <span id="erpass"><?php echo  $error['pass']; //echo $passErr; 
                                                ?></span>
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label for="password" class="control-label">Xác nhận mật khẩu<span id="xnmk">*</span></label>
                        <div class="col">
                            <input type="password" class="form-control" id="txtrepass" name="txtrepass" placeholder="" value="<?php echo $repass //(isset($repass)) ? $repass : ''; 
                                                                                                                                ?>">
                            <span id="errepass"><?php echo $error['repass']; //echo $repassErr; 
                                                ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 form-group">
                        <label for="male" class="control-label">Giới tính<span id="male">*</span></label>
                        <div class="col">
                            <select class="form-control" id="gt" name="txtgioitinh">
                                <option value="<?php echo $gioitinh  ?>"><?php echo $gioitinh  ?></option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                            <span id="ernamsinh"><?php echo $error['gioitinh'] //echo $namsinhErr; 
                                                    ?></span>
                        </div>
                    </div>
                    <div class="col-8 form-group">
                        <label for="namsinh" class="control-label">Năm sinh<span id="ns">*</span></label>
                        <div class="col">
                            <input type="text" class="form-control" id="txtns" name="txtns" placeholder="" value="<?php echo $namsinh //(isset($namsinh)) ? $namsinh : ''; 
                                                                                                                    ?>">
                            <span id="ernamsinh"><?php echo $error['namsinh'] //echo $namsinhErr; 
                                                    ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="diachi" class="control-label">Địa chỉ<span id="dc">*</span></label>
                        <div class="col">
                            <input type="text" class="form-control" id="txtdiachi" name="txtdiachi" placeholder="" value="<?php echo $diachi; //(isset($diachi)) ? $diachi : ''; 
                                                                                                                            ?>">
                            <span id="erdiachi"><?php echo $error['diachi'] //echo $diachiErr; 
                                                ?></span>
                        </div>
                    </div>
                    <div class="col-6 form-group">
                        <label for="phone" class="control-label">Số điện thoại<span id="sdt">*</span></label>
                        <div class="col">
                            <input type="tel" class="form-control" id="txtsdt" name="txtsdt" placeholder="" value="<?php echo $sdt //(isset($sdt)) ? $sdt : ''; 
                                                                                                                    ?>">
                            <span id="ersdt"><?php echo $error['sdt']; //echo $sdtErr; 
                                                ?></span>
                        </div>
                    </div>
                </div>
                <button type="submit" id="btndk" name="nut" class="btn btn-success signin">Đăng ký</button>
            </form>
        </div>
    </div>
    <?php

    // $tenErr = $emailErr = $passErr = $repassErr = $gioitinhErr = $namsinhErr=$diachiErr = $sdtErr ="";
    // $sql = "SELECT * FROM benhnhan WHERE tenbenhnhan='".$ten."'";
    // $kp = mysqli_query($link,$kq);
    // if(mysqli_num_rows($kp)>0){
    //     $tenErr['tenbenhnhan'] = 'Ten da ton tai!';
    // }
    //     $ten = $_REQUEST["txtten"];
    //     $email = $_REQUEST["txtemail"];
    //     $pass = md5($_REQUEST["txtpass"]);
    //     $repass = md5($_REQUEST["txtrepass"]);
    //     $gioitinh = $_REQUEST["txtgioitinh"];
    //     $namsinh = $_REQUEST["txtns"];
    //     $diachi = $_REQUEST["txtdiachi"];
    //     $sdt = $_REQUEST["txtsdt"];
    //     // var_dump($_POST); exit();
    //     $link = $p->connect();

    //     $sql2 = "INSERT INTO `benhnhan` (`id_benhnhan`, `tenbenhnhan`, `gioitinh`, `namsinh`, `diachi`, `sdt`) VALUES (NULL, '" . $ten . "', '" . $gioitinh . "', '" . $namsinh . "', '" . $diachi . "', '" . $sdt . "')";
    //     if ($ten != "" && $email != "" && $pass != "" && $repass != "" && $gioitinh != "" && $namsinh != "" && $diachi != "" && $sdt != "") {
    //         if (mysqli_query($link, $sql2)) {
    //             $last_id = mysqli_insert_id($link);
    //             $sql1 = "INSERT INTO `taikhoan` (`tentaikhoan`, `email`, `password`, `phanquyen`, `id_user`) VALUES 
    //             ('" . $ten . "', '" . $email . "', '" . $pass . "', '1', '" . $last_id . "')";
    //             if (mysqli_query($link, $sql1)) {
    //                 header("location:login.php");
    //             } else {
    //                 echo "<script>alert('Đăng ký không thành công!')</script>";
    //             }
    //         }
    //     } else {
    //         echo "<script>alert('Vui lòng nhập đầy đủ thông tin!')</script>";
    //     }
    // }


    ?>
    <?php
    include("footer.php");
    ?>
</body>

</html>