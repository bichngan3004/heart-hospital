<?php
    session_start();

    if (isset($_SESSION['user'])) {
       // unset($_SESSION['user']);
       session_unset();
        session_destroy();
    } else if(isset($_SESSION['user_token']))
    {
        session_unset();
        session_destroy();
    }
    header("location:login.php");
?>