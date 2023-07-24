<?php
session_start();
ob_start();
if (isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['id_user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen']) == 2) {
    include('../class/config.php');
    $q = new connect();
    $q->confirm_login($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen'], $_SESSION['id_user']);
} else {
    header('location:../login.php');
}

include("../class/clsdoctor.php");
$p = new doctor();
include_once "../mail/lichban.php";
$h = new Mailer();
$layid = $_SESSION['id_user'];
$layidpk = 0;
if (isset($_REQUEST['id'])) {
    $layidpk = $_REQUEST['id'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./../tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#txtnoidung',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
    </script>
    <style>
        nav {
            line-height: 45px;
            background-color: #eeeeee;
            height: 100%;
            width: 23%;
            float: left;
            padding: 5px;


        }

        section {
            width: 76%;
            float: left;
            padding: 10px;

        }

        footer {
            clear: both;
            position: sticky;

        }

        nav ul {
            margin-bottom: 10px;
            padding-right: 30px;
        }

        nav ul li {
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

        table,
        tr {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        table {
            border-collapse: collapse;
            text-align: center;

        }

        th,
        td {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        td>a {
            text-decoration: none;
            color: black;
        }

        td>a:hover {
            color: green;
        }

        tr:hover {
            background-color: #d2d2ff;
            cursor: pointer;
        }

        input {
            border: none;
            width: 250px;
        }
    </style>

</head>

<body>
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>
    <nav>
        <ul>
            <li><a href="XemThongTinCaNhan.php"><i class="fa fa-bars"></i>&emsp;Xem thông tin cá nhân</a></li>
            <li><a href="XemLich.php"><i class="fa fa-calendar-week"></i>&emsp;Xem lịch khám</a></li>
            <li><a href="chidinhxn.php"><i class="fa fa-user"></i>&emsp;Nhận xét nghiệm</a></li>
            <li><a href="QuanLyBenhAn.php"><i class="fa fa-user"></i>&emsp;Quản lý bệnh án bệnh nhân</a></li>
            <li><a href="updateaccount.php"><i class="fa fa-user"></i>&emsp;Cập nhật tài khoản</a></li>
        </ul>


    </nav>
    <section>
        <?php
            $sql = "SELECT * FROM phieudkkham WHERE id_phieudk='$layidpk'";
            $ketqua = mysqli_query($p->connect(),$sql);
            $row = mysqli_fetch_array($ketqua);
        ?>
        <div class="xemlich">
            <div class="row">

                <div class="col-md-12">
                    <div style="float:left; ">
                        <h3 style="text-align: center;font-weight: bold;">Gửi mail báo bận đến cho bệnh nhân</h3>
                        <form action="" method="POST">
                            <input type="hidden" name="bacsi" value="<?php echo $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi='".$row['id_bacsi']."'")  ?>"> <br>
                            <label for=""><b>Bệnh nhân:</b></label>
                            <input type="text" name="ten" value="<?php echo $p->laycot("SELECT tenbenhnhan FROM benhnhan WHERE id_benhnhan='".$row['id_benhnhan']."'")  ?>"> <br>
                            <label for=""><b>Email bệnh nhân:</b></label>
                            <input type="text" name="email" value="<?php echo $p->laycot("SELECT email FROM taikhoan WHERE id_user='".$row['id_benhnhan']."'") ?>"> <br>
                            <label for=""><b>Ngày hẹn</b></label>
                            <input type="text" name="ngayhen" value="<?php echo $p->laycot("SELECT ngayhen FROM phieudkkham WHERE id_phieudk='$layidpk'")  ?>"> <br>
                            <a href="XemLich.php"  class="btn btn-outline-success">Thoát</a>
                            <button  class="btn btn-success" name="nut"> Xác nhận</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

<?php
    if(isset($_POST['nut']))
    {
        $bacsi = $_REQUEST['bacsi'];
        $title = "Thông báo lịch khám hủy của bác sĩ " .$bacsi. " tại Bệnh viện Tim Tâm Đức thành công.";
        $addressMail = $_POST['email'];
        $benhnhan = $_REQUEST['ten'];
        $ngayhen = $_REQUEST['ngayhen'];
        $content = "Xin chào " .$benhnhan. "Tôi là " .$bacsi."! Vào ca " .$ngayhen. " tôi bận việc nên thông báo đến bạn là lịch hẹn khám bị hủy. Bạn vui lòng đặt lại lịch khám vào thời gian khác giúp tôi. Tôi xin lỗi về sự bất tiện này!!";
        $h->sendmail($title, $content, $addressMail);
        
        
       $p->themxoasua("DELETE FROM phieudkkham WHERE id_phieudk='$layidpk'");
        
            header("location: XemLich.php");
       
    }
    // else
    // {
    //     $p->themxoasua("DELETE FROM phieudkkham WHERE id_phieudk='$layidpk'");
    //     header("location: XemLich.php");
    // }
?>

    </section>
    <!-- Back to top -->
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up"></i></button>
    <style>
        #myBtn {
            width: 50px;
            height: 50px;
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: green;
            color: white;
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
        }

        #myBtn:hover {
            background-color: #555;
        }
    </style>
    <script>
        // Get the button
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <footer>
        <?php include("footer.php"); ?>
    </footer>

</body>

</html>