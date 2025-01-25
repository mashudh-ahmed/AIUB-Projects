<?php
// Database connection details
$host = "localhost"; // Change if not localhost
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "library"; // Your database name

// Establishing a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving form data and trimming whitespace
$book_id = trim($_POST["book-id"]);
$book_title = trim($_POST["book-title"]);
$author_name = trim($_POST["author-name"]);
$isbn = trim($_POST["isbn"]);
$quantity = trim($_POST["quantity"]);
$category = trim($_POST["category"]);

// Initialize an array for error messages
$errors = [];

// Validation
if (!preg_match('/^\d{5}$/', $book_id)) {
    $errors[] = "Book ID must be exactly 5 digits.";
}
if (empty($book_title)) {
    $errors[] = "Book title is required.";
}
if (empty($author_name)) {
    $errors[] = "Author name is required.";
}
if (!preg_match('/^\d{13}$/', $isbn)) {
    $errors[] = "ISBN number must be exactly 13 digits.";
}
if (!filter_var($quantity, FILTER_VALIDATE_INT) || $quantity <= 0) {
    $errors[] = "Quantity must be a positive integer.";
}
if (empty($category)) {
    $errors[] = "Category is required.";
}

// If there are errors, display them and exit
if (!empty($errors)) {
   
    foreach ($errors as $error) {
        echo htmlspecialchars($error) . "<br>";
    }
    exit;
}

// SQL query to insert data into the database
$sql = "INSERT INTO books (book_id, book_title, author_name, isbn, quantity, category) VALUES (?, ?, ?, ?, ?, ?)";

// Preparing and binding
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssis", $book_id, $book_title, $author_name, $isbn, $quantity, $category); // "ssssis" stands for string, string, string, string, integer, string

// Executing the query
if ($stmt->execute()) {
    echo "Book added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Closing the connection
$stmt->close();
$conn->close();
?>
