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
        <title>Publishers</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
                <h1>Publishers</h1> 
            </div>
        <div class="container">
            <?php if (empty($publishers)) { ?>
                <p>No publishers found.</p>
            <?php } else { ?>
                <div class="width-12 cards" id="book_cards">
                    <?php foreach ($publishers as $publisher) { ?>
                        <div class="card" data-name="<?= h($publisher->name) ?>">
                            <div class="top-content">
                                <h2><?= h($publisher->name) ?></h2>
                            </div>
                            <div class="bottom-content">
                                <div class="actions">
                                     
                                    <button class="delete-btn" onclick="document.getElementById('modal-<?= $publisher->id ?>').style.display='block'">Delete</button>

                                    <div id="modal-<?= $publisher->id ?>" class="modal">
                                        <span onclick="document.getElementById('modal-<?= $publisher->id ?>').style.display='none'" class="close">&times;</span>

                                        <form class="modal-content" action="publisher_delete.php" method="GET">
                                            <input type="hidden" name="id" value="<?= $publisher->id ?>">

                                            <div class="container">
                                                <h1>Delete Book</h1>
                                                <p>Are you sure you want to delete this publisher?</p>

                                                <div class="clearfix">
                                                    <button type="button" onclick="document.getElementById('modal-<?= $publisher->id ?>').style.display='none'" class="cancelbtn">Cancel</button>
                                                    <button type="submit" class="deletebtn">Delete</button>
                                                </div>
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