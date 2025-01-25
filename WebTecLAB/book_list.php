<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "library";

// Establishing a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieving search keyword if available
$search_keyword = isset($_GET['search']) ? trim($_GET['search']) : '';

// SQL query to fetch books with optional search filter
$sql = "SELECT book_id, book_title, author_name, isbn, quantity, category FROM books";
if (!empty($search_keyword)) {
    $sql .= " WHERE book_title LIKE ?";
}

$stmt = $conn->prepare($sql);

if (!empty($search_keyword)) {
    $search_term = "%" . $search_keyword . "%";
    $stmt->bind_param("s", $search_term);
}

$stmt->execute();
$result = $stmt->get_result();

// HTML Output
echo "<h2 style='text-align: center;'>Available Books</h2>";

// Search form with refresh button
echo "<form method='get' style='text-align: center; margin-bottom: 20px; display: flex; justify-content: center; align-items: center; gap: 10px;'>";
echo "<button type='button' onclick='window.location.href=\"\"' style='padding: 8px 12px; background-color: #f44336; color: white; border: none; cursor: pointer;'>Refresh</button>";
echo "<input type='text' name='search' placeholder='Search by Title' value='" . htmlspecialchars($search_keyword) . "' style='padding: 8px; width: 50%; border: 1px solid #ddd;'>";
echo "<button type='submit' style='padding: 8px 12px; background-color: #4CAF50; color: white; border: none; cursor: pointer;'>Search</button>";
echo "</form>";

// Check if books are available
if ($result->num_rows > 0) {
    echo "<table style='width:100%; border-collapse: collapse;'>";
    echo "<thead>";
    echo "<tr style='background-color: #f2f2f2; border: 1px solid #ddd;'>";
    echo "<th style='padding: 8px; text-align: left;'>Book ID</th>";
    echo "<th style='padding: 8px; text-align: left;'>Title</th>";
    echo "<th style='padding: 8px; text-align: left;'>Author</th>";
    echo "<th style='padding: 8px; text-align: left;'>ISBN</th>";
    echo "<th style='padding: 8px; text-align: left;'>Quantity</th>";
    echo "<th style='padding: 8px; text-align: left;'>Category</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Output each book as a table row
    while ($row = $result->fetch_assoc()) {
        echo "<tr style='border: 1px solid #ddd;'>";
        echo "<td style='padding: 8px;'>" . $row["book_id"] . "</td>";
        echo "<td style='padding: 8px;'>" . $row["book_title"] . "</td>";
        echo "<td style='padding: 8px;'>" . $row["author_name"] . "</td>";
        echo "<td style='padding: 8px;'>" . $row["isbn"] . "</td>";
        echo "<td style='padding: 8px;'>" . $row["quantity"] . "</td>";
        echo "<td style='padding: 8px;'>" . $row["category"] . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No books available in the library.</p>";
}

// Closing the connection
$stmt->close();
$conn->close();
?>
