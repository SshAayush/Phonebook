<?php 
    session_start();

    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
      exit();
    }
    include('dbconn.php');
    $id ;
    $i = 0;
    $maifhokenai;
    @$count = $_GET['count'];

    do{
    @$id = $_GET[$i]; // @ used to hide error of this specific line
    

    if($id != null){
    $stmt = $pdo->prepare("SELECT * FROM phonebook where id = :id");
    $stmt -> bindParam(':id',$id);
    $stmt -> execute();
    $value[$i] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $maifhokenai = true;
    // $s_value = $value[0]['name'];
    }
    else{
    $stmt = $pdo->query('SELECT * FROM phonebook');
    $value = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $maifhokenai = false;

    // $s_value = "Search";
    }$i++;}while($i<$count);
// ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <title>Phone Book</title>
</head>
<body>
<div class="container my-5">
    <h1 class="display-4 text-center mb-5">Phone Book</h1>
    <div class="d-flex justify-content-end align-items-center">
        <form class="form-inline my-2 my-lg-0" action="search.php" method="POST">
            <div class="input-group">
                <input type="search" class="form-control rounded-0" placeholder="<?php //echo $s_value ?>" name="search" aria-label="Search" aria-describedby="search-addon" />
                <div class="input-group-append">
                    <button class="btn btn-primary rounded-0" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if($maifhokenai){

                    foreach ($value as $item) {?>
            <tr>
                <td><?php echo $item[0]['name'];?></td>
                <td><?php echo $item[0]['phone_no'];?></td>
                <td><?php echo $item[0]['addr'] ; ?></td>
                <td class="d-flex justify-content-around align-items-center">
                    <form action="update.php" method="GET">
                        <button class="btn btn-primary btn-sm text-white" type="submit" name="id" value="<?php echo $item['id']?>">Update</button>
                    </form>
                    <form action="delete.php" method="GET">
                        <button class="btn btn-danger btn-sm text-white" type="submit" name="id" value="<?php echo $item['id']?>">Delete</button>
                    </form>
                </td>
            </tr>
            <?php }} 
            else{

                    foreach ($value as $item) {?>
            <tr>
                <td><?php echo $item['name'];?></td>
                <td><?php echo $item['phone_no'];?></td>
                <td><?php echo $item['addr'] ; ?></td>
                <td class="d-flex justify-content-around align-items-center">
                    <form action="update.php" method="GET">
                        <button class="btn btn-primary btn-sm text-white" type="submit" name="id" value="<?php echo $item['id']?>">Update</button>
                    </form>
                    <form action="delete.php" method="GET">
                        <button class="btn btn-danger btn-sm text-white" type="submit" name="id" value="<?php echo $item['id']?>">Delete</button>
                    </form>
                </td>
            </tr>
            <?php }}?>
        </tbody>
    </table>
    <div class="d-flex justify-content-around align-items-center">
        <a href="/SL/phonebook/directory.php">
            <button class="btn btn-success btn-sm my-3 text-white">Add Contact</button>
        </a>
        <!-- <a href="/SL/phonebook/login.php">
            <button class="btn btn-danger btn-sm my-3 text-white">Log Out</button>
        </a> -->
        <form action="logout.php" method="POST">
            <button class="btn btn-danger btn-sm text-white" type="submit" name="logout" value="logout">Log out</button>
        </form>
    </div>
</div>
    
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
  crossorigin="anonymous"
></script>
</body>
</html>
