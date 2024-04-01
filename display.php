<?php
include 'config.php';

$sql = "SELECT * FROM `ajaxcrd`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display data as a table
    echo '<table class="table table-striped">';
    echo '<thead>
    <tr><th>Name</th>
    <th>Email</th>
    <th>Address</th>
    <th>Phone</th>
    <th colspan="2">Action</th>
    </tr>
    </thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['address'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        // echo '<td><button class=" user_edit btn btn-primary" onclick="editRecord(' . $row['id'] . ')">Edit</button></td>';
        echo '<td><button class="user_edit btn btn-primary" data-id="' . $row['id'] . '">Edit</button></td>';
        echo '<td><button class="btn btn-danger" onclick="deleteRecord(' . $row['id'] . ')">Delete</button></td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>No data found</p>';
}

$conn->close();
?>
