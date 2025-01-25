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

// Handle the search
$searchTerm = "";
if (isset($_POST['submit-search'])) {
    $searchTerm = $_POST['search'];
}

// SQL query to fetch books based on search term
$sql = "SELECT book_id, book_title, author_name, isbn, quantity, category FROM books WHERE book_title LIKE ? OR author_name LIKE ? OR category LIKE ?";
$stmt = $conn->prepare($sql);
$searchParam = "%$searchTerm%";
$stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);

// Execute and fetch results
$stmt->execute();
$result = $stmt->get_result();

// Display search results in a table
if ($result->num_rows > 0) {
    echo "<h3>Search Results</h3>";
    echo "<table style='width:100%; border-collapse: collapse;'>";
    echo "<thead>";
    echo "<tr style='background-color: #f2f2f2; border: 1px solid #ddd;'>";
    echo "<th>Book ID</th>";
    echo "<th>Title</th>";
    echo "<th>Author</th>";
    echo "<th>ISBN</th>";
    echo "<th>Quantity</th>";
    echo "<th>Category</th>";
    echo "<th>Edit</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr style='border: 1px solid #ddd;'>";
        echo "<td>" . $row['book_id'] . "</td>";  // Book ID
        echo "<td>" . $row["book_title"] . "</td>";
        echo "<td>" . $row["author_name"] . "</td>";
        echo "<td>" . $row["isbn"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo "<td><a href='?edit=" . $row["book_id"] . "'>Edit</a></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No books found matching your search.</p>";
}

// Handle book edit functionality
if (isset($_GET['edit'])) {
    $book_id = $_GET['edit'];
    
    // Fetch book details for editing
    $edit_sql = "SELECT * FROM books WHERE book_id = ?";
    $edit_stmt = $conn->prepare($edit_sql);
    $edit_stmt->bind_param("i", $book_id);
    $edit_stmt->execute();
    $edit_result = $edit_stmt->get_result();
    
    if ($edit_result->num_rows > 0) {
        $edit_row = $edit_result->fetch_assoc();
        ?>

        <!-- Edit Form to Update Book Details -->
        <form method="POST" action="">
    <!-- Hidden Book ID for processing -->
    <input type="hidden" name="book-id" value="<?php echo isset($edit_row['book_id']) ? $edit_row['book_id'] : ''; ?>">

    <div class="form-group">
        <label for="book-id">Book ID</label>
        <!-- Display Book ID, not editable -->
        <input type="text" id="book-id" name="book-id" value="<?php echo isset($edit_row['book_id']) ? $edit_row['book_id'] : ''; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="book-title">Book Title</label>
        <input type="text" id="book-title" name="book-title" value="<?php echo isset($edit_row['book_title']) ? $edit_row['book_title'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label for="author-name">Author Name</label>
        <input type="text" id="author-name" name="author-name" value="<?php echo isset($edit_row['author_name']) ? $edit_row['author_name'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type="text" id="isbn" name="isbn" value="<?php echo isset($edit_row['isbn']) ? $edit_row['isbn'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo isset($edit_row['quantity']) ? $edit_row['quantity'] : ''; ?>" required />
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" id="category" name="category" value="<?php echo isset($edit_row['category']) ? $edit_row['category'] : ''; ?>" required />
    </div>

    <button type="submit" name="update-book">Update Book</button>
</form>


        <?php
    } else {
        echo "<p>Book not found for editing.</p>";
    }
}

// Handle book update
if (isset($_POST['update-book'])) {
    $book_id = $_POST['book-id'];
    $book_title = $_POST['book-title'];
    $author_name = $_POST['author-name'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];

    // SQL query to update book information
    $update_sql = "UPDATE books SET book_title = ?, author_name = ?, isbn = ?, quantity = ?, category = ? WHERE book_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $book_title, $author_name, $isbn, $quantity, $category, $book_id);

    if ($update_stmt->execute()) {
        echo "<p>Book updated successfully!</p>";
    } else {
        echo "<p>Error: " . $update_stmt->error . "</p>";
    }
}

// Closing the connection
$conn->close();
?>
