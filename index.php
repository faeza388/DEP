<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>PHP CRUD Application</title>
</head>
<body>
<nav class="navbar navbar-light bg-primary justify-content-center mb-5 py-3" style="color:white;">
    PHP Complete CRUD Application
</nav>

<div class="container">
    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        '.$msg.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <a href="add_new.php" class="btn btn-dark mb-3">Add New</a>

    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">First Name</th> 
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Gender</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      // Include the database connection file
      include "db_conn.php";
      
      // Fetch all the records from the CRUD table
      $sql = "SELECT * FROM `crud` WHERE id != 1"; // Exclude the first row with id = 1
      $result = mysqli_query($conn, $sql);
      
      // Check if query was successful
      if ($result) {
          // Loop through each row and display the data
          while ($row = mysqli_fetch_assoc($result)) {
      ?>
         <tr>
          <td><?php echo $row['id']; ?></td> 
          <td><?php echo $row['first_name']; ?></td>
          <td><?php echo $row['last_name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['gender']; ?></td>
          <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>" class="link-dark">
                <i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
            <a href="delete.php?id=<?php echo $row['id']; ?>" class="link-dark">
                <i class="fa-solid fa-trash fs-5"></i></a>
          </td>
        </tr>
      <?php
          }
      } else {
          echo "<tr><td colspan='6'>No records found.</td></tr>";
      }
      ?>
      </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>