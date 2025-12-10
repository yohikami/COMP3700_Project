<?php
include 'db_connect.php';

class Tour
{
    public $name;
    public $price;
    public $duration;
    public $image;

    // Constructor
    public function __construct($name, $price, $duration, $image)
    {
        $this->name = $name;
        $this->price = $price;
        $this->duration = $duration;
        $this->image = $image;
    }
}

// Get Data from DB
$sql = "SELECT * FROM tours";
$result = $conn->query($sql);

// Array of Objects to hold tours
$toursArray = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { # fetch_assoc() in short fetches a result row as an associative array
        // Create a new Object for each tour
        $tourObj = new Tour($row["name"], $row["price"], $row["duration"], $row["image_url"]);
        // Add to array
        array_push($toursArray, $tourObj);
    }
}


function displayTours($tours)
{
    if (empty($tours)) {
        echo "<div class='alert alert-warning'>No tours found.</div>";
        return;
    }

    echo '<div class="row g-4">';
    foreach ($tours as $t) {
        echo '
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="../' . $t->image . '" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Tour Image">
                <div class="card-body">
                    <h5 class="card-title fw-bold">' . $t->name . '</h5>
                    <p class="card-text text-muted">Duration: ' . $t->duration . '</p>
                    <h4 class="text-danger">$' . $t->price . '</h4>
                </div>
            </div>
        </div>';
    }
    echo '</div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Our Tours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="../html/index.html">MangaMaps</a>
        </div>
    </nav>

    <div class="container pb-5">
        <h1 class="text-center fw-bold mb-5 text-danger">Available Tours</h1>

        <?php displayTours($toursArray); ?>

        <div class="text-center mt-5">
            <a href="../html/index.html" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>
</body>

</html>