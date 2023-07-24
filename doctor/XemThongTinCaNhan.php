<?php
session_start();
ob_start();
if(isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['id_user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen'])==2)
{
	include('../class/config.php');
	$q=new connect();
    $q->confirm_login($_SESSION['id'], $_SESSION['user'],$_SESSION['pass'], $_SESSION['phanquyen'],$_SESSION['id_user']);
    
}
else
{
	header('location:../login.php');
}

include("../class/clsdoctor.php");
$p = new doctor();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">   
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        nav {
            line-height:45px;
            background-color: #eeeeee;
            height: 100%;
            width:23%;
            float:left;
            padding:5px;
           
        }
        section {
            width: 77%;
            float:left;
            padding:10px;
        }
        footer {
            clear:both;
        }
        nav ul{
            padding-right:30px;
        }
        nav ul li{
            
            border-bottom: 1px solid #cdcdcd;
        }
        nav ul li a{
            color: black;
            text-decoration: none;  
        }
        nav ul{
            list-style: none;
        }
        nav ul li a:hover{
            font-weight: 700;
        }
        p>a{
            font-weight: bold;
            color:#00a629;
            text-decoration: none;
        }
        p>a:hover{
            color: #004000;
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>
    <nav>
      <ul>
        <li><a href="XemThongTinCaNhan.php"><i class="fa fa-bars"></i>&emsp;Xem thông tin cá nhân</a></li>
        <li><a href="XemLich.php"><i class="fa fa-calendar-week"></i>&emsp;Xem lịch khám</a></li>
        <li><a href="chidinhxn.php"><i class="fa fa-id-card"></i>&emsp;Nhận phiếu xét nghiệm</a></li>
        <li><a href="QuanLyBenhAn.php"><i class="fa fa-user"></i>&emsp;Quản lý bệnh án bệnh nhân</a></li>
        <li><a href="updateaccount.php"><i class="fa fa-file-signature"></i>&emsp;Cập nhật tài khoản</a></li>
      </ul>
    </nav>

    <section>
    <h4 style="font-weight: bold">THÔNG TIN CÁ NHÂN</h4>
    
        <div class="information">
           
            <?php $p->loadinfo("SELECT * FROM bacsi order by id_bacsi asc"); ?>
        </div>


    </section>

    
     
     <!--Modal nút SỬA thông tin-->
    <div class="modal" id="capnhat">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

      <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">CẬP NHẬT THÔNG TIN BÁC SĨ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

      <!-- Modal body -->
                
               <?php $p->updateinfo("SELECT * FROM bacsi order by id_bacsi asc"); ?>

          </div>
       </div>
    </div>

    <!--Modal sửa hình-->
    <div class="modal" id="change_image">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <label for="myimg"></label>
                        <input type="file" name="myimg" id="myimg" />
                        <div class="modal-footer">
                        <input type="submit" style="background-color: green; border-color:#7dff7d" class="btn btn-primary" name="saveimg" value="Lưu"></input>
                            <a href='#' class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <footer>
    <?php include("footer.php");?>
    </footer>
     
    <?php
        if(isset($_POST['capnhat']))
        {
            $idsua=$_REQUEST['txtid'];
            $ten = $_REQUEST['txtten'];
            $gioitinh = $_REQUEST['txtgioitinh'];
            $namsinh = $_REQUEST['txtns'];
            $chuyenkhoa = $_REQUEST['txtck'];
            $sdt = $_REQUEST['txtsdt'];
            $diachi = $_REQUEST['txtdiachi'];
            $mota = $_REQUEST['txtmota'];
            $noidung = $_REQUEST['txtnoidung'];
            $chucvu = $_REQUEST['txtchucvu'];
            if($idsua>0)
            {
                if($p->themxoasua("UPDATE bacsi SET tenbacsi = '$ten', gioitinh = '$gioitinh', namsinh = '$namsinh', chucvu = '$chucvu', id_khoa = '$chuyenkhoa', diachi = '$diachi', sdt = '$sdt', mota = '$mota', noidung = '$noidung' WHERE id_bacsi ='$idsua' LIMIT 1 ;")==1)
                {  
                    header('location:XemThongTinCaNhan.php');
                }
                else
                {
                    echo'<script>alert("Cập nhật thông tin không thành công!")</script>';	
                }
            }
            else
            {
                echo'<script>alert("Lỗi!!!")</script>';	
            }
        }
        if(isset($_POST['saveimg']))
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
                        if($p->themxoasua("UPDATE bacsi SET hinhanh = '$name' WHERE id_bacsi = ".$_SESSION['id_user']."")==1)
                        {
                            header("location:XemThongTinCaNhan.php");
                        }
                        else
                        {
                            echo '<script> alert("Cập nhật hình không thành công")</script>';
                        }
                    }
         
                }
                else
                {
                    echo '<script>alert("Up hình không thành công")</script>';
                }
            }
            else
            {
                echo '<script> alert("Vui lòng chọn hình đại diện")</script>';
            }
        }
    ?>
    <script src="./../tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#txtnoidung',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
    </script>
</body>
</html>
