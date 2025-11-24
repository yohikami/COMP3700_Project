// TOUR 
function Tour(name, price, duration) {
    this.name = name;
    this.price = price;
    this.duration = duration;
}

let tours = [
    new Tour("Tokyo City Lights", 99, "3 days"),
    new Tour("Osaka Food Adventure", 50, "3 days"),
    new Tour("Kyoto Heritage Escape", 89, "3 days")
];

function loadToursTable(data) {
    let tbody = document.querySelector("#toursTable tbody");
    tbody.innerHTML = "";

    data.forEach(t => {
        tbody.innerHTML += `
            <tr>
                <td>${t.name}</td>
                <td>${t.price}</td>
                <td>${t.duration}</td>
            </tr>
        `;
    });
}

loadToursTable(tours);

function addTour() {
    let name = document.getElementById("newName").value;
    let price = document.getElementById("newPrice").value;
    let duration = document.getElementById("newDuration").value;

    if (!name || !price || !duration) {
        alert("Please fill all fields.");
        return;
    }

    tours.push(new Tour(name, price, duration));
    loadToursTable(tours);

    document.getElementById("newName").value = "";
    document.getElementById("newPrice").value = "";
    document.getElementById("newDuration").value = "";
}



// REVIEW 
function Review(name, rating, comment) {
    this.name = name;
    this.rating = rating;
    this.comment = comment;
}

let reviews = [
    new Review(
        "Sarah Johnson",
        5,
        "Our Tokyo City Lights tour was absolutely incredible!"
    ),
    new Review(
        "Michael Chen",
        5,
        "The Osaka Food Adventure was a culinary delight!"
    ),
    new Review(
        "Emma Williams",
        4,
        "Kyoto Heritage Escape was peaceful and beautiful."
    ),
    new Review(
        "David Brown",
        5,
        "MangaMaps made our first trip to Japan very easy."
    )
];

function loadReviewTable(data) {
    let tbody = document.querySelector("#reviewsTable tbody");
    tbody.innerHTML = "";

    data.forEach(r => {
        tbody.innerHTML += `
            <tr>
                <td>${r.name}</td>
                <td>${r.rating}</td>
                <td>${r.comment}</td>
            </tr>
        `;
    });
}

loadReviewTable(reviews);

function addReview() {
    let name = document.getElementById("newNameR").value;
    let rating = document.getElementById("newRatingR").value;
    let comment = document.getElementById("newCommentR").value;

    if (!name || !rating || !comment) {
        alert("Please fill all fields.");
        return;
    }

    reviews.push(new Review(name, rating, comment));
    loadReviewTable(reviews);

    document.getElementById("newNameR").value = "";
    document.getElementById("newRatingR").value = "";
    document.getElementById("newCommentR").value = "";
}
