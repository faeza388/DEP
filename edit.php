<?php
include "db_conn.php"; // Include the database connection

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the user ID from the URL (for updating the correct user)
    $id = $_GET['id'];

    // Collect form data and sanitize input to prevent SQL injection
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // SQL query to update user information based on the ID
    $sql = "UPDATE `crud` 
            SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `gender` = '$gender' 
            WHERE `id` = $id";

    // Execute the query and check if it was successful
    if (mysqli_query($conn, $sql)) {
        // Redirect to index.php with a success message
        header("Location: index.php?msg=Record updated successfully");
        exit();
    } else {
        // Output an error message if the update failed
        echo "Failed: " . mysqli_error($conn);
    }
}

// Fetch the current user data based on the ID in the URL
$id = $_GET['id'];
$sql = "SELECT * FROM `crud` WHERE `id` = $id LIMIT 1";
$result = mysqli_query($conn, $sql);

// If user data exists, fetch it into an associative array
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    // Handle case where no user is found (optional)
    echo "No user found with ID: $id";
    exit();
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
    
    <title>Edit User Information</title>
</head>
<body>
<nav class="navbar navbar-light bg-primary text-white justify-content-center mb-5 py-3">
    PHP Complete CRUD Application
</nav>

<div class="container">
    <div class="text-center mb-4">
        <h3>Edit User Information</h3>
        <p class="text-muted">Click update after changing any Information</p>
    </div>
    
    <div class="container d-flex justify-content-center">
        <!-- Form to submit user data -->
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First Name:</label>
                    <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name']; ?>" required>
                </div>
                <div class="col">
                    <label class="form-label">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                </div>
            </div>

            <div class="mb-3"> 
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
            </div>

            <div class="form-group mb-3">
                <label>Gender:</label> &nbsp;
                <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php echo ($row['gender'] == 'male') ? "checked" : ""; ?>> 
                <label for="male" class="form-input-label">Male</label>
                &nbsp;
                <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php echo ($row['gender'] == 'female') ? "checked" : ""; ?>>
                <label for="female" class="form-input-label">Female</label>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">Update</button>
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>