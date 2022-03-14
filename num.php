<?php
    session_start();
    require 'config/db.php';

    $userEmail = isset($_SESSION['email']) ? strtolower(explode('@', $_SESSION['email'])[0]) : '';
    $db = new DB();
    $num = $db->returnCartNumber($userEmail);
    echo $num;