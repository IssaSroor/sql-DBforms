<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Registration Page</title>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">User Registration</h2>

    <?php
    include("config.php");

    // Handle registration form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the data into the database
        $insertSql = "INSERT INTO STUDENTS (firstName, email, password) VALUES (:firstName, :email, :password)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bindParam(':firstName', $name);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->bindParam(':password', $hashedPassword);

        if ($insertStmt->execute()) {
            echo "<div class='alert alert-success' role='alert'>Registration successful!</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Registration failed!</div>";
        }
    }
    ?>

    <form method="post" action="register.php">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
    </form>
</div>

<!-- Add Bootstrap JS and jQuery (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
