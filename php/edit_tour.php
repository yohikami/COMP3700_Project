<?php
include 'db_connect.php';

$id = "";
$name = "";
$price = "";
$duration = "";
$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    // SQL Update Query
    $sql = "UPDATE tours SET name='$name', price='$price', duration='$duration' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to manage page after success
        header("Location: manage_tours.php");
        exit();
    } else {
        $message = "Error updating record: " . $conn->error;
    }
}

// FETCH EXISTING DATA
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tours WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $price = $row['price'];
        $duration = $row['duration'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-5">
    <div class="container">
        <div class="card shadow-sm" style="max-width: 600px; margin: auto;">
            <div class="card-header bg-warning">
                <h3 class="mb-0 fw-bold">Edit Tour</h3>
            </div>
            <div class="card-body">
                <?php if ($message): ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>

                <form action="edit_tour.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="mb-3">
                        <label class="form-label">Tour Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price ($)</label>
                        <input type="number" name="price" class="form-control" step="0.01" value="<?php echo $price; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" name="duration" class="form-control" value="<?php echo $duration; ?>" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="manage_tours.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Update Tour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>