<?php

include "func.php";

// if(isset($_POST["rfid"])){
//     //get the rfid number
//     //get the user id
//     $rfid = $_POST["rfid"];
//     //$userid = getUserId($rfid);
//     $userid=2;
//     addPaymentRequest($userid,$rfid);
//     //add record in the payment table
//     //firebase request to android
// }


		$arr["090096E8E691"]="mridul.kepler@gmail.com";
        $arr["090096E07708"]="akanuragkumar712@gmail.com";
        $arr["8400CE408A80"]="innovatinganuragkumar@gmail.com";

$key= 'AAAAOGofpio:APA91bGtxHUhN1cji0KmCi2O7R9wbSO6s9LZUZWe522CaA7VdCqmH2l7Re-2TALp_Ux1FjGXZeCKVX12Qt7cszWBGQ3Jq9It7cSI9-69Mp4svSnV6qMh6WoajShalw7P0Cho5zyAE88q';

//swsguest01
//S!emen$WiFi@2017
//bang_hack_2017

if(isset($_GET["rfid"])){
    //get the rfid number
    //get the user id
    $rfid = $_GET["rfid"];


    switch ($_GET["context"]){
       
        case "attendance":  
            //get usn 
        	//$usn = $_GET["usn"];            //mark attendance
  			echo "RFID ".$_GET["rfid"]." Class Attended";
            break;

        case "pay-per-print":
            $doc = $_GET["doc"];
            //will give amount to be deducted from card
            echo "RFID ".$_GET["rfid"]." amount deducted is :40";
            break;
            
        case "item-inventory":
            //$item_code = $_GET["item_code"];
            echo "RFID ".$_GET["rfid"]." item has been taken";
            break;

       case "door_unlock":
            //make door unlock in specified area
          echo "RFID".$_GET["rfid"]." rfid authenticated";
            break;
        case "attendance":
            //get usn
            //mark attendance
        	echo "RFID ".$_GET["rfid"]." Class Attended";
            break;

        case "health":
            $token = file_get_contents("https://easykey-160212.firebaseio.com/userinfo/".md5($arr[$_GET["rfid"]])."/medical.json");
            //$token = file_get_contents("https://easykey-160212.firebaseio.com/userinfo/857c8158090d7c11a3bcbd403dc628dc/medical.json");
            echo "{".substr(stripcslashes($token),1)."}";
            // $jd = json_decode("{".substr(stripcslashes($token),1)."}");
            // print_r ($jd);
            break;

        case "payment":

             $amount = $_GET["amount"];
             $vendor = $_GET["vendor"];

             $token = file_get_contents("https://easykey-160212.firebaseio.com/user/".md5($arr[$_GET["rfid"]]).".json");
             //echo substr($token, 1,$token.length-1);
             $data->requester= $vendor;
             $data->context= "payment";
             $notif->title="EasyKey";
             $notif->body= $vendor." has requested payment of ".$amount;

             $body->notification=$notif;
             $body->data=$data;
             $body->to=substr($token, 1,$token.length-1);



             $body_json = json_encode($body);


            echo $body_json;

             $ch =curl_init('https://fcm.googleapis.com/fcm/send');
             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
             curl_setopt($ch, CURLOPT_POSTFIELDS, $body_json);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             		'Content-Type: application/json',
             		'Content-Length: '.strlen($body_json),
             		'Authorization: key='.$key
             	));

             if ($res = curl_exec($ch))
                echo $res;
            else
                echo "You failed yet again!";


            //http://192.168.1.6/EasyKey/rfid.php?rfid=1234&context=payment&vendor=abc&amount=12
             echo "Payment done";
             break;
    }

}


?>
