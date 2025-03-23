<title>Index - TopsCodingCppWiki</title>
<?php
include 'common.php';
$sql= "select * from articles";
$result=$conn->query($sql);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo "<h4 style='margin:0px;'>".$row["title"]."</h4>";
        echo substr($row["content"],0,20);
        echo " <a href='article.php?id=".$row["id"]."'>Read more</a><br><hr>";
    }
}else{
    echo "No page found.";
};
?>