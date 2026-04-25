<?php

require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Publisher ID not provided.");
    }

    $formatId = $_GET["id"];
    $format = Format::findById($formatId);

    if ($format == null) {
        throw new Exception("Format not found.");
    }

    $books = Book::findByFormatId($formatId);
}
catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Publishers</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
                <div class="bookList title">
                    <h1><?= $format->name ?></h1>
                </div>  
                <div class="buttonHolder">
                    <a href="format_list.php" class="button">Back to Formats</a>
                </div>
            </div>
                <div class="width-12 cards" id="book_cards">
                    <?php foreach ($books as $book) { 
                        $bookFormats = Format::findByBookId($book->id);
                        $formatIds = [];
                        foreach ($bookFormats as $f) {
                            $formatIds[] = $f->id;
                        }
                        $formatIdStr = implode(" ", $formatIds);
                    ?>
                        <div class="card"
                            data-title="<?= h($book->title) ?>"
                            data-publisher="<?= h($book->publisher_id) ?>"
                            data-format="<?= h($formatIdStr) ?>"
                            data-year="<?= h($book->year) ?>">
                            <div class="top-content">
                                <h2><?= h($book->title) ?></h2>
                                <p>Release Year: <?= h($book->year) ?></p>
                            </div>
                            <div class="bottom-content">
                                <img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" />
                                <div class="actions">
                                    <a href="book_view.php?id=<?= h($book->id) ?>">View</a>/ 
                                    <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a>/
                                     
                                    <button class="delete-btn" onclick="document.getElementById('modal-<?= $book->id ?>').style.display='block'">Delete</button>

                                    <div id="modal-<?= $book->id ?>" class="modal">
                                        <span onclick="document.getElementById('modal-<?= $book->id ?>').style.display='none'" class="close">&times;</span>

                                        <form class="modal-content" action="book_delete.php" method="GET">
                                            <input type="hidden" name="id" value="<?= $book->id ?>">

                                            <div class="container">
                                                <h1>Delete Book</h1>
                                                <p>Are you sure you want to delete this book?</p>

                                                <div class="clearfix">
                                                    <button type="button" onclick="document.getElementById('modal-<?= $book->id ?>').style.display='none'" class="cancelbtn">Cancel</button>
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
        </div>
    </body>
</html>