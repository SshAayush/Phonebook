<?php
    session_start();

    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
      exit();
    }
    include('dbconn.php');

    if(isset($_POST['search']));{
        // $name =strtolower( $_POST['search']);
        $name =$_POST['search'];
    }
    $stmt =$pdo->prepare("SELECT * FROM phonebook where name = :name");
    $stmt -> bindParam(':name',$name);
    $stmt -> execute();
    $value = $stmt->fetch(PDO::FETCH_ASSOC);

    // session_start(); // start the session
    // $_SESSION['search'] = $value['id']; // set the value to pass
echo $value['id'];
    header("Location: /SL/phonebook/homepg.php?id= $value[id]");
?>