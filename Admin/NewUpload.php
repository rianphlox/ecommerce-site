<?php
    $conn = new mysqli('localhost', 'root', '1234') or die($conn->connect_error);
    $conn->select_db('fashi');
    
    $msg = $msgClass = "";

    if (isset($_POST['upload'])) {
        // path to store the uploaded image
        $target = 'images/' . basename($_FILES['image']['name']);
        $image_name = $_FILES['image']['name'];
        $image_name = explode('.', $image_name)[0];
        $category = $_POST['category'];

        $query = "INSERT IGNORE INTO stock (image_name, image_path, category, current_price, initial_price) VALUES ('$image_name', '$target', '$category', '34.00', '50.00')";
        $conn->query($query);

        // move the file to the destination
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // error
            $msg = "Error";
            $msgClass = 'alert-danger';
        } else {
            // success
            $msgClass = 'alert-success';
            $msg = 'Success';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fashi/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <form action="Upload.php" method="post" enctype="multipart/form-data">
                <?php if($msg !== '') : ?>
                    <div class="alert alert-dismissible <?= $msgClass ?>">
                        <span class="close">&times;</span>
                        <?= $msg ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="category" id="category">
                    <label for="#category">Category</label>
                </div>
                <button type="submit" name="upload" class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>
</body>
</html>