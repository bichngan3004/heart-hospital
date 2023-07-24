<?php  
class listds
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
    public function showdetailskhoa($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link,$sql);
        mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            while($row = mysqli_fetch_array($ketqua))
            {
                $id_khoa = $row['id_khoa'];
                echo '
                <div class="khoa">
                <div class="khoa_hinh"><a href="chitietkhoa.php?id='.$id_khoa.'" style="text-decoration:none" class="title-khoa"><img src="../img/khoa/'.$row['hinh'].'" alt="" width="300" height="220"/></a></div>
                <div class="khoa_ten"><a href="chitietkhoa.php?id='.$id_khoa.'" style="text-decoration:none" class="title-khoa">'.$row['tenkhoa'].'</a></div>
            </div>'
                ;
            }
        }
    }
    public function listkhoatable($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link,$sql);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            // $layid=0;
            // if(isset($_REQUEST['id']))
            // {
            //     $layid=$_REQUEST['id'];	
            // }
           
           // $tenkhoa = $this->laycot("SELECT tenkhoa FROM khoa WHERE id_khoa='$layid' LIMIT 1");
            echo'<table class="table table-bordered " width="500px">';
            while($row = mysqli_fetch_array($ketqua))
            {
                $id_khoa = $row['id_khoa'];
                $tenkhoa = $row['tenkhoa'];
                echo'<tr>';
                echo '<td><a href="chitietkhoa.php?id='.$id_khoa.'">'.$tenkhoa.'</a></td>';
                echo'</tr>';
            }
            echo'</table>';
        }
    }
    public function showinformationdetailskhoa($sql)
    {
        $link = $this->connect();
        $sql = "SELECT * FROM khoa LIMIT 1";
        $ketqua = mysqli_query($link,$sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            $layid=0;
            if(isset($_REQUEST['id']))
            {
                $layid=$_REQUEST['id'];	
            }
            $tenkhoa = $this->laycot("select tenkhoa from khoa where id_khoa='$layid' limit 1");
           
            $mota= $this->laycot("select mota from khoa where id_khoa='$layid'limit 1");
            echo '<p style="font-size:30px"><b>'.$tenkhoa.'</b></p> 
                   <div>'.$mota.'</div>
            ';
            
        }   
    }
    function loadimgdoctor($sql)
    {
        $link = $this->connect();
        $sql = "select * from bacsi limit 1";
        $ketqua = mysqli_query($link,$sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            $layid=0;
            if(isset($_REQUEST['id']))
            {
                $layid=$_REQUEST['id'];	
            }
            $hinh = $this->laycot("select hinhanh from bacsi where id_bacsi='$layid' limit 1");
            // echo '<div>'.$hinh.'</div>';
            echo '  <img src="../img/'.$hinh.'" alt="">';
        }   
    }
    // function loadinformationdetailsdoctor($sql)
    // {
    //     $link = $this->connect();
    //     $sql = "select * from bacsi limit 1";
    //     $ketqua = mysqli_query($link,$sql);
    //     @mysqli_close($link);
    //     $i = mysqli_num_rows($ketqua);
    //     if($i>0)
    //     {
    //         $layid=0;
    //         if(isset($_REQUEST['id']))
    //         {
    //             $layid=$_REQUEST['id'];	
    //         }
    //         $ten = $this->laycot("select tenbacsi from bacsi where id_bacsi='$layid' limit 1");
    //         $chucvu = $this->laycot("select chucvu from bacsi where id_bacsi='$layid' limit 1");
    //         $khoa= $this->laycot("select tenkhoa from khoa where id_khoa='$layid'limit 1");
    //         echo '<p style="font-size:30px"><b>'.$ten.'</b></p> 
    //                 <p style="font-size:20px"> <b>Khoa:</b> ' .$khoa.'</p>
    //                 <p style="font-size:20px"> <b>Chức vụ:</b> ' .$chucvu.'</p>
    //         ';
            
    //     }   
    // }
    function loadinformationdetailsdoctor($sql)
    {
        $link = $this->connect();
        $sql = "select * from bacsi limit 1";
        $ketqua = mysqli_query($link,$sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            $layid=0;
            if(isset($_REQUEST['id']))
            {
                $layid=$_REQUEST['id'];	
            }
            $ten = $this->laycot("select tenbacsi from bacsi where id_bacsi='$layid' limit 1");
            $chucvu = $this->laycot("select chucvu from bacsi where id_bacsi='$layid' limit 1");
            $idkhoa= $this->laycot("select id_khoa from bacsi where id_bacsi='$layid'limit 1");
            $khoa= $this->laycot("select tenkhoa from khoa where id_khoa='$idkhoa'limit 1");
            $namsinh= $this->laycot("select namsinh from bacsi where id_bacsi='$layid'limit 1");
            $gioitinh= $this->laycot("select gioitinh from bacsi where id_bacsi='$layid'limit 1");
            echo '<p style="font-size:30px"><b>'.$ten.'</b></p> 
                    <p style="font-size:20px"> <b>Năm sinh: </b> ' .$gioitinh.'</p>
                    <p style="font-size:20px"> <b>Giới tính: </b> ' .$namsinh.'</p>
                    <p style="font-size:20px"> <b>Chuyên khoa: </b> ' .$khoa.'</p>
                    <p style="font-size:20px"> <b>Chức vụ: </b> ' .$chucvu.'</p>
            ';
            
        }   
    }
    function loaddetailsdoctor()
    {
        $link = $this->connect();
        $sql = "select * from bacsi limit 1";
        $ketqua = mysqli_query($link,$sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            $layid=0;
            if(isset($_REQUEST['id']))
            {
                $layid=$_REQUEST['id'];	
            }
            $noidung = $this->laycot("select noidung from bacsi where id_bacsi='$layid' limit 1");
            echo '<div>'.$noidung.'</div>';
        }   
    }
    public function showbacsichitiet($sql)
    {

        $link = $this->connect();
        $ketqua = mysqli_query($link,$sql);
    
        $i = mysqli_num_rows($ketqua);
     
        if($i>0)
        {
            while($row = mysqli_fetch_array($ketqua))
            {
                $id_khoa = $row['id_khoa'];
                $id_bacsi = $row['id_bacsi'];
              $sql1="SELECT tenkhoa FROM khoa WHERE id_khoa='$id_khoa'";
              $ketqua1 = mysqli_query($link,$sql1);
             
              $row1=mysqli_fetch_array($ketqua1);
                echo '
                <div class="bacsi">
                    <div class="bacsi_hinh"> <img src="../img/'.$row['hinhanh'].'" alt="" width="250" height="200"/></div>
                    <div class="bacsi_ten"> <a href="chitietbacsi.php?id='.$id_bacsi.'" style="text-decoration:none" class="title-khoa">'.$row['tenbacsi'].'</a></div>
                    <div class="bacsi_ten"> <a href="chitietkhoa.php?id='.$id_khoa.'" style="text-decoration:none" class="title-khoa">'.$row1['tenkhoa'].'</a></div>
                    <div class="bacsi_mota"> <p>'.$row['mota'].'</p></div>
                </div>'
                ;
            }
        }
    }
    function loadlistnoticedetail()
    {
        $link = $this->connect();
        $sql = "select * from notice";
        $ketqua = mysqli_query($link,$sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            echo '<div class="notice" style="text-align:center">';
            while($row = mysqli_fetch_array($ketqua))
            {
                $id_notice = $row['id_notice'];
                $anh = $row['hinhanh'];
                $tieude= $row['tieude'];
                echo '<a class="tt" href="chitietnotice.php?id='.$id_notice.'">
                <img src="../img/news/'.$anh.'" alt="" width="300" height="200" />
                <div class="title" style="margin-bottom:10px">'.$tieude.'</div>

            </a>';
            }
            echo'</div>';
        }   
    }
    function loadlistnewsdetail()
    {
        $link = $this->connect();
        $sql = "select * from tintuc";
        $ketqua = mysqli_query($link,$sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            echo '<div class="tintuc">';
            while($row = mysqli_fetch_array($ketqua))
            {
                $id_tintuc = $row['id_tintuc'];
                $anh = $row['hinhanh'];
                $tieude= $row['tieude'];
                $mota = $row['mota'];
                $ngaydang = $row['ngaydang'];
                echo '<a class="tt" href="chitiettintuc.php?id='.$id_tintuc.'">
                <img src="../img/news/'.$anh.'" alt="" width="260" height="180" />
                <div class="title">'.$tieude.'</div>
                <div class="mota">'.$mota.'</div>
                <div class="ngaydang-tt"><i>'.$ngaydang.'</i></div>
            </a>';
            }
            echo'</div>';
        }   
    }
    public function loadlistnew($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link,$sql);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            while($row = mysqli_fetch_array($ketqua))
            {
                $id_tintuc = $row['id_tintuc'];
                $anh = $row['hinhanh'];
                $tieude= $row['tieude'];
                $mota = $row['mota'];
                $ngaydang = $row['ngaydang'];
                echo '<div class="newdetails"
                    <div><img src="img/news/'.$anh.'" alt="" width="260" height="200" /><div>
                    <div class="title"><a href="chitiettintuc.php?id='.$id_tintuc.'" style="text-decoration:none">'.$tieude.'</a></div>
                    <div class="mota"><a href="chitiettintuc.php?id='.$id_tintuc.'" style="text-decoration:none">'.$mota.'</a></div>
                    <div class="ngaydang"><a href="chitiettintuc.php?id='.$id_tintuc.'" style="text-decoration:none">'.$ngaydang.'</a></div>
                </div>
                ';
            }
        }
    }
    function loadlistnewsdetailsec($sql)
    {
        $link = $this->connect();
       // $sql = "select * from tintuc";
        $ketqua = mysqli_query($link,$sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            echo '<div class="tintuc">';
            while($row = mysqli_fetch_array($ketqua))
            {
                $id_tintuc = $row['id_tintuc'];
                $anh = $row['hinhanh'];
                $tieude= $row['tieude'];
                $mota = $row['mota'];
                $ngaydang = $row['ngaydang'];
                echo '<a class="tt" href="chitiettintuc.php?id='.$id_tintuc.'">
                <img src="./img/news/'.$anh.'" alt="" width="260" height="180" />
                <p class="title">'.$tieude.'</p><br/>
                <p class="mota" style="padding-top: 10px">'.$mota.'</p>
                <p class="ngaydang-tt">'.$ngaydang.'</p>
            </a>';
            }
            echo'</div>';
        }   
    }
    
}
?>