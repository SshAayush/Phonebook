<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <title>Add Contact</title>
  </head>
  <body>
  <h1 class="mb-5 text-center">Add Contact</h1>
    <?php
    session_start();

    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
      exit();
    }
      include('dbconn.php');

      $success = false;

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $phone_no = $_POST['phone_no'];
        $addr = $_POST['addr'];

        $query = "INSERT INTO phonebook(name, phone_no, addr) VALUES (:name,:phone_no,:addr)";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone_no', $phone_no);
        $stmt->bindParam(':addr', $addr);

        if ($stmt->execute()) {
          $success = true;
        }
      }
    ?>

    <div class="container">
      <?php if ($success): ?>
        <div class="alert alert-success mb-3" role="alert">Form submitted successfully!</div>
      <?php endif; ?>
      <form action="#" method="POST">
        <div class="row mb-3">
          <div class="col-3">
            <label class="form-label" for="name">Full Name:</label>
          </div>
          <div class="col">
            <input class="form-control" type="text" name="name" id="name" placeholder="Full Name" />
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-3">
            <label class="form-label" for="num">Phone No.:</label>
          </div>
          <div class="col">
            <input class="form-control" type="number" name="phone_no" id="phone_no" placeholder="Phone No." />
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-3">
            <label class="form-label" for="addr">Address:</label>
          </div>
          <div class="col">
            <input class="form-control" type="text" name="addr" id="addr" placeholder="Address" />
          </div>
        </div>
        <button class="btn btn-primary btn-lg my-3" type="submit">Save</button>
      </form>
    </div>

    <script>
      setTimeout(function() {
        document.querySelector(".alert").style.display = "none"; // hide success message
        window.location.href = "/SL/phonebook/homepg.php"; // redirect to main page
      }, 900); // hide the message after 2 seconds
    </script>
 </body>
</html>    