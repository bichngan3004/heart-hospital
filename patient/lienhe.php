<?php
ob_start();
include("header.php");
include("menu.php");
include("../mail/sendcontact.php");
$h = new Mailer();



session_start();
include("../class/patient.php");
$p = new patient();
if (isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"])==1) {
   include("../class/config.php");
   $q = new connect();
   $q->confirm_bn($_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
} 
else if (isset($_SESSION['user_token'])) 
{
   
       
        //$email = $row['email'];
} 
else {
   header("location: ../login.php");
}
// $id_benhnhantoken= $_SESSION['user_token'];
// $id_benhnhan = $_SESSION["id_user"];

if(isset($_POST['lienhe']))
{
    $nTo = 'Bệnh viện';
    $mTo = 'bichngan12a11@gmail.com';
    $title= $_REQUEST['txttieude'];
    $content = $_REQUEST['txtmo'];
    $addressMail = $_REQUEST['txtemail'];
   
    // $emailbn = $_REQUEST['txtemailbn'];
 
    $h->sendmail($title, $content, $nTo, $mTo,$diachicc='');

    if(isset($_SESSION['id_user']))
    {

        $p->themxoasua("INSERT INTO lienhe (email,tieude,noidung,id_benhnhan) VALUES ('".$_SESSION["user"]."','$title', '$content','".$_SESSION['id_user']."')");
    }
   else
   {
    $sql = "SELECT * FROM taikhoan WHERE token =".$_SESSION['user_token']."";
            $kq = mysqli_query($p->connect(),$sql);
            $row = mysqli_fetch_array($kq);
            $email = $row['email'];
            $p->themxoasua("INSERT INTO lienhe (email,tieude,noidung,token) VALUES ('".$email."','$title', '$content','".$_SESSION['user_token']."')");
   }
 // }
       
       
}

?> 
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
<style>
    
    #lh-email-details
    {
        width:900px; 
        height:600px;
        /* border: 1px solid black; */
        margin: 50px;
        background-color: #EEEEEE;
        border-radius: 5px;
    }
    .nut
    {
        margin-left: 150px;
       width: 200px;
      
    }
    .lienhe
    {
        width: 600px;
        height: 350px;
        /* border: 1px solid black; */
        margin-left: 180px;
    }
    #lh-email-details{
        margin-left: 50px;
    }
    .contact{
        margin-top: 50px;
        /* margin-left: 20px; */
        margin-left: 50px;
    }
</style>
<body>
    <div class="row" style="margin-left:0px; margin-right:0px;">
    <div class="col-3 ">
        <div class="contact">
            <h4>Thông tin liên lạc</h4>
            <p><i class="fa fa-location-dot"></i> 4 Nguyễn Lương Bằng, phường Tân Phú, quận 7, TP.Hồ Chí Minh</p> 
            <span><i class="fa fa-envelope" style="color: #003e00;"></i> hospital@tamduchearthospital.com</span>&ensp; <br> <br>
            <span><i class="fa fa-phone-square" style="color: #003e00;"></i> 028 5411 0036</span>
            <h4>Thời gian làm việc</h4>
            <p>Khám bệnh ngoại trú:</p>
            <p>Thứ 2 - thứ 7: 07:00 tới 17:00</p>
        </div>
    </div>
        <div class="lh-email col-9" >
            <div id="lh-email-details" >
                <h3 style="text-align:center; margin-left:30px; color:red; ">
                    <img src="../img/lienhe.png" style="width:160px;"></img> Đặt câu hỏi để được giải đáp từ các chuyên gia!!!  
                  
                </h3>
               
                <br>
                <div class="lienhe">
                <form name="contactus" method="post" style="margin: 0px 50px">
                   
                       <h3 class="text-center">THƯ LIÊN HỆ</h3>
                        <input type="hidden" name="txtemail" required="true" class="form-control"  value="bichngan12a11@gmail.com">
                       
                    
                    <div>
                        <span><label><b>Họ và tên:</b></label></span><br>
                        <span><input type="text" name="txttieude" required="true" class="form-control" placeholder="Nhập họ và tên" value=""></span>
                    </div><br>
                    <div>
                        <span><label><b>Nội dung:</b></label></span><br>
                        <span><textarea name="txtmo" required="true" style=" resize: none;"  placeholder="Nhập câu hỏi" class="form-control"></textarea></span>
                    </div><br>
                    <div>
                        <span><button type="submit" class="btn btn-default nut" name="lienhe" style="background-color:#00661a; color:white; ">Gửi nội dung</button></span>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <?php
  
// if(isset($_POST['lienhe']))
// {
//     $title= $_REQUEST['txttieude'];
//     $content = $_REQUEST['txtmo'];
//     $addressMail = $_REQUEST['txtemail'];

 
//     $h->sendmail($title,$content,$addressMail);
//     if($p->themxoasua("INSERT INTO lienhe (email,tieude,noidung,id_benhnhan) VALUES ('$addressMail','$title', '$content','".$_SESSION['id_user']."')")==1)
//     {
       
//         echo '<script>alert("Đã gởi email cho bệnh viện.")</script>';
//         //header("location:lienhe.php");
//     }
// }

?>
</body>
<?php
    include("footer.php");
?>