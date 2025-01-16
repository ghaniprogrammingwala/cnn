<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];
    $category = $_POST['category'];

    $query = $conn->prepare("INSERT INTO articles (title, description, content, image_url, category) VALUES (:title, :description, :content, :image_url, :category)");
    $query->execute([
        'title' => $title,
        'description' => $description,
        'content' => $content,
        'image_url' => $image_url,
        'category' => $category
    ]);

    header('Location: admin_panel.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
    <style>
        /* CNN-inspired color theme */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #c8102e; /* CNN red color */
            text-align: center;
            margin-top: 20px;
        }

        form {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            width: 60%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            background-color: #c8102e; /* CNN red color */
            color: white;
            border: none;
            padding: 14px 20px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #9b0b1d; /* Darker red for hover */
            transform: scale(1.05);
        }

        input[type="text"]:hover, textarea:hover {
            border-color: #c8102e; /* CNN red color on hover */
            transform: scale(1.02);
        }

        /* Hover effect on form fields */
        input[type="text"], textarea {
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        
    </style>
</head>
<body>
    <h1>Add New Article</h1>
    <form method="POST" action="">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Short Description" required></textarea>
        <textarea name="content" placeholder="Full Content" required></textarea>
        <input type="text" name="image_url" placeholder="Image URL">
        <input type="text" name="category" placeholder="Category">
        <button type="submit">Add Article</button>
    </form>
</body>
</html>
