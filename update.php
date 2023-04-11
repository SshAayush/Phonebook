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

    $stmt = $pdo->prepare('SELECT * FROM phonebook WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $value = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <title>Update contact</title>
</head>
<body>
    <?php
        $id = $value['id'];
        $name = $value['name'];
        $phone = $value['phone_no'];
        $address = $value['addr'];
    ?>
    <div class="container my-5">
        <form action="updatedb.php" method="POST">
            <h1 class="mb-5 text-center">Update Contact</h1>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="id">ID:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" name="id" id="id" value="<?php echo $id; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="name">Full Name:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Full Name" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="phone_no">Phone No.:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" name="phone_no" id="phone_no" value="<?php echo $phone;?>" placeholder="Phone No." />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="addr">Address:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="addr" id="addr" value="<?php echo $address; ?>" placeholder="Address" />
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-lg my-3" type="submit">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
