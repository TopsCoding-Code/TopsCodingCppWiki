<?php
include 'configure.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=\"$username\"";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        if (password_verify($password, $hashed_password)) {
            $id = $row["id"];
            $token = $row["token"];
            setcookie("id", $id, time() + 864000);
            setcookie("token", $token, time() + 864000);
            echo "Login success.";
        } else {
            echo "Login failed: Incorrect password.";
        }
    } else {
        echo "Login failed: User not found.";
    }

    exit();
}
?>