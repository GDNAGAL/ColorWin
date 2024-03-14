<?php
include("../config.php");
require("../encryption.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	

    if(!isset($_POST['Username']) || !isset($_POST['Password']) || $_POST['Username'] == "" || $_POST['Password'] ==""){
        $data = array ("Status" => false, "Message" => "Please Enter Username or Password");
        httpResponse(400,$data);
    }else{

        $myusername = mysqli_real_escape_string($conn,$_POST['Username']);
        $mypassword = md5(mysqli_real_escape_string($conn,$_POST['Password'])); 

        $result = mysqli_query($conn, "SELECT * FROM `users`  WHERE `Mobile` = '$myusername' AND `Password` = '$mypassword' LIMIT 1");
        if (mysqli_num_rows($result)==1) {
            $row = mysqli_fetch_assoc($result);
            
                $loginDateTime = $CurrendDateTime; 
                $row['loginDateTime'] = $loginDateTime;
                $accesstoken = encrypt(json_encode($row));
                $UserID = $row['ID'];
                $UserIP = getUserIP();
                $isActive = 1;
                $Success = 1;
                
                // mysqli_query($conn,"INSERT INTO `user_logins` (`UserID`, `Token`, `Created_At`, `isActive`, `IP_Address`, `Success`) VALUES ($UserID, '$accesstoken', '$loginDateTime', 1, '$UserIP', 1)");
                // mysqli_query($conn,"CALL setUserAllowedLogins($UserID)");

                $data = array ("Status" => true, "Message" => "Login Success", "Token" => $accesstoken);
                httpResponse(200, $data);

        }else{

            $data = array ("Status" => false, "Message" => "Incorrect Username And Password");
            httpResponse(401, $data);

        }

    }
	
}else{

    $data = array ("Status" => false,"Message" => "GET Method Not Allowed.");
    httpResponse(405, $data);
	
}

?>