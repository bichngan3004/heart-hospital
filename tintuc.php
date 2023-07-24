<?php
include("class/patient.php");
$p = new patient();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='shortcut icon' href='img/icon/tittle.jpg' />
    <title>Tam Duc Heart Hospital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
</head>
<style>
    /* * {
        box-sizing: border-box;
        margin: 0 auto;
    } */

    .container {
        display: flex;
        /* float: left; */
    }

    .list-tintuc {
        width: 100%;

    }

    .tintuc {
        width: 260px;
        margin: 20px 5px;
        float: left;
        /* display:flex; */
    }

    .title {
        font-weight: 600;
    }

    .mota {
        text-align: justify;
    }

    .ngaydang-tt {
        font-size: small;
        font-weight: lighter;
        margin-bottom: 10px;
    }

    .tt {
        text-decoration: none;
        color: black;
    }

    .tt:hover {
        color: #00bb00;
    }

    #history {
        display: block;
    }

    .history {
        width: 430px;
        margin: 20px 5px;
        float: left;
    }

    .his {
        text-decoration: none;
        color: black;
    }

    .his:hover {
        color: #00bb00;
    }

    .tt>img:hover,
    .his>img:hover {
        box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }

    .calendar-container {
        margin-top: 20px;
        background: #fff;
        width: 420px;
        border-radius: 10px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .calendar-container header {
        display: flex;
        align-items: center;
        padding: 25px 30px 10px;
        justify-content: space-between;
    }

    header .calendar-navigation {
        display: flex;
    }

    header .calendar-navigation span {
        height: 38px;
        width: 38px;
        margin: 0 1px;
        cursor: pointer;
        text-align: center;
        line-height: 38px;
        border-radius: 50%;
        user-select: none;
        color: #aeabab;
        font-size: 1.9rem;
    }

    .calendar-navigation span:last-child {
        margin-right: -10px;
    }

    header .calendar-navigation span:hover {
        background: #f2f2f2;
        color: #6332c5;
    }

    header .calendar-current-date {
        font-weight: 500;
        font-size: 1.45rem;
    }

    .calendar-body {
        padding: 20px;
    }

    .calendar-body ul {
        list-style: none;
        flex-wrap: wrap;
        display: flex;
        text-align: center;
    }

    .calendar-body .calendar-dates {
        margin-bottom: 20px;
    }

    .calendar-body li {
        width: calc(100% / 7);
        font-size: 1.07rem;
        color: #414141;
    }

    .calendar-body .calendar-weekdays li {
        cursor: default;
        font-weight: 500;
    }

    .calendar-body .calendar-dates li {
        margin-top: 30px;
        position: relative;
        z-index: 1;
        cursor: pointer;
    }

    .calendar-dates li.inactive {
        color: #aaa;
    }

    .calendar-dates li.active {
        color: #fff;
    }

    .calendar-dates li::before {
        position: absolute;
        content: "";
        z-index: -1;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }

    .calendar-dates li.active::before {
        background: #6332c5;
    }

    .calendar-dates li:not(.active):hover::before {
        background: #e4e1e1;
    }
    .note-details{
        width: 400px; 
        /* height: 200px; */
        /* border: 1px solid black; */
        margin-left: 20px;
    }
</style>

<body>
    <?php
    include("header.php");
    include("menu.php");
    ?>

    <div class="container">
        <div class="col-md-3" id="listnews">
            <div class="list-tintuc">
                <?php $p->loadlistnewsdetail("SELECT * FROM tintuc order by id_tintuc asc") ?>
            </div>
        </div>
        <div class="col-md-5" id="history">
            <div class="history">
                <a class="his" href="history.php">
                    <img src="./img/news/history1.jpg" alt="" width="430" height="320" />
                    <div class="title">LỊCH SỬ BỆNH VIỆN</div>
                    <div class="mota">
                        <p>Với những thành quả giúp đỡ cho bệnh nhân nghèo mổ tim, năm 2014,
                            Tâm Đức đã được đón nhận Huân chương Lao động hạng 3 của Chính phủ và nhiều bằng khen của các Hội
                            bảo trợ Bệnh nhân nghèo các tỉnh. Tâm Đức thực sự là niềm hy vọng cho những người bệnh nhân mắc bệnh tim cần được cứu sống ...</p>
                    </div>
                </a>
            </div>
            <br>

            <div class="note">
                <div class="note-details">
                    <h4 style="color:#00bb00;text-align:center;"><b>BẠN CẦN BIẾT </b></h4>
                    <?php $p->loadlistnoticedetail("SELECT * FROM notice order by id_notice asc") ?>
                </div>
            </div>

        </div>
        <div class="col-md-4" id="showcalendar">
            <div class="calendar-container">
                <header class="calendar-header">
                    <p class="calendar-current-date" style="color:#6332c5"></p>
                    <div class="calendar-navigation">
                        <span id="calendar-prev" class="material-symbols-rounded">chevron_left</span>
                        <span id="calendar-next" class="material-symbols-rounded">chevron_right</span>
                    </div>
                </header>

                <div class="calendar-body">
                    <ul class="calendar-weekdays">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                    </ul>
                    <ul class="calendar-dates"></ul>
                </div>
            </div>
        </div>
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
    <?php
    include("footer.php");
    ?>


</body>
<script>
    let date = new Date();
    let year = date.getFullYear();
    let month = date.getMonth();

    const day = document.querySelector(".calendar-dates");

    const currdate = document
        .querySelector(".calendar-current-date");

    const prenexIcons = document
        .querySelectorAll(".calendar-navigation span");

    // Array of month names
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    // Function to generate the calendar
    const manipulate = () => {

        // Get the first day of the month
        let dayone = new Date(year, month, 1).getDay();

        // Get the last date of the month
        let lastdate = new Date(year, month + 1, 0).getDate();

        // Get the day of the last date of the month
        let dayend = new Date(year, month, lastdate).getDay();

        // Get the last date of the previous month
        let monthlastdate = new Date(year, month, 0).getDate();

        // Variable to store the generated calendar HTML
        let lit = "";

        // Loop to add the last dates of the previous month
        for (let i = dayone; i > 0; i--) {
            lit +=
                `<li class="inactive">${monthlastdate - i + 1}</li>`;
        }

        // Loop to add the dates of the current month
        for (let i = 1; i <= lastdate; i++) {

            // Check if the current date is today
            let isToday = i === date.getDate() &&
                month === new Date().getMonth() &&
                year === new Date().getFullYear() ?
                "active" :
                "";
            lit += `<li class="${isToday}">${i}</li>`;
        }

        // Loop to add the first dates of the next month
        for (let i = dayend; i < 6; i++) {
            lit += `<li class="inactive">${i - dayend + 1}</li>`
        }

        // Update the text of the current date element
        // with the formatted current month and year
        currdate.innerText = `${months[month]} ${year}`;

        // update the HTML of the dates element
        // with the generated calendar
        day.innerHTML = lit;
    }

    manipulate();

    // Attach a click event listener to each icon
    prenexIcons.forEach(icon => {

        // When an icon is clicked
        icon.addEventListener("click", () => {

            // Check if the icon is "calendar-prev"
            // or "calendar-next"
            month = icon.id === "calendar-prev" ? month - 1 : month + 1;

            // Check if the month is out of range
            if (month < 0 || month > 11) {

                // Set the date to the first day of the
                // month with the new year
                date = new Date(year, month, new Date().getDate());

                // Set the year to the new year
                year = date.getFullYear();

                // Set the month to the new month
                month = date.getMonth();
            } else {

                // Set the date to the current date
                date = new Date();
            }

            // Call the manipulate function to
            // update the calendar display
            manipulate();
        });
    });
</script>

</html>