<?php
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
    <link rel='shortcut icon' href='img/icon/tittle.jpg' />
    <title>Tam Duc Heart Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<style>
    .information-bacsi {
        margin: 20px 300px;
        display: flex;
    }

    .information-detail {
        margin-left: 30px;
    }
    .information-details{
        margin: 0px 300px;
    }
    .bookcalendar
    {
        width: 150px;
        height: 40px;
        margin-left: 370px;
        margin-bottom: 10px;
        border: 1px solid #00bb00; 
        background-color: white;
        border-radius: 15px;
    }
    .bookcalendar a
    {
        text-decoration: none;
        color: #00bb00;
    }
    .bookcalendar:hover{
        background-color: #009933;
    }
    .bookcalendar:hover a{
        color: white;
    }
</style>

<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>
    <div class="information-bacsi">
        <div class="image">
            <!-- <img src="./img/bs-TonThatMinh-GĐbv.jpg" alt=""> -->
            <?php $p->loadimgdoctor("SELECT * FROM bacsi ORDER BY id_bacsi asc") ?>
        </div>
     
        <div class="information-detail">
           <?php $p->loadinformationdetailsdoctor("SELECT * FROM bacsi ORDER BY id_bacsi asc") ?>
        </div>
    </div>
    <button class="bookcalendar"><a href="patient/datlich.php">Đặt lịch khám</a></button>
    <div class="information-details">
        <?php $p->loaddetailsdoctor("SELECT * FROM bacsi ORDER BY id_bacsi asc ") ?>
    </div>
    
    <?php
    include("footer.php");
    ?>
</body>

</html>