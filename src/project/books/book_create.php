<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
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
            <div class="width-12 flash">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>

            <div class="width-12">
                
                <form id="book_form" action="book_store.php" method="POST" enctype="multipart/form-data" novalidate>
                    
                    <h1>Create Book</h1>

                    <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

                    <div class="input">
                        <label class="special" for="title">Title:</label>
                        <div>
                            <input type="text" id="title" name="title" data-minlength="3" data-maxlength="255" value="<?= old('title') ?>" required>
                            <span id="title_error" class="error"></span>
                            <p><?= error('title') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="author">Author:</label>
                        <div>
                            <input type="text" id="author" name="author" data-minlength="3" data-maxlength="255" value="<?= old('author') ?>" required>
                            <span id="author_error" class="error"></span>
                            <p><?= error('author') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="year">Release Year:</label>
                        <div>
                            <input type="number" id="year" name="year" min="1900" max="2099" value="<?= old('year') ?>" required>
                            <span id="year_error" class="error"></span>
                            <p><?= error('year') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="isbn">ISBN:</label>
                        <div>
                            <input type="text" id="isbn" name="isbn" data-minlength="13" data-maxlength="13" value="<?= old('isbn') ?>" required>
                            <span id="isbn_error" class="error"></span>
                            <p><?= error('isbn') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="publisher_id">Publishers:</label>
                        <div>
                            <select id="publisher_id" name="publisher_id" required>
                                <?php foreach ($publishers as $publisher) { ?>
                                    <option value="<?= h($publisher->id) ?>" <?= chosen('publisher_id', $publisher->id) ? "selected" : "" ?>>
                                        <?= h($publisher->name) ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <span id="publishers_error" class="error"></span>
                            <p><?= error('publisher_id') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="description">Description:</label>
                        <div>
                            <textarea id="description" name="description" data-minlength="10" data-maxlength="5000" required><?= old('description') ?></textarea>
                            <span id="description_error" class="error"></span>
                            <p><?= error('description') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special">Formats:</label>
                        <div>
                            <?php foreach ($formats as $format) { ?>
                                <div>
                                    <input type="checkbox" id="format_<?= h($format->id) ?>" name="format_ids[]" value="<?= h($format->id) ?>" <?= chosen('format_ids', $format->id) ? "checked" : "" ?>>
                                    <label for="format_<?= h($format->id) ?>"><?= h($format->name) ?></label>
                                </div>
                            <?php } ?>
                            <span id="format_ids_error" class="error"></span>
                            <p><?= error('format_ids') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="cover">Image (required):</label>
                        <div>
                            <input type="file" id="cover" name="cover" accept="image/*">
                            <span id="image_error" class="error"></span>
                            <p><?= error('cover') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <button class="button" id="submit_btn" type="submit">Store Book</button>
                        <div class="button"><a href="book_list.php">Cancel</a></div>
                    </div>

                </form>
            </div>
        </div>
        <script src="js/validation.js"></script>
    </body>
</html>
<?php
clearFormData();
clearFormErrors();
?>