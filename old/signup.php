<?php
require 'config/db.php';
$db = new DB('sql306.epizy.com', 'epiz_25023672', 'RBTXS7KOenTLR', 'epiz_25023672_phpblog');
$conn = $db->conn;

// if (!empty($name)  && !empty($email)  && !empty($password)) {
//     // validate email
//     if (filter_var($email) === false) {
//         $res = ['msg' => 'Please use a valid email', 'msgClass' => 'error'];
//         echo json_encode($res);
//     } else {
//         // check if user exists
//         $query = "SELECT id FROM users WHERE email = ? AND password = ?";
//         $stmt = $conn->prepare($query);
//         $stmt->bind_param('ss', $email, $password);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         if ($stmt->num_rows > 0) {
//             // user in data base
//             $res = array('msg' => "Email already exists", 'msgClass' => "error");
//             echo json_encode($res);
//         } else {
//             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//             $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
//             $stmt = $conn->prepare($query);
//             $stmt->bind_param('sss', $name, $email, $password);
//             $stmt->execute();
//             $res = array('msg' => 'Proceed to sign in', 'msgClass' => 'success');
//             echo json_encode($res);
//         }
//     }
// } else {
    // $res = array('msg' => "Please fill in all details", 'msgClass' => "error");
//     echo json_encode($res);
// }


    $name = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    if (!empty($name) &&!empty($email) && !empty($password)) {
        // validate the email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            // $res = ['msg' => 'Please use a valid email!', 'msgClass' => '#ff3547'];
            $res = ['msg' => 'Please use a valid email', 'msgClass' => 'error'];
            echo json_encode($res);
        } else {
            // check if user already exists using email 
            $query = "SELECT id FROM users WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // user exists. 
                // $res = ['msg' => 'User already exists', 'msgClass' => '#fb3', 'msgTitle' => 'Please Sign in!'];
                $res = array('msg' => "Email already exists", 'msgClass' => "error");
                echo json_encode($res);
            } else {
                // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ? )";
                // $query = "INSERT INTO users ( email, password) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sss', $name, $email, $password);
                if ($stmt->execute()) {
                    // $res = ['msg' => 'Success', 'msgTitle' => 'Please sign in', 'msgClass' => '#00c851'];
                    $res = array('msg' => 'Proceed to sign in', 'msgClass' => 'success');
                    echo json_encode($res);
                }
            }
        }
    } else {
        // $res = ['msg' => 'Please include all fields', 'msgClass' => '#ff3547'];
        $res = array('msg' => "Please fill in all details", 'msgClass' => "error");
        echo json_encode($res);
    }