<?php
include 'config.php';

if(isset($_POST['edit'])) {
    $id = $_POST['id'];
    
    $sql = "SELECT * FROM `ajaxcrd` WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(array('error' => 'User not found'));
    }
} elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
    $uname = $_POST['name'];
    $uemail = $_POST['email'];
    $uphone = $_POST['phone'];
    $uaddress = $_POST['address'];

    $sql = "UPDATE `ajaxcrd` SET name='$uname', email='$uemail', phone='$uphone', address='$uaddress' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => 'User updated successfully'));
    } else {
        echo json_encode(array('error' => 'Error updating user: ' . $conn->error));
    }
} else {
    echo json_encode(array('error' => 'Invalid request'));
}
?>
