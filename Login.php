<?php 
    session_start();
    require 'config/db.php';
    $db = new DB();
    $email = isset($_SESSION['email']) ? explode('@', $_SESSION['email'])[0] : '';
?>

<?php include 'navLinks.php' ?>
<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <?php include 'header.php' ?>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Login</h2>
                        <form id="Login">
                            <div class="group-input">
                                <label for="username">Username or email address *</label>
                                <input name="email" autocomplete="off" type="text" id="email">
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input name="password" type="password" autocomplete="off" id="pass">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <label for="save-pass">
                                        Save Password
                                        <input type="checkbox" id="save-pass">
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="./Reset" class="forget-pass">Forget your Password</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="./Register" class="or-login">Or Create An Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

    

    <?php include 'footer.php' ?>

    <!-- Js Plugins -->
    <script src="fashi/js/jquery-3.3.1.min.js"></script>
    <script src="fashi/js/bootstrap.min.js"></script>
    <script src="fashi/js/jquery-ui.min.js"></script>
    <script src="fashi/js/jquery.countdown.min.js"></script>
    <script src="fashi/js/jquery.nice-select.min.js"></script>
    <script src="fashi/js/jquery.zoom.min.js"></script>
    <script src="fashi/js/jquery.dd.min.js"></script>
    <script src="fashi/js/jquery.slicknav.js"></script>
    <script src="fashi/js/owl.carousel.min.js"></script>
    <script src="fashi/js/notyf.min.js"></script>
    <script src="fashi/js/main.js"></script>
    <script src="fashi/js/add.js"></script>
    <script>const form=document.querySelector("#Login");form.addEventListener("submit",e=>{e.preventDefault(),fetch("y.php",{method:"POST",body:new FormData(form)}).then(e=>e.json()).then(e=>{var o=new Notyf;"success"==e.msgClass?(o.success({message:e.msg,duration:4e3,position:{x:"right",y:"top"}}),setTimeout(()=>window.location="./Shop",2e3)):o.error({message:e.msg,duration:4e3,position:{x:"right",y:"top"}})})});</script>
</body>

</html>