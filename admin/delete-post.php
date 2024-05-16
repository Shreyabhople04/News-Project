<?php

include "config.php";

$POST_id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql1 = "SELECT * FROM `post` WHERE `post_id` = '$POST_id';";
$result = mysqli_query($conn, $sql1) or die("Query Failled..! : select");
$row = mysqli_fetch_assoc($result);

unlink("upload/".$row['post_img']);

$sql = "DELETE FROM `post` WHERE `post_id` = '$POST_id';";
$sql .= "UPDATE `category` SET `post` = `post` - 1 WHERE `category_id` = '$cat_id';";

if(mysqli_multi_query($conn,$sql)){$result
;

echo "<pre>";
print_r($row);header("Location: $host/admin/post.php");
}else{
    echo "Query Failled..!";
}

?>