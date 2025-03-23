<?php
include 'common.php';
$sql='select * from articles where id="'.$_GET["id"].'"';
$result=$conn->query($sql);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo "<h1>".$row["title"]."</h1>";
        echo $row["content"];
    }
}else{
    echo "No page found.";
}
?>