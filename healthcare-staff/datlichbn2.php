
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
</head>
<style>
    
        .container{
            padding: 20px;
            width: 1300px;
        }
        .doctor{
            display: flex;
            justify-content: center;
          float: left;
          
        }
    .card{
            width: 350px;
            margin: 10px 20px;
        }
        .card_body{
            padding: 20px;
            margin-bottom: 10px;
          
        }
        .doctor{
            display: flex;
            justify-content: center;
        }
        .optionnut{
            
            display: flex;
            justify-content: space-between;
        }
        
</style>
<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>
    <?php 
    // ob_start();
    // session_start();
include_once "../class/healthcarestaff.php";
$p = new healthcarestaff();
include("../class/clsadmin.php");
$q = new admin();
if(isset($_POST['nut']))
{
    $tenbn = $_POST['txtname'];
    // $_SESSION['tenbn']=$tenbn;
    $gioitinh = $_POST['txtgioitinh'];
    $namsinh = $_POST['txtns'];
    $diachi = $_POST['txtdiachi'];
    $sdt = $_POST['txtsdt'];
    $id_khoa = $_POST['id_khoa'];
    $pass = md5(123);
    $_SESSION["trieuchung"] = $_POST["trieuchung"];
    $link = $p->connect();
///m,/var_dump($_POST); exit();
$sql2 = "INSERT INTO `benhnhan` (`id_benhnhan`, `tenbenhnhan`, `gioitinh`, `namsinh`,`diachi`,`sdt`) 
VALUES (NULL, '" . $tenbn . "', '" . $gioitinh . "', '" . $namsinh . "','".$diachi."','".$sdt."')";
    if (mysqli_query($link, $sql2)) 
    {
       $last_id = mysqli_insert_id($link);
        //var_dump($last_id); exit();
        $sql1 = "INSERT INTO `taikhoan` (`tentaikhoan`, `password`, `phanquyen`, `id_user`) VALUES 
        ('" . $tenbn . "', '" . $pass . "', '1', '" . $last_id . "')";
        if (mysqli_query($link, $sql1)) {
           // header("location:datlichbn2.php");
           $sql4 = "SELECT id_benhnhan FROM benhnhan WHERE id_benhnhan='$last_id'";
           $ketqua = mysqli_query($link,$sql4);
           $row = mysqli_fetch_array($ketqua);
            $id_benhnhan = $row['id_benhnhan']; 
           $sql3 = "SELECT * FROM bacsi WHERE id_khoa=" . $id_khoa . "";
           $ketqua = mysqli_query($link, $sql3);
           $i = mysqli_num_rows($ketqua);
           if ($i > 0) {
               while ($row = mysqli_fetch_array($ketqua)) {
                   echo "<div class='container'>
                   <div class='row doctor'>
                       <div class='col-4'>
                           <div class='card' style='margin-top: 20px;'>
                               <div class='card_body'>
                                   <div class='information' style='padding: 0 10px'>
                                       <p class='text-center'><a href='../patient/chitietbacsi.php?id=".$row['id_bacsi']."'><img src='../img/".$row['hinhanh']."' width='200px' height='200px'></a></p>
                                       <p><span>Tên bác sĩ: </span>".$row['tenbacsi']." </p>
                                       <p><span>Chuyên khoa: </span><a href='../patient/chitietkhoa.php?id=".$id_khoa."' style='text-decoration:none; color: black;'>".$p->laycot("SELECT tenkhoa FROM khoa WHERE id_khoa=".$row['id_khoa']."")."</p>
                                       <p><span>Giới tính: </span>".$row['gioitinh']."</p>
                                       <p><span>Số điện thoại: </span>".$row['sdt']."</p>
                                       <p><span>Địa chỉ: </span>".$row['diachi']."</p>
                                   </div>
                                   <div class='row' style='margin: 5px 5px'>
                                       <div class='col-3'>
                                           <a href='datlich.php' button class='btn btn-outline-secondary mr-2'>Back</button></a>
                                       </div>
                                       <div class='col-9'>
                                           <form action='datlichbn3.php' method='POST'>
                                           <input type='hidden' name='bacsi' value=' ".$row['id_bacsi']."'/>
                                           <input type='hidden' name='trieuchung' value=' ".$_POST['trieuchung']."'/>
                                           <input type='hidden' name='benhnhan' value=' ".$id_benhnhan."'/>
                                               <div class=''><button class='btn btn-outline-success' type='submit' name='next' value='Select' style='float:right'>Select</button></div>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>";
               }
           }
        } 
    }
   
} 
?>
</body>

</html>