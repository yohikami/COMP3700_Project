<?php
include 'db_connect.php';

$search_term = ""; // Stores what the user typed

// INSERTION
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    // Insert into DB
    $sql_insert = "INSERT INTO tours (name, price, duration) VALUES ('$name', '$price', '$duration')";
    $conn->query($sql_insert);
}


// Check if the search box was used
if (isset($_GET['search'])) {

    // Get the text the user typed
    $search_term = $_GET['search'];

    // Write Query: Find names that are "LIKE" the search term
    $sql = "SELECT * FROM tours WHERE name LIKE '%$search_term%'";
} else {

    // Fallback: If no search, select ALL tours
    $sql = "SELECT * FROM tours";
}

$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Tours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">
    <div class="container">
        <h2 class="text-danger fw-bold mb-4">Manage Tours</h2>

        <form action="manage_tours.php" method="GET" class="d-flex gap-2 mb-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name..." value="<?php echo $search_term; ?>">
            <button type="submit" class="btn btn-dark">Search</button>
            <a href="manage_tours.php" class="btn btn-outline-secondary">Reset</a>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>$<?php echo $row['price']; ?></td>
                            <td><?php echo $row['duration']; ?></td>
                            <td>
                                <a href="edit_tour.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_tour.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No tours found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <hr class="my-5">

        <h3 class="fw-bold">Add New Tour</h3>
        <form action="manage_tours.php" method="POST" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Tour Name" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="price" class="form-control" placeholder="Price ($)" step="0.01" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="duration" class="form-control" placeholder="Duration (e.g. 5 days)" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Add Tour</button>
            </div>
        </form>
    </div>
</body>

</html>