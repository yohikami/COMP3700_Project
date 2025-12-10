<?php
include 'db_connect.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM tours WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Redirect back to the Manage page (so the user doesn't get stuck here)
header("Location: manage_tours.php");
exit();
