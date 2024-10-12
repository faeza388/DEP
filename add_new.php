<?php
include "db_conn.php"; // Include database connection
if (isset($_POST['submit'])) {
    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    // SQL query to insert form data into the database
    $sql = "INSERT INTO `crud`(`id`, `first_name`, `last_name`, `email`, `gender`) 
            VALUES (NULL, '$first_name', '$last_name', '$email', '$gender')"; // Fixed missing semicolon

    // Execute the query and check if successful
    $result = mysqli_query($conn, $sql);  
    if ($result) {
        header("Location: index.php?msg=New record created successfully");
        exit(); // Stop further script execution after redirection
    } else {
        echo "Failed: " . mysqli_error($conn); // Corrected error handling
    }
}
?>

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
<nav class="navbar navbar-light bg-primary text-white justify-content-center mb-5 py-3">
    PHP Complete CRUD Application
</nav>

<div class="container">
    <div class="text-center mb-4">
        <h3>Add New User</h3>
        <p class="text-muted">Complete the form below to add a new user</p>
    </div>
    <div class="container d-flex justify-content-center">
        <!-- Form to submit user data -->
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First Name:</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Albert" required>
                </div>

                <div class="col">
                    <label class="form-label">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Einstein" required>
                </div>
            </div>

            <div class="mb-3"> 
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
            </div>

            <div class="form-group mb-3">
                <label>Gender:</label> &nbsp;
                <input type="radio" class="form-check-input" name="gender" id="male" value="male" required>
                <label for="male" class="form-input-label">Male</label>
                &nbsp;
                <input type="radio" class="form-check-input" name="gender" id="female" value="female" required>
                <label for="female" class="form-input-label">Female</label>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>