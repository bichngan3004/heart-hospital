<?php
include("../class/patient.php");
$p = new patient();
include("../class/clsadmin.php");
$q = new admin();
include("header.php");
include("menu.php");


if (isset($_POST["nut"])) {
    $id_khoa = $_POST["id_khoa"];
    $_SESSION["trieuchung"] = $_POST["trieuchung"];
    //var_dump($_POST); exit();
    $sql = "SELECT * FROM bacsi WHERE id_khoa=" . $id_khoa . "";
    $ketqua = mysqli_query($p->connect(), $sql);
    $i = mysqli_num_rows($ketqua);
    if ($i > 0) {
        while ($row = mysqli_fetch_array($ketqua)) {
            echo "<div class='container'>
            <div class='row doctor'>
                <div class='col-4'>
                    <div class='card' style='margin-top: 20px;'>
                        <div class='card_body'>
                            <div class='information' style='padding: 0 10px'>
                               
                                <p class='text-center'> <a href='chitietbacsi.php?id=".$row['id_bacsi']."'><img src='../img/".$row['hinhanh']."' width='200px' height='200px' ></a></p>
                                <p><span>Tên bác sĩ: </span>".$row['tenbacsi']." </p>
                                <p><span>Chuyên khoa: </span><a href='chitietkhoa.php?id=".$id_khoa."' style='text-decoration:none; color: black;'>".$p->laycot("SELECT tenkhoa FROM khoa WHERE id_khoa=".$row['id_khoa']."")."</a></p>
                                <p><span>Giới tính: </span>".$row['gioitinh']."</p>
                                <p><span>Số điện thoại: </span>".$row['sdt']."</p>
                                <p><span>Địa chỉ: </span>".$row['diachi']."</p>
                            </div>
                            <div class='row' style='margin: 5px 5px'>
                                <div class='col-3'>
                                    <a href='datlich.php' button class='btn btn-outline-secondary mr-2'>Back</button></a>
                                </div>
                                <div class='col-9'>
                                    <form action='datlich3.php' method='POST'>
                                    <input type='hidden' name='bacsi' value=' ".$row['id_bacsi']."'/>
                                    <input type='hidden' name='trieuchung' value=' ".$_POST['trieuchung']."'/>
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
 <!--Modal nút XEM thông tin-->
 <div class="modal" id="xem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">THÔNG TIN BÁC SĨ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                   
                    <?php $q->loadinfodoctor("SELECT * FROM bacsi order by id_bacsi asc"); ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>