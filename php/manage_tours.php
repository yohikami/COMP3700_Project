<?php
include 'db_connect.php';

$search_term = "";

// INSERT 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];

    // Insert into DB
    $sql_insert = "INSERT INTO tours (name, price, duration) VALUES ('$name', '$price', '$duration')";
    $conn->query($sql_insert);
}

// SEARCH 
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    $sql = "SELECT * FROM tours WHERE name LIKE '%$search_term%'";
} else {
    $sql = "SELECT * FROM tours";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tours - MangaMaps</title>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body id="top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.html">
                <img src="../assets/images/logo.png" alt="MangaMaps Logo" height="38" width="38" class="me-3 rounded-circle">
                MangaMaps
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="../html/index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../html/tours.html">Tours</a></li>
                    <li class="nav-item"><a class="nav-link" href="../html/calculator.html">Calculator</a></li>
                    <li class="nav-item"><a class="nav-link" href="../html/booking.html">Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="../html/review.html">Reviews</a></li>
                    <li class="nav-item"><a class="nav-link" href="../html/questionnaire.html">Questionnaire</a></li>
                    <li class="nav-item"><a class="nav-link" href="../html/funPage.html">Quiz Game</a></li>
                    <li class="nav-item"><a class="nav-link " href="../html/about.html" aria-current="page">About</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../html/contact.html">Contact</a></li>
                    <li class="nav-item"><a class="nav-link active disabled fw-semibold" href="../php/manage_tours.php">Manage</a></li>

                    <!-- Divider -->
                    <li class="nav-item mx-2 d-none d-lg-block">
                        <span class="text-secondary">|</span>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-danger btn-sm px-3 py-1 fw-semibold" href="login.html">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="bg-danger text-white text-center py-5 shadow" style="margin-top: 56px;">
        <div class="container py-4">
            <h1 class="display-4 fw-bold mb-2" style="font-family: 'Noto Sans JP', sans-serif;">Manage Tours</h1>
            <p class="lead">Admin Panel for Adding, Editing, and Removing Tours</p>
        </div>
    </section>

    <div class="container py-5">

        <form action="manage_tours.php" method="GET" class="d-flex gap-2 mb-4" style="max-width: 600px; margin: 0 auto;">
            <input type="text" name="search" class="form-control" placeholder="Search by name..." value="<?php echo $search_term; ?>">
            <button type="submit" class="btn btn-dark">Search</button>
            <a href="manage_tours.php" class="btn btn-outline-secondary">Reset</a>
        </form>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Actions</th>
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
        </div>

        <hr class="my-5">

        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0 fw-bold">Add New Tour</h4>
            </div>
            <div class="card-body p-4">
                <form action="manage_tours.php" method="POST" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tour Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Kyoto Temple Run" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Price ($)</label>
                        <input type="number" name="price" class="form-control" placeholder="0.00" step="0.01" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Duration</label>
                        <input type="text" name="duration" class="form-control" placeholder="e.g. 5 days" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Add Tour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <h5 class="fw-bold mb-1">MangaMaps</h5>
            <p class="text-light small mb-2">© 2025 MangaMaps. All rights reserved.</p>
            <a href="#top" class="text-decoration-none text-light small">Back to top ↑</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>