<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    include 'conn_db.php';

    $stmt = $pdo->prepare("INSERT INTO books (title, author, price, description, image_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $author, $price, $description, $target_file]);

    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Book</title>
</head>
<body>
    <h1>Upload Book</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title"><br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author"><br>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price"><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
