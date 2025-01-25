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

// Fetch recently borrowed books
$sql_recent = "SELECT * FROM recently_borrowed_books ORDER BY borrow_date DESC LIMIT 10";
$result_recent = $conn->query($sql_recent);
?>
