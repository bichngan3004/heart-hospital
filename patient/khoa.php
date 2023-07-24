<?php
include_once "../class/listds.php";
$p = new listds();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='img/icon/tittle.jpg' />
    <link rel='shortcut icon' href='../img/icon/tittle.jpg' />
    <title>Tam Duc Heart Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
    .doctor {
        /* margin-left: auto;
        margin-right: auto; */
        margin: 0px 200px;
        width: 1300px;
        height: 1820px;
        /* border: 1px solid black;  */

    }

    .khoa {
        float: left;
        height: 300px;
        width: 380px;
        /* border: 1px solid black; */
        /* margin-top: 55px;*/
        margin-left: 10px;
        /* margin: 10px 20px; */

    }

    .khoa_hinh {
        /* margin: 15px; */

    }

    .khoa_hinh img {
        border-radius: 10px;
    }

    .bacsi img {
        border-radius: 50%;
        margin-left: 25px;
    }

    .bacsi {
        float: left;
        height: 200px;
        width: 300px;
        margin: 40px 50px;
        margin-bottom: 200px;
    }

    .bacsi_ten,
    .khoa_ten {
        float: left;
        height: 20px;
        width: 300px;
        font-weight: bold;
        color: #FC0;
        padding-left: 10px;
        text-align: center;
        font-size: 15px;
        padding-top: 5px;
    }

    .bacsi_ten a,
    .khoa_ten a {
        color: #00bb00;

    }

    .bacsi_ten a:hover,
    .khoa_ten a:hover {
        color: #00661a;
    }

    .bacsi_mota {
        margin-top: 30px;
        float: left;
        width: 400px;
        text-align: center;
        padding-right: 50px;
    }
    .khoa_hinh img:hover{
        box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }
</style>

<body>
    <?php
    include_once "header.php";
    include_once "menu.php";
    ?>
    <div class="doctor">
        <h2 class="" style="margin-top: 20px;padding-left:450px">CHUYÊN KHOA</h2>
        <?php
        $p->showdetailskhoa("SELECT * FROM khoa ORDER BY id_khoa asc");
        ?>
    </div>
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
        <?php include_once "footer.php"; ?>
    </footer>
</body>

</html>