<?php
include 'database.php';
include 'user.php';

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the POST request
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    //buat update and display output jika berjaya
    if ($user->updateUser($matric, $name, $role)) {
        $message = "Update action is successful!";
    } else {
        $message = "Update failed. Please try again.";
    }

    // Close the connection
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status</title>
</head>
<body>
    <?php if (!empty($message)): ?>
        <p class="<?php echo ($message == "Update action is successful!") ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <button onclick="window.location.href='read.php';">Go Back</button>
</body>
</html>
