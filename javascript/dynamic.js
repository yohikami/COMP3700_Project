/***************************************************
 *  TOUR OBJECT
 *  -----------------------------------
 *  This function creates a Tour object with
 *  three properties: name, price, and duration.
 *  It is used to store each tour inside the array.
 ***************************************************/
function Tour(name, price, duration) {
    this.name = name;
    this.price = price;
    this.duration = duration;
}

/***************************************************
 *  TOUR ARRAY 
 *  -----------------------------------
 *  We initialize the tours array with three sample
 *  objects using the Tour constructor above.
 ***************************************************/
let tours = [
    new Tour("Tokyo City Lights", 99, "3 days"),
    new Tour("Osaka Food Adventure", 50, "3 days"),
    new Tour("Kyoto Heritage Escape", 89, "3 days")
];

/***************************************************
 *  DISPLAY TOURS TABLE
 *  -----------------------------------
 *  This function receives an array of Tour objects
 *  and dynamically adds each item as a row inside
 *  the <tbody> of the Tours table.
 *
 *  Steps:
 *   1. Select table body
 *   2. Clear old rows
 *   3. Loop through the array
 *   4. Add each tour as an HTML table row
 ***************************************************/
function loadToursTable(data) {
    let tbody = document.querySelector("#toursTable tbody");
    tbody.innerHTML = ""; // Clear previous rows

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

// Load tours table when page starts
loadToursTable(tours);

/***************************************************
 *  ADD NEW TOUR
 *  -----------------------------------
 *  This function reads the user's input from the
 *  three text fields, validates that all fields
 *  are filled, then creates a new Tour object and
 *  adds it to the tours array.
 *
 *  After updating the array, it refreshes the table
 *  and clears the input boxes.
 ***************************************************/
function addTour() {
    let name = document.getElementById("newName").value;
    let price = document.getElementById("newPrice").value;
    let duration = document.getElementById("newDuration").value;

    // Basic validation: all fields must be filled
    if (!name || !price || !duration) {
        alert("Please fill all fields.");
        return;
    }

    // Create new object and push to array
    tours.push(new Tour(name, price, duration));

    // Refresh table display
    loadToursTable(tours);

    // Clear inputs after adding
    document.getElementById("newName").value = "";
    document.getElementById("newPrice").value = "";
    document.getElementById("newDuration").value = "";
}



/***************************************************
 *  REVIEW OBJECT (Constructor Function)
 *  -----------------------------------
 *  Similar to Tour, this constructor defines a
 *  Review object with name, rating, and comment.
 ***************************************************/
function Review(name, rating, comment) {
    this.name = name;
    this.rating = rating;
    this.comment = comment;
}

/***************************************************
 *  REVIEWS ARRAY (Initial Data)
 *  -----------------------------------
 *  Pre-filled list of reviews that appear when the
 *  user opens the page. Each item uses the Review
 *  constructor and stores user-like feedback.
 ***************************************************/
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

/***************************************************
 *  DISPLAY REVIEWS TABLE
 *  -----------------------------------
 *  Works the same way as loadToursTable, but for
 *  Review objects. It loops through the reviews
 *  array and builds table rows dynamically.
 ***************************************************/
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

// Load reviews table when page starts
loadReviewTable(reviews);

/***************************************************
 *  ADD NEW REVIEW
 *  -----------------------------------
 *  Similar to addTour(), this function:
 *    - Reads inputs
 *    - Validates entries
 *    - Creates a new Review object
 *    - Pushes it to the array
 *    - Reloads the table
 *    - Clears form fields afterwards
 ***************************************************/
function addReview() {
    let name = document.getElementById("newNameR").value;
    let rating = document.getElementById("newRatingR").value;
    let comment = document.getElementById("newCommentR").value;

    // Validate: all fields required
    if (!name || !rating || !comment) {
        alert("Please fill all fields.");
        return;
    }

    // Add new review
    reviews.push(new Review(name, rating, comment));

    // Refresh reviews table
    loadReviewTable(reviews);

    // Clear input fields
    document.getElementById("newNameR").value = "";
    document.getElementById("newRatingR").value = "";
    document.getElementById("newCommentR").value = "";
}
