<?php
session_start();
include 'conn_db.php';

$sql = "SELECT * FROM books";
$stmt = $pdo->query($sql);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <style>
        .book-container {
            display: flex;
            flex-wrap: wrap;
        }
        .book {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: calc(25% - 20px);
            box-sizing: border-box;
        }
        .book img {
            max-width: 100%;
            height: auto;
        }
        .book-info {
            border-top: 1px solid #ccc;
            margin-top: 10px;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Book Store</h1>
    <a href="upload.php">Upload Book</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <?php if (isset($_SESSION['username'])): ?>
        <a href="profile.php">Profile</a>
    <?php endif; ?>
    <h2>Books</h2>
    <div class="book-container">
        <?php foreach ($books as $row): ?>
            <div class="book">
                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                <div class="book-info">
                    <h3>Title:</h3>
                    <p><?php echo htmlspecialchars($row['title']); ?></p>
                    <h3>Author:</h3>
                    <p><?php echo htmlspecialchars($row['author']); ?></p>
                    <h3>Price:</h3>
                    <p><?php echo htmlspecialchars($row['price']); ?></p>
                    <h3>Description:</h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <a href="buy.php?id=<?php echo $row['id']; ?>">Buy</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
