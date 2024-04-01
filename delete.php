<?php
include "config.php";

if(isset($_GET['deleteid'])){
    $uid = $_GET['deleteid'];
    $sql = "DELETE FROM `ajaxcrd` WHERE id =  $uid";
    $res = $conn->query($sql);

}

?>