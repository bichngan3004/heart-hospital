<?php
ob_start();
include("header.php");
include("menu.php");
include("mail/indexm.php");
$h = new Mailer();



session_start();
include("class/patient.php");
$p = new patient();
if (isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"])==1) {
   include("class/config.php");
   $q = new connect();
   $q->confirm_bn($_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
} 
else if (isset($_SESSION['user_token'])) 
{

} 
else {
   header("location: login.php");
}

$id_benhnhan = $_SESSION["id_user"];
if(isset($_POST['lienhe']))
{
    $title= $_REQUEST['txttieude'];
    $content = $_REQUEST['txtmo'];
    $addressMail = $_REQUEST['txtemail'];

 
    $h->sendmail($title,$content,$addressMail);
    if($p->themxoasua("INSERT INTO lienhe (email,tieude,noidung,id_benhnhan) VALUES ('$addressMail','$title', '$content','".$_SESSION['id_user']."')")==1)
    {
       
        echo '<script>alert("Đã gởi email cho bệnh viện.")</script>';
        //header("location:lienhe.php");
    }
}

?> 

<style>
    
    #lh-email-details
    {
        width:1000px; 
        height:600px;
        /* border: 1px solid black; */
        margin: 20px;
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
        margin-left: 200px;
    }
</style>
<body>
    <div class="col-xs-12 row" style="margin-left: 250px; margin-right:auto;">
        <div class="lh-email" >
            <div id="lh-email-details" >
                <h2 style="text-align:center; margin-left:30px; color:red; ">
                    <img src="../img/lienhe.png" style="width:160px;"></img> Nơi giải đáp những thắc mắc!!!
                </h2>
                <br>
                <div class="lienhe">
                <form name="contactus" method="post" style="margin: 20px 50px">
                    <div class="form-group col-12">
                        <span><label>E-mail hệ thống:</label></span><br>
                        <span><input type="email" name="txtemail" required="true" class="form-control" placeholder="hospital@tamduchearthospital.com" value="bichngan12a11@gmail.com"></span>
                    </div><br>
                    <div>
                        <span><label>Tiêu đề:</label></span><br>
                        <span><input type="text" name="txttieude" required="true" class="form-control" placeholder="Tiêu đề" value=""></span>
                    </div><br>
                    <div>
                        <span><label>Nội dung:</label></span><br>
                        <span><textarea name="txtmo" required="true" style=" resize: none;"  placeholder="Nội dung" class="form-control"></textarea></span>
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