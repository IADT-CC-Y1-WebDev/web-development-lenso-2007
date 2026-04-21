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
        <title>Books</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
                <div class="bookList title">
                    <h1>The Book Library</h1>
                </div>  
                <div class="buttonHolder">
                    <div class="button">
                        <a href="book_create.php">Add New Book</a>
                    </div>
                    <div class="button">
                        <a href="publisher_list.php">View all Publishers</a>
                    </div>
                    <div class="button">
                        <a href="format_list.php">View all Formats</a>
                    </div>
                </div>
            </div>
            <?php if (!empty($books)) { ?>
                <div class="width-12 filters">
                    <form id ="filters">
                        <div>
                            <label for="title_filter">Title:</label>
                            <input type="text" id="title_filter" name="title_filter">
                        </div>
                        <div>
                            <label for="publisher_filter">Publisher:</label>
                            <select id="publisher_filter" name="publisher_filter">
                                <option value="">All Publishers</option>
                                <?php foreach ($publishers as $publisher) { ?>
                                    <option value="<?= h($publisher->id) ?>"><?= h($publisher->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label for="format_filter">Format:</label>
                            <select id="format_filter" name="format_filter">
                                <option value="">All Formats</option>
                                <?php foreach ($formats as $format) { ?>
                                    <option value="<?= h($format->id) ?>"><?= h($format->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label class="filter-label" for="sort_by">Sort:</label>
                            <select id="sort_by" name="sort_by">
                                <option value="title_asc">Title A-Z</option>
                                <option value="year_desc">Year (newest first)</option>
                                <option value="year_asc">Year (oldest first)</option>
                            </select>
                        </div>
                        <div>
                            <button type="button" id="apply_filters">Apply Filters</button>
                            <button type="button" id="clear_filters">Clear Filters</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
        <div class="container">
            <?php if (empty($books)) { ?>
                <p>No games found.</p>
            <?php } else { ?>
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
                                     
                                    <button class="delete-btn" data-modal="modal-<?= $book->id ?>">Delete</button>

                                    <div data-modal="modal-<?= $book->id ?>" id="modal-<?= $book->id ?>" class="modal" >
                                        <span class="close">&times;</span>

                                        <form class="modal-content" action="book_delete.php" method="GET">
                                            <input type="hidden" name="id" value="<?= $book->id ?>">

                                            <div class="container">
                                                <h1>Delete Book</h1>
                                                <p>Are you sure you want to delete "<?= h($book->title) ?>"?</p>

                                                <div class="clearfix">
                                                    <button type="button" class="cancelbtn" data-modal="modal-<?= $book->id ?>">Cancel</button>
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
        <script src="js/modal_button.js"></script>
        <script src="js/book_filters.js"></script>
    </body>
</html>