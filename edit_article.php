<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require 'db.php';

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM articles WHERE id = :id");
$query->execute(['id' => $id]);
$article = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    // Handle file upload
    $image_url = $article['image_url']; // Default to existing image URL
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] !== "") {
        $upload_dir = 'uploads/';
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_path = $upload_dir . basename($image_name);

        // Check if file is an image and upload
        $check = getimagesize($image_tmp_name);
        if ($check !== false) {
            // Move the uploaded file to the server directory
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                $image_url = $image_path; // Update image URL if file is uploaded
            }
        }
    }

    $update = $conn->prepare("UPDATE articles SET title = :title, description = :description, content = :content, image_url = :image_url, category = :category WHERE id = :id");
    $update->execute([
        'title' => $title,
        'description' => $description,
        'content' => $content,
        'image_url' => $image_url,
        'category' => $category,
        'id' => $id
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
    <title>Edit Article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fefefe;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #cc0000;
            color: white;
            text-align: center;
            padding: 20px;
            margin: 0;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: calc(100% - 40px);
            margin: 10px 20px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        input[type="text"]:hover,
        textarea:hover,
        input[type="file"]:hover {
            border-color: #cc0000;
            transform: scale(1.02);
        }

        button {
            display: block;
            width: calc(100% - 40px);
            margin: 20px auto;
            padding: 12px 20px;
            background-color: #cc0000;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #a30000;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        input[type="text"]:focus,
        textarea:focus,
        button:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <h1>Edit Article</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <input 
            type="text" 
            name="title" 
            value="<?= htmlspecialchars($article['title']) ?>" 
            placeholder="Enter the article title" 
            required>
        <textarea 
            name="description" 
            rows="4" 
            placeholder="Enter a short description of the article" 
            required><?= htmlspecialchars($article['description']) ?></textarea>
        <textarea 
            name="content" 
            rows="8" 
            placeholder="Enter the full content of the article" 
            required><?= htmlspecialchars($article['content']) ?></textarea>
        <input 
            type="file" 
            name="image" 
            accept="image/*" 
            placeholder="Upload an image (optional)">
        <input 
            type="text" 
            name="category" 
            value="<?= htmlspecialchars($article['category']) ?>" 
            placeholder="Enter the article category">
        <button type="submit">Update Article</button>
    </form>
</body>
</html>
