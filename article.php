<?php
require 'db.php';

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM articles WHERE id = :id");
$query->execute(['id' => $id]);
$article = $query->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "Article not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article['title'] ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>My News</h1>
    </header>
    <main>
        <h2><?= $article['title'] ?></h2>
        <img src="<?= $article['image_url'] ?>" alt="<?= $article['title'] ?>">
        <p><?= $article['content'] ?></p>
    </main>
</body>
</html>
