<?php
include 'database.php';
include 'user.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the matric value from the POST request
    $matric = $_GET['matric'];

    //buat instance baru untuk database class and connect

    $database = new Database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new User($db);
    $user->deleteUser($matric);

    // Close the connection
    $db->close();
}