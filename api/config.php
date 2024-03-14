<?php
$ApiMode = "LOCAL";   //LIVE OR TEST OR LOCAL

if($ApiMode == "LOCAL"){

  $servername = "localhost"; $username = "root"; $password = ""; $db = "vclub_new";

}elseif($ApiMode == "TEST"){

  $servername = "localhost"; $username = "u664437076_grocery"; $password = ";9tYHTiD"; $db = "u664437076_grocery";

}elseif($ApiMode == "LIVE"){

  $servername = "localhost"; $username = "root"; $password = ""; $db = "easy";

}



$allowedOrigins = [
  "http://localhost:3000",
  "http://localhost:3000/",
  "http://192.168.66.190:3000",
  "http://localhost",
  "https://royalplay.live", 
];


if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins)) {
  header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Max-Age: 86400');
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  header("HTTP/1.1 200 OK");
  exit;
}


date_default_timezone_set("Asia/Calcutta");

$conn = new mysqli($servername, $username, $password, $db);
$LoginUserID = 0;
$CurrendDateTime = date("Y-m-d H:i:s");

function verifyUserToken($token){
  
  global $conn, $LoginUserID;

  $datajson = json_decode(decrypt($token),true);
  if(isset($datajson['Type'])){

    //For Users
    if($datajson['Type'] == "USER"){
       $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as rowcount, UserID FROM `user_logins`  WHERE `Token` = '$token' AND `isActive` = 1"));
      if($row['rowcount']==1){
        $LoginUserID = $row['UserID'];
        return true;
      }else{
        return false;
      }
    }

  }else{
    return false;
  }
}



// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function httpResponse($code,$data){
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode( $data );
}

function getUserIP() {
  $ip = $_SERVER['REMOTE_ADDR'];
  
  // Use a proxy or load balancer's IP address if available
  if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } elseif (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  }

  return $ip;
}

?>