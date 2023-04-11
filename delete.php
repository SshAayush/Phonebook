<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit();
}
    include('dbconn.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $stmt = $pdo->prepare('DELETE FROM phonebook WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: /SL/phonebook/homepg.php");
    exit();

?>