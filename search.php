<?php
    session_start();

    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
      exit();
    }
    include('dbconn.php');

    if(isset($_POST['search']));{
        $name = strtolower($_POST['search']); // convert search string to lowercase
        // $name =$_POST['search'];
    }
    $stmt =$pdo->prepare("SELECT * FROM phonebook where lower(name) LIKE :name");
    $stmt->bindParam(':name', $name_like);
    $name_like = '%' . $name . '%';
    $stmt -> execute();
    $value = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($value as $item){
        $get_id[] = $item['id']; //used to take array of id's
        // echo $get_id[1];
        $count++;
    }
    // echo $count;
    // Converting the array to a query string
    $queryString = http_build_query($get_id);
    
    // Sending the values using the header function
    header("Location: /SL/phonebook/homepg.php?count=$count&$queryString");

?>