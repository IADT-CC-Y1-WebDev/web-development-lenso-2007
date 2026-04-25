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
            <div class="width-12">
                <div class="flash">
                    <?php require 'php/inc/flash_message.php'; ?>
                </div>
            </div>
            <div class="width-12">
                <form id="publisher_form" action="publisher_store.php" method="POST" enctype="multipart/form-data" novalidate>
                    <h1>Create Publisher</h1>
                    <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

                    <div class="input">
                        <label class="special" for="name">Name:</label>
                        <div>
                            <input type="text" id="name" name="name" data-minlength="3" data-maxlength="255" value="<?= old('name') ?>" required>
                            <span id="name_error" class="error"></span>
                            <p><?= error('name') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <button class="button" id="submit_btn" type="submit">Store Publisher</button>
                        <div class="button"><a href="publisher_list.php">Cancel</a></div>
                    </div>

                </form>
            </div>
        </div>
        <script src="js/publisher_validation.js"></script>
    </body>
</html>
<?php
clearFormData();
clearFormErrors();
?>