<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    require 'config/db.php';
    
    $db = new DB();

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $product_name = $_POST['product_name'];
        $path = $_POST['image_path'];
        $price = $_POST['price'];
        $quantity = 1;

        $res = $db->AddToCart(isset($_SESSION['email']) ? strtolower(explode('@', $_SESSION['email'])[0]) : '', $product_name, $path, $price, $quantity);
        echo json_encode($res);
    }

    // if ( isset($_POST['reset'])  ) {
    //     // 1. First Validate the Email
    //     // 2. Check if user email exists in database
    //     $resetEmail = $db->conn->real_escape_string(htmlentities($_POST['email']));
    //     if (!empty(htmlentities($_POST['email']))) {
    //         // validate the email
    //         if (!filter_var($resetEmail, FILTER_VALIDATE_EMAIL)) {
    //             // invalid email
    //             echo json_encode(['msg' => 'Please use a valid email', 'msgClass' => 'error', 'secondMsgclass' => '#fb3']);
    //         } else {
    //             // check if email exists in db
    //             $query = "SELECT id FROM users WHERE email = ?";
    //             $stmt = $db->conn->prepare($query);
    //             $stmt->bind_param('s', $resetEmail);
    //             $stmt->execute();
    //             $stmt->bind_result($id);
    //             $stmt->fetch();
    //             if (!$id) {
    //                 // email not in database 
    //                 echo json_encode(['msg' => "Email doesn't exist", 'msgClass' => 'error', 'secondMsgClass' => '#fb3']);
    //             } else {
    //                 // send email 
    //                 $msg = "Please Reset your password using this link <a href='link.php'>Reset Password</a>";
    //                 mail($resetEmail, 'Reset Password', $msg);
    //             }
    //         }
    //     } else {
    //         echo json_encode(['msg' => 'Please include a valid email', 'msgClass' => 'success', 'secondMsgClass' => '#fb3']);
    //     }
    // }


    // // if ( isset($_POST['req']) && isset($_POST['req']) == 'CartNumber' ) {
    // //     $res = $db->returnCartNumber(isset($_SESSION['email']) ? strtolower(explode('@', $_SESSION['email'])[0]) : '');
    // // }