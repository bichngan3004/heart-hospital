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
        margin: 20px 50px ;
       
        display: flex;
    }

    .information-detail {
        margin-left: 30px;
        width: 1000px;
        /* border: 1px solid black; */
    }
    tr td a{
        text-decoration: none;
        color: black;
    }
   tr td{
    width: 300px;
   }
   tr td a:hover{
      
        color: #00661a;
        font-weight: bold;
    }
    tr:hover {
            background-color: #DDDDDD;
            cursor: pointer;
            
        }
      
</style>

<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>
    <div class="information-bacsi">
        <!-- <div class="image">
            <img src="./img/khoa/kiemsoatnhiemkhuan.jpg" alt="">
        </div> -->
        <div class="listkhoa">
            <?php $p->listkhoatable("SELECT * FROM khoa ORDER BY id_khoa ASC")  ?>
        </div>
        <div class="information-detail">
           <?php $p->showinformationdetailskhoa("SELECT * FROM khoa ORDER BY id_khoa ASC") ?>
        </div>
    </div>

    <?php
    include("footer.php");
    ?>
</body>

</html>