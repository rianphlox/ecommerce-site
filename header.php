<?php
    $email = isset($_SESSION['email']) ? strtolower(explode('@', $_SESSION['email'])[0]) : '';
?>
  
  
  <!-- Header Section Begin -->
    <header class="header-section">
       
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="./">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <input type="text" placeholder="What do you need?">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span id="cart-num">0</span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody id="products">

                                            <?php $results =  $db->GetCartItems($email); ?>
                                            <?php if(!$results->num_rows): ?>
                                                <tr>
                                                    <td></td>
                                                    <td class="si-text">No Product in cart.</td>
                                                    <td></td>
                                                </tr>
                                            <?php else: ?>
                                                <?php while($item = $results->fetch_assoc()): ?>

                                                    <tr>
                                                        <td class="si-pic"><img height="70" width="70" src="<?= $item['image_path'] ?>" alt=""></td>
                                                        <td class="si-text">
                                                            <div class="product-selected">
                                                                <p>$<?= $item['current_price'] ?>.00 x <?= $item['quantity'] ?></p>
                                                                <h6><?= $item['image_name'] ?></h6>
                                                            </div>
                                                        </td>
                                                        <td class="si-close">
                                                            <i class="ti-close"></i>
                                                        </td>
                                                    </tr>


                                                <?php endwhile; ?>
                                            <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>$<?= $db->GetTotalAmount($email); ?>.00</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="./Cart" class="primary-btn view-card">VIEW CART</a>
                                        <a href="./Checkout" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                                            
                            <?php $total = $db->GetTotalAmount($email); ?>

                            <li class="cart-price">$<?= $total ?>.00</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            <li class="active"><a href="#">Women’s Clothing</a></li>
                            <li><a href="#">Men’s Clothing</a></li>
                            <li><a href="#">Underwear</a></li>
                            <li><a href="#">Kid's Clothing</a></li>
                            <li><a href="#">Brand Fashion</a></li>
                            <li><a href="#">Accessories/Shoes</a></li>
                            <li><a href="#">Luxury Brands</a></li>
                            <li><a href="#">Brand Outdoor Apparel</a></li>
                        </ul>
                    </div>
                </div>
<?php 
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $fileName = strtolower(basename($scriptName, '.php'));
?>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="<?php if ($fileName == 'index') { echo "active" ;} ?>"><a href="./">Home</a></li>
                        <li class="<?php if ($fileName == 'shop') { echo "active" ;} ?>"><a href="./Shop">Shop</a></li>
                        <li><a href="#">Collection</a>
                            <ul class="dropdown">
                                <li><a href="#">Men's</a></li>
                                <li><a href="#">Women's</a></li>
                                <li><a href="#">Kid's</a></li>
                            </ul>
                        </li>
                        <!-- <li class="<?php if ($fileName == 'blog') { echo "active" ;} ?>"><a href="./blog">Blog</a></li> -->
                        <li class="<?php if ($fileName == 'contact') { echo "active" ;} ?>"><a href="./Contact">Contact</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <!-- <li><a href="./Blog-details">Blog Details</a></li> -->
                                <li><a href="./Cart">Shopping Cart</a></li>
                                <li><a href="./Checkout">Checkout</a></li>
                                <li><a href="./faq">Faq</a></li>
                                <li><a href="./Register">Register</a></li>
                                <li><a href="<?= isset($_SESSION['email']) ? './Logout' : './Login'; ?>"><?= isset($_SESSION['email']) ? 'Logout' : 'Login' ; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>