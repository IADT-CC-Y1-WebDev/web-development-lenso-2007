<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';
 
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
    die("<p>Error: No book ID provided.</p>");
}
$id = $_GET['id'];
 
try {
    $book = Book::findById($id);
    if ($book === null) {
        die("<p>Error: Book not found.</p>");
    }
 
    $publisher = Publisher::findById($book->publisher_id);
    $formats = Format::findByBookId($book->id);
 
    $formatNames = [];
    foreach ($formats as $format) {
        $formatNames[] = htmlspecialchars($format->name ?? "");
    }
}
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/book_list.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>View Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <div class="flash">
                    <?php require 'php/inc/flash_message.php'; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="buttonHolder">
                <a href="book_list.php" class="button"> <- Back To Books</a>
            </div>
            <div class="width-12" id="book_cards">
                <div class="hCard">
                    <div class="bottom-content">
                        <img src="images/<?= htmlspecialchars($book->cover_filename) ?>" />
 
                        <div class="actions">
                            <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a> /
                            <button class="delete-btn" data-modal="modal-<?= $book->id ?>">Delete</button>

                                    <div data-modal="modal-<?= $book->id ?>" id="modal-<?= $book->id ?>" class="modal" >
                                        <span class="close">&times;</span>

                                        <form class="modal-content" action="book_delete.php" method="GET">
                                            <input type="hidden" name="id" value="<?= $book->id ?>">

                                                <h1>Delete Book</h1>
                                                <p>Are you sure you want to delete "<?= h($book->title) ?>"?</p>

                                                <div class="clearfix">
                                                    <button type="button" class="cancelbtn" data-modal="modal-<?= $book->id ?>">Cancel</button>
                                                    <button type="submit" class="deletebtn">Delete</button>
                                                </div>
                                        </form>
                                    </div>
                        </div>
                    </div>
 
                    <div class="bottom-content">
                        <h2><?= htmlspecialchars($book->title) ?></h2>
                        <p>Release Year: <?= htmlspecialchars($book->year) ?></p>
                        <p>Author: <?= htmlspecialchars($book->author) ?></p>
                        <p>Publisher: <?= htmlspecialchars($publisher->name) ?></p>
                        <p>ISBN: <?= htmlspecialchars($book->isbn) ?></p>
                        <p>Description:<br /><?= nl2br(htmlspecialchars($book->description)) ?></p>
                        <p>Formats:<br /><?= nl2br(htmlspecialchars(implode(", ", $formatNames))) ?></p>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/modal_button.js"></script>
    </body>
</html>