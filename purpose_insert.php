<?php
    include_once './db.php';
    include_once './session.php';
    $name = $_POST['name'];
    if (!empty($name)) {
        //zapis v bazo        
        $query = sprintf("INSERT INTO purposes (name, user_id) VALUES ('".$name."', '".$_SESSION['user_id']."');");
        
        
        if (mysqli_query($link,$query)) {
            //vse je ok, zapisalo se je v bazo
            header("Location: add_bill.php");
        }
        else {
            //napaka pri zapisu v bazo, verjetno tak email že obstaja
            //die(mysqli_error($link));
            header("Location: bills.php");
        }
        
    }
    else {
        //neki je narobe
        //preusmeritev
        header("Location: bills.php");
    }
?>  