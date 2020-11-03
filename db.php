<?php

    $db_host = "127.0.0.1";
    $db_user = "root";
    $db_password = "";
    $db_name = "cms";


    $baglan = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if(!$baglan){
        die("Connection failed : " . mysqli_connect_error());
    }


?>