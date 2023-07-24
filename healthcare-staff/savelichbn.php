<?php
 session_start();
 include("../class/patient.php");
 $p = new patient();
if (isset($_SESSION["id"]) && isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"])==3) {
    include("../class/config.php");
    $q = new connect();
    $q->confirm_nvyt ($_SESSION["id"],$_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
} 
 
else {
    header("location: ../login.php");
}


if(isset($_POST["datlich"]))
{
    $link =$p->connect();
    $trieuchung = $_POST['trieuchung'];
    
        // $g ="SELECT id_benhnhan FROM `benhnhan` WHERE id_nvyt ='".$_SESSION["id_user"]."'";
        // $result= @mysqli_query($link,$g);
        // $row  = @mysqli_fetch_array($result);
        $id_bacsi = $_SESSION['bacsi'];
       
        $ngayhen = $_POST['ngayhen'];
        $_SESSION['ngayhen'] = $ngayhen; 
        $id_benhnhan = $_POST['benhnhan'];
        //var_dump($_POST); exit();

   
        if(!empty($_POST['ngayhen']))
         {
        $link = $p->connect();
        $ngayhen = $_POST['ngayhen'];
        $_SESSION['ngayhen'] = $ngayhen;

        $sql ="INSERT INTO phieudkkham(`id_phieudk`,`ngayhen`,`ngaydatlich`,`trieuchung`,`phikham`,`id_benhnhan`,`id_bacsi`)
                VALUES (NULL,'$ngayhen',current_timestamp(),'$trieuchung','150000','$id_benhnhan','$id_bacsi')";
                if(mysqli_query($p->connect(),$sql)==true)
                {
                $sql="SELECT *  FROM `phieudkkham`  WHERE `id_benhnhan` =".$id_benhnhan." ORDER BY `id_phieudk` DESC LIMIT 1";
                $id_phieu= $p->laycot($sql);
                $_SESSION['phieukham']=$id_phieu;// ràng buộc bên kia để chỉ là duy nhất.            
                    $ketquapk = "SELECT * FROM phieudkkham";
                    $phieukham = mysqli_query($link,$ketquapk);
                    $i = mysqli_num_rows($phieukham);
                    setcookie($id_phieu,$i, time() + 60*2, "/");//cookie 2 p
                    //header("location: lichhenkham.php");
                    header("location: successbookbn.php");
                }
                else
                {
                    echo 'Khong thanh cong';
                } 
        }  
        else
        {
            echo '<script>alert("Vui lòng chọn ngày khám!")</script>';
            header("refresh:1;url=datlichbn.php");
        }
    
}
?>