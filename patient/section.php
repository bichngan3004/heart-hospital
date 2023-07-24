<?php
include("../class/config.php");
$p = new connect();
include("../class/patient.php");
$h = new patient();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        .content-section {
            display: flex;
            justify-content: space-between;
            width: 1200px;
            margin-top: 30px;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
        }

        .content-section-column {
            width: 400px;
            margin: 0 1px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .image img {
            max-width: 100%;
            max-height: 100%;
            width: 100px;
            height: 100px;
            margin: 5px 150px;
        }

        .content-title h5 {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #009933;
            font-family: Verdana, Geneva, Tahoma;
        }

        .content-comment {
            font-size: 18px;
            padding: 0 15px;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
            color: #777777;
            padding-bottom: 30px;
        }

        .introduce {
            width: 1200px;
            margin: 0 auto;
            display: flex;
            margin-top: 50px;
        }

        .introduce-img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }

        .introduce-noidung {
            width: 600px;
            padding-left: 30px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana;
        }

        .introduce-noidung span {
            font-size: 30px;
        }

        .introduce-noidung h4 {
            font-size: 45px;
        }

        .introduce-noidung p {
            font-size: 18px;
            line-height: 30px;
        }

        .khoas {
            width: 1200px;
            margin: 0 auto;
            margin-top: 30px;
            margin-bottom: 20px;
            height: 630px;
            /* border: 1px solid black; */
        }

        .khoas h2 {
            text-align: center;
            color: #009933;
            font-weight: bold;

        }

        .list-khoa {
            display: flex;
            justify-content: center;
            margin: 0;
            height: 500px;
            width: 1200px;
        }

        .khoa {
            /* margin: 10px 5px;
            width: 300px;
            text-align: center;
             border: 1px solid black; */
        }

        /* .khoa img {
            max-width: 100%;
            max-height: 100%;
            width: 70%;
            height: 70%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        } */

        .khoa .title-khoa {
            font-size: 18px;
        }

        .list-khoa a {
            color:#009933;
            font-weight: 600;
            text-decoration: none;
        }

        .list-khoa a:hover {
            color: #00661a;
            text-decoration: none;
            font-weight: 700;

        }

        .khoa {
            float: left;
            height: 200px;
            width: 250px;

            /* margin-top: 55px;*/
            margin-left: 40px;
            margin: 20px;
        }

        .bacsi {
            float: left;
            height: 200px;
            width: 250px;

            /* margin-top: 55px;
            margin-left: 40px; */
            margin: 40px 20px;
        }

        .bacsi_ten,
        .khoa_ten {
            float: left;
            height: 20px;
            margin-left: 10px;
            width: 250px;
            font-weight: bold;
            color: #009933;
            text-align: center;
            font-size: 15px;
            padding-top: 10px;
        }
        .khoa_hinh img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }

        .bacsi_hinh img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }

        .bacsi_ten a,
        .khoa_ten a {
            color: #009933;
        }

        .bacsi_ten a:hover,
        .khoa_ten a:hover {
            color: #00661a;
        }

        .doctors {
            width: 1200px;
            margin: 100 auto;
            margin-top: 20px;
            height: 700px;
            /* border: 1px solid black; */
            margin-left: auto;
            margin-right: auto;
        }

        .doctors h2 {
            text-align: center;
            color: #009933;
            font-weight: bold;

        }

        .list-doctor {
            display: flex;
            justify-content: center;
        }

        .doctor {
            margin: 10px 5px;
            width: 300px;
            text-align: center;

        }

        
        .list-doctor a {
            color: #009933;
            font-weight: 500;
            text-decoration: none;
        }

        .list-doctor a:hover {
            color: blue;
            text-decoration: none;
            font-weight: 700;
        }

        .note-details a:hover {
            font-weight: 600;
        }

        .resourcebundle_locales {
            padding-top: 50px;
        }

        .xemkhoa {
            margin-top: 55px;
            margin-left: 460px;
            width: 250px;
            height: 40px;
            border: 1px solid #00bb00;
            background-color: white;
            border-radius: 20px;
        }

        .xemkhoa a {
            color: #00bb00;
        }

       
        button:hover {
            background-color: #009933;

        }

        button:hover a {
            color: white;
        }
        .tt{
            text-decoration: none;
            color: black;
            margin: 20px 10px;
        }
        .tt:hover{
            color: #00661a;
        }
        .tt>img:hover
    {
        box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }
        .news {
            display: flex;
            width: 1200px;
            /* height: 600px; */
            /* border: 1px solid black; */
            margin-top: 20px;
            /* float: left; */
        }

      
        .tintuc {
        width: 260px;
        margin: 20px 5px;
        float: left;
        display:flex;
    }
        .title {
            font-weight: 600;
            /* border: 1px solid black; */
            height: 20px;
            /* float: left; */
            margin-left: 20px;
        }

        .mota {
            text-align: justify;
        }

        .ngaydang-tt {
            font-size: small;
            font-weight: lighter;
            /* margin-top: 150px; */
            margin-left: 180px;
        }
    </style>
    <script>
        var image = document.getElementById("aaa");
        var img_array = ["../img/banner/banner0.jpg","../img/banner/banner1.png", "../img/banner/banner-dkikhambenh.png", "../img/banner/banner7.png", "../img/banner/banner8.png", "../img/banner/banner5.gif"];
        var index = 0;

        function slide() {
            image.setAttribute("src", img_array[index]);
            index++;
            if (index >= img_array.length) {
                index = 0;
            }
        }
        setInterval("slide()", 4000);
    </script>
</head>

<body>
    <div class="banner" style=" height: 100%; width: 100%;">
        <img id="aaa" style="width:100%; height: 80%" src="../img/banner/banner0.jpg" />
    </div>
    <div class="content-section">
        <div class=" content-section-column">
            <div class="image">
                <img src="../img/cnvtt.png" alt="">
            </div>
            <div class="content-title">
                <h5>CHUYÊN MÔN & KINH NGHIỆM</h5>
            </div>
            <div class="content-comment">
                Với hơn 15 năm kinh nghiệm, Bệnh viện Tim Tâm Đức ngày nay đã trở thành một bệnh viện chuyên khoa tim kỹ thuật cao.
                Bệnh viện phẫu thuật được tất cả các bệnh lý ngoại khoa tim mạch bao gồm phẫu thuật tim bẩm sinh, bệnh van tim, bệnh mạch vành
                và các loại mạch máu ngoại biên. Và điều trị tất cả các rối loạn nhịp tim bằng các phương pháp hiện đại bao gồm khảo sát, cắt
                đốt điện sinh lý tim, đặt máy phá rung các loại...
            </div>
        </div>
        <div class="content-section-column">
            <div class="image">
                <img src="../img/dnbs.png" alt="">
            </div>
            <div class="content-title">
                <h5>ĐỘI NGŨ TẬN TÂM</h5>
            </div>
            <div class="content-comment">
                Với qui mô 250 giường, 100 bác sĩ, 300 điều dưỡng và kỹ thuật viên, Bệnh viện Tim Tâm Đức trở thành niềm tin và hy vọng
                của những người mắc bệnh tim cần phẫu thuật để được sống, cần thông tim can thiệp kịp thời, điều trị loạn nhịp tiên tiến
                hoặc điều trị nội khoa hiệu quả.
            </div>
        </div>
        <div class=" content-section-column">
            <div class="image">
                <img src="../img/qtdd.png" alt="">
            </div>
            <div class="content-title">
                <h5>NIỀM TIN VÀ CHẤT LƯỢNG</h5>
            </div>
            <div class="content-comment">
                Chất lượng phục vụ tốt luôn là nền móng của niềm tin! Với phương châm Chất lượng Thế giới vì Trái tim Việt Nam, Bệnh viện
                Tim Tâm Đức không ngừng nỗ lực áp dụng những kỹ thuật tiên tiến trong y khoa nhằm đảm bảo chất lượng điều trị cao nhất, hiệu
                quả an toàn người bệnh cũng như hài lòng người bệnh tối ưu, đem lại chất lượng cuộc sống cho người bệnh tim.
            </div>
        </div>
    </div>
    <div id="introduces" class="introduce">
        <a href="">
            <div class="introduce-img" style="margin-top: 25px;">
               <a href="history.php"> <img src="../img/1.jpg" alt="" width="600px" height="450px"></a>
            </div>
        </a>
        <div class="introduce-noidung">
            <span>Chào mừng đến với</span>
            <h4 style="color: #009933">Bệnh viện Tim Tâm Đức</h4>
            <p>Qua 13 năm hoạt động, Bệnh viện Tim Tâm Đức – Bệnh viện chuyên khoa tim mạch kỹ thuật cao – đã tổ chức khám, điều trị ngoại trú
                và phẫu thuật với tỷ lệ thành công trên 98%. Đặc biệt số ca phẫu thuật tim cho bệnh nhi có hoàn cảnh khó khăn được các tổ chức, cá
                nhân thiện nguyện đóng thay chi phí là 60%. Trong đó có các cháu thuộc tỉnh An Giang, Đồng Tháp, Bạc Liêu, Sóc Trăng, Cà Mau, Sóc Trăng,
                Vĩnh Long, Tiền Giang, Long An, Bến Tre, Đồng Nai, Bình Phước, TPHCM, Lâm Đồng, Đak Lak, Bình Thuận, Kiên Giang, Bình Phước…</p>
            <p>Bệnh viện Tim Tâm Đức đã cùng các nhà tài trợ, các tổ chức, các cá nhân thiện nguyên khắp mọi nơi giúp cho các cháu về: chi phí khám,
                khám sàng lọc tim ban đầu; chi phí phẫu thuật; chi phí trong lúc nằm viện điều trị; chi phí giường bệnh và một số chi phí đặt biệt khác.</p>
        </div>

    </div>

    <div id="khoas" class="khoas">
        <h2>CHUYÊN KHOA ĐIỀU TRỊ</h2>

        <?php $p->showkhoa_bn("SELECT * FROM khoa order by id_khoa asc limit 8") ?>
        <button class=" xemkhoa"><a href="khoa.php" style="text-decoration:none; ">Xem thêm</a></button>
    </div>

    <div id="doctors" class="doctors">
        <h2 class="text-center">ĐỘI NGŨ BÁC SĨ</h2>

        <?php $p->showbacsi_bn("SELECT * FROM bacsi ORDER BY tenbacsi asc limit 8") ?>
        <button class=" xemkhoa"><a href="dnbacsi.php" style="text-decoration:none; ">Xem thêm</a></button>

    </div>
    <div class="rule">

        <div class="container" id="contact">
            <div class="row">
                <div class="col-lg-12" style="margin-top: 20px;margin-bottom:50px">
                    <div class="contact text-center">
                        <h2 class="contact-title" style="font-weight:bold; color:#009933">QUY ĐỊNH VÀ TIN TỨC</h2>
                    </div>
                </div>
            </div>

            <div class="row mt--20">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="note">
                        <div class="note-details">
                            <br>
                            <h6><a href="dlhen.php" style="color:#009933; text-decoration:none; font-size: large;"><b>🚑 QUY ĐỊNH ĐẶT LỊCH HẸN</b></a></h6>
                            <h6><a href="chuanbi.php" style="color:#009933; text-decoration:none; font-size: large;"><b>🏥 CHUẨN BỊ GÌ KHI ĐẾN KHÁM</b></a></h6>
                            <h6><a href="huongdan.php" style="color:#009933; text-decoration:none; font-size: large;"><b>🕛 HƯỚNG DẪN KHÁM BỆNH</b></a></h6>
                        </div>
                        <video width="320" height="240" controls>
                            <source src="../img/lichsuTD.mp4" type="video/mp4">
                        </video>
                        <video width="320" height="240" controls>
                            <source src="../img/dinhduong.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 row">
                    <div class="lh-email">
                    <?php $h->loadlistnewsdetailsecpa("SELECT * FROM tintuc order by id_tintuc desc limit 3") ?>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>