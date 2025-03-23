<title>Create Article - TopsCodingCppWiki</title>
<script>
function publish(){
    var id = document.getElementById("id").value;
    var title = document.getElementById("title").value;
    var content = document.getElementById("content").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "create_server.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("id=" + id + "&title=" + title + "&content=" + content);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText == "Publish success.") {
                window.location.href = "index.php";
            } else {
                alert(xhr.responseText);
            }
        }
    };
}
</script>
<?php
include 'common.php';
if(isset($_COOKIE['id'])&&isset($_COOKIE['token'])){
    $id = $_COOKIE['id'];
    $token = $_COOKIE['token'];
    $sql = 'SELECT * FROM users WHERE id="' . $id . '" AND token="' . $token . '"';
    $result = $conn -> query($sql);
    if($result -> num_rows > 0){
        $row = $result -> fetch_assoc();
        if($row['access'] == 'admin'){
            echo '<input id="id" placeholder="The unique id"/><br>';
            echo '<input id="title" placeholder="Title"/><br>';
            echo '<textarea id="content" placeholder="Content, Support HTML"></textarea><br>';
            echo '<button onclick="publish()">Publish</button>';
            exit();
        }else{
            echo "You are not allowed to create articles.";
            exit();
        }
    }else{
        echo "You are not allowed to create articles.";
        exit();
    }
}else{
    echo "You are not allowed to create articles.";
    exit();
}
?>