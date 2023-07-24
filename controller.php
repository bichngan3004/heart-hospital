<?php
session_start();
require_once("class/config_google.php");

//set connect
$conn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DATABASE);
IF(!$conn)
{
    echo 'Khong ket noi duoc toi co so du lieu' . PHP_EOL;
    ECHO 'Debugging errno:' . mysqli_connect_errno() . PHP_EOL;
    ECHO 'Debugging error:' . mysqli_connect_error() . PHP_EOL;
    exit();
}

//call google api
require_once 'google-api/vendor/autoload.php';
$client = new Google_Client();
$client -> setClientId(GOOGLE_APP_ID);
$client -> setClientSecret(GOOGLE_APP_SECRET);
$client -> setRedirectUri(GOOGLE_APP_CALLBACK_URL);
$client -> addScope("email");
$client -> addScope("profile");

if(isset($_GET["code"]))
{
    $token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;
    $token = $google_account_info->id;
     $_SESSION['user_token'] = $token; 
    $_SESSION['token'] 	= $client->getAccessToken();
    $check = "SELECT * FROM taikhoan WHERE email='".$email."' and tentaikhoan = '".$name."'";
    $result = mysqli_query($conn,$check);
    $rowcount = mysqli_num_rows($result);
    if($rowcount>0)
    {
        $userinfo = mysqli_fetch_assoc($result);
         $_SESSION['user_token'] = $token;
    }
    else
    {
        $sql2 = "INSERT INTO benhnhan (id_benhnhan,tenbenhnhan,token) values (null,'".$name."','".$token."')";
        if(mysqli_query($conn,$sql2))
        {
            $last_id = mysqli_insert_id($conn);
            $sql = "INSERT INTO taikhoan(email,tentaikhoan,phanquyen,id_user,token) VALUES ('".$email."','".$name."','1','".$last_id."','".$token."')";
            $kq = mysqli_query($conn,$sql);
            header("location: index.php");
        }
    }
    // save user data into session
    session_start();
    //$_SESSION['user_token'] = $token;
    header("location:patient/index.php");
}
else{
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        
        <meta http-equiv="refresh" content="0.1; url= <?php echo $client->createAuthUrl();?>">
        
    </head>
    <?php
}

?>
