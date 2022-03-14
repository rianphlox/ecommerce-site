<?php
    require 'config/db.php';
    $db = new DB();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $db->LogUserIn($email, $password);
    // if ($res['msgClass'] == 'success') {
    //     session_start();
    //     $_SESSION['email'] = $_POST['email'];
    // }
    // $res['msgClass'] == 'success' && (session_start() $_SESSION['email'] = $email);
    echo json_encode($res);