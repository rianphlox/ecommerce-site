<?php
    function pre_file($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    
    // if (isset($_POST['submit'])) {
        $file = $_FILES['file'];

        // pre_file($file);
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $fileTempName = $file['tmp_name'];
        $error = $file['error'];


        $fileExt = explode('.', $fileName);
        $fileActualExtension = strtolower(end($fileExt));
        $allowed = ['jpg', 'jpeg', 'png'];
        if (!in_array($fileActualExtension , $allowed)) {
            // echo "You can't upload files of this type";
            echo json_encode(['msg' => "You can't upload files of this type"]);
            // header('Location: index.php?uploaded=error');
        } else {
            if ($error === 0) {
                if ($fileSize < 1000000) {
                    $newFileName = uniqid('', true) . ".$fileActualExtension";
                    $fileDestination = "Admin" . $newFileName;
                    move_uploaded_file($fileTempName, $fileDestination);
                    echo json_encode(['msg' => 'Success']);
                    // header('Location: index.php?uploaded=true');
                } else {
                    echo json_encode(['msg' => "Your file is too large"]);
                }
            } else {
                echo json_encode(['msg' => "There was an error uploading this file"]);
            }
        }
    // }
    