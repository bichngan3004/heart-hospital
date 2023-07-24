<?php
ob_start();
session_start();
include("../class/patient.php");
$p = new patient();
if (isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"])==1) {
    include("../class/config.php");
    $q = new connect();
    $q->confirm_bn($_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
} 
else if 
(isset($_SESSION['user_token'])) 
{

} 
else {
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
        </style>
</head>

<body>
   
    <?php
    include("header.php");
    include("menu.php");
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
        <div class="information col-9">
            <h2 class="text-center pt-2">Thông tin cá nhân</h2>
            <div class="row">
                <div class="img col-4">
                 <img src="../img/<?php  
                    if(isset($_SESSION['id_user']))
                    {
                        echo $p->laycot("SELECT hinhanh FROM benhnhan WHERE id_benhnhan=".$_SESSION['id_user'].""); 
                    }
                    elseif(isset($_SESSION['user_token']))
                    {
                        echo $p->laycot("SELECT hinhanh FROM benhnhan WHERE token=".$_SESSION['user_token']."");
                    }
                    
                    ?>" style="margin-left: 150px" width="150px" height="150px" alt=""> 
                     
                    <p style="padding-top:20px; margin-left:180px;"><a href="#" style="text-decoration: none; color:#00bb00" data-toggle="modal" data-target="#change_image">Thay đổi ảnh</a></p>
                </div>
               
                <?php 
                    if(isset($_SESSION['id_user']))
                    {
                        $p->xemthongtin("SELECT * FROM benhnhan WHERE id_benhnhan =".$_SESSION['id_user']."");
                    }
                    else
                    {
                        $p->xemthongtin("SELECT * FROM benhnhan WHERE token=".$_SESSION['user_token']."");
                    }
                ?>
            </div>
        </div>
    </div>
    <!--Modal đổi ảnh-->

    <div class="modal" id="change_image">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <label for="myimg"></label>
                        <input type="file" name="myimg" id="myimg" />
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" name="hinh" value="Lưu"></input>
                            <a href='#' class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
         if(isset($_POST['hinh']))
         {
             $name=$_FILES['myimg']['name'];
             $size=$_FILES['myimg']['size'];
             $tmp_name=$_FILES['myimg']['tmp_name'];
             $type=$_FILES['myimg']['type'];
           if($name!='')
           {
             $name=time()."_".$name;
             if($p->myupfile($name,$tmp_name,"../img")==1)
             {
                 if(isset($_SESSION['id_user']))
                 {
                     if($p->themxoasua("UPDATE benhnhan SET hinhanh = '$name' WHERE id_benhnhan = ".$_SESSION['id_user']."")==1)
                     {
                       header("location:showinformation.php");
                     }
                     else
                     {
                       echo '<script>alert("Cập nhật hình không thành công!")</script>';
                     }
                 }
                 else if(isset($_SESSION['user_token']))
                 {
                     if($p->themxoasua("UPDATE benhnhan SET hinhanh = '$name' WHERE token = ".$_SESSION['user_token']."")==1)
                     {
                       header("location:showinformation.php");
                     }
                     else
                     {
                       echo '<script>alert("Cập nhật hình không thành công!")</script>';
                     }
                 }
              
             }
             else
             {
                 echo '<script>alert("Up hình không thành công!")</script>';
             }
           }
           else
           {
             echo '<script>alert("Vui lòng chọn hình đại diện!")</script>';
           }
         }
         
    ?>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin cá nhân</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="font-weight-bolder">Họ và tên: </label>
                            <input type="text" class="form-control" name="txtten" value="<?php 
                                                                                     if(isset($_SESSION['id_user']))
                                                                                     {
                                                                                         echo $p->laycot("select tenbenhnhan from benhnhan where id_benhnhan=".$_SESSION['id_user']."");
                                                                                     }
                                                                                     else
                                                                                     {
                                                                                         echo $p->laycot("select tenbenhnhan from benhnhan where token=".$_SESSION['user_token']."");
                                                                                     }
                                                                                    ?>">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder">Giới tính: </label> 

                            <select class="form-control" name="txtgioitinh">
                                <option value="
                                    <?php
                                        if(isset($_SESSION['id_user']))
                                        {
                                             echo $p->laycot("select gioitinh from benhnhan where id_benhnhan=".$_SESSION['id_user']."");
                                        }
                                        else if(isset($_SESSION['user_token']))
                                        {
                                            echo $p->laycot("select gioitinh from benhnhan where id_benhnhan=".$_SESSION['user_token']."");
                                        }
                                    ?> "selected="selected" style="color:black;">
                                     <?php 
                                        if(isset($_SESSION['id_user']))
                                        {
                                            echo $p->laycot("select gioitinh from benhnhan where id_benhnhan=".$_SESSION['id_user']."");
                                        }
                                        else if(isset($_SESSION['user_token']))
                                        {
                                            echo $p->laycot("select gioitinh from benhnhan where id_benhnhan=".$_SESSION['user_token']."");
                                        }
                                    ?>
                                </option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder">Năm sinh: </label>
                            <input type="text" class="form-control" name="txttuoi" value="<?php
                                                                                    if(isset($_SESSION['id_user']))
                                                                                    {
                                                                                        echo $p->laycot("select namsinh from benhnhan where id_benhnhan=".$_SESSION['id_user']."");
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo $p->laycot("select namsinh from benhnhan where token=".$_SESSION['user_token']."");
                                                                                    }
                                                                                ?>">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder">Số điện thoại: </label>
                            <input type="text" class="form-control" name="txtsdt" minlength="8" maxlength="12" required="required" value="<?php
                                                                                    if(isset($_SESSION['id_user']))
                                                                                    {
                                                                                        echo $p->laycot("select sdt from benhnhan where id_benhnhan=".$_SESSION['id_user']."");
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo $p->laycot("select sdt from benhnhan where token=".$_SESSION['user_token']."");
                                                                                    }
                                                                                ?>">
                                                                                

                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder">Địa chỉ: </label>
                            <input type="text" class="form-control" name="txtdiachi" minlength="8" maxlength="80" required="required" value="<?php 
                                                                                    if(isset($_SESSION['id_user']))
                                                                                    {
                                                                                        echo $p->laycot("select diachi from benhnhan where id_benhnhan=".$_SESSION['id_user']."");
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo $p->laycot("select diachi from benhnhan where token=".$_SESSION['user_token']."");
                                                                                    }
                                                                                ?>">
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="update" value="Lưu"></input>
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
if(isset($_POST['update']))
{
    $ten = $_REQUEST['txtten'];
    $gioitinh = $_REQUEST['txtgioitinh'];
    $tuoi = $_REQUEST['txttuoi'];
    $sdt = $_REQUEST['txtsdt'];
    $diachi = $_REQUEST['txtdiachi'];
   

   // var_dump($_POST); exit();
    /*if($p->themxoasua("UPDATE benhnhan SET tenbenhnhan = '$ten', gioitinh ='$gioitinh', tuoi='$tuoi', diachi = '$diachi', sdt = '$sdt' WHERE id_benhnhan = '$id_user';")==1)
    {
        echo '<script>alert("Cập nhật thông tin thành công")</script>';
      
    }
    else
    {
        echo'Cập nhật thông tin không thành công';
    }*/
    if($ten!='' && $gioitinh !='' && $tuoi!='' && $sdt!='' && $diachi!='')
    {
        if(isset($_SESSION['id_user']))
        {
            if($p->themxoasua("UPDATE benhnhan SET tenbenhnhan = '$ten', gioitinh ='$gioitinh', namsinh='$tuoi', diachi = '$diachi', sdt = '$sdt' WHERE id_benhnhan = ".$_SESSION['id_user'].";")==1)
            {
            // echo '<script>alert("Cập nhật thông tin thành công")</script>';
                header("location:showinformation.php");
            }
            else
            {
                echo'<script>alert("Cập nhật thông tin không thành công!")</script>';
            }
        }
        else
        {
            if($p->themxoasua("UPDATE benhnhan SET tenbenhnhan = '$ten', gioitinh ='$gioitinh', namsinh='$tuoi', diachi = '$diachi', sdt = '$sdt' WHERE token = ".$_SESSION['user_token'].";")==1)
            {
            // echo '<script>alert("Cập nhật thông tin thành công")</script>';
                header("location:showinformation.php");
            }
            else
            {
                echo'<script>Cập nhật thông tin không thành công!</script>';
            }
        }

        }
    else
    {
        echo '<script>alert("Vui lòng nhập đầy đủ thông tin!")</script>';
    }
}

?>

    <?php
    include("footer.php");
    ?>

</body>

</html>