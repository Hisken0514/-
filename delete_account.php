<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'conn_db.php';

$username = $_SESSION['username'];

// 刪除使用者的所有資料，包括書籍等相關資訊
try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("DELETE FROM books WHERE user_id = (SELECT id FROM users WHERE username = ?)");
    $stmt->execute([$username]);

    $stmt = $pdo->prepare("DELETE FROM users WHERE username = ?");
    $stmt->execute([$username]);

    $pdo->commit();
    session_destroy();
    header("Location: register.php");
    exit();
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Failed to delete account: " . $e->getMessage();
}
?>
