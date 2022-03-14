<?php

    require 'config/db.php';

    $db = new DB();
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $username = htmlentities(trim($username))
    $email = htmlentities(trim($email))
    $password = htmlentities(trim($password))


    $res = $db->createUser($username, $email, $password);
    echo json_encode($res);

    ?>