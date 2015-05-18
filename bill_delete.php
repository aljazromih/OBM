<?php

include_once './header.php';
include_once './db.php';
include_once './session.php';
if($_SESSION['logged'] != 1){
    header("Location: index.php");
}

$bill_id = $_GET['id'];

$query = "SELECT * FROM bills WHERE id = ".$bill_id.";";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

if (file_exists($row['image_path'])) {
    unlink($row['image_path']);
}

$query = "DELETE FROM bills WHERE id = ".$bill_id.";";
if(mysqli_query($link, $query)){
    header("Location: bills.php");
}
else{
    echo 'Error';
    die();
}

?>