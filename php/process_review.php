<?php
include 'db_connect.php';

$message = "";
$status = "pending";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get Data from Form
    $name = $conn->real_escape_string($_POST['fullName']);
    $rating = (int)$_POST['rating'];
    $comment = $conn->real_escape_string($_POST['comment']);

    // Insert into Database
    $sql = "INSERT INTO reviews (reviewer_name, rating, comment) 
            VALUES ('$name', '$rating', '$comment')";

    if ($conn->query($sql) === TRUE) {
        $status = "success";
        $message = "Thank you for your review! Your feedback helps us improve.";
    } else {
        $status = "error";
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Review Submitted</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-5">
    <div class="container">
        <div class="card shadow text-center" style="max-width: 500px; margin: auto;">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Review Status</h3>
            </div>
            <div class="card-body">
                <?php if ($status == "success"): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>
                    <h1 class="display-1 text-warning">★★★★★</h1>
                    <p class="lead">We appreciate your feedback!</p>
                <?php else: ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>

                <a href="../html/index.html" class="btn btn-secondary mt-3">Back to Home</a>
            </div>
        </div>
    </div>
</body>

</html>