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
                <h2>Chuẩn bị gì khi đến khám</h2>
                <p><strong>Trước khi đến khám</strong></p>
                <p>Để đạt được hiệu quả tốt nhất, bạn và gia đình nên chuẩn bị những giấy tờ, thông tin sau:</p>
                <p style="padding-left: 20px;">- Hồ sơ bệnh án và các giấy tờ liên quan đến tình trạng sức khỏe của bạn:</p>
                <p style="padding-left: 30px;">
                    + Bản sao của kết quả xét nghiệm, phim X- quang, bệnh án trước đây <br>
                    + Tên các loại thuốc đang sử dụng thường xuyên, bao gồm cả thuốc không kê đơn và thảo dược.
                </p>
                <p style="padding-left: 20px;">- Kiểm tra lại các yêu cầu của Bác sĩ trong lần khám trước về 
                chế độ ăn (Ví dụ: nhịn ăn sáng khi tái khám, …) cũng như các loại thuốc cần ngưng trước khi đến khám.</p>
                <p style="padding-left: 20px;">- Bạn có thể đi cùng người thân hoặc bạn bè nếu cần. Trong một số trường hợp đặc biệt, bạn nên có người đi cùng để giúp đưa bạn về nhà an toàn.</p>
                <p style="padding-left: 20px;">- Mang theo áo khoác hoặc áo lạnh. Ở Bệnh viện Tim Tâm Đức, một số thiết bị y tế cần được bảo quản ở nhiệt độ thích hợp, điều này có thể làm bạn cảm thấy lạnh khi đi vào các khu vực này.</p>
                <p style="padding-left: 20px;">- Đối với trẻ em, đặc biệt là trẻ nhỏ, bé đôi khi cần cả một ngày để hoàn tất việc khám (vì bệnh phức tạp cần chẩn đoán chính xác để điều trị). Do đó, gia đình nên chuẩn bị đầy đủ sữa, tả, quần áo và kể cả đồ chơi cho các cháu.</p>

                <p><strong>Trong khi khám</strong></p>
                <p style="padding-left: 20px;">- Để buổi khám đạt được hiệu quả cao nhất, hãy trình bày rõ ràng các lo lắng về bệnh tình của bạn và chúng tôi khuyến khích bạn đặt câu hỏi cho bác sĩ.</p>
                <p><strong>Sau khi khám</strong></p>
                <p style="padding-left: 20px;">- Bạn sẽ được nhận toàn bộ hồ sơ buổi khám (bao gồm bệnh án, các kết quả cận lâm sàng và toa thuốc)</p>
                <p style="padding-left: 20px;">- Đặt lịch hẹn tái khám. Nếu bạn muốn thay đổi lịch tái khám, hãy liên lạc qua số điện thoại (028) 54110026 hoặc qua website.</p>
            </div>
        </div>
    </div>
    <?php
        include("footer.php");

?>
</body>

</html>