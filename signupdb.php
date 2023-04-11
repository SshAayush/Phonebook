<?php
    include('dbconn.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = ('INSERT INTO authentication(username, password, name, email) VALUES (:username, :password, :name, :email)');
    $stmt = $pdo->prepare($query);
    $stmt -> bindParam(':username',$username);
    $stmt -> bindParam(':password',$password);
    $stmt -> bindParam(':name',$name);
    $stmt -> bindParam(':email',$email);
    
    $stmt -> execute();

    header("Location: /SL/phonebook/login.php");
?>