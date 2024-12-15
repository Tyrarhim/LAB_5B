<?php
include 'database.php';
include 'user.php';

  //buat instance baru untuk database class and connect
$database = new Database();
$db = $database->getConnection();

// Create an instance of the User class
$user = new User($db);

// handle untuk post data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($user->createUser($matric, $name, $password, $role)) {
        // Registration berjaya
        $message = "Register is successful!";
    } else {
        // Registration gagal
        $message = "Registration failed. Please try again.";
    }
}

// Close the connection
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status</title>
</head>
<body>
    <h2><?php echo isset($message) ? $message : "Something went wrong."; ?></h2>
    
    <?php if (isset($message) && $message == "Register is successful!"): ?>
        <button onclick="window.location.href='login.php';">Go to Login Page</button>
    <?php else: ?>
        <button onclick="window.history.back();">Go Back</button>
    <?php endif; ?>
</body>
</html>
