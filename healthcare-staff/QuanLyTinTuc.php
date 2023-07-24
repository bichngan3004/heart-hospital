<?php
session_start();
ob_start();
if (isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['id_user']) && isset($_SESSION['pass']) && isset($_SESSION['phanquyen']) == 3) {
    include('../class/config.php');
    $q = new connect();
    $q->confirm_login($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen'], $_SESSION['id_user']);
} else {
    header('location:../login.php');
}

include("../class/clsadmin.php");
$p = new admin();
$layid = 0;
if (isset($_REQUEST['id'])) {
    $layid = $_REQUEST['id'];
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
    <style>
        nav {
            line-height: 45px;
            background-color: #eeeeee;
            height: 100%;
            width: 21%;
            float: left;
            padding: 5px;

        }

        section {
            width: 77%;
            float: left;
            padding: 10px;
        }

        footer {
            clear: both;
        }

        nav ul {
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
            width: 100%;
            text-align: center;
        }

        th,
        td {
            vertical-align: top;
            /* text-align:left; */
            padding: 10px;
            border-bottom: 1px solid #ccc;

        }

        td>a {
            text-decoration: none;
            color: black;
        }

        td>a:hover {
            color: #00a600;
        }

        tr:hover {
            background-color: #d2d2ff;
            cursor: pointer;
        }
    </style>

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
        <div class="col-md-6" style="margin-left: 35px; width:95%">
            <form method="post" action="" enctype="multipart/form-data" id="form8" name="form8">
                <h3 style="text-align: center;font-weight: bold">QUẢN LÝ TIN TỨC</h3>
                <table class="pt-5" style="border-left:1px solid #ccc; border-right:1px solid #ccc;" cellpadding="5" cellspacing="0">
                    <tr>
                        <td><label for="tieude"><b>Tiêu đề:</b></label></td>
                        <td style="text-align:left"><input style="border: 2px ridge #efefef; border-radius:5px" type="text" name="txttieude" id="txttieude" value="<?php echo $p->laycot("select tieude from tintuc where id_tintuc='$layid'"); ?>" />
                            <label for="tin"></label>
                            <input type="hidden" name="txtid" id="txtid" value="<?php echo $layid ?>" />
                        </td>

                        <td><label for="textfield2"><b>Tác giả: </b></label></td>
                        <td style="text-align:left"><input style="border: 2px ridge #efefef; border-radius:5px" type="text" name="txttacgia" id="txttacgia" value="<?php echo $p->laycot("select tacgia from tintuc where id_tintuc='$layid'"); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td><b>Mô tả: </b></td>
                        <td colspan="2" style="vertical-align: top; text-align: left">
                            <label for="textarea"></label>
                            <textarea name="txtmota" id="txtmota" style="border: 2px ridge #efefef; border-radius:5px" cols="50" rows="3">
                                <?php echo $p->laycot("select mota from tintuc where id_tintuc='$layid'"); ?>
                            </textarea>
                        </td>

                    </tr>
                    <tr>
                        <td><b>Nội dung: </b></td>
                        <td colspan="3">
                            <label for="textarea"></label>
                            <textarea name="txtnoidung" id="txtnoidung">
                                <?php echo $p->laycot("select noidung from tintuc where id_tintuc='$layid'"); ?>
                            </textarea>
                        </td>

                    </tr>
                    <tr>
                        <td><b>Hình: </b></td>
                        <td colspan="3" style="text-align:left">
                            <label for="fileField"></label>
                            <input type="file" name="myfile" id="myfile" value="<?php echo $p->laycot("select hinhanh from tintuc where id_tintuc='$layid'"); ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" style="position:relative;text-align:center;">
                            <input type="submit" style=" background-color: green; border-color:#7dff7d" name="them" id="button" class="btn btn-primary" value="Đăng">
                            <input type="submit" style=" background-color: green; border-color:#7dff7d" name="update" id="nut" class="btn btn-primary" value="Cập nhật" />
                            <input type="submit" name="xoa" id="nut" class="btn btn-danger" value="Xóa" />
                        </td>
                    </tr>
                </table>
                <br> <br>
                <div class="information">
                    <div class="container" style="width:100%;">
                        <h3 style="text-align: center;font-weight: bold">DANH SÁCH TIN TỨC</h3>
                       
                        <?php $p->loadlistnews("SELECT * FROM tintuc order by id_tintuc asc"); ?>
                    </div>
                </div>
        </div>
        </form>
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
    <?php
    //Thêm tin tức
    if (isset($_POST['them'])) {
        $tieude = $_REQUEST['txttieude'];
        $mota = $_REQUEST['txtmota'];
        $noidung = $_REQUEST['txtnoidung'];
        $tacgia = $_REQUEST['txttacgia'];
        $name = $_FILES['myfile']['name'];
        $tmp_name = $_FILES['myfile']['tmp_name'];
        $size = $_FILES['myfile']['size'];
        $type = $_FILES['myfile']['type'];
        // echo $tieude; echo $noidung; echo $tacgia; echo $name; exit();
        if ($name != '') {
            $name = time() . "_" . $name;
            if ($p->myupfile($name, $tmp_name, "../img/news/") == 1) {
                $sql = "INSERT INTO tintuc(tieude,mota,noidung,hinhanh,ngaydang,tacgia) VALUES ('$tieude', '$mota', '$noidung', '$name', current_timestamp(), '$tacgia')";
                if (mysqli_query($p->connect(), $sql) == true) {
                    header("location:QuanLyTinTuc.php");
                } else {
                    echo "<script>alert('Thêm tin tức không thành công!')</script>";
                }
            } else {
                echo "<script>alert('Upload hình không thành công')</script>";
            }
        } else {
            echo "<script>alert('Vui lòng chọn hình!')</script>";
        }
    }
    //Cập nhật tin tức
    if (isset($_POST['update'])) {
        $idsua = $_REQUEST['txtid'];
        $mota = $_REQUEST['txtmota'];
        $tieude = $_REQUEST['txttieude'];
        $noidung = $_REQUEST['txtnoidung'];
        $tacgia = $_REQUEST['txttacgia'];
        $name = $_FILES['myfile']['name'];
        $tmp_name = $_FILES['myfile']['tmp_name'];
        $size = $_FILES['myfile']['size'];
        $type = $_FILES['myfile']['type'];
        if ($idsua > 0) {
            if ($p->myupfile($name, $tmp_name, "../img/news/") == 1) {
                $sql = "UPDATE tintuc SET tieude = '$tieude', hinhanh = '$name', mota = '$mota', noidung = '$noidung', tacgia = '$tacgia' WHERE id_tintuc = '$idsua' limit 1";
                if (mysqli_query($p->connect(), $sql) == true) {
                    header("location:QuanLyTinTuc.php");
                } else {
                    echo "<script>alert('Cập nhật không thành công!')</script>";
                }
            } else {
                echo "<script>alert('Vui lòng chọn hình cập nhật!')</script>";
            }
        } else {
            echo "<script>alert('Vui lòng chọn tin tức cần sửa!')</script>";
        }
    }
    //Xóa tin tức
    if (isset($_POST['xoa'])) {
        $idxoa = $_REQUEST['txtid'];
        if ($idxoa > 0) {

            if ($p->themxoasua("DELETE FROM tintuc WHERE id_tintuc='$idxoa'") == 1) {
                header("location:QuanLyTinTuc.php");
            } else {
                echo '<script>alert("Xoá tin tức không thành công")</script>';
            }
        } else {
            echo '<script>alert("Vui lòng chọn tin tức cần xóa")</script>';
        }
    }


    ?>


</body>

</html>