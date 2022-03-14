<?php 
    session_start();
    require 'config/db.php';
    $db = new DB();
    
?>

<?php include 'navLinks.php'; ?>

<body>
    <?php include 'header.php' ?>
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Reset Password</h2>
                        <h4 class="lead mb-3 text-center">Enter Your Email</h4>
                        <form id="reset">
                            <div class="group-input">
                                <label for="email">Email Address *</label>
                                <input name="email" autocomplete="off" type="text" id="email">
                            </div>
                            <input type="hidden" name="reset">
                            <button type="submit"  class="site-btn login-btn">Send Email</button>
                        </form>
                        <div class="switch-login">
                            <a href="./Login" class="or-login">Back To Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    
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
    <script src="notyf.min.js"></script>
    <script src="fashi/js/main.js"></script>
    <script>
        const form = document.querySelector('#reset')
        form.addEventListener('submit', e => {
            e.preventDefault();
            fetch('request.php', {
                method: 'POST',
                body: new FormData(form)
            })
            .then(res => res.json())
            .then(data => console.log(data))
            .catch(err => console.log(err))
        })
    </script>
    </body>
</html>
