<?php
    session_start();
    include('dbconn.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = ('SELECT username,password FROM authentication');
    $stmt = $pdo->prepare($query);
    $stmt -> execute();

    $value = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // $org_username = $value[0]['username'];
    // $org_password = $value[0]['password'];

    foreach($value as $item){
        if($username === $item['username'] && $password === $item['password']){
            $_SESSION['username'] = $username;
            header("Location: /SL/phonebook/homepg.php");
           }
    }
    if (!isset($_SESSION['username'])){
    $invalid = "Invalid Credentials!";
    header("Location: /SL/phonebook/login.php?invalid= $invalid");}
?>