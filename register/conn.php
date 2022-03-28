<?php
$server = "localhost";
$db_name = "webtech";
$pwd= "";
$user = "root";

$conn = mysqli_connect($server,$user,$pwd, $db_name);
if(!$conn){
    echo "Connection failed";
}else{
    // echo"Hurray we are connected";
}






?>