<div class="box8">
    <h2 style="text-align: center;">Recently Borrowed Books</h2>
    <?php include 'fetch_recent_books.php'; ?>
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>AIUB ID</th>
                <th>Book Title</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Fees</th>
                <th>Token Number</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result_recent->num_rows > 0): ?>
                <?php while ($row = $result_recent->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['aiub_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['book_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['borrow_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['fees']); ?></td>
                        <td><?php echo htmlspecialchars($row['token_number']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">No records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
