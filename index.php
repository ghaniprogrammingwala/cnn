<?php
require 'db.php';

$query = $conn->query("SELECT * FROM articles ORDER BY created_at DESC LIMIT 10");
$articles = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My News</title>
    <link rel="stylesheet" href="beauty.css">
</head>
<body>
    <header>
        <h1>My News</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Politics</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">Tech</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="headlines">
            <h2>Top Headlines</h2>
            <?php foreach ($articles as $article): ?>
                <article>
                    <img src="<?= $article['image_url'] ?>" alt="<?= $article['title'] ?>">
                    <h3><?= $article['title'] ?></h3>
                    <p><?= substr($article['description'], 0, 100) ?>...</p>
                    <a href="article.php?id=<?= $article['id'] ?>">Read More</a>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>
