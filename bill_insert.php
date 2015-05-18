<?php
    include_once './session.php';
    include_once './db.php';
    $name = $_POST['name'];
    $date = $_POST['date'];
    $currency = $_POST['currency'];
    $value = $_POST['value'];
    $purpose = $_POST['purpose'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];
    
    if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] < 5000000)) {
    
    $newName = "upload/".date('YmdHisu').'-'.$_FILES["file"]["name"];
    $newName = str_replace(' ', '', $newName);
    move_uploaded_file($_FILES["file"]["tmp_name"], $newName);
    }
    else {
        //neki je narobe
        //preusmeritev
        header("Location: add_bill.php");
    }
    
    if (!empty($name)) {
        $query = sprintf("INSERT INTO bills (currency_id, purpose_id, user_id, day, value, description, name, image_path) 
                  VALUES ((SELECT id FROM currencies WHERE abb='%s'),(SELECT id FROM purposes WHERE name='%s'),'%s','%s','%s','%s','%s','%s')",
                mysqli_real_escape_string($link, $currency),
                mysqli_real_escape_string($link, $purpose),
                mysqli_real_escape_string($link, $user_id),
                mysqli_real_escape_string($link, $date),
                mysqli_real_escape_string($link, $value),
                mysqli_real_escape_string($link, $description),
                mysqli_real_escape_string($link, $name),
                mysqli_real_escape_string($link, $newName));
        
        if (mysqli_query($link,$query)) {
            //vse je ok, zapisalo se je v bazo
            
            header("Location: bills.php");
        }
        else {
            //die(mysqli_error($link));
            header("Location: add_bill.php");
        }
        
    }
    else {
        //neki je narobe
        //preusmeritev
        header("Location: add_bill.php");
    }
?>  