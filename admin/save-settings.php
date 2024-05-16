<?php

include "config.php";

if(empty($_FILES['logo']['name'])){
    $file_name = $_POST['old_logo'];

}else{

    $errors = array();

    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size']/1024;
    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
   
    $file_ext = explode('.',$file_name);
    $ext = strtolower(end($file_ext));
    $extentions = array("jpeg","jpg","png");

    if(in_array($ext,$extentions) === false){

        $errors[] = "This Extention File is Not Allowed,Please choose jpg or png file.";
    }

    if($file_size > (1024*2))
    {
        $errors[] = "File size must be 2MB or lower";
    }

    if(empty($errors) == true)
    {
        move_uploaded_file($file_tmp,"images/".$file_name);
    }
    else
    {
        print_r($errors);
        die();
    }
}

$sql = "UPDATE `settings` SET `websitename` = '{$_POST["website_name"]}', `logo` = '{$file_name}', `footerdesc` = '{$_POST["footer_desc"]}' ";

$result = mysqli_query($conn,$sql);

if($result){
    header("Location:setting.php");
}else{
    echo "Query Failled..";
}

?>