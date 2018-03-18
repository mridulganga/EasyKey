<?php

include "func.php";

if (isset($_GET["action"])){
    switch ($_GET["action"]){
        case "form_view":
            //generate form
            echo "<center><h2>Register for EasyKey</h2><br><br>";
            echo generateForm();
            echo "</center>";
            //echo it to the screen
        break;
        case "form_submit":
            //get the info into variables
            $ret = addNewUser($_GET["name"],$_GET["email"],$_GET["mob"],$_GET["rfid"],$_GET["pass"]);
            $v = json_decode($ret);
            echo $v->info;
            //add info to the DB
            //send reply that register was successfull
            //perform login
        break;
        case "form_submit_app":
            //get the info into vars
            //add info to the DB
            //reply with yes or no (to the app)
            addNewUser($_GET["name"],$_GET["email"],$_GET["mob"],$_GET["rfid"],$_GET["pass"]);

        break;

        case "web_register_request":
            $url = $_GET["url"];
            $email = $_GET["email"];
            //check if the email exists in the DB
            //if email is not there then reply with not found
            //if user is present then add entry in db
            //send firebase request to android with id from DB
        break;
        default:
    }
}
elseif (isset($_POST["action"])){
    if ($_POST["action"]=="form_submit_app"){
            //get the info into vars
            //add info to the DB
            //reply with yes or no (to the app)
        echo addNewUser($_POST["name"],$_POST["email"],$_POST["mob"],$_POST["rfid"],$_POST["pass"]);
    }
}
else{
            echo "<center><h2>Register for EasyKey</h2><br><br>";
            echo generateForm();
            echo "</center>";
}


function generateForm(){
    $html = '<form action="register.php" method="get">
                <input type="hidden" name="action" value="form_submit"><br><br>
                <input type="text" name="name" placeholder="Full Name"><br><br>
                <input type="number" name="mob" placeholder="Mobile Number"><br><br>
                <input type="text" name="rfid" placeholder="Pay Card Number"><br><br>
                <input type="text" name="email" placeholder="Email"><br><br>
                <input type="password" name="pass" placeholder="Password"><br><br>
                <input type="submit" value="Register">
            </form>';
    return $html;
}


function addNewUser($name,$email,$mob,$rfid,$pass){
    $c = connectDB();
    $id;


    $sql = "select * from user where email='".$email."'";
    $t = queryDB($c,$sql);
    print_r($t);

    $pass = hash("sha256",$pass);
    $sql = "insert into user(Name,Email,Mob,RFID,Pass) values('".$name."','".$email."','".$mob."','".$rfid."','".$pass."')";
    echo $sql;
    if (executeDB($c,$sql)){
        $sql = "select id from user where email='".$email."'";
        $res = queryDB($c,$sql);
        $row = $res->fetch_assoc();
        disconnectDB($c);

        $obj2->userid = $row["id"];
        $obj2->info = "User created";
        $obj2->success = 1;
        return json_encode($obj2);
    }
    else{
        disconnectDB($c);
        $obj3->success=0;
        $obj3->info="User could not be created";
        return json_encode($obj3); 
    }

    disconnectDB($c);
}

?>
