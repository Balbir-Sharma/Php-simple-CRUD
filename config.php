<?php
$servername = "localhost";
$username ="root";
$password = "";
$db ="rough";

$conn = mysqli_connect($servername,$username,$password,$db);
if(!$conn){
    echo "not connect";
}
?>