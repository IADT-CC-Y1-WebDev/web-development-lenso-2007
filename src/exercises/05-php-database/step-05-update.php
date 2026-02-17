<?php
require_once __DIR__ . '/lib/config.php';
// =============================================================================
// Create PDO connection
// =============================================================================
try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
} 
catch (PDOException $e) {
    echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
    exit();
}
// =============================================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 5: UPDATE Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-05-update.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 5: UPDATE Operations</h1>

        <h2>Task</h2>
        <p>Update an existing book's description.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>First, display the current details of book ID 1</li>
            <li>Update the description to include a timestamp</li>
            <li>Check <code>rowCount()</code> to verify the update worked</li>
            <li>Display the updated book details</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. Fetch and display book ID 1
            // 2. Prepare: UPDATE books SET description = :description WHERE id = :id
            // 3. Execute with new description + timestamp
            // 4. Check rowCount()
            // 5. Fetch and display updated book

            //1
            $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
            $stmt->execute([':id' => 1]);
            $book = $stmt->fetch();
            echo "Before update:\n";
            ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($book['id']) ?></td>
                        <td><?= htmlspecialchars($book['title']) ?></td>
                        <td><?= htmlspecialchars($book['description']) ?></td>
                    </tr>
                </tbody>
            </table>
            <?php
            //2
            $stmt = $db->prepare("
                UPDATE books
                SET description = :description
                WHERE id = :id
            ");

            //3
            $stmt->execute([
                'description' => 'Updated description text at ', // . date("Y-m-d H:i:s"),
                'id' => 1
            ]);

            //4
            echo "Updated " . $stmt->rowCount() . " row(s)" . " at " . date('H:i:s');

            //5
            $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
            $stmt->execute([':id' => 1]);
            $updatedBook = $stmt->fetch();
            echo " After update:\n";
            ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($updatedBook['id']) ?></td>
                        <td><?= htmlspecialchars($updatedBook['title']) ?></td>
                        <td><?= htmlspecialchars($updatedBook['description']) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
