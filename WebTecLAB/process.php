<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "library";

// Establish connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving form data
$full_name = trim($_POST["full-name"]);
$aiub_id = trim($_POST["aiub-id"]);
$book_title = trim($_POST["book-title"]);
$borrow_date = trim($_POST["borrow-date"]);
$return_date = trim($_POST["return-date"]);
$fees = trim($_POST["fees"]);
$token_number = trim($_POST["token-number"]);  // Optional, based on validation

// Validation flag
$errors = [];

// Full Name validation
if (empty($full_name)) {
    $errors[] = "Full Name is required.";
} elseif (!preg_match("/^[a-zA-Z\s]+$/", $full_name)) {
    $errors[] = "Full Name can only contain letters and spaces.";
}

// AIUB ID validation
if (empty($aiub_id)) {
    $errors[] = "AIUB ID is required.";
} elseif (!preg_match("/^\d{2}-\d{5}-\d{1}$/", $aiub_id)) {
    $errors[] = "AIUB ID must be in the format XX-XXXXX-X.";
}

// Fees validation
if (empty($fees)) {
    $errors[] = "Fees is required.";
} elseif (!is_numeric($fees)) {
    $errors[] = "Fees must be a numeric value.";
}

// Borrow and Return Date validation
if (empty($borrow_date) || empty($return_date)) {
    $errors[] = "Both Borrow and Return Dates are required.";
} elseif (strtotime($return_date) <= strtotime($borrow_date)) {
    $errors[] = "Return Date must be after the Borrow Date.";
}

// Token Number validation
$borrowTimestamp = strtotime($borrow_date);
$returnTimestamp = strtotime($return_date);
$timeDiff = ($returnTimestamp - $borrowTimestamp) / (60 * 60 * 24);  // Days difference

if ($timeDiff > 10 && empty($token_number)) {
    $errors[] = "Token number is required because the borrowing time exceeds 10 days.";
}

// If there are validation errors
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
    exit;
}

// Insert data into the recently_borrowed_books table
$sql = "INSERT INTO recently_borrowed_books (full_name, aiub_id, book_title, borrow_date, return_date, fees, token_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $full_name, $aiub_id, $book_title, $borrow_date, $return_date, $fees, $token_number);

// Execute query and display result
if ($stmt->execute()) {
    echo "<p style='color: green;'>Borrowing details have been successfully saved!</p>";
} else {
    echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
}

// Closing the connection
$stmt->close();
$conn->close();
?>
