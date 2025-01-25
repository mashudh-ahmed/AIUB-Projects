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

// Fetch available tokens
$sql_tokens = "SELECT token_number FROM token WHERE is_available = TRUE";
$result_tokens = $conn->query($sql_tokens);

// Display tokens
echo "<div class='box9'>";


if ($result_tokens->num_rows > 0) {
    echo "<ul>";
    while ($row = $result_tokens->fetch_assoc()) {
        echo "<li>Token Number: " . $row['token_number'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Not available.</p>";
}

echo "</div>";

// Close the connection
$conn->close();
?>
