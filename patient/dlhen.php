<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
</head>
<style>
    .table{
        margin: 30px;
    }
    .details{
        margin: 30px;
    }
    tr td a{
        color: black;
        text-decoration: none;
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
    <div class="row" style="margin: 0px;">
        <div class="col-3">
            <div class="listqd">
                <!-- <ul>
                    <li><a href="">Đặt lịch hẹn</a></li>
                    <li><a href="">Chuẩn bị gì khi đến khám</a></li>
                    <li><a href="">Hướng dẫn khám bệnh</a></li>
                </ul> -->
                <table class="table table-bordered" >
                    <tr><td><a href="dlhen.php"> Đặt lịch hẹn</a></td>
                    </tr>
                    <tr><td><a href="chuanbi.php"> Chuẩn bị gì khi đến khám</a></td></tr>
                    <tr><td><a href="huongdan.php"> Hướng dẫn khám bệnh</a></td></tr>
                </table>
            </div>

        </div>
        <div class="col-9">
            
            <div class="details">
                <h2>Đặt lịch hẹn</h2>
                <p><strong> - Gói đặt lịch hẹn khám</strong></p>
                <p style="padding-left: 20px;">Bệnh nhân và gia đình có thể gọi đặt lịch hẹn trực tiếp qua số điện thoại 
                (028) 54110036 để khám bệnh theo yêu cầu như chọn Bác sĩ và thời gian phù hợp nhất.</p>
                <p><strong> - Đăng ký trực tuyến</strong></p>
                <p style="padding-left: 20px;">Bạn có thể đăng ký khám bệnh trực tuyến qua website bệnh viện Tim Tâm Đức</p>
                <p><strong> - Trường hợp cấp cứu</strong></p>
                <p style="padding-left: 20px;">Trong trường hợp khẩn cấp, bạn có thể đi trực tiếp tới cổng cấp cứu Bệnh viện hoặc gọi điện thoại số (028) 54110036 để liên hệ đội Cấp cứu Ngoại viện.</p>
            </div>
        </div>
    </div>
    <?php
        include("footer.php");

?>
</body>

</html>