<?php
    require 'config/db.php';
    session_start();
    $db = new DB();
    
    $email = isset($_SESSION['email']) ? strtolower(explode('@', $_SESSION['email'])[0]) : ''
?>

<?php include 'navLinks.php' ?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include 'header.php'; ?>

    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./"><i class="fa fa-home"></i> Home</a>
                        <a href="./Shop">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $results = $db->GetCartItems($email); ?>
                                <?php if (!$results->num_rows) : ?>
                                    <tr>
                                        <td class="cart-pic first-row"><!--<img src="fashi/img/cart-page/product-1.jpg" alt="">--></td>
                                        <td class="cart-title first-row">
                                            <h5>No item in cart.</h5>
                                        </td>
                                        <!-- <td class="p-price first-row">$60.00</td>
                                        <td class="qua-col first-row">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="1">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total-price first-row">$60.00</td>
                                        <td class="close-td first-row"><i class="ti-close"></i></td> -->
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($results->fetch_all(MYSQLI_ASSOC) as $item): ?>
                                        <tr>
                                            <td class="cart-pic first-row"><img height="170" width="170" src="<?= $item['image_path'] ?>" alt=""></td>
                                            <td class="cart-title first-row">
                                                <h5><?= $item['image_name'] ?></h5>
                                            </td>
                                            <td class="p-price first-row">$<?= $item['current_price'] ?>.00</td>
                                            <td class="qua-col first-row">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" value="<?= $item['quantity'] ?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="total-price first-row">$<?= $item['quantity'] * $item['current_price'] ?>.00</td>
                                            <td class="close-td first-row"><i class="ti-close"></i></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="./Shop" class="primary-btn continue-shop">Continue shopping</a>
                                <a href="#" class="primary-btn up-cart">Update cart</a>
                            </div>
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                   <?php $total = $db->GetTotalAmount($email); ?>
                                    <li class="subtotal">Subtotal <span>$<?= $total ?>.00</span></li>
                                    <li class="cart-total">Total <span>$<?= $total ?>.00</span></li>
                                </ul>
                                <a href="#" class="proceed-btn <?= $total > 1 ? '': 'btn-disabled' ?>">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    

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
    <script src="fashi/js/add.js"></script>
    <script src="fashi/js/main.js"></script>
</body>

</html>