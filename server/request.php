<?php

    include "func.php";

if (isset($_GET["action"])){
    if ($_GET["action"] == "request_login"){
        $email = $_GET["email"];
        $website = $_GET["website"];

        $c = connectDB();
            $sql = "insert into log(website,email,status) values('".$website."','".$email."',0)";
            if (executeDB($c,$sql)){
                echo "waiting mode";
            }

        disconnectDB($c);
    }


}

?>

<script>

function database(){
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.open("GET","request.php?action=get_status&email",false);
  xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("database").innerHTML=xmlhttp.responseText;
      }
      }
  xmlhttp.send();
}

setInterval(database,1000);

</script>
