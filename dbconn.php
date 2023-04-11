<?php 
    $host="127.0.0.1";
    $db="phonebooks";
    $user="root";
    $pass="";
    $dsn="mysql:host=$host;dbname=$db;";
    $pdo=new PDO($dsn,$user,$pass);

    // $conn = mysqli_connect('localhost', 'root', '', 'phonebooks');

    // if(!$conn){
    //     die(('Connection Failed.'.mysqli_connect_error()));
    // }
?>