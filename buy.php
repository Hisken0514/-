<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $buyer_id = $_SESSION['user_id'];

    $mysqli = new mysqli("localhost", "web", "1234", "mybookstore");
    $stmt = $mysqli->prepare("INSERT INTO orders (book_id, buyer_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $book_id, $buyer_id);
    $stmt->execute();

    echo "Book purchased successfully!";
} else {
    echo "Invalid book ID.";
}
?>
