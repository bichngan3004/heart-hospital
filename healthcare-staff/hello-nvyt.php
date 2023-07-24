
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
    <style>
        nav {
        line-height:30px;
        background-color: #eeeeee;
        height: 300px;
        width:auto;
        float:left;
        padding:5px;
        }
        section {
        width:auto;
        float:left;
        padding:10px;
        }
        footer {
        clear:both;
        }
        nav ul {
            padding-right: 30px;
        }

        nav ul li {
            padding: 10px 0px;
            border-bottom: 1px solid #cdcdcd;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
        }

        nav ul {
            list-style: none;
        }

        nav ul li a:hover {
            font-weight: 700;
        }
        </style>
</head>
<body>
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>
    <nav>
        <ul>
            <li><a href="XemThongTinCaNhan.php"><i class="fa fa-user-nurse"></i>&emsp;Xem thông tin cá nhân</a></li>
            <li><a href="datlichbn.php"><i class="fa fa-user-pen"></i>&emsp;Đặt lịch khám</a></li>
            <li><a href="QuanLyBenhNhan.php"><i class="fa fa-address-book"></i>&emsp;Quản lý bệnh nhân</a></li>
            <li><a href="QuanLyTinTuc.php"><i class="fa fa-newspaper"></i>&emsp;Quản lý tin tức</a></li>
            <li><a href="BenhNhanDangKy.php"><i class="fa fa-bell"></i>&emsp;Điều phối bệnh nhân đăng ký</a></li>
        </ul>
    </nav>
    <section>
        <h3 style="text-align: left;font-weight: bold;">Hello Nhân viên y tế!</h3> 
        <h3 style="text-align: left;font-weight: bold;">Chào mừng đến trang quản lý!!!</h3> 
    </section>
     
    <footer>
    <?php include("footer.php");?>
    </footer>
     
    </body>
    </html>
