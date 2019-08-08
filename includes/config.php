<?php
ob_start();

$timezone = date_default_timezone_set("Pacific/Auckland");

$con = mysqli_connect("localhost","root","","musicplayer");

if(mysqli_connect_errno()){
    echo "Failed to connect: ".mysqli_connect_errno();
}


?>