<?php
class admin
{
    function connect()
    {
        $con = mysqli_connect("localhost", "root", "", "benhvien");
        if (!$con) {
            echo 'Không kết nối cơ sở dữ liệu!';
            exit();
        } else {
            mysqli_set_charset($con, "utf8");
            return $con;
        }
    }
    function laycot($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        $giatri = '';
        if ($i > 0) {
            while ($row = mysqli_fetch_array($ketqua)) {
                $id = $row['0'];
                $giatri = $id;
            }
        }
        return $giatri;
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
    public function myupfile($name, $tmp_name, $folder)
    {
        if ($name != ' ' && $tmp_name != ' ' && $folder != ' ') {
            $newname = $folder . "/" . $name;
            if (move_uploaded_file($tmp_name, $newname)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    //Admin
    function loadinfoadmin($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = $_SESSION['id_user'];
            $ten = $this->laycot("select tenadmin from admin where id_admin='$layid' limit 1");
            $namsinh = $this->laycot("select namsinh from admin where id_admin='$layid' limit 1");
            $gioitinh = $this->laycot("select gioitinh from admin where id_admin='$layid' limit 1");
            $sdt = $this->laycot("select sdt from admin where id_admin='$layid' limit 1");
            $diachi = $this->laycot("select diachi from admin where id_admin='$layid' limit 1");
            echo '
                <div id="information_detail">
					<div id="bs_ten"><b>Tên admin: </b>' . $ten . '</div>
					<div id="bs_namsinh"><b>Năm sinh: </b>' . $namsinh . '</div>
                    <div id="bs_gioitinh"><b>Giới tính: </b>' . $gioitinh . '</div>
                    <div id="bs_sdt"><b>Số điện thoại: </b>' . $sdt . '</div>
                    <div id="bs_diachi"><b>Địa chỉ: </b>' . $diachi . '</div>
				</div>';
        } else {
            echo 'Không có dữ liệu.';
        }
    }
    //Doctor
    function loadlistdropdowndoctor()
    {
        $link = $this->connect();
        $sql = "select * from bacsi";
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            echo '<div id="myDropdown" class="dropdown-content">';
            while ($row = mysqli_fetch_array($ketqua)) {
                $id_bacsi = $row['id_bacsi'];
                $ten = $row['tenbacsi'];
                echo '<a href="?id=' . $id_bacsi . '">' . $ten . '</a>';
            }
            echo '</div>';
        }
    }

    function loadlistdoctor()
    {
        $link = $this->connect();
        $sql = "select * from bacsi";
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            echo '<table class="table table-bordered">
                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                    <th>STT</th>
                    <th>HỌ TÊN</th>
                    <th>GIỚI TÍNH</th>
                    <th>SỐ ĐIỆN THOẠI</th>
                    <th>CHUYÊN KHOA</th>            
                </tr>';
            $dem = 1;
            while ($row = mysqli_fetch_array($ketqua)) {
                $id_bacsi = $row['id_bacsi'];
                $ten = $row['tenbacsi'];
                $gioitinh = $row['gioitinh'];
                $sdt = $row['sdt'];
                $id_khoa = $row['id_khoa'];
                echo '<tr>
                        <td style="text-align: center;"><a href="?id=' . $id_bacsi . '">' . $dem . '</a></td>
                        <td><a href="?id=' . $id_bacsi . '">' . $ten . '</a></td>
                        <td style="text-align: center;"><a href="?id=' . $id_bacsi . '">' . $gioitinh . '</a></td>
                        <td style="text-align: center;"><a href="?id=' . $id_bacsi . '">' . $sdt . '</a></td>
                        <td><a href="?id=' . $id_bacsi . '">' . $this->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") . '</a></td>     
                    </tr>';
                $dem++;
            }
            echo '</table>';
        }
    }
    function loadinfodoctor($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = 0;
            if (isset($_REQUEST['id'])) {
                $layid = $_REQUEST['id'];
            }
            $anh = $this->laycot("select hinhanh from bacsi where id_bacsi='$layid' limit 1");
            $ten = $this->laycot("select tenbacsi from bacsi where id_bacsi='$layid' limit 1");
            $namsinh = $this->laycot("select namsinh from bacsi where id_bacsi='$layid' limit 1");
            $gioitinh = $this->laycot("select gioitinh from bacsi where id_bacsi='$layid' limit 1");
            $sdt = $this->laycot("select sdt from bacsi where id_bacsi='$layid' limit 1");
            $diachi = $this->laycot("select diachi from bacsi where id_bacsi='$layid' limit 1");
            $id_khoa = $this->laycot("select id_khoa from bacsi where id_bacsi='$layid' limit 1");
            $mota = $this->laycot("select mota from bacsi where id_bacsi='$layid' limit 1");
            $chucvu = $this->laycot("select chucvu from bacsi where id_bacsi='$layid' limit 1");
            $noidung = $this->laycot("select noidung from bacsi where id_bacsi='$layid' limit 1");
            echo '<div id="bs" class="row">
                    <div class="col-md-3">
					    <div id="bs_anh"><img src="../img/' . $anh . '" width="150" height="150" /></div>
                    </div>
                    <div class="col-md-8">
                        <div id="bs_ten"><b>Tên bác sĩ: </b>' . $ten . '</div>
					    <div id="bs_namsinh"><b>Năm sinh: </b>' . $namsinh . '</div>
                        <div id="bs_gioitinh"><b>Giới tính: </b>' . $gioitinh . '</div>
                        <div id="bs_sdt"><b>Số điện thoại: </b>' . $sdt . '</div>
                        <div id="bs_diachi"><b>Địa chỉ: </b>' . $diachi . '</div>
                        <div id="bs_chuyenkhoa"><b>Chuyên khoa: </b>' . $this->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") . '</div>
                        <div id="bs_chucvu"><b>Chức vụ: </b>' . $chucvu . '</div>
                        <div id="bs_mota"><b>Mô tả: </b>' . $mota . '</div>
                        
                    </div>
                  </div>
                  <div class="row" style="margin-top:5px">
                    <div id="bs_noidung"><b>Mô tả chi tiết: </b>' . $noidung . '</div>
				  </div>';
        } else {
            echo 'Không có dữ liệu.';
        }
    }
    function updateinfodoctor($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = 0;
            if (isset($_REQUEST['id'])) {
                $layid = $_REQUEST['id'];
            }
            $anh = $this->laycot("select hinhanh from bacsi where id_bacsi='$layid' limit 1");
            $ten = $this->laycot("select tenbacsi from bacsi where id_bacsi='$layid' limit 1");
            $namsinh = $this->laycot("select namsinh from bacsi where id_bacsi='$layid' limit 1");
            $gioitinh = $this->laycot("select gioitinh from bacsi where id_bacsi='$layid' limit 1");
            $sdt = $this->laycot("select sdt from bacsi where id_bacsi='$layid' limit 1");
            $diachi = $this->laycot("select diachi from bacsi where id_bacsi='$layid' limit 1");
            $id_khoa = $this->laycot("select id_khoa from bacsi where id_bacsi='$layid' limit 1");
            $mota = $this->laycot("select mota from bacsi where id_bacsi='$layid' limit 1");
            $chucvu = $this->laycot("select chucvu from bacsi where id_bacsi='$layid' limit 1");
            $noidung = $this->laycot("select noidung from bacsi where id_bacsi='$layid' limit 1");
            echo '<div class="modal-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-3">
                                <div id="bs_anh"><img src="../img/' . $anh . '" width="150" height="150" /></div>
                                <label for="txtid"></label>
                                <input name="txtid" type="hidden" id="txtid" value="' . $layid . '" />
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Tên bác sĩ: </b></label>
                                    <input type="text" class="form-control" name="txtten" value="' . $ten . '">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Giới tính: </b></label>
                                    <select class="form-control" name="txtgioitinh">
                                        <option value="' . $gioitinh . '" selected="selected" style="color:white;">' . $gioitinh . '</option>
                                        <option value="Nữ">Nữ</option>
                                        <option value="Nam">Nam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Năm sinh: </b></label>
                                    <input type="text" class="form-control" name="txtns" value="' . $namsinh . '">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Số điện thoại: </b></label>
                                    <input type="text" class="form-control" name="txtsdt"  minlength="8" maxlength="10"  value="' . $sdt . '">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Chuyên khoa: </b></label>
                                    <select class="form-control" name="txtck">
                                        <option value="' . $this->laycot("select id_khoa from khoa where id_khoa ='$id_khoa'") . '" selected="selected" style="color:white;">' . $this->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") . '</option>
                                        <option value="1">Khoa nội tim mạch tổng quát (nội tim mạch 3)</option>
                                        <option value="2">Khoa phẫu thuật tim</option>
                                        <option value="3">Khoa phòng khám</option>
                                        <option value="4">Khoa điện sinh lý và loạn nhịp tim (nội tim mạch 1)</option>
                                        <option value="5">Khoa thông tim can thiệp (nội tim mạch 2)</option>
                                        <option value="6">Khoa bệnh lý mạch máu</option>
                                        <option value="7">Khoa hồi sức cấp cứu nội tim mạch (USIC)</option>
                                        <option value="8">Khoa tim mạch chuyển hóa (nội tim mạch 4)</option>
                                        <option value="9">Khoa phục hồi chức năng tim mạch (nội tim mạch 5)</option>
                                        <option value="10">Khoa hồi sức cấp cứu ngoại tim mạch</option>
                                        <option value="11">Khoa gây mê</option>
                                        <option value="12">Khoa phòng mổ</option>
                                        <option value="13">Khoa chuẩn đoán hình ảnh</option>
                                        <option value="14">Khoa kiểm soát nhiễm khuẩn</option>
                                        <option value="15">Khoa dược</option>
                                        <option value="16">Khoa xét nghiệm</option>
                                        <option value="17">Khoa dinh dưỡng</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Chức vụ: </b></label>
                                    <input type="text" class="form-control" name="txtchucvu" value="' . $chucvu . '">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Địa chỉ: </b></label>
                                    <input type="text" class="form-control" name="txtdiachi"  value="' . $diachi . '">
                                </div>  
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Mô tả: </b></label>
                                    <input type="text" class="form-control" name="txtmota"  value="' . $mota . '">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="textarea"><b>Nội dung:</b></label>
                                <textarea name="txtnoidung" id="txtnoidung">'.$noidung.'</textarea>  
                            </div>
                        </div>
                        
                        
                        
                </div>   
                <div class="modal-footer">
                    <button type="submit" id="nut" style="background-color: green; border-color:#7dff7d" name="capnhat" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                    <button type="submit" id="nut" name="xoa" value="Xóa" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                    </form>
                
                ';
        } else {
            echo 'Không có dữ liệu.';
        }
    }

    //Nvyt
    function loadliststaff()
    {
        $link = $this->connect();
        $sql = "select * from nvyt";
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            echo '<table class="table table-bordered">
                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                    <th>STT</th>
                    <th>HỌ TÊN</th>
                    <th>GIỚI TÍNH</th>
                    <th>SỐ ĐIỆN THOẠI</th>
                    <th>CHUYÊN KHOA</th>            
                </tr>';
            $dem = 1;
            while ($row = mysqli_fetch_array($ketqua)) {
                $id_bacsi = $row['id_nvyt'];
                $ten = $row['tennvyt'];
                $gioitinh = $row['gioitinh'];
                $sdt = $row['sdt'];
                $id_khoa = $row['id_khoa'];
                echo '<tr>
                        <td style="text-align: center;"><a href="?id=' . $id_bacsi . '">' . $dem . '</a></td>
                        <td style="text-align: left;"><a href="?id=' . $id_bacsi . '">' . $ten . '</a></td>
                        <td><a href="?id=' . $id_bacsi . '">' . $gioitinh . '</a></td>
                        <td><a href="?id=' . $id_bacsi . '">' . $sdt . '</a></td>
                        <td style="text-align: left;"><a href="?id=' . $id_bacsi . '">' . $this->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") . '</a></td>     
                    </tr>';
                $dem++;
            }
            echo '</table>';
        }
    }
    function loadinfostaff($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = 0;
            if (isset($_REQUEST['id'])) {
                $layid = $_REQUEST['id'];
            }
            $anh = $this->laycot("select hinhanh from nvyt where id_nvyt='$layid' limit 1");
            $ten = $this->laycot("select tennvyt from nvyt where id_nvyt='$layid' limit 1");
            $chucvu= $this->laycot("select chucvu from nvyt where id_nvyt='$layid' limit 1");
            $namsinh = $this->laycot("select namsinh from nvyt where id_nvyt='$layid' limit 1");
            $gioitinh = $this->laycot("select gioitinh from nvyt where id_nvyt='$layid' limit 1");
            $sdt = $this->laycot("select sdt from nvyt where id_nvyt='$layid' limit 1");
            $diachi = $this->laycot("select diachi from nvyt where id_nvyt='$layid' limit 1");
            $id_khoa = $this->laycot("select id_khoa from nvyt where id_nvyt='$layid' limit 1");
            echo '<div id="bs">
					<div id="bs_anh"><img src="../img/' . $anh . '" width="150" height="150" /></div>
					<div id="bs_ten"><b>Tên nhân viên y tế: </b>' . $ten . '</div>
					<div id="bs_namsinh"><b>Năm sinh: </b>' . $namsinh . '</div>
                    <div id="bs_gioitinh"><b>Giới tính: </b>' . $gioitinh . '</div>
                    <div id="bs_sdt"><b>Số điện thoại: </b>' . $sdt . '</div>
                    <div id="bs_diachi"><b>Địa chỉ: </b>' . $diachi . '</div>
                    <div id="bs_chuyenkhoa"><b>Chuyên khoa: </b>' . $this->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") . '</div>
                    <div id="bs_chucvu"><b>Chức vụ: </b>' . $chucvu . '</div>
				</div>';
        } else {
            echo 'Không có dữ liệu.';
        }
    }
    function updateinfostaff($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = 0;
            if (isset($_REQUEST['id'])) {
                $layid = $_REQUEST['id'];
            }
            $anh = $this->laycot("select hinhanh from nvyt where id_nvyt='$layid' limit 1");
            $ten = $this->laycot("select tennvyt from nvyt where id_nvyt='$layid' limit 1");
            $chucvu = $this->laycot("select chucvu from nvyt where id_nvyt='$layid' limit 1");
            $namsinh = $this->laycot("select namsinh from nvyt where id_nvyt='$layid' limit 1");
            $gioitinh = $this->laycot("select gioitinh from nvyt where id_nvyt='$layid' limit 1");
            $sdt = $this->laycot("select sdt from nvyt where id_nvyt='$layid' limit 1");
            $diachi = $this->laycot("select diachi from nvyt where id_nvyt='$layid' limit 1");
            $id_khoa = $this->laycot("select id_khoa from nvyt where id_nvyt='$layid' limit 1");
            echo '<div class="modal-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div id="nvyt_anh"><img src="../img/' . $anh . '" width="150" height="150" /></div>
                                <label for="txtid"></label>
                                <input name="txtid" type="hidden" id="txtid" value="' . $layid . '" />
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Tên nhân viên y tế: </b></label>
                                    <input type="text" class="form-control" name="txtten" value="' . $ten . '">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Giới tính: </b></label>
                                    <select class="form-control" name="txtgioitinh">
                                        <option value="' . $gioitinh . '" selected="selected" style="color:white;">' . $gioitinh . '</option>
                                        <option value="Nữ">Nữ</option>
                                        <option value="Nam">Nam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Năm sinh: </b></label>
                                    <input type="text" class="form-control" name="txtns" value="' . $namsinh . '">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Số điện thoại: </b></label>
                                <input type="text" class="form-control" name="txtsdt"  minlength="8" maxlength="10"  value="' . $sdt . '">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Địa chỉ: </b></label>
                                <input type="text" class="form-control" name="txtdiachi"  value="' . $diachi . '">
                            </div> 
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Chuyên khoa: </b></label>
                                <select class="form-control" name="txtck">
                                    <option value="' . $this->laycot("select id_khoa from khoa where id_khoa ='$id_khoa'") . '" selected="selected" style="color:white;">' . $this->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") . '</option>
                                    <option value="1">Khoa nội tim mạch tổng quát (nội tim mạch 3)</option>
                                    <option value="2">Khoa phẫu thuật tim</option>
                                    <option value="3">Khoa phòng khám</option>
                                    <option value="4">Khoa điện sinh lý và loạn nhịp tim (nội tim mạch 1)</option>
                                    <option value="5">Khoa thông tim can thiệp (nội tim mạch 2)</option>
                                    <option value="6">Khoa bệnh lý mạch máu</option>
                                    <option value="7">Khoa hồi sức cấp cứu nội tim mạch (USIC)</option>
                                    <option value="8">Khoa tim mạch chuyển hóa (nội tim mạch 4)</option>
                                    <option value="9">Khoa phục hồi chức năng tim mạch (nội tim mạch 5)</option>
                                    <option value="10">Khoa hồi sức cấp cứu ngoại tim mạch</option>
                                    <option value="11">Khoa gây mê</option>
                                    <option value="12">Khoa phòng mổ</option>
                                    <option value="13">Khoa chuẩn đoán hình ảnh</option>
                                    <option value="14">Khoa kiểm soát nhiễm khuẩn</option>
                                    <option value="15">Khoa dược</option>
                                    <option value="16">Khoa xét nghiệm</option>
                                    <option value="17">Khoa dinh dưỡng</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Chức vụ: </b></label>
                                <input type="text" class="form-control" name="txtchucvu" value="' .$chucvu. '">
                            </div>
                            
                        </div>          
                </div>   
                <div class="modal-footer">
                    <button type="submit" id="nut" style="background-color: green; border-color:#7dff7d" name="capnhat" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                    <button type="submit" id="nut" name="xoa" value="Xóa" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                    </form>
                
                ';
        } else {
            echo 'Không có dữ liệu.';
        }
    }

    //Patient
    function loadlistpatient()
    {
        $link = $this->connect();
        $sql = "select * from benhnhan";
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            echo '<table class="table table-bordered">
                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                        <th>STT</th>
                        <th>HỌ TÊN</th>
                        <th>GIỚI TÍNH</th>
                        <th>NĂM SINH</th>
                        <th>SỐ ĐIỆN THOẠI</th>             
                    </tr>';
            $dem = 1;
            while ($row = mysqli_fetch_array($ketqua)) {
                $id_benhnhan = $row['id_benhnhan'];
                $ten = $row['tenbenhnhan'];
                $gioitinh = $row['gioitinh'];
                $sdt = $row['sdt'];
                $namsinh = $row['namsinh'];
                echo '<tr>
                        <td style="text-align: center;"><a href="?id=' . $id_benhnhan . '">' . $dem . '</a></td>
                        <td style="text-align: left;"><a href="?id=' . $id_benhnhan . '">' . $ten . '</a></td>
                        <td><a href="?id=' . $id_benhnhan . '">' . $gioitinh . '</a></td>
                        <td><a href="?id=' . $id_benhnhan . '">' . $namsinh . '</a></td>
                        <td><a href="?id=' . $id_benhnhan . '">' . $sdt . '</a></td>     
                    </tr>';
                $dem++;
            }
            echo '</table>';
        }
    }
    function loadinfopatient($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = 0;
            if (isset($_REQUEST['id'])) {
                $layid = $_REQUEST['id'];
            }
            $anh = $this->laycot("select hinhanh from benhnhan where id_benhnhan='$layid' limit 1");
            $ten = $this->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$layid' limit 1");
            $namsinh = $this->laycot("select namsinh from benhnhan where id_benhnhan='$layid' limit 1");
            $gioitinh = $this->laycot("select gioitinh from benhnhan where id_benhnhan='$layid' limit 1");
            $sdt = $this->laycot("select sdt from benhnhan where id_benhnhan='$layid' limit 1");
            $diachi = $this->laycot("select diachi from benhnhan where id_benhnhan='$layid' limit 1");
            echo '<div id="bs">
					<div id="bs_anh"><img src="../img/' . $anh . '" width="150" height="150" /></div>
					<div id="bs_ten"><b>Tên bệnh nhân: </b>' . $ten . '</div>
					<div id="bs_namsinh"><b>Năm sinh: </b>' . $namsinh . '</div>
                    <div id="bs_gioitinh"><b>Giới tính: </b>' . $gioitinh . '</div>
                    <div id="bs_sdt"><b>Số điện thoại: </b>' . $sdt . '</div>
                    <div id="bs_diachi"><b>Địa chỉ: </b>' . $diachi . '</div>
				</div>';
        } else {
            echo 'Không có dữ liệu.';
        }
    }
    function updateinfopatient($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = 0;
            if (isset($_REQUEST['id'])) {
                $layid = $_REQUEST['id'];
            }
            $anh = $this->laycot("select hinhanh from benhnhan where id_benhnhan='$layid' limit 1");
            $ten = $this->laycot("select tenbenhnhan from benhnhan where id_benhnhan='$layid' limit 1");
            $namsinh = $this->laycot("select namsinh from benhnhan where id_benhnhan='$layid' limit 1");
            $gioitinh = $this->laycot("select gioitinh from benhnhan where id_benhnhan='$layid' limit 1");
            $sdt = $this->laycot("select sdt from benhnhan where id_benhnhan='$layid' limit 1");
            $diachi = $this->laycot("select diachi from benhnhan where id_benhnhan='$layid' limit 1");
            echo '<div class="modal-body">
                    <form action="" method="POST">
                        <div id="bn_anh"><img src="../img/' . $anh . '" width="150" height="150" /></div>
                        <label for="txtid"></label>
                        <input name="txtid" type="hidden" id="txtid" value="'.$layid.'" />
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Tên bệnh nhân: </b></label>
                            <input type="text" class="form-control" name="txtten" value="' . $ten . '">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Giới tính: </b></label>
                            <select class="form-control" name="txtgioitinh">
                                <option value="' . $gioitinh . '" selected="selected" style="color:white;">' . $gioitinh . '</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Nam">Nam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Năm sinh: </b></label>
                            <input type="text" class="form-control" name="txtns" value="' . $namsinh . '">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Số điện thoại: </b></label>
                            <input type="text" class="form-control" name="txtsdt"  minlength="8" maxlength="10"  value="' . $sdt . '">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Địa chỉ: </b></label>
                            <input type="text" class="form-control" name="txtdiachi"  value="' . $diachi . '">
                        </div>  
                </div>   
                <div class="modal-footer">
                    <button type="submit" style="background-color: green; border-color:#7dff7d" id="nut" name="capnhat" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                    <button type="submit" id="nut" name="xoa" value="Xóa" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                    </form>
                
                ';
        } else {
            echo 'Không có dữ liệu.';
        }
    }

    //Phiếuđkikham
    function loadlistphieudki()
    {
        $link = $this->connect();
        $sql = "select * from phieudkkham";
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            echo '<table class="table table-bordered">
                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                        <th>STT</th>
                        <th scope="col">BỆNH NHÂN</th>
                        <th>TRIỆU CHỨNG</th>
                        <th>NGÀY HẸN KHÁM</th>
                        <th>BÁC SĨ HẸN</th>
                                  
                    </tr>';
            $dem = 1;
            while ($row = mysqli_fetch_array($ketqua)) {
                $id_phieudk = $row['id_phieudk'];
                $id_benhnhan = $row['id_benhnhan'];
                $trieuchung = $row['trieuchung'];
                $ngayhen = $row['ngayhen'];
                $id_bacsi = $row['id_bacsi'];
                $array_ngayhen = explode('_', $row['ngayhen']);
                echo '<tr>
                        <td style="text-align: center;">' . $dem . '</td>
                        <td style="text-align: left;">' . $this->laycot("select tenbenhnhan from benhnhan where id_benhnhan ='$id_benhnhan'") . '</td>
                        <td>' . $trieuchung . '</td>
                        <td>' . date('j-m-Y', strtotime($array_ngayhen[1])) . '</td>
                        <td>' . $this->laycot("select tenbacsi from bacsi where id_bacsi ='$id_bacsi'") . '</td>  
                       
                    </tr>';
                $dem++;
            }
            echo '</table>';
        }
    }

    
    //Tintuc
    function loadlistnews()
    {
        $link = $this->connect();
        $sql = "select * from tintuc";
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            echo '<table class="table table-bordered">
                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                        <th>STT</th>
                        <th>TIÊU ĐỀ</th>
                        <th>MÔ TẢ</th>
                        <th>NGÀY ĐĂNG</th>
                        <th>TÁC GIẢ</th>          
                    </tr>';
            $dem = 1;
            while ($row = mysqli_fetch_array($ketqua)) {
                $id_tintuc = $row['id_tintuc'];
                $tieude = $row['tieude'];
                $mota = $row['mota'];
                $ngaydang = $row['ngaydang'];
                $tacgia = $row['tacgia'];
                echo '<tr>
                        <td style="text-align: center;"><a href="?id=' . $id_tintuc . '">' . $dem . '</a></td>
                        <td style="text-align: left;"><a href="?id=' . $id_tintuc . '">' . $tieude . '</a></td>
                        <td style="text-align: left;"><a href="?id=' . $id_tintuc . '">' . $mota . '</a></td>
                        <td><a href="?id=' . $id_tintuc . '">' . $ngaydang . '</a></td>
                        <td><a href="?id=' . $id_tintuc . '">' . $tacgia . '</a></td>      
                    </tr>';
                $dem++;
            }
            echo '</table>';
        }
    }
    function loadlistnotice()
    {
        $link = $this->connect();
        $sql = "select * from notice";
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            echo '<table class="table table-bordered">
                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                        <th>STT</th>
                        <th>TIÊU ĐỀ</th>
                        <th>NGÀY ĐĂNG</th>       
                    </tr>';
            $dem = 1;
            while ($row = mysqli_fetch_array($ketqua)) {
                $id_notice = $row['id_notice'];
                $tieude = $row['tieude'];
                $ngaydang = $row['ngaydang'];
                echo '<tr>
                        <td style="text-align: center;"><a href="?id=' . $id_notice . '">' . $dem . '</a></td>
                        <td style="text-align: left;"><a href="?id=' . $id_notice . '">' . $tieude . '</a></td>
                        <td><a href="?id=' . $id_notice . '">' . $ngaydang . '</a></td>    
                    </tr>';
                $dem++;
            }
            echo '</table>';
        }
    }

    //Khoa
    function loadlistkhoa()
    {
        $link = $this->connect();
        $sql = "select * from khoa";
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            echo '<table class="table table-bordered">
                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                    <th >STT</th>
                    <th>TÊN KHOA</th>           
                </tr>';
            $dem = 1;
            while ($row = mysqli_fetch_array($ketqua)) {
                $id_khoa = $row['id_khoa'];
                $tenkhoa = $row['tenkhoa'];
                echo '<tr>
                        <td style="text-align: center;"><a href="?id=' . $id_khoa . '">' . $dem . '</a></td>
                        <td style="text-align: left;"><a href="?id=' . $id_khoa . '">' . $tenkhoa . '</a></td>    
                    </tr>';
                $dem++;
            }
            echo '</table>';
        }
    }
    function loadinfokhoa($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = 0;
            if (isset($_REQUEST['id'])) {
                $layid = $_REQUEST['id'];
            }
            $hinh = $this->laycot("select hinh from khoa where id_khoa='$layid' limit 1");
            $tenkhoa = $this->laycot("select tenkhoa from khoa where id_khoa='$layid' limit 1");
            $mota = $this->laycot("select mota from khoa where id_khoa='$layid' limit 1");

            echo '<div id="bs" class="row">
					<div id="k_anh">
                        <img src="../img/khoa/' . $hinh . '" width="150" height="150" />
                        <p style="width:150px; padding-top:10px; padding-left:25px;">
                            <a href ="#" id="changeimg" data-toggle="modal" data-target="#change_image"><b>Thay đổi ảnh</b></a></p>
                    </div>
                    
                    <div id="k_tenkhoa"><b>Tên khoa: </b>' . $tenkhoa . '</div>
                    <div id="bs_mota"><b>Mô tả: </b>' . $mota . '</div>      
				  </div>';
        } else {
            echo 'Không có dữ liệu.';
        }
    }
    function updateinfokhoa($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = 0;
            if (isset($_REQUEST['id'])) {
                $layid = $_REQUEST['id'];
            }
            $hinh = $this->laycot("select hinh from khoa where id_khoa='$layid' limit 1");
            $tenkhoa = $this->laycot("select tenkhoa from khoa where id_khoa='$layid' limit 1");
            $mota = $this->laycot("select mota from khoa where id_khoa='$layid' limit 1");
            echo '<div class="modal-body">
                    <form action="" method="POST">                               
                        <label for="txtid"></label>
                        <input name="txtid" type="hidden" id="txtid" value="' . $layid . '" />
                        <div id="k_anh"><img src="../img/khoa/' . $hinh . '" width="150" height="150" /></div>
                        <div class="form-group">
                            <label class="font-weight-bolder"><b>Tên khoa: </b></label>
                            <input type="text" class="form-control" name="txtten" value="' . $tenkhoa . '">
                        </div>     
                        <div class="form-group">
                            <label for="textarea"><b>Mô tả:</b></label>
                            <textarea name="txtnoidung" id="txtnoidung">'.$mota.'</textarea>  
                        </div>  
                </div>   
                <div class="modal-footer">
                    <button type="submit" id="nut" style=" background-color: green; border-color:#7dff7d" name="capnhat" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                    <button type="submit" id="nut" name="xoa" value="Xóa" class="btn btn-danger">Xóa</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                    </form>
                
                ';
        } else {
            echo 'Không có dữ liệu.';
        }
        
    }
    function deletelichnghi($sql)
        {
            $link = $this->connect();
            $ketqua = mysqli_query($link,$sql);
            $i = mysqli_num_rows($ketqua);
            echo '<form method="POST">';
            echo'<table class="table table-bordered">
            <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                <td align="center">STT</td>
                <td align="center">Bác sĩ nghỉ</td>
                <td align="center">Ngày nghỉ</td>
                <td align="center">Thời gian nghỉ</td>
                <td align="center">Lý do nghỉ</td>
                
            </tr>';
            if($i>0)
            {
                $dem = 1;
                while($row = mysqli_fetch_array($ketqua))
                {
                    
                    $id_lichnghi = $row['id_lichnghi'];
                    //$array_ngaynghi = explode('_', $row['ngayhen']);
                    $ngaynghi = $row['ngayhen'];
                    $lydo = $row['lydo'];
                    $id_bacsi = $row['id_bacsi'];
                    $tenbacsi = $this->laycot("SELECT tenbacsi FROM bacsi WHERE id_bacsi = '.$id_bacsi.'");
                    echo '<tr>
                        <td><a href="?id_ln=' . $id_lichnghi . '">'.$dem.'</a></td>
                        <td><a href="?id_ln=' . $id_lichnghi . '">'.$tenbacsi.'</a></td>
                        <td><a href="?id_ln=' . $id_lichnghi . '">'.$ngaynghi.'</a></td>
                     
                        <td><a href="?id_ln=' . $id_lichnghi . '">'.$lydo.'</a></td>
                        <td align="center"><button onclick="?id_ln=' . $id_lichnghi . '"  class="btn btn-danger" name="nutxoa">Hủy</td>
                    </tr>';
                }
            }
            echo '</table>';
            echo'</form>';
        }

        function information($sql)
        {
            $link = $this->connect();
            $ketqua = mysqli_query($link, $sql);
            @mysqli_close($link);
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                $layid = $_SESSION['id_user'];
                $ten = $this->laycot("select tenadmin from admin where id_admin='$layid' limit 1");
                $namsinh = $this->laycot("select namsinh from admin where id_admin='$layid' limit 1");
                $gioitinh = $this->laycot("select gioitinh from admin where id_admin='$layid' limit 1");
                $sdt = $this->laycot("select sdt from admin where id_admin='$layid' limit 1");
                $diachi = $this->laycot("select diachi from admin where id_admin='$layid' limit 1");
                echo '
                    <div id="information_detail">
                        <div id="bs_ten"><b>Tên admin: </b>' . $ten . '</div>
                        <div id="bs_namsinh"><b>Năm sinh: </b>' . $namsinh . '</div>
                        <div id="bs_gioitinh"><b>Giới tính: </b>' . $gioitinh . '</div>
                        <div id="bs_sdt"><b>Số điện thoại: </b>' . $sdt . '</div>
                        <div id="bs_diachi"><b>Địa chỉ: </b>' . $diachi . '</div>
                    </div>';
            } else {
                echo 'Không có dữ liệu.';
            }
        }

        function show_lich_kham($id_phieudk){
			$link = $this->connect();
			$sql = "select * from phieudkkham where id_phieudk ='".$id_phieudk."'";
			$result = mysqli_query($link ,$sql);
			$lichkham = mysqli_fetch_all($result, MYSQLI_ASSOC);
			mysqli_free_result($result);
			mysqli_close($link);
			return $lichkham;
		}
        function timkiem($sql)
        {
            $link =$this->connect();
            $ketqua = mysqli_query($link,$sql);
            $i = mysqli_num_rows($ketqua);
            if($i>0)
            {
                echo '<table class="table table-bordered">
                    <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                        <th>STT</th>
                        <th>HỌ TÊN</th>
                        <th>GIỚI TÍNH</th>
                        <th>NĂM SINH</th>
                        <th>SỐ ĐIỆN THOẠI</th>             
                    </tr>';
            $dem = 1;
            while ($row = mysqli_fetch_array($ketqua)) {
                $id_benhnhan = $row['id_benhnhan'];
                $ten = $row['tenbenhnhan'];
                $gioitinh = $row['gioitinh'];
                $sdt = $row['sdt'];
                $namsinh = $row['namsinh'];
                echo '<tr>
                        <td style="text-align: center;"><a href="?id=' . $id_benhnhan . '">' . $dem . '</a></td>
                        <td style="text-align: left;"><a href="?id=' . $id_benhnhan . '">' . $ten . '</a></td>
                        <td><a href="?id=' . $id_benhnhan . '">' . $gioitinh . '</a></td>
                        <td><a href="?id=' . $id_benhnhan . '">' . $namsinh . '</a></td>
                        <td><a href="?id=' . $id_benhnhan . '">' . $sdt . '</a></td>     
                    </tr>';
                $dem++;
            }
            echo '</table>';
            }
        }
        function timkiemnvyt($sql)
        {
            $link =$this->connect();
            $ketqua = mysqli_query($link,$sql);
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                echo '<table class="table table-bordered">
                        <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                        <th>STT</th>
                        <th>HỌ TÊN</th>
                        <th>GIỚI TÍNH</th>
                        <th>SỐ ĐIỆN THOẠI</th>
                        <th>CHUYÊN KHOA</th>            
                    </tr>';
                $dem = 1;
                while ($row = mysqli_fetch_array($ketqua)) {
                    $id_bacsi = $row['id_nvyt'];
                    $ten = $row['tennvyt'];
                    $gioitinh = $row['gioitinh'];
                    $sdt = $row['sdt'];
                    $id_khoa = $row['id_khoa'];
                    echo '<tr>
                            <td style="text-align: center;"><a href="?id=' . $id_bacsi . '">' . $dem . '</a></td>
                            <td style="text-align: left;"><a href="?id=' . $id_bacsi . '">' . $ten . '</a></td>
                            <td><a href="?id=' . $id_bacsi . '">' . $gioitinh . '</a></td>
                            <td><a href="?id=' . $id_bacsi . '">' . $sdt . '</a></td>
                            <td style="text-align: left;"><a href="?id=' . $id_bacsi . '">' . $this->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") . '</a></td>     
                        </tr>';
                    $dem++;
                }
                echo '</table>';
            }
        }
        function timkiembacsi($sql)
        {
            $link =$this->connect();
            $ketqua = mysqli_query($link,$sql);
            $i = mysqli_num_rows($ketqua);
            if ($i > 0) {
                echo '<table class="table table-bordered">
                        <tr style=" border-bottom:1px solid #ccc; background-color:green; color: white;">
                        <th>STT</th>
                        <th>HỌ TÊN</th>
                        <th>GIỚI TÍNH</th>
                        <th>SỐ ĐIỆN THOẠI</th>
                        <th>CHUYÊN KHOA</th>            
                    </tr>';
                $dem = 1;
                while ($row = mysqli_fetch_array($ketqua)) {
                    $id_bacsi = $row['id_bacsi'];
                    $ten = $row['tenbacsi'];
                    $gioitinh = $row['gioitinh'];
                    $sdt = $row['sdt'];
                    $id_khoa = $row['id_khoa'];
                    echo '<tr>
                            <td style="text-align: center;"><a href="?id=' . $id_bacsi . '">' . $dem . '</a></td>
                            <td><a href="?id=' . $id_bacsi . '">' . $ten . '</a></td>
                            <td style="text-align: center;"><a href="?id=' . $id_bacsi . '">' . $gioitinh . '</a></td>
                            <td style="text-align: center;"><a href="?id=' . $id_bacsi . '">' . $sdt . '</a></td>
                            <td><a href="?id=' . $id_bacsi . '">' . $this->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") . '</a></td>     
                        </tr>';
                    $dem++;
                }
                echo '</table>';
            }
        }
}
