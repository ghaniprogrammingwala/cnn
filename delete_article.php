<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

require 'db.php';

$id = $_GET['id'];
$query = $conn->prepare("DELETE FROM articles WHERE id = :id");
$query->execute(['id' => $id]);

header('Location: admin_panel.php');
exit();
?>
