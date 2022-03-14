<?php 
    session_start();
    require 'config/db.php';
    $db = new DB();
?>
<?php include 'navLinks.php'; ?>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <?php include 'header.php'; ?>
    
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Register</span>
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
                    <div class="register-form">
                        <h2>Register</h2>
                        <form id="signUp">
                            <div class="group-input">
                                <label for="username">Full Name *</label>
                                <input autocomplete="off" type="text" name="username" id="username">
                            </div>
                            <div class="group-input">
                                <label for="pass">Email *</label>
                                <input autocomplete="off" type="text" name="email" id="pass">
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Password *</label>
                                <input autocomplete="off" type="password" name="password" id="con-pass">
                            </div>
                            <button type="submit" class="site-btn register-btn">REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <a href="./Login.php" class="or-login">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    
    

    <?php include 'footer.php' ; ?>

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
    <script src="fashi/js/main.js"></script>
    <script src="fashi/js/add.js"></script>
    <script src="fashi/js/notyf.min.js"></script>
    <script>const form=document.querySelector("#signUp");form.addEventListener("submit",e=>{e.preventDefault();fetch("x.php",{method:"POST",body:new FormData(form)}).then(e=>e.json()).then(e=>{var o=new Notyf;"success"==e.msgClass?(o.success({message:e.msg,duration:4e3,position:{x:"right",y:"top"}}),setTimeout(()=>window.location="./Login",2e3)):o.error({message:e.msg,duration:4e3,position:{x:"right",y:"top"}})})});</script>
</body>

</html>