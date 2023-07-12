<?php
include_once('../config/dbcon.php');

if(isset($_POST['uploadfile'])) {
    $picture = $_FILES["choosefile"]["name"];
    $tempname = $_FILES["choosefile"]["tmp_name"];
    $folder  = "../uploads".$picture;


    $pg = "INSERT INTO car (picture) VALUES('$picture')";

    pg_query($db, $pg);

    if(move_uploaded_file($tempname, $folder)) {
        $msg= "Image bien importée";
    } else {
        $msg = "Ca a pas marché je te dis";
    }
}
$result = pg_query($db, "SELECT * FROM uploads");
?>