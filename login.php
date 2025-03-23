<title>Login - TopsCodingCppWiki</title>
<script>
function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login_server.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("username=" + username + "&password=" + password);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText == "Login success.") {
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
if(isset($_COOKIE["id"])&&isset($_COOKIE["token"])){
    $id=$_COOKIE["id"];
    $token=$_COOKIE["token"];
    $sql='select * from users where id="'.$id.'" and token="'.$token.'"';
    $result=$conn->query($sql);
    if($result->num_rows>0){
        echo 'You have already logged in.';
        exit();
    }else{
        setcookie("id", "", time() - 3600, "/");
        setcookie("token", "", time() - 3600, "/");
        echo "<h1>Login</h1>";
        echo "<input type='text' id='username' placeholder='Username'><br>";
        echo "<input type='password' id='password' placeholder='Password'><br>";
        echo "<button onclick='login()'>Login</button>";
        exit();
    }
}else{
    echo "<h1>Login</h1>";
    echo "<input type='text' id='username' placeholder='Username'><br>";
    echo "<input type='password' id='password' placeholder='Password'><br>";
    echo "<button onclick='login()'>Login</button>";
    exit();
}
?>