<?php
 session_start();
 include("../class/patient.php");
 $p = new patient();
if (isset($_SESSION["user"]) && isset($_SESSION["pass"]) && isset($_SESSION["id_user"]) && isset($_SESSION["phanquyen"])) {
    include("../class/config.php");
    $q = new connect();
    $q->confirm_bn($_SESSION["user"], $_SESSION["pass"], $_SESSION["id_user"], $_SESSION["phanquyen"]);
} 
else if (isset($_SESSION['user_token'])) 
{

} 
else {
    header("location: ../login.php");
}
$trieuchung = $_POST['trieuchung'];
if(!empty($_SESSION['user_token']))
{
    $g ="SELECT * FROM `taikhoan` WHERE token =".$_SESSION['user_token']."";
    $result= @mysqli_query($p->connect(),$g);
    $row  = @mysqli_fetch_array($result);
    $id_bacsi = $_SESSION['bacsi'];
    
    $id_user=$row['id_user'];
}
else
{
    $id_bacsi = $_SESSION['bacsi'];
    //$trieuchung = $_SESSION['trieuchung'];
    $id_user=$_SESSION['id_user'];
}

if(isset($_POST["datlich"]))
{
// $id_bacsi =$_POST["bacsi"];
// $trieuchung =$_POST["trieuchung"];
// $id_user=$_SESSION['id_user'];
$ngayhen = $_POST['ngayhen'];
$_SESSION['ngayhen'] = $ngayhen; 
//var_dump($_POST); exit();
    
    // if($p->themxoasua("INSERT INTO `phieudkkham` (`ngayhen`, `ngaydatlich`, `trieuchung`, `phikham`, `id_benhnhan`, `id_bacsi`) 
    // VALUES ('$ngayhen', current_timestamp(), '$trieuchung', '150000', '$id_user', '$id_bacsi')")==1)
    // {
    //     header("location:successbook.php");
    // }
    // else
    // {
    //     echo "<script>alert('Đặt lịch không thành công!')</script>";
    // }
    if(!empty($_SESSION["user_token"]))
    {
        if(!empty($_POST['ngayhen']))
        {
            $link = $p->connect();
            $ngayhen = $_POST['ngayhen'];
            $_SESSION['ngayhen'] = $ngayhen;
            $sql1 ="INSERT INTO phieudkkham(`id_phieudk`,`ngayhen`,`ngaydatlich`,`trieuchung`,`phikham`,`code_phieu`,`id_benhnhan`,`id_bacsi`,`token`)
            VALUES (NULL,'$ngayhen',current_timestamp(),'$trieuchung','150000','no','$id_user','$id_bacsi',".$_SESSION['user_token'].")";
            if(mysqli_query($p->connect(),$sql1)==true)
            {
                $sql2 = "SELECT *  FROM `phieudkkham`  WHERE `token` =".$_SESSION['user_token']." ORDER BY `id_phieudk` DESC LIMIT 1";
                $id_phieu1= $p->laycot($sql2);
                $dem1=$p->laycot("SELECT COUNT(*) FROM `phieudkkham` WHERE `code_phieu`='no' AND `token`=" . $_SESSION['user_token'] . "");
                // setcookie('200k',$id_phieu1, time() + 61, "/");
               //$_SESSION['phieukham']=$id_phieu1;// ràng buộc bên kia để chỉ là duy nhất.            
                $ketquapk1 = "SELECT * FROM phieudkkham";
                $phieukham1 = mysqli_query($p->connect(),$ketquapk1);
                $i1 = mysqli_num_rows($phieukham1);
                setcookie($dem1,$i1, time() + 60, "/");//cookie 2 p
                //header("location: xemlichkham.php");
                //header("location: successbook.php");
                header("location: successbook.php");
               
            }
            else
            {
                echo "<script>alert('Đặt lịch không thành công!')</script>";
            }   
        }
        else
        {
            echo '<script>alert("Vui lòng chọn ngày khám!")</script>';
            header("refresh:1;url=datlich.php");
        }
    }
    else
    {
        if(!empty($_POST['ngayhen']))
         {
        $link = $p->connect();
        $ngayhen = $_POST['ngayhen'];
        $_SESSION['ngayhen'] = $ngayhen;

        $sql ="INSERT INTO phieudkkham(`id_phieudk`,`ngayhen`,`ngaydatlich`,`trieuchung`,`phikham`,`code_phieu`,`id_benhnhan`,`id_bacsi`)
                VALUES (NULL,'$ngayhen',current_timestamp(),'$trieuchung','150000','no','$id_user','$id_bacsi')";
                if(mysqli_query($p->connect(),$sql)==true)
                {
                $sql="SELECT *  FROM `phieudkkham`  WHERE `id_benhnhan` =".$_SESSION['id_user']." ORDER BY `id_phieudk` DESC LIMIT 1";
                 $id_phieu= $p->laycot($sql);
                 $dem=$p->laycot("SELECT COUNT(*) FROM `phieudkkham` WHERE `code_phieu`='no' AND `id_benhnhan`=" . $_SESSION['id_user'] . "");
                //mục đích là làm điểm để kiểm tra có tồn tại cookie hay không để thực hiện update trạng thái từ no thành yes 
                // Vì khi tồn tại trạng thái code_phieu='no' và id_user='mã bệnh nhân' thì sẽ có trường hợp cần kiểm tra -> sau đó kiểm tra session

                 //$_SESSION['phieukham']=$id_phieu; // ràng buộc bên kia để chỉ là duy nhất.            
                    $ketquapk = "SELECT * FROM phieudkkham";
                    $phieukham = mysqli_query($p->connect(),$ketquapk);
                    $i = mysqli_num_rows($phieukham);
                    setcookie($dem,$i, time() + 60, "/");//cookie 2 p
                    //header("location: xemlichkham.php");
                header("location: successbook.php");
                    
                }
                else
                {
                    echo 'Đặt lịch Không thành công';
                } 
        }  
        else
        {
            echo '<script>alert("Vui lòng chọn ngày khám!")</script>';
            header("refresh:1;url=datlich.php");
        }
    }
}
?>