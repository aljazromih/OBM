<?php
    include_once './session.php';
    include_once './db.php';
    $name = $_POST['name'];
    $date = $_POST['date'];
    $currency = $_POST['currency'];
    $value = $_POST['value'];
    $purpose = $_POST['purpose'];
    $description = $_POST['description'];
    
    $query = "SELECT id FROM currencies WHERE abb = '".$currency."';";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $query = "SELECT id FROM purposes WHERE name = '".$purpose."';";
    $result = mysqli_query($link, $query);
    $row2 = mysqli_fetch_array($result);
    
    /*if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] < 5000000)) {
    
    $newName = "upload/".date('YmdHisu').'-'.$_FILES["file"]["name"];
    move_uploaded_file($_FILES["file"]["tmp_name"], $newName);
    }
    else {
        //neki je narobe
        //preusmeritev
        header("Location: add_bill.php");
    }*/
    
    if (!empty($name)) {
        $query = sprintf("UPDATE bills SET currency_id = '".$row['id']."', purpose_id = '".$row2['id']."', day = '".$date."', value = '".$value."', description = '".$description."', name = '".$name."' WHERE id = '".$_SESSION['bill_edit']."';");
        
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
        header("Location: index.php");
    }
?>  