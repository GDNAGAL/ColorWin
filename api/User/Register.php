<?php
include("../config.php");
require("../encryption.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	

    if (!isset($_POST['Mobile'])||$_POST['Mobile']=="") {
        $data = array("Status" => false, "Message" => "Please Enter Mobile No.");
        httpResponse(400, $data);
    } elseif (!isset($_POST['Password'])||$_POST['Password']=="") {
        $data = array("Status" => false, "Message" => "Please Enter Password.");
        httpResponse(400, $data);
    } elseif (!isset($_POST['ReferCode'])||$_POST['ReferCode']=="") {
        $data = array("Status" => false, "Message" => "Please Enter Invite Code.");
        httpResponse(400, $data);
    } elseif (!isset($_POST['AcceptTC'])||$_POST['AcceptTC']==false || $_POST['AcceptTC']=="") {
        $data = array("Status" => false, "Message" => "Please Accept Terms and Conditions.");
        httpResponse(400, $data);
    } elseif (!isset($_POST['CPassword'])|| $_POST['CPassword']=="") {
        $data = array("Status" => false, "Message" => "Please Enter Confirm Password.");
        httpResponse(400, $data);
    } else{

        $Mobile = $_POST['Mobile'];
        $Password = $_POST['Password'];
        $PasswordEnc = md5($_POST['Password']);
        $CPassword = $_POST['CPassword'];
        $ReferCode = $_POST['ReferCode'];
        $AcceptTC = $_POST['AcceptTC'];

        $FullName = generateRandomName();
        $Email = '';
        $OwnCode=createRandomReferCode();
        $isReferalBonusCredited=0;
        $Privacy=0;
        $Status=0;
        

        //Validate Mobile No.
        $chkValidMobile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(Mobile) as MobileCount FROM `users`  WHERE `Mobile` = '$Mobile' LIMIT 1"));
        if($chkValidMobile['MobileCount']>0){
            $data = array ("Status" => false, "Message" => "Mobile No. Already Registred With us.");
            httpResponse(400, $data);
            exit;
        }

        
        //Validate Passwords
        if($Password != $CPassword){
            $data = array ("Status" => false, "Message" => "Password and confirmed password not matched.");
            httpResponse(400, $data);
            exit;
        }
        
        //Validate Refferal Code
        $chkInviteCode = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(OwnCode) as OwnCode FROM `users`  WHERE `OwnCode` = '$ReferCode' LIMIT 1"));
        if($chkInviteCode['OwnCode']==0){
            $data = array ("Status" => false, "Message" => "Invalid Invite Code.");
            httpResponse(400, $data);
            exit;
        }

        //Register User
        $query = "INSERT INTO `users`(`FullName`, `Mobile`, `Email`, `Password`, `RefCode`, `OwnCode`, `isReferalBonusCredited`, `Privacy`, `Staus`, `CreatedAt`) VALUES (?, ?, ?, ?, ?, ?, ? ,?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->bind_param("ssssssiiis", $FullName, $Mobile, $Email, $PasswordEnc, $ReferCode, $OwnCode, $isReferalBonusCredited, $AcceptTC, $Status, $CurrendDateTime);
        if($statement->execute()){
                $data = array ("Status" => true, "Message" => "Registration Success.");
                httpResponse(201, $data);

        }else{

            $data = array ("Status" => false, "Message" => "Something Went Wrong");
            httpResponse(401, $data);

        }

    }
	
}else{

    $data = array ("Status" => false,"Message" => "GET Method Not Allowed.");
    httpResponse(405, $data);
	
}

?>