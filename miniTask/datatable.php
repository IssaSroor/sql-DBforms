<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Student Management</title>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Student Management</h2>

    <?php
    include("config.php");

    // Fetch all students
    $sql = "SELECT * FROM STUDENTS";
    $stmt = $conn->query($sql);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the students in a table
    echo "<table class='table table-bordered'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($students as $student) {
        echo "<tr>
                <td>" . htmlspecialchars($student['id']) . "</td>
                <td>" . htmlspecialchars($student['firstName']) . "</td>
                <td>" . htmlspecialchars($student['email']) . "</td>
                <td>
                    <form method='post' action='index.php' style='display:inline;'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($student['id']) . "' />
                        <button type='submit' class='btn btn-warning' name='edit'>Edit</button>
                    </form>
                    <form method='post' action='index.php' style='display:inline;'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($student['id']) . "' />
                        <button type='submit' class='btn btn-danger' name='delete' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</button>
                    </form>
                </td>
            </tr>";
    }

    echo "</tbody>
        </table>";

        if (isset($_POST['edit'])) {
            $editId = $_POST['id'];
            $editSql = "SELECT * FROM STUDENTS WHERE id = :id";
            $editStmt = $conn->prepare($editSql);
            $editStmt->bindParam(':id', $editId);
            $editStmt->execute();
            $editStudent = $editStmt->fetch(PDO::FETCH_ASSOC);
    
            if ($editStudent) {
                echo "<h3>Edit Student</h3>
                <form method='post' action='index.php'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($editStudent['id']) . "' />
                    <div class='form-group'>
                        <label for='firstName'>First Name:</label>
                        <input type='text' class='form-control' name='firstName' value='" . htmlspecialchars($editStudent['firstName']) . "' required />
                    </div>
                    <div class='form-group'>
                        <label for='email'>Email:</label>
                        <input type='email' class='form-control' name='email' value='" . htmlspecialchars($editStudent['email']) . "' required />
                    </div>
                    <div class='form-group'>
                        <label for='password'>Update Password:</label>
                        <input type='password' class='form-control' name='password' placeholder='Leave blank to keep current password' />
                    </div>
                    <button type='submit' class='btn btn-primary' name='update'>Update</button>
                    <a href='index.php' class='btn btn-secondary'>Cancel</a>
                </form>";
            }
        }
    ?>

    <a href="register.php" class="btn btn-primary">Register New Student</a>
</div>

<!-- Add Bootstrap JS and jQuery (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
