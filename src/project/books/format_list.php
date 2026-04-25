<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

try {
    $books = Book::findAll();
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Formats</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
            <div class="flash">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
                <div class="titleHolder">
                    <h1>Formats</h1>
                </div>
                <div class="buttonHolder">
                    <a href="format_create.php" class="button">Add New Format</a>
                    <a href="book_list.php" class="button">Back to books</a>
                </div>
            </div>
        <div class="container">
            <?php if (empty($formats)) { ?>
                <p>No formats found.</p>
            <?php } else { ?>
                <div class="width-12 cards" id="book_cards">
                    <?php foreach ($formats as $format) { ?>
                        <div class="card" data-name="<?= h($format->name) ?>">
                            <div class="top-content">
                                <h2><?= h($format->name) ?></h2>
                            </div>
                            <div class="bottom-content">
                                <div class="actions">
                                     
                                    <a href="format_view.php?id=<?= h($format->id) ?>">View all Books</a>/
                                    <button class="delete-btn" data-modal="modal-<?= $format->id ?>">Delete</button>

                                    <div data-modal="modal-<?= $format->id ?>" id="modal-<?= $format->id ?>" class="modal" >
                                        <span class="close">&times;</span>

                                        <form class="modal-content" action="format_delete.php" method="GET">
                                            <input type="hidden" name="id" value="<?= $format->id ?>">

                                            <h1>Delete Book</h1>
                                            <p>Are you sure you want to delete "<?= h($format->name) ?>"?</p>

                                            <div class="clearfix">
                                                 <button type="button" class="cancelbtn" data-modal="modal-<?= $format->id ?>">Cancel</button>
                                                 <button type="submit" class="deletebtn">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <script src="js/book_filters.js"></script>
        <script src="js/modal_button.js"></script>
    </body>
</html>