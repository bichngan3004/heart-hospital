<?php
include("../class/clsdoctor.php");
$p = new doctor();
if(isset($_REQUEST['id']))
{
    $link = $p->connect();
    $id = $_GET['id'];
    $sql = "DELETE FROM lichnghi WHERE id_lichnghi ='".$id."' ";
    if(mysqli_query($link,$sql)===true)
    {
        echo '<script>alert("Hủy thành công!")</script>';
        header("refresh:1;url=QuanLyLichNghiBacSi.php");
    }
    else
    {
        echo '<script>alert("Hủy lịch không thành công!")</script>';
    }
}

?>