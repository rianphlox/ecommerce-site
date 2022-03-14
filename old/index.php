<?php
    require_once 'config/db.php';
    
    $db = new DB('sql306.epizy.com', 'epiz_25023672', 'RBTXS7KOenTLR', 'epiz_25023672_phpblog');
    $conn = $db->conn;
    $msg = $msgClass = "";
    if (isset($_POST['signin'])) {
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = $conn->real_escape_string(trim($_POST['password']));

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    if (!empty($email) && !empty($password)) {
        // validate the email and password
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $msgClass = "alert-danger";
            $msg = "Please use a valid email!";
        } else {
            $query = "SELECT * FROM users WHERE email = ? AND password = ?";
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param('ss', $email, $password);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cookie_name = 'Username';
                        $cookie_value = $row['name'];
                        setcookie($cookie_name, $cookie_value, time() + 86400, '/');
                        header('Location: /blog');
                    }
                } else {
                    $msg = "User not found";
                    $msgClass = "alert-danger";
                }
            }
        }
    } else {
        $msg = "Please include all fields";
        $msgClass = "alert-danger";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    <style>
        .form-check-input {
            position: absolute;
            margin-top: 0.3rem;
            margin-left: -1.25rem;
        }

        .bg {
            background-image: url('https://w.wallhaven.cc/full/zm/wallhaven-zm8j9o.jpg');
            background-repeat: no-repeat;
        }

        .form-elegant .font-small {
            font-size: 0.8rem;
        }

        .form-elegant .z-depth-1a {
            -webkit-box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25);
            box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25);
        }

        .form-elegant .z-depth-1-half,
        .form-elegant .btn:hover {
            -webkit-box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15);
            box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15);
        }

        .form-elegant .modal-header {
            border-bottom: none;
        }

        .modal-dialog .form-elegant .btn .fab {
            color: #2196f3 !important;
        }

        .form-elegant .modal-body,
        .form-elegant .modal-footer {
            font-weight: 400;
        }
    </style>
    <title>Login | Welcome</title>
</head>

<body style="height: 100vh; width: 100wv">
    <div class="d-flex h-100 flex-row justify-content-between">
        <div class="d-none bg d-md-block w-100 img-gradient"></div>
        <div class="w-100">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h3 class="display-4">Welcome! Login</h3>
                            <p class="animated fadeInDown text-muted mb-4">Please Login to Continue!</p>
                            <form action="<?= htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

                                <?php if ($msg !== "") : ?>
                                    <div class="alert alert-dismissible <?= $msgClass ?>">
                                        <button class="close">&times;</button>
                                        <?= $msg ?>
                                    </div>
                                <?php endif; ?>

                                <div class="md-form">
                                    <input type="text" name="email" id="materialRegisterFormEmail" class="form-control">
                                    <label for="materialRegisterFormEmail">Email</label>
                                </div>

                                <div class="md-form">
                                    <input type="password" id="materialRegisterFormPassword" name="password" class="form-control">
                                    <label for="materialRegisterFormPassword">Password</label>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkInput">
                                        <label class="form-check-label" for="checkInput">Remember Me</label>
                                    </div>
                                    <div>
                                        <p class="font-small blue-text d-flex justify-content-end">Forgot <a href="#" class="blue-text ml-1">
                                                Password?</a></p>
                                    </div>
                                </div>

                                <!-- <button name="signin" type="submit" class="btn blue-gradient btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button> -->

                                <button type="submit" name="signin" class="btn animated pulse blue-gradient btn-large btn-block text-uppercase mb-2 btn-rounded rounded-pill shadow-sm">Sign in</button>


                                <a href="" class="btn animated flipInX dusty-grass-gradient btn-block text-uppercase mb-2 rounded-pill shadow-sm" data-toggle="modal" data-target="#elegantModalForm">Sign Up</a>

                                <div class="text-center d-flex justify-content-between mt-4">
                                    <p><a href="/developer" class="text-info">Developer</a></p>
                                    <p><a href="/about" class="text-info">About</a></p>
                                    <p><a href="/privacy-policy" class="text-info">Privacy Policy</a></p>
                                    <p><a href="cookies" class="text-info">Cookie Policy</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- End -->




                <!-- Modal -->
                <div class="modal fade" id="elegantModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <!--Content-->
                        <div class="modal-content form-elegant">
                            <!--Header-->
                            <div class="modal-header text-center">
                                <h3 class="modal-title w-100 dark-grey-text font-weight-bold my-3" id="myModalLabel"><strong>Sign Up</strong></h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!--Body-->
                            <div class="modal-body mx-4">
                                <!--Body-->
                                <form id="signup">
                                    <div class="md-form mb-5">
                                        <input type="text" name="username" id="name" class="form-control validate">
                                        <label for="name" data-success="right" data-error="wrong">Your Name</label>
                                    </div>
                                    <div class="md-form mb-5">
                                        <input type="email" name="email" id="Form-email1" class="form-control validate">
                                        <label data-error="wrong" data-success="right" for="Form-email1">Your email</label>
                                    </div>

                                    <div class="md-form pb-3">
                                        <input type="password" name="password" id="Form-pass1" class="form-control validate">
                                        <label data-error="wrong" data-success="right" for="Form-pass1">Your password</label>

                                        <!-- <p class="font-small blue-text d-flex justify-content-end">Forgot <a href="#" class="blue-text ml-1">
                                                Password?</a></p> -->
                                    </div>

                                    <div class="text-center mb-3">
                                        <button type="submit" name="submit" class="btn animated bounceInDown btn-block blue-gradient btn-rounded z-depth-1a">sign up</button>
                                    </div>
                                </form>


                                <p class="font-small dark-grey-text text-right d-flex justify-content-center mb-3 pt-2"> or Sign in
                                    with:</p>

                                <div class="row my-3 d-flex justify-content-center">
                                    <!--Facebook-->
                                    <button type="button" class="btn btn-white btn-rounded mr-md-3 z-depth-1a"><i class="fab fa-facebook-f text-center"></i></button>
                                    <!--Twitter-->
                                    <button type="button" class="btn btn-white btn-rounded mr-md-3 z-depth-1a"><i class="fab fa-twitter"></i></button>
                                    <!--Google +-->
                                    <button type="button" class="btn btn-white btn-rounded z-depth-1a"><i class="fab fa-google-plus-g"></i></button>
                                </div>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer mx-5 pt-3 mb-1">
                                <!-- <p class="font-small grey-text d-flex justify-content-end">Not a member? <a href="#" class="blue-text ml-1">
                                        Sign Up</a></p> -->
                            </div>
                        </div>
                        <!--/.Content-->
                    </div>
                </div>
                <!-- Modal -->


            </div>
        </div>



        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.0/js/mdb.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            const signUpForm = document.querySelector('#signup')
            signUpForm.addEventListener('submit', e => {
                e.preventDefault()
                fetch('signup.php', {
                        method: 'POST',
                        body: new FormData(signUpForm)
                    })
                    .then(res => res.json())
                    .then(data => swal(`${data.msg}`, '', `${data.msgClass}`))
            })
        </script>
</body>

</html>
