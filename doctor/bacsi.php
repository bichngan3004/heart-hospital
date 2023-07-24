<option value="">Chọn bác sĩ</option>
<?php
    include("../class/clsdoctor.php");
    $p = new doctor();
    $sql = "SELECT * FROM bacsi WHERE id_khoa = ".$_POST['khoaid']."";
    $ketqua = mysqli_query($p->connect(),$sql);
    $i=mysqli_num_rows($ketqua);
    if($i>0)
    {
        while( $row = mysqli_fetch_array($ketqua))
        {
            echo '<option value="'.$row['id_bacsi'].'">'.$row['tenbacsi'].'</option>';
        }
    }
?>