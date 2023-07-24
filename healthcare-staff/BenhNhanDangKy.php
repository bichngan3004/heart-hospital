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
$layid_pdk = 0;
if (isset($_REQUEST['id_pdk'])) {
    $layid_pdk = $_REQUEST['id_pdk'];
}
$layid_pdkkham = 0;
if (isset($_REQUEST['id_pdkham'])) {
    $layid_pdkkham = $_REQUEST['id_pdkham'];
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;

        }

        tr:hover {
            background-color: #d2d2ff;
            /* color: white; */
            cursor: pointer;
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
        <div class="information">
            <div class="container" style="width:100%; margin-left:15px;">
                <h3 style="text-align: center;font-weight: bold">DANH SÁCH BỆNH NHÂN ĐĂNG KÝ KHÁM</h3>
                <?php //$p->loadlistphieudki("SELECT * FROM phieudkkham order by id_phieudk asc"); 
                ?>
                <?php
                $sql = "SELECT * FROM phieudkkham";
                $ketqua = mysqli_query($p->connect(), $sql);
                
                ?>
                <table class="table table-bordered">
                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                        <th>STT</th>
                        <th scope="col">BỆNH NHÂN</th>
                        <th>TRIỆU CHỨNG</th>
                        <th>NGÀY HẸN KHÁM</th>
                        <th>GIỜ HẸN KHÁM</th>
                        <th>BÁC SĨ HẸN</th>
                        <th></th>
                    </tr>
                    <?php
                    $dem = 1;
                    while ($row = mysqli_fetch_array($ketqua)) {
                        $id_phieudk = $row['id_phieudk'];
                        $id_benhnhan = $row['id_benhnhan'];
                        $trieuchung = $row['trieuchung'];
                        $ngayhen = $row['ngayhen'];
                        $id_bacsi = $row['id_bacsi'];
                        $array_ngayhen = explode('_', $row['ngayhen']);

                    ?>
                        <tr>
                            <td><?php echo $dem; ?></td>
                            <td><?php echo $p->laycot("SELECT tenbenhnhan FROM benhnhan WHERE id_benhnhan = '" . $id_benhnhan . "'")   ?></td>
                            <td><?php echo $trieuchung;  ?></td>
                            <td><?php echo date('j-m-Y', strtotime($array_ngayhen[1])) ?></td>
                            <td><?php
                                if ($array_ngayhen[0] == 1) :
                                    echo "7:00 - 9:00";
                                elseif ($array_ngayhen[0] == 2) :
                                    echo "9:00 - 11:00";
                                elseif ($array_ngayhen[0] == 3) :
                                    echo "13:00 - 15:00";
                                else :
                                    echo "15:00 - 17:00";
                                endif; ?></td>
                            <td><?php echo $p->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi ='" . $id_bacsi . "'") ?></td>
                            <td><a class="btn btn-danger" href="?id_pdk=<?php echo $id_phieudk; ?>">Xóa</a>
                                <a href="dieuphoi.php?id_pdk=<?php echo $id_phieudk; ?>" class="update btn btn-success">
                                    Điều phối
                                </a>
                            </td>
                        </tr>
                    <?php
                        $dem++;
                    }
                    ?>
                </table>

            </div>
        </div>
    </section>

    <?php
    if (isset($_REQUEST['id_pdk'])) {
        $layid = $_REQUEST['id_pdk'];
        if ($p->themxoasua("DELETE FROM phieudkkham WHERE id_phieudk = " . $layid . "") == 1) {
            echo '<script>alert("Xóa thành công!")</script>';
            header("refresh:1;url=BenhNhanDangKy.php");
        } else {
            echo '<script>alert("Xóa lịch không thành công!")</script>';
        }
    }

    
    ?>


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
        $(document).ready(function() {
            // $('#modal_update').click(function(e){
            //     e.preventDefault();
            //     //var id_row = $(this).closest('tr').find('.id_row').text();
            //     var id_row = $(this).data('')
            //     console.log(id_row);
            // })
            $(document).on('click', ".update"),
                function(e) {
                    var formData = new FormData(this);
                    formData.append("update_student", true);
                    $.ajax({
                        type: "GET",
                        url: 'BenhNhanDangKy.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response){
                            var res = jQuery.parseJSON(response);

                        }

                    })
                }
        })
    </script>



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