<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #menu{
            height: 80px;
            /* width: 1360px; */
            font-size: 18px;
            font-weight: bold;
            background-color: #00661a;
            margin: 0;
            padding: 0;
        }
        #menu-list ul{
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
        }
        #menu-list ul li{
            padding: 30px ;
            line-height: 25px;
        }
        #menu-list ul li a{
            color: white;
            transition: all 0.5s ease-out;
            text-decoration: none;
        }
        #menu-list ul li a:hover{
            color: aqua;
            text-decoration: none; 
            font-weight: 900;
        }
        .title-name h3{
            color: white;
            line-height: 25px;
            padding: 30px ;
            padding-left: 200px;
        }
        .welcome{
            color: white;
            line-height: 25px;
            padding: 30px ;
        }
       .actor img{
       margin-left: 200px;
       }
    </style>
</head>
<body>
    <div class="row" id="menu" >
        <div class="col-4 title-name" id="menu-list">
            <!-- <ul style="margin: 0px;">
                <li><a href="index.php">TRANG CHỦ</a></li>
                <li><a href="#introduces">GIỚI THIỆU</a></li>
                <li><a href="dnbacsi.php">ĐỘI NGŨ BÁC SĨ</a></li>
                <li><a href="#khoas">CHUYÊN KHOA</a></li>
                <li><a href="../tintuc.php ">TIN TỨC</a></li>
            </ul> -->
            <!-- <h3>BVTimTamDuc</h3> -->
        </div>
        <div class="col-4">
            <p class="welcome"><marquee behavior="" direction="">Chào mừng bạn đến với trang quản lý!</marquee> </p>
        </div>
        <div class="col-4 actor"> 
           <img src="../img/icon/ad1-removebg-preview (2).png" alt="" width="100px" height="80px">
        </div>
    </div>
</body>
</html>