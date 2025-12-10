<?php
include 'db_connect.php';

$message = "";
$status = "pending";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $conn->real_escape_string($_POST['fullName']); # I Put $conn->real_escape_string to prevent SQL injection 
    $email = $conn->real_escape_string($_POST['email']);
    $destination = $conn->real_escape_string($_POST['destination']);
    $travelers = (int)$_POST['travelers'];
    $travel_date = $_POST['travelDate'];
    $special_requests = $conn->real_escape_string($_POST['specialRequests']);

    // Create the SQL Insert Query
    $sql = "INSERT INTO bookings (full_name, email, destination, travelers, travel_date, special_requests)
            VALUES ('$full_name', '$email', '$destination', '$travelers', '$travel_date', '$special_requests')";

    // Run the query
    if ($conn->query($sql) === TRUE) {
        $status = "success";
        $message = "Booking confirmed successfully! We will contact you at " . $email;
    } else {
        $status = "error";
        $message = "Error: " . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-5">
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-danger text-white">
                <h2 class="mb-0">Booking Status</h2>
            </div>
            <div class="card-body">

                <?php if ($status == "success"): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>

                    <h4 class="mt-4">Booking Details</h4>
                    <table class="table table-bordered table-striped mt-3">
                        <tr>
                            <th style="width: 30%">Full Name</th>
                            <td><?php echo $full_name; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <th>Destination</th>
                            <td><?php echo $destination; ?></td>
                        </tr>
                        <tr>
                            <th>Travelers</th>
                            <td><?php echo $travelers; ?></td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td><?php echo $travel_date; ?></td>
                        </tr>
                        <tr>
                            <th>Requests</th>
                            <td><?php echo $special_requests; ?></td>
                        </tr>
                    </table>

                <?php else: ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>

                <a href="../html/index.html" class="btn btn-secondary mt-3">Back to Home</a>
            </div>
        </div>
    </div>
</body>

</html>