<?php
include 'configure.php';
if(isset($_COOKIE['id'])&&isset($_COOKIE['token'])){
    $id = $_COOKIE['id'];
    $token = $_COOKIE['token'];
    $sql = 'SELECT * FROM users WHERE id="' . $id . '" AND token="' . $token . '"';
    $result = $conn -> query($sql);
    if($result -> num_rows > 0){
        $row = $result -> fetch_assoc();
        if($row['access'] != 'admin'){
            exit();
        }
    }else{
        exit();
    }
}else{
    exit();
}
if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["content"])){
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    if($id == "" || $title == "" || $content == ""){
        echo "All fields are required.";
        exit();
    }
    $sql = 'SELECT * FROM articles WHERE id="' . $id . '"';
    $result = $conn -> query($sql);
    if($result -> num_rows > 0){
        echo "Id already exist.";
        exit();
    }
    $sql = 'INSERT INTO articles VALUE("' . $id . '", "' . $title . '", "' . $content . '")';
    $result = $conn -> query( $sql );
    if($result == TRUE){
        echo 'Publish success.';
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>