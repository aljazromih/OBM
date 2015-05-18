<?php
    include_once './db.php';
    include_once './session.php';
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $country = $_POST['cu'];
    if (!empty($name) && !empty($surname) && !empty($email) && 
            !empty($pass1) && ($pass1 == $pass2)) {
        $pass1 = sha1($pass1);
        //zapis v bazo        
        $query = sprintf("INSERT INTO users (country_id, name, lastname, email, pass) 
                  VALUES ((SELECT id FROM countries WHERE name='%s'),'%s','%s','%s','%s');",
                mysqli_real_escape_string($link, $country),
                mysqli_real_escape_string($link, $name),
                mysqli_real_escape_string($link, $surname),
                mysqli_real_escape_string($link, $email),
                mysqli_real_escape_string($link, $pass1));
        
        
        if (mysqli_query($link,$query)) {
            //vse je ok, zapisalo se je v bazo
            header("Location: index.php");
        }
        else {
            //napaka pri zapisu v bazo, verjetno tak email že obstaja
            //die(mysqli_error($link));
            header("Location: login.php");
        }
        
    }
    else {
        //neki je narobe
        //preusmeritev
        header("Location: login.php");
    }
?>  