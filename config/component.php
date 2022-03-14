<?php


    function component($id, $image_name, $image_path, $category, $current_price, $initial_price) {
        $element = "
            <div class='col-lg-4 col-sm-6'>
                 <!--<form class='card-form' method='POST'> -->
                    <div class='product-item'>
                        <div class='pi-pic'>
                            <img src='$image_path' alt=''>
                            <div class='sale'>sale</div>
                            <div class='icon'>
                                <i class='icon_heart_alt'></i>
                            </div>
                            <ul>
                                <form class='form-submit'>
                                    <input type='hidden' name='product_id' value='$id' />
                                    <input type='hidden' name='product_name' value='$image_name' />
                                    <input type='hidden' name='price' value='$current_price' /> 
                                    <input type='hidden' name='image_path' value='$image_path' /> 
                                    <li class='w-icon active'><button class='addBtn special-btn'><i class='icon_bag_alt'></i></button></li>
                                    <li class='quick-view'><a href='#'>+ Quick View</a></li>
                                    <li class='w-icon active'><a><i class='fa fa-random'></i></a></li>
                                </form>
                            </ul>
                        </div>
                        <div class='pi-text'>
                            <div class='catagory-name'>$category</div>
                            <a class='block2-name' href='#'>
                                <h5>$image_name</h5>
                            </a>
                            <div class='product-price'>
                                $$current_price
                                <span>$$initial_price</span>
                            </div>
                        </div>
                    </div>
                 <!-- </form>  -->
            </div>
        ";
        echo $element;
    }