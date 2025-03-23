<?php
include 'configure.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($username) < 3 || strlen($username) > 20) {
        echo "Username must be between 3 and 20 characters long.";
        exit();
    }

    $sql = "SELECT * FROM users WHERE username=\"$username\"";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Username already exists.";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $token = bin2hex(random_bytes(16));

    $sql = "INSERT INTO users (username, password, token) VALUES (\"$username\", \"$hashed_password\", \"$token\")";

    if ($conn->query($sql) == TRUE) {
        echo "Registration success.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    exit();
}
?>