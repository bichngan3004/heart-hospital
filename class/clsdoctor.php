<?php
class doctor
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
    function loadinfo($sql)
    {
        $link = $this->connect();

        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = $_SESSION['id_user'];
            $anh = $this->laycot("select hinhanh from bacsi where id_bacsi='$layid' limit 1");
            $ten = $this->laycot("select tenbacsi from bacsi where id_bacsi='$layid' limit 1");
            $namsinh = $this->laycot("select namsinh from bacsi where id_bacsi='$layid' limit 1");
            $gioitinh = $this->laycot("select gioitinh from bacsi where id_bacsi='$layid' limit 1");
            $sdt = $this->laycot("select sdt from bacsi where id_bacsi='$layid' limit 1");
            $chucvu = $this->laycot("select chucvu from bacsi where id_bacsi='$layid' limit 1");
            $diachi = $this->laycot("select diachi from bacsi where id_bacsi='$layid' limit 1");
            $id_khoa = $this->laycot("select id_khoa from bacsi where id_bacsi='$layid' limit 1");
            $mota = $this->laycot("select mota from bacsi where id_bacsi='$layid' limit 1");
            $noidung = $this->laycot("select noidung from bacsi where id_bacsi='$layid' limit 1");
            echo '
                <div class="row" style="width:100%; margin-left:15px;">
                    <label for="txtid"></label>
                    <input name="txtid"  type="hidden"  id="txtid" value="' . $layid . '" />       
                    <div class="col-md-2 col-sm-6 col-xs-12" id="bs_anh">
                        <img src="../img/' . $anh . '" width="150" height="150" />
                        <p style=" padding-top:20px; padding-left:30px;"><a href ="#" data-toggle="modal" data-target="#change_image"><i>Thay đổi ảnh</i></a></p>
                    </div>
                    <div class="col-md-9 col-sm-6 col-xs-12" id="information_detail" style="margin-left:10px">
                        <div id="bs_ten"><b>Tên bác sĩ: </b>' . $ten . '</div>
                        <div id="bs_namsinh"><b>Năm sinh: </b>' . $namsinh . '</div>
                        <div id="bs_gioitinh"><b>Giới tính: </b>' . $gioitinh . '</div>
                        <div id="bs_sdt"><b>Số điện thoại: </b>' . $sdt . '</div>
                        <div id="bs_diachi"><b>Địa chỉ: </b>' . $diachi . '</div>
                        <div id="bs_chuyenkhoa"><b>Chuyên khoa: </b>' . $this->laycot("select tenkhoa from khoa where id_khoa ='$id_khoa'") . '</div>
                        <div id="bs_chucvu"><b>Chức vụ: </b>' . $chucvu . '</div>
                        <div id="bs_mota"><b>Mô tả: </b>' . $mota . '</div>
                    
                        <button type="button"  style="margin-top:15px;background-color: green; border-color:#7dff7d" class="btn btn-primary"  data-toggle="modal" data-target="#capnhat">Cập nhật</button>
                        <button type="button" style="margin-top:15px" class="btn btn-danger" ><a href="../logout.php" style="color:white;text-decoration: none;">Đăng xuất</a></button>
                    </div>
                </div>
                <div class="row" style="width:90%; margin-left:15px;">
                    <div id="bs_noidung"><b>Nội dung: </b>' . $noidung . '</div>
                </div>
                ';
        } else {
            echo 'Không có dữ liệu.';
        }
    }
    function updateinfo($sql)
    {
        $link = $this->connect();

        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = $_SESSION['id_user'];
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
                            <div class="col-md-5">
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
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Năm sinh: </b></label>
                                    <input type="text" class="form-control" name="txtns" value="' . $namsinh . '">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Số điện thoại: </b></label>
                                    <input type="text" class="form-control" name="txtsdt"  minlength="8" maxlength="10"  value="' . $sdt . '">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bolder"><b>Chức vụ: </b></label>
                                    <input type="text" class="form-control" name="txtchucvu"  value="' . $chucvu . '">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Địa chỉ: </b></label>
                                <input type="text" class="form-control" name="txtdiachi"  value="' . $diachi . '">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bolder"><b>Mô tả: </b></label>
                                <input type="text" class="form-control" name="txtmota"  value="' . $mota . '">
                            </div>
                            <div class="form-group">
                                <label for="textarea"><b>Nội dung:</b></label>
                                <textarea name="txtnoidung" id="txtnoidung">' . $noidung . '</textarea>  
                            </div>
                        </div>
                                
                        
                       
                </div>   
                <div class="modal-footer">
                    <button type="submit" style="background-color: green; border-color:#7dff7d" id="nut" name="capnhat" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                    </form>
                
                ';
        } else {
            echo 'Không có dữ liệu.';
        }
    }

    //Lịch khám
    function loaddetailsdoctor()
    {
        $link = $this->connect();
        $sql = "select * from bacsi limit 1";
        $ketqua = mysqli_query($link, $sql);
        @mysqli_close($link);
        $i = mysqli_num_rows($ketqua);
        if ($i > 0) {
            $layid = 0;
            if (isset($_REQUEST['id'])) {
                $layid = $_REQUEST['id'];
            }
            $noidung = $this->laycot("select noidung from bacsi where id_bacsi='$layid' limit 1");
            echo '<div>' . $noidung . '</div>';
        }
    }
    function show_toathuoc($id_phieukham)
    {
        $link = $this->connect();
        $sql = "select * from toathuoc where id_phieukham = '$id_phieukham' ";
        $result = mysqli_query($link, $sql);
        $toathuoc = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($link);
        return $toathuoc;
    }
    function timkiemlist($sql)
    {
        $link = $this->connect();
        $ketqua = mysqli_query($link,$sql);
        $i = mysqli_num_rows($ketqua);
        if($i>0)
        {
            echo' <table class="table table-bordered" style="margin-bottom: 50px; width:102%">
            <tr style=" border-bottom:1px solid #ccc; background-color:green; color:white">
                <th>STT</th>
                <th>BỆNH NHÂN</th>
                <th>TRIỆU CHỨNG</th>
                <th>NGÀY HẸN KHÁM</th>
                <th>GIỜ HẸN</th>
                <th>TRẠNG THÁI</th>

            </tr>';
            $i = 0;
            while($row = mysqli_fetch_array($ketqua))
            {
                $id_phieudkkham = $row['id_phieudk'];
                $id_benhnhan = $row['id_benhnhan'];
                $token = $row['token'];
                $trieuchung = $row['trieuchung'];
                $ngayhen = $row['ngayhen'];
                $id_bacsi = $row['id_bacsi'];
                $array_ngayhen = explode('_', $row['ngayhen']);
                echo '
                    <tr>
                        <td><a href="?id=' . $id_phieudkkham . '">' . $i . '</a></td>
                        <td>
                        <a href="?id=' . $id_phieudkkham . '">' .

                        $this->laycot("select tenbenhnhan from benhnhan where id_benhnhan ='$id_benhnhan' and token='$token'")
                        . '</a>
                        </td>
                        <td>
                        <a href="?id=' . $id_phieudkkham . '">' . $trieuchung . '</a>
                        </td>
                    </tr>
                ';
            }
            $i++;
            echo '</table>';
        }
    }
}
