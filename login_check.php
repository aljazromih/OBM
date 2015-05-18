<?php
    include_once './db.php';
    include_once './session.php';
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    if (!empty($email) && !empty($pass)) {
        $pass = sha1($pass);
        $query = sprintf("SELECT * FROM users 
                  WHERE (email = '%s') 
                  AND (pass = '%s')",
                mysqli_real_escape_string($link, $email),
                mysqli_real_escape_string($link, $pass));
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_array($result);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['logged'] = 1;
            header("Location: index.php");
            die();
        }
        else {
            header("Location: login.php");
            die();
        }
    }
    else {
        header("Location: login.php");
        die();
    }
?>