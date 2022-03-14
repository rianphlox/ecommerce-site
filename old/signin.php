<?php

    
    require 'config/db.php';

    $msg = '';
    $msgClass  = '';

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        // check for details
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            // check if email exists already
            $exists =  mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
            if (mysqli_num_rows($exists) > 0) {
               header('Location: blog')
            } else {
                $msg = "Email not registered";
                $msgClass = "alert-danger";
            }
            
        } else {
            // Failed
            $msg = "Please fill all details";
            $msgClass = "alert-danger";
        }
    }

?>

<?php include 'navbar.php'; ?>



    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card border-warning">
                    <div class="card-body">
                        <h4 class="card-title text-center">SIGN IN</h4>

                        
                        
                        <?php if($msg !== ''): ?>
                            <div class="alert alert-dismissible <?php echo $msgClass; ?>">
                                <?php echo $msg; ?>
                                <button role="button" class="close">&times;</button>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="md-form">
                                <input type="text" name="email" id="email" class="form-control">
                                <label for="name">Email</label>
                            </div>
                            <div class="md-form">
                                <input type="password" name="password" id="password" class="form-control">
                                <label for="password">Password</label>
                            </div>
                            <button class="btn btn-warning btn-lg btn-block" name="submit">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>