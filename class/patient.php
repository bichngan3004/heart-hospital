<?php
class patient
{
    function connect()
    {
        $con = mysqli_connect("localhost","root","","benhvien");
        if(!$con)
        {
            echo "Không kết nối cơ sở dữ liệu";
            exit();
        }
        else
        {
            mysqli_set_charset($con,"utf8");
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
    //Phía bác sĩ được bệnh nhân hẹn
		function show_lich_hen($id_bacsi){
			$link = $this->connect();
			$sql = "SELECT * FROM phieudkkham WHERE id_bacsi = '$id_bacsi'";
			$result = mysqli_query($link ,$sql);
			$lichhen = mysqli_fetch_all($result, MYSQLI_ASSOC);
			mysqli_free_result($result);
			mysqli_close($link);
			return $lichhen; 
		}

		// lịch nghỉ bận dành cho bác sĩ 
		function show_lich_nghi($id_bacsi){
			$link = $this->connect();
			$sql = "SELECT * FROM lichnghi WHERE id_bacsi = '$id_bacsi' order by ngayhen ASC ";
			$result = mysqli_query($link ,$sql);
			$lichnghi = mysqli_fetch_all($result, MYSQLI_ASSOC);
			mysqli_free_result($result);
			mysqli_close($link);
			return $lichnghi;
		}
        // lịch hẹn tái khám
        // function show_lich_hentaikham($id_bacsi){
		// 	$link = $this->connect();
		// 	$sql = "SELECT * FROM phieuhen WHERE id_bacsi = '$id_bacsi'";
		// 	$result = mysqli_query($link ,$sql);
		// 	$lichhentaikham = mysqli_fetch_all($result, MYSQLI_ASSOC);
		// 	mysqli_free_result($result);
		// 	mysqli_close($link);
		// 	return $lichhentaikham; 
		// }
        public function themxoasua($sql)
        {
            $link = $this->connect();
            if(@mysqli_query($link, $sql)) 
            {
                return 1;
            } else {
                return 0;
            }
        }
		function show_info_doctor($id_bacsi){
			$link = $this->connect();
			$sql = "select * from bacsi where id_bacsi = '$id_bacsi'";
			$result = mysqli_query($link ,$sql);
			$doctor = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
			mysqli_close($link);
			return $doctor;
        }
        function show_info($tentaikhoan){
			$link = $this->connect();
			$sql = "select * from taikhoan where tentaikhoan = '$tentaikhoan'";
			$result = mysqli_query($link ,$sql);
			$user = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
			mysqli_close($link);
			return $user; 
		}
		public function xemthongtin($sql)
		{
			$link = $this->connect();
			$ketqua = mysqli_query($link,$sql);
			mysqli_close($link);
			$i = mysqli_num_rows($ketqua);
			if($i>0)
			{
				while($row = mysqli_fetch_array($ketqua))
				{
					$hoten = $row['tenbenhnhan'];
					$gioitinh = $row['gioitinh'];
					$tuoi = $row['namsinh'];
					$sdt = $row['sdt'];
					$diachi = $row['diachi'];
					$img = $row['hinhanh'];
					echo ' 
					
				<div class="information-details col-8 float-right" >
				   <p class="font-weight-bold">Họ và tên: '.$hoten.'</p>
				   <p class="font-weight-bold">Giới tính: '.$gioitinh.'</p>
				   <p class="font-weight-bold">Năm sinh: '.$tuoi.'</p>
				   <p class="font-weight-bold">Số điện thoại: '.$sdt.'</p>
				   <p class="font-weight-bold">Địa chỉ: '.$diachi.'</p>
				   <div class="nut">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Cập nhật</button>
					</div>
				</div>
				'
					;
				}
			   
			}
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

		public function showlichhenkham($id_user, $token)
		{
			$link = $this->connect();
			$sql = "SELECT * FROM phieudkkham WHERE id_benhnhan = '$id_user' OR id_benhnhan = '$token'";
			$result = mysqli_query($link ,$sql);
			$lichhenkham = mysqli_fetch_assoc($result);
			mysqli_free_result($result);
			mysqli_close($link);
			return $lichhenkham; 
		}

		
		public function showphieukham($sql)
		{
			$link = $this->connect();
			$ketqua = mysqli_query($link,$sql);
			$i = mysqli_num_rows($ketqua);
			echo '<table class="table table-bordered" style="width:80%">';
                    echo ' <tr style="text-align: center;font-weight: bold; background-color:green; color: white;">
                            <th>STT</th>
                            <th scope="col">NGÀY KHÁM</th>
                            <th>TRIỆU CHỨNG</th>
                            <th>BÁC SĨ KHÁM</th>
                            <th>KẾT QUẢ</th>
                        </tr>';
			if($i>0)
			{
				$dem = 1;
                        while($row = mysqli_fetch_array($ketqua))
                        {
							$id_phieukhambenh = $row['id_phieukham'];
							$ngaykham = $row['ngaykham'];
							$giokham = $row['giokham'];
							$kq = $row['ketqua'];
							$chidan = $row['chidan'];
							$phikham = $row['phikham'];
							$id_benhnhan = $row['id_benhnhan'];
							$id_phieudk = $row['id_phieudk'];
							$id_bacsi = $row['id_bacsi'];
							$id_benhan = $row['id_benhan'];
							echo' <tr style="text-align: center;">
							            <td style="text-align: center;"><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$dem.'</a></td>
                                        <td><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$ngaykham.'</a></td>
							            <td><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$this->laycot("SELECT trieuchung FROM phieudkkham WHERE id_phieudk='".$id_phieudk."'").'</a></td>
							            <td><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$this->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi='".$id_bacsi."'").'</a></td>
                                        <td><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$kq.'</a></td>
                                    </tr>';
									$dem++;
						}
				
			}
			echo '</table>';
		}

		public function showphieukhamtoken($sql)
		{
			$link = $this->connect();
			$ketqua = mysqli_query($link,$sql);
			$i = mysqli_num_rows($ketqua);
			echo '<table class="table table-bordered" style="width:80%">';
                    echo ' <tr style="text-align: center;font-weight: bold; background-color:green; color: white;">
                            <th>STT</th>
                            <th scope="col">NGÀY KHÁM</th>
                            <th>TRIỆU CHỨNG</th>
                            <th>BÁC SĨ KHÁM</th>
                            <th>KẾT QUẢ</th>
                        </tr>';
			if($i>0)
			{
				$dem = 1;
                        while($row = mysqli_fetch_array($ketqua))
                        {
							$id_phieukhambenh = $row['id_phieukham'];
							$ngaykham = $row['ngaykham'];
							$giokham = $row['giokham'];
							$kq = $row['ketqua'];
							$chidan = $row['chidan'];
							$phikham = $row['phikham'];
							$id_benhnhan = $row['id_benhnhan'];
							$id_phieudk = $row['id_phieudk'];
							$id_bacsi = $row['id_bacsi'];
							$id_benhan = $row['id_benhan'];
							echo' <tr style="text-align: center;">
							            <td style="text-align: center;"><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$dem.'</a></td>
                                        <td><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$ngaykham.'</a></td>
							            <td><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$this->laycot("SELECT trieuchung FROM phieudkkham WHERE id_phieudk='".$id_phieudk."'").'</a></td>
							            <td><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$this->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi='".$id_bacsi."'").'</a></td>
                                        <td><a href="phieukhamct.php?id='.$id_phieukhambenh.'">'.$kq.'</a></td>
                                    </tr>';
									$dem++;
						}
				
			}
			echo '</table>';
		}

		public function showthongtinbenhan($sql)
		{
			$link = $this->connect();
			$ketqua = mysqli_query($link,$sql);
			$i = mysqli_num_rows($ketqua);
			if($i>0)
			{
				while($row = mysqli_fetch_array($ketqua))
				{
					$id_benhnhan = $row['id_benhnhan'];
					$id_bacsi= $row['id_bacsi'];
					echo' <p><b>Họ và tên:</b> '.$this->laycot("SELECT tenbenhnhan FROM benhnhan WHERE id_benhnhan='$id_benhnhan'").'</p>
					<p><b>Giới tính:</b> '.$this->laycot("SELECT gioitinh FROM benhnhan WHERE id_benhnhan='$id_benhnhan'").'</p>
					<p><b>Năm sinh:</b> '.$this->laycot("SELECT namsinh FROM benhnhan WHERE id_benhnhan='$id_benhnhan'").'</p>
					<p><b>Số điện thoại:</b> '.$this->laycot("SELECT sdt FROM benhnhan WHERE id_benhnhan ='$id_benhnhan'").'</p>
					<p><b>Địa chỉ:</b> '.$this->laycot("SELECT diachi FROM benhnhan WHERE id_benhnhan = '$id_benhnhan'").'</p>';
					
				}
			}
		}
		public function showimg($sql)
		{
			$link = $this->connect();
			$ketqua = mysqli_query($link,$sql);
			$i = mysqli_num_rows($ketqua);
			if($i>0)
			{
				while($row = mysqli_fetch_array($ketqua))
				{
					$id_benhnhan = $row['id_benhnhan'];
					 echo '<img src="../img/'.$this->laycot("SELECT hinhanh FROM benhnhan WHERE id_benhnhan='$id_benhnhan' ").'" alt="" width="250" height="250"">' ;
				}
			}
		}
		public function phieuxetnghiem($sql)
		{
			$link = $this->connect();
			$ketqua = mysqli_query($link,$sql);
			$i = mysqli_num_rows($ketqua);
			if($i>0)
			{
				while($row = mysqli_fetch_array($ketqua))
				{
					$id_phieukham = $row['phieukham'];
					echo'<p><b></b></p>';
				}
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
                <img src="./img/news/'.$anh.'" alt="" width="260" height="180" />
                <div class="title">'.$tieude.'</div>
                <div class="mota">'.$mota.'</div>
                <div class="ngaydang-tt"><i>'.$ngaydang.'</i></div>
            </a>';
            }
            echo'</div>';
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
                <img src="./img/news/'.$anh.'" alt="" width="300" height="200" />
                <div class="title" style="margin-bottom:10px">'.$tieude.'</div>

            </a>';
            }
            echo'</div>';
        }   
    }
	function loadnewsnotice()
    {
        $link = $this->connect();
        $sql = "select * from notice limit 1";
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
            $noidung = $this->laycot("select noidung from notice where id_notice='$layid' limit 1");
            echo '<div>'.$noidung.'</div>';
        }   
    }
	function loadnewsdetail()
    {
        $link = $this->connect();
        $sql = "select * from tintuc limit 1";
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
            $noidung = $this->laycot("select noidung from tintuc where id_tintuc='$layid' limit 1");
            echo '<div>'.$noidung.'</div>';
        }   
    }
	function loadlistnewsdetailsec()
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
                <img src="./img/news/'.$anh.'" alt="" width="260" height="180" />
                <div class="title">'.$tieude.'</div>
                <div class="mota">'.$mota.'</div>
                <div class="ngaydang-tt"><i>'.$ngaydang.'</i></div>
            </a>';
            }
            echo'</div>';
        }   
    }
	function loadlistnewsdetailsecpa($sql)
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
                <img src="../img/news/'.$anh.'" alt="" width="260" height="180" />
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