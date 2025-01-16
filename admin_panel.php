<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require 'db.php';

$query = $conn->query("SELECT * FROM articles ORDER BY created_at DESC");
$articles = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            padding: 20px;
            background-color: #d32424;
            color: #fff;
            margin: 0;
        }
        a {
            text-decoration: none;
            color: #d32424;
            font-weight: bold;
            transition: color 0.3s;
        }
        a:hover {
            color: #a51e1e;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);
        }
        table thead {
            background-color: #d32424;
            color: #fff;
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table tbody tr:hover {
            background-color: #f7e5e5;
            transform: scale(1.01);
            transition: all 0.2s ease-in-out;
        }
        table td a {
            margin-right: 10px;
            padding: 5px 10px;
            border-radius: 3px;
        }
        table td a:hover {
            background-color: #d32424;
            color: #fff;
            transition: all 0.3s ease-in-out;
        }
        .add-article {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 0;
            text-align: center;
            background-color: #d32424;
            color: #fff;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .add-article:hover {
            background-color: #a51e1e;
        }
    </style>
</head>
<body>
    <h1>Admin Room</h1>
    <a href="add_article.php" class="add-article">Add New Article</a>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $article['title'] ?></td>
                    <td>
                        <a href="edit_article.php?id=<?= $article['id'] ?>">Edit</a>
                        <a href="delete_article.php?id=<?= $article['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
