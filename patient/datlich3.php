<?php
session_start();
	
	include '../class/patient.php';
?>
<?php
$p = new patient();
if(isset($_POST['next'])):
	$_SESSION['bacsi'] = $_POST['bacsi'];	
	
endif;

$array_busy =[];
$lichhen = $p->show_lich_hen($_SESSION['bacsi'] ?? '');
$lichnghi = $p->show_lich_nghi($_SESSION['bacsi'] ?? '');
//$lichhentaikham = $p->show_lich_hentaikham($_SESSION['bacsi'] ?? '');

foreach ($lichhen as $val) {
		$val = explode('_', $val['ngayhen']);
		$array_busy[] = $val; 
	
}
foreach ($lichnghi as $key => $val) {
        $val = explode('_', $val['ngayhen']);
        $array_busy[] = $val;
}

date_default_timezone_set('Asia/Ho_Chi_Minh');


if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
   
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y / m', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {

    $date = $ym . '-' . $day;
    // $date = '2020-06-1';
    if ($today == $date) {
        $week .= '<td class="today">'."<span class='font-weight-bolder'>". $day ."</span>";
    } else {
        $week .= '<td>' ."<span class='font-weight-bolder'>". $day ."</span>";
    }

    if($str % 7 == 0 || strtotime($date) < strtotime($today)):
        // echo date('Y-m-j', strtotime($date)).'<br>';
        $caLamViec = "<br>
        <p class='text-danger font-weight-bolder'>CLOSED</p>";
    else:
        $caLamViec = "<br>
            <label><input type='radio' name='ngayhen' value='1_$date'>07:00 - 09:00</label> <br>

            <label><input type='radio' name='ngayhen' value='2_$date'>09:00 - 11:00</label> <br>
            
            <label><input type='radio' name='ngayhen' value='3_$date'>13:00 - 15:00</label> <br>
            
            <label><input type='radio' name='ngayhen' value='4_$date'>15:00 - 17:00</label>";
           
        // foreach ($array_busy as $key => $val) {
         
        //   if($val[1] == $date):
        //   switch ($val[0]) {
        //     case '1':   
        //         if($count==2)
        //         {
        //       $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='1_$date'>07:00 - 09:00</label>", "<label><input type='radio' name='ngayhen' value='1_$date' disabled>07:00 - 09:00</label><span class ='text-danger ml-1'> FULL </span>", $caLamViec);
        //         }
        //       break;
        //     case '2':
        //       $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='2_$date'>09:00 - 11:00</label>", "<label><input type='radio' name='ngayhen' value='2_$date' disabled>09:00 - 11:00</label><span class ='text-danger ml-1'> FULL </span>", $caLamViec);
        //       break;
        //     case '3':
        //       $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='3_$date'>13:00 - 15:00</label>", "<label><input type='radio' name='ngayhen' value='3_$date' disabled>13:00 - 15:00</label><span class ='text-danger ml-1'> FULL </span>", $caLamViec);
        //       break;
        //     case '4':
        //       $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='4_$date'>15:00 - 17:00</label>", "<label><input type='radio' name='ngayhen' value='4_$date' disabled>15:00 - 17:00</label><span class ='text-danger ml-1'> FULL </span>", $caLamViec);
        //       break;    
        //     default:
        //       break;
        //   }
        //   endif; 
        // }                 
    endif;    
    foreach ($array_busy as $key => $val) {
         $sql = "SELECT * FROM phieudkkham";
         $ketqua = mysqli_query($p->connect(),$sql);
         $row = mysqli_fetch_array($ketqua);
        
          if($val[1] == $date):
          switch ($val[0]) {
            case '1':   
            $count1 = $p->laycot("SELECT count(ngayhen) FROM phieudkkham WHERE ngayhen = '1_$date' ");
            $count1_nn = $p->laycot("SELECT count(ngayhen) FROM lichnghi WHERE ngayhen = '1_$date' ");
            if($count1 ==2){
              $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='1_$date'>07:00 - 09:00</label>", "<label><input type='radio' name='ngayhen' value='1_$date' disabled>07:00 - 09:00</label><span class ='text-danger ml-1'> FULL </span>", $caLamViec);
            }
            else if($count1_nn == 1)
            {
                $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='1_$date'>07:00 - 09:00</label>", "<label><input type='radio' name='ngayhen' value='1_$date' disabled>07:00 - 09:00</label><span class ='text-danger ml-1'> OFF </span>", $caLamViec);
            }
              break;
            case '2':
                $count2 = $p->laycot("SELECT count(ngayhen) FROM phieudkkham WHERE ngayhen = '2_$date' ");
                $count2_nn = $p->laycot("SELECT count(ngayhen) FROM lichnghi WHERE ngayhen = '2_$date' ");
                if($count2 == 2){
                     $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='2_$date'>09:00 - 11:00</label>", "<label><input type='radio' name='ngayhen' value='2_$date' disabled>09:00 - 11:00</label><span class ='text-danger ml-1'> FULL </span>", $caLamViec);
                }
                elseif ($count2_nn==1)
                {
                    $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='2_$date'>09:00 - 11:00</label>", "<label><input type='radio' name='ngayhen' value='2_$date' disabled>09:00 - 11:00</label><span class ='text-danger ml-1'> OFF </span>", $caLamViec);
                }
              break;
            case '3':
                $count3 = $p->laycot("SELECT count(ngayhen) FROM phieudkkham WHERE ngayhen = '3_$date' ");
                $count3_nn = $p->laycot("SELECT count(ngayhen) FROM lichnghi WHERE ngayhen = '3_$date' ");
                if($count3 == 2){
                    $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='3_$date'>13:00 - 15:00</label>", "<label><input type='radio' name='ngayhen' value='3_$date' disabled>13:00 - 15:00</label><span class ='text-danger ml-1'> FULL </span>", $caLamViec);
                }
                elseif($count3_nn==1)
                {
                    $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='3_$date'>13:00 - 15:00</label>", "<label><input type='radio' name='ngayhen' value='3_$date' disabled>13:00 - 15:00</label><span class ='text-danger ml-1'> OFF </span>", $caLamViec);
                }
              break;
            case '4':
                $count4 = $p->laycot("SELECT count(ngayhen) FROM phieudkkham WHERE ngayhen = '4_$date' ");
                $count4_nn = $p->laycot("SELECT count(ngayhen) FROM lichnghi WHERE ngayhen = '4_$date' ");
                if($count4 == 2){
                    $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='4_$date'>15:00 - 17:00</label>", "<label><input type='radio' name='ngayhen' value='4_$date' disabled>15:00 - 17:00</label><span class ='text-danger ml-1'> FULL </span>", $caLamViec);
                }
                elseif($count4_nn==1)
                {
                    $caLamViec = str_replace("<label><input type='radio' name='ngayhen' value='4_$date'>15:00 - 17:00</label>", "<label><input type='radio' name='ngayhen' value='4_$date' disabled>15:00 - 17:00</label><span class ='text-danger ml-1'> OFF </span>", $caLamViec);
                }
              break;    
            default:
              break;
          }
          endif; 
        }        
    $week .= $caLamViec.'</td>';
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
        $week = '';
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
    <style>
        
        #calendar td:hover{
            background-color: #e5e5e5;
        }
        h3 {
            margin-bottom: 20px;
        }
        th {
            height: 30px;
            text-align: center;
        }
        td {
            height: 70px;
        }
        .today {
            background: #f2f2f2;
        }
        th:nth-of-type(1), td:nth-of-type(1) {
            /*color: black;*/
        }
        th:nth-of-type(7), td:nth-of-type(7) {
            color: blue;
        }


    </style>
    <div class="container mt-1 mb-3">
    	<h3 class="text-center font-weight-bolder mt-4 mb-2">Xác nhận thời gian khám.</h3>
    	<div class=" row justify-content-center">
    		<div class="col-1 text-right"><h3><a href="?ym=<?php echo $prev; ?>">&lt;&lt;&lt;</a></h3></div>
    		<div class="col-2 text-center pt-1"><h5 class="font-weight-bolder"> <?php echo $html_title; ?> </h5></div>
    		<div class="col-1 text-left"><h3><a href="?ym=<?php echo $next; ?>">&gt;&gt;&gt;</a></h3></div>
    	</div>
        <table class="table table-bordered" id = "calendar">
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thur</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            <form action="savelich.php" method="POST">
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
            <div class="row justify-content-center">
                <div class="col-2 text-right">
                    <a href="datlich2.php" class="btn btn-secondary">Quay lại</a>
                </div>
                <div class="col-2 text-left">
                    
                    <input type="hidden" name="trieuchung" value="<?php echo $_POST['trieuchung']; ?>">
                    <input type="hidden" name="bacsi" value="<?php echo $_POST['bacsi'];?>">
                    <button type="submit" name="datlich" class="btn btn-success">Đặt lịch</button>
                </div>
            </div>
            </form>
    </div>
    </body>

</html>