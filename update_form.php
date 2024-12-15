<?php
include 'database.php';
include 'user.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $database = new Database();
    $db = $database->getConnection();

    // instance User class
    $user = new User($db);

    // panggil maklumat user berdasarkan no matrik
    $userDetails = $user->getUser($matric);

    $db->close();

    // Check  user details
    if ($userDetails) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
        </head>

        <body>
            <h2>Update User</h2>
            <form action="update.php" method="post">
                <!-- Matric No input field (Editable) -->
                <label for="matric">Matric No:</label>
                <input type="text" id="matric" name="matric" value="<?php echo $userDetails['matric']; ?>" required><br>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>" required><br>
                
                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="">Please select</option>
                    <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
                    <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected"; ?>>Student</option>
                </select><br>
                
                <input type="submit" value="Update">
            </form>
        </body>

        </html>
        <?php
    } else {
        echo "User not found.";
    }
}
?>