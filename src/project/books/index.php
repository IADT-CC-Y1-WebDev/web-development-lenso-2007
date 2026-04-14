<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'php/inc/head_content.php'; ?>
    <title>Home</title>
</head>
<body>

<div class="container">
    <div class="width-12 indexTop">
        <?php require 'php/inc/flash_message.php'; ?>
        <div>
            <h1>The Book Library</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="width-12">

        <div class="cards index">

            <div class="card">
                <h2>View Books</h2>
                <p>View all books here</p>
                <div class="actions">
                    <a href="book_list.php">Open</a>
                </div>
            </div>

            <div class="card">
                <h2>Add New Book</h2>
                <p>Add a new book here</p>
                <div class="actions">
                    <a href="book_create.php">Create</a>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>