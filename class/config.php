<?php
class connect
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

    public function login_user($user, $pass)
    {
        $pass = md5($pass);
        $sql = "select * from taikhoan where email='$user' and password='$pass'";
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        if ($i == 1) {
            while ($row = mysqli_fetch_array($ketqua)) {
                $id = $row['id'];
                $user = $row['email'];
                $pass = $row['password'];
                $ten = $row['tentaikhoan'];
                $id_user = $row['id_user'];
                // $token = $row['email'];
                $phanquyen = $row['phanquyen'];
                $token = $row['token'];
                if ($phanquyen == 1) {
                    //bệnh nhân
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $pass;
                    $_SESSION['phanquyen'] = $phanquyen;
                    $_SESSION['id_user'] = $id_user;
                    $_SESSION['tentaikhoan'] = $ten;
                    $_SESSION['user_token'] = $token;
                    return 1;
                } else if ($phanquyen == 2) {
                    //bác sĩ
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $pass;
                    $_SESSION['phanquyen'] = $phanquyen;
                    $_SESSION['id_user'] = $id_user;
                    $_SESSION['tentaikhoan'] = $ten;
                    return 2;
                } else if ($phanquyen == 3) {
                    //nvyt
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $pass;
                    $_SESSION['phanquyen'] = $phanquyen;
                    $_SESSION['id_user'] = $id_user;
                    $_SESSION['tentaikhoan'] = $ten;
                    return 3;
                } else if ($phanquyen == 4) {
                    //admin
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = $user;
                    $_SESSION['pass'] = $pass;
                    $_SESSION['phanquyen'] = $phanquyen;
                    $_SESSION['id_user'] = $id_user;
                    $_SESSION['tentaikhoan'] = $ten;
                    return 4;
                }
            }
        } else {
            return 0;
        }
    }
    //hàm xác nhận đăng nhập
    public function confirm_login($id, $user, $pass, $phanquyen, $id_user)
    {
        $link = $this->connect();
        $sql = "select id from taikhoan where email='$user' and password ='$pass' and phanquyen='$phanquyen' and id_user='$id_user'";
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        if ($i != 1) {
            return 1;
        } else {
            return 0;
        }
    }
    public function confirm_bn($id_user, $user, $pass, $phanquyen)
    {
        $link = $this->connect();
        $sql = "SELECT id FROM `taikhoan` WHERE id_user='$id_user' AND email='$user' AND password='$pass' AND phanquyen='$phanquyen'";
        $ketqua = mysqli_query($link, $sql);
        $i = @mysqli_num_rows($ketqua);
        if ($i != 1) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function confirm_nvyt($id, $user, $pass,$id_user, $phanquyen)
    {
        $link = $this->connect();
        $sql = "SELECT id FROM `taikhoan` WHERE id='$id' AND email='$user' AND id_user ='$id_user' AND password='$pass' AND phanquyen='$phanquyen'";
        $ketqua = mysqli_query($link, $sql);
        $i = @mysqli_num_rows($ketqua);
        if ($i != 1) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function confirmgg($id, $user, $phanquyen, $id_user, $token)
    {
        $link = $this->connect();
        $sql = "select id from taikhoan where id='$id' and email='$user' and phanquyen='$phanquyen' and id_user='$id_user' or token ='$token'";
        $ketqua = mysqli_query($link, $sql);
        $i = mysqli_num_rows($ketqua);
        if ($i != 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function showkhoa($sql)
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
                <div class="khoa_hinh"><a href=chitietkhoa.php?id='.$id_khoa.'" style="text-decoration:none"><img src="img/khoa/'.$row['hinh'].'" alt="" width="250" height="200"/></a></div>
                <div class="khoa_ten"><a href="chitietkhoa.php?id='.$id_khoa.'" style="text-decoration:none" class="title-khoa">'.$row['tenkhoa'].'</a></div>
            </div>'
                ;
            }
        }
    }
    public function showbacsi($sql)
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
                    <div class="bacsi_hinh"><a href="chitietbacsi.php?id='.$id_bacsi.'" style="text-decoration:none"><img src="img/'.$row['hinhanh'].'" alt="" width="250" height="200"/></a></div>
                    <div class="bacsi_ten"><a href="chitietbacsi.php?id='.$id_bacsi.'" style="text-decoration:none" class="title-khoa">'.$row['tenbacsi'].'</a></div>
                    <div class="bacsi_ten">'.$row1['tenkhoa'].'</div>
                </div>'
                ;
            }
        }
    }
    public function showkhoa_bn($sql)
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
                    <div class="khoa_hinh"><a href="chitietkhoa.php?id='.$id_khoa.'" style="text-decoration:none"><img src="../img/khoa/'.$row['hinh'].'" alt="" width="250" height="200"/></a></div>
                    <div class="khoa_ten"><a href="chitietkhoa.php?id='.$id_khoa.'" style="text-decoration:none" class="title-khoa">'.$row['tenkhoa'].'</a></div>
                </div>'
                ;
            }
        }
    }
    public function showbacsi_bn($sql)
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
                    <div class="bacsi_hinh"> <a href="chitietbacsi.php?id='.$id_bacsi.'" style="text-decoration:none" class="title-khoa"> <img src="../img/'.$row['hinhanh'].'" alt="" width="250" height="200"/></a></div>
                    <div class="bacsi_ten"> <a href="chitietbacsi.php?id='.$id_bacsi.'" style="text-decoration:none" class="title-khoa">'.$row['tenbacsi'].'</a></div>
                    <div class="bacsi_ten"> <a >'.$row1['tenkhoa'].'</a></div>
                </div>'
                ;
            }
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
                    <div class="bacsi_hinh"> <img src="img/'.$row['hinhanh'].'" alt="" width="230" height="200"/></div>
                    <div class="bacsi_ten"> <a href="chitietbacsi.php?id='.$id_bacsi.'" style="text-decoration:none" class="title-khoa">'.$row['tenbacsi'].'</a></div>
                    <div class="bacsi_ten"> <a style="text-decoration:none" class="title-khoa">'.$row1['tenkhoa'].'</a></div>
                    <div class="bacsi_mota"> <p>'.$row['mota'].'</p></div>
                </div>'
                ;
            }
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
            echo '  <img src="./img/'.$hinh.'" alt="">';
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
                <div class="khoa_hinh"><a href="chitietkhoa.php?id='.$id_khoa.'" style="text-decoration:none"><img src="img/khoa/'.$row['hinh'].'" alt="" width="300" height="220"/></a></div>
                <div class="khoa_ten"><a href="chitietkhoa.php?id='.$id_khoa.'" style="text-decoration:none" class="title-khoa">'.$row['tenkhoa'].'</a></div>
            </div>'
                ;
            }
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
    function exist_user($ten){
        $conn = $this->connect();
        $sql = "select * from benhnhan where tenbenhnhan = '$ten'";
        $result = mysqli_query($conn ,$sql);
        $existUser = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $existUser; 	
    }
    function exist_email($email){
        $conn = $this->connect();
        $sql = "select * from taikhoan where email = '$email'";
        $result = mysqli_query($conn ,$sql);
        $existEmail = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $existEmail; 	
    }
}
