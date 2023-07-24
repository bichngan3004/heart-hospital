<?php
class healthcarestaff
{
     function connect()
     {
         $con = mysqli_connect("localhost", "root", "", "benhvien");
         if (!$con) {
             echo "Không kết nối cơ sở dữ liệu";
             exit();
         } else {
             mysqli_set_charset($con, "utf8");
             return $con;
         }
     }
     function themxoasua($sql)
     {
         $link = $this->connect();
         if (mysqli_query($link, $sql)) {
             return 1;
         } else {
             return 0;
         }
     }
     function laycot($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link,$sql);
        mysqli_close($link);
        $i=mysqli_num_rows($ketqua);
        $giatri ='';
        if($i>0)
        {
            while($row = mysqli_fetch_array($ketqua))
            {
                $id = $row['0'];
                $giatri = $id;
            }
        }
        return $giatri;
    }
    public function myupfile($name,$tmp_name,$folder)
		{
			if($name!=''&& $tmp_name!='' && $folder!='')
			{
				$newname=$folder."/".$name;
				if(move_uploaded_file($tmp_name,$newname))
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 0;
			}
		}
}
?>