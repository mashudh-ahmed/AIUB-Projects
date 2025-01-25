<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Book Borrowing System</title>
    <link rel="stylesheet" href="style.css"> <!-- Linking the external CSS file -->
    
</head>
<body>
    <div class="container-box">

    
        <img src="Images\XX.png" alt="NAME ID Image" class="top-image">

        <div class="wrapper">
            <div class="content">
                
                <!-- Book List and Search/Edit Section -->
                <div class="first">
                    <div class="box1">
                        <?php include('book_list.php'); ?>
                    </div>
                       
                
                </div>

                <div class="second">

                <div class="second">
    
    <div class="box2">
        <img src="Images\CC.jpg" alt="Book Image 2" class="box-image">
    </div>
    <div class="box2">
        <img src="Images\The_Law_Of_Attraction.jpg" alt="Book Image 1" class="box-image">
    </div>
    <div class="box2">
        <img src="Images\A.jpg" alt="Book Image 4" class="box-image">
    </div>
    <div class="box2">
        <img src="Images\The_Art_of_Computer_Programming.jpg" alt="Book Image 5" class="box-image">
    </div>
    <div class="box2">
        <img src="Images\The_Law_Of_Attraction.jpg" alt="Book Image 1" class="box-image">
    </div>
    
    <div class="box2">
        <img src="Images\images12.jpg" alt="Book Image 5" class="box-image">
    </div>
    
</div>

                
                </div>

                <!-- Add New Book Section -->
                <div class="third">
                    <div class="box3">
                        <h2 style="text-align: center">Add New Book</h2>
                        <form class="form-box" method="POST" action="add_books.php">
                            <div class="form-group">
                                <label for="book-id">Book ID</label>
                                <input type="text" id="book-id" name="book-id" placeholder="Enter book ID" required>
                            </div>
                            <div class="form-group">
                                <label for="book-title">Book Title</label>
                                <input type="text" id="book-title" name="book-title" placeholder="Enter book title" required>
                            </div>
                            <div class="form-group">
                                <label for="author-name">Author Name</label>
                                <input type="text" id="author-name" name="author-name" placeholder="Enter author name" required>
                            </div>
                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input type="text" id="isbn" name="isbn" placeholder="Enter ISBN" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <input type="text" id="category" name="category" placeholder="Enter category" required>
                            </div>
                            <button type="submit">Add Book</button>
                        </form>
                    </div>

                    <div class="box10">
                        <h2 style="text-align: center;">Search and Edit Book</h2>
                        <!-- Search Form -->
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="search">Search Book by Title, Author or Category</label>
                                <input type="text" id="search" name="search" placeholder="Enter search term" required>
                                <button type="submit" name="submit-search">Search</button>
                            </div>
                        </form>
                        <!-- Book Table and Edit Form -->
                        <?php include('book_edit_form.php'); ?>
                    </div>

                    
                </div>

                <!-- Borrowed Book Section -->
                <div class="seventh">
                    
                    
                 <!-- Display Available Tokens -->
                 <div class="box9">
                        <h2 style="text-align: center;">Tokens</h2>
                        <?php include 'available_tokens.php'; ?>
                        <ul>
                           
                    </div>

                    <!-- Borrow Books Form -->
                    <div class="box7">
                        <form class="form-box" method="POST" action="process.php">
                            <h2 style="text-align: center;">Borrow Books</h2>
                            <div class="form-group">
                                <label for="full-name">Full Name</label>
                                <input type="text" id="full-name" name="full-name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="aiub-id">ID</label>
                                <input type="text" id="aiub-id" name="aiub-id" placeholder="Enter your ID">
                            </div>
                            <div class="form-group">
                                <label for="book-title">Book Title</label>
                                <select id="book-title" name="book-title">
                                    <option value="book1">The Law of Attraction</option>
                                    <option value="book2">DSA</option>
                                    <option value="book3">HTML 5</option>
                                    <option value="book4">Clean sCode></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="borrow-date">Borrowing Date</label>
                                <input type="date" id="borrow-date" name="borrow-date">
                            </div>
                            <div class="form-group">
                                <label for="return-date">Return Date</label>
                                <input type="date" id="return-date" name="return-date">
                            </div>
                            <div class="form-group">
                                <label for="fees">Fees</label>
                                <input type="text" id="fees" name="fees" placeholder="Enter fees">
                            </div>
                            <div class="form-group">
                                <label for="token-number">Token Number</label>
                                <input type="text" id="token-number" name="token-number" placeholder="Enter token number">
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                    </div>

                     

                    
                   <?php include ('box8.php')?>
                   </div>
               
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
