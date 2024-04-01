<?php 
include "config.php";

extract($_POST);

if(isset($_POST['aname']) && isset($_POST['aemail']) && isset($_POST['aaddress']) && isset($_POST['aphone']) );

$sql = "INSERT INTO `ajaxcrd` (`name`,`email`,`address`,`phone`) VALUES ('$aname','$aemail','$aaddress','$aphone')";

$res = $conn->query($sql);

if($res=true){
    echo "success";
}

?>