<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit();
}
include('dbconn.php');
$id = $_POST['id'];
$name = $_POST['name'];
$phone_no = $_POST['phone_no'];
$addr = $_POST['addr'];

$stmt = $pdo->prepare("UPDATE phonebook SET id=:id,name=:name, phone_no=:phone_no, addr=:addr WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":phone_no", $phone_no);
$stmt->bindParam(":addr", $addr);

$stmt->execute();

header("Location: /SL/phonebook/homepg.php");
exit();

?>
