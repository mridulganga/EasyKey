<?php

include "func.php";


if (isset($_GET["action"])){
    switch ($_GET["action"]){
        case "form_view":
            //generate form
            echo generateForm();
            //echo it to the screen
        break;
        case "form_submit":
            //get the info into variables
            //compare info with DB info
            //If info matches then perform login
        break;
        case "form_submit_app":
            //get the info into vars
            //compare vars with DB info
            //reply with yes or no (to the app)
        break;
        default:
    }
}


if (isset($_POST["action"])){
    if ($_POST["action"]=="form_submit_app")
            //get the info into vars
            //compare vars with DB info
            //reply with yes or no (to the app)    
    }
}

function generateForm(){
    $html = '<form action="login.php" method="get">
                <input type="hidden" name="action" value="form_submit">
                <input type="text" name="id" placeholder="Email">
                <input type="password" name="pass" placeholder="Password">
                <input type="submit" value="Login">
            </form>';
    return $html;
}

function performLogin($userid,$pass){
    $c = 

}

?>
