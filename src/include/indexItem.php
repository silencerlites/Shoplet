        <!-- ads -->
    <?php
        require_once('./function/view.php');
        $objView = new view();
        $view = $objView->product_data();
    ?>
        
        <div class="ads-container">
                <button class="button_carousel--left">
                    <i class="fas fa-angle-left"></i>
                </button>

                <ul class="carousel__track-container">
                    <img src="./image/womenswear_summer_dresses.jpg" class="current-slide">
                    <li class="carousel-slide">
                            <img class="carousel-image" src="./image/menswear_summer_home_shirts.jpg" alt="image">
                    </li>
                    <li class="carousel-slide">
                        <img class="carousel-image" src="./image/menswear_summer_home_shirts.jpg" alt="image">
                </li>
                </ul>

                <button class="button_carousel--right">
                    <i class="fas fa-angle-right"></i>
                </button>

                <div class="carousel-nav">
                    <button class="carousel-indicator"></button>
                    <button class="carousel-indicator"></button>
                </div>
            </div>

            <!-- feature product -->
            <div class="product-holder">
                
                <!-- review product details -->
                <div class="modal-container-review" id="revmodal">
                        <div class="product-container-review">
                                <span class="closer" style="right: 12px; position: relative;" onclick="revMdalclose()">&times;</span>
                                <figure class='zoom' style="background-image: url(./image/lucienne_hawaii_shirt_5612.jpg)" onmousemove="zoom(event)" ontouchmove="zoom(event)">
                                <img src="./image/lucienne_hawaii_shirt_5612.jpg">
                            </figure>
                            <div class="review-prod-title" id="review-prod-title">LOUCHE ISMELDA STARLEAF PRINT TOP</div>
                            <div class="review-prod-price">&#8369; 1000.00</div>
                            <div class="review-prod-status">IN STOCK</div>
                            <div class="review-prod-code" id="reviewProdCode">2A9A37A8021BEIGE</div>
                            <hr style="width:550px; position: relative; right: 30px;">
                            <div class="review-prod-size">
                                <div>Size: <span class="sizechoose">M</span></div>
                                <button class="sizevariable 0">S</button>
                                <button class="sizevariable 0">M</button>
                            </div>
                            <div class="review-prod-qty">
                                    <span>QTY:</span>
                                    <button class="minus-btn" type="button" name="button" onclick="minus()">
                                            <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="text" value="1" id="inputedqty" disabled>
                                    <button class="plus-btn" type="button" name="button" onclick="plus()">
                                            <i class="fas fa-plus"></i>
                                    </button>
                            </div>
                            <button class="review-prod-addcart">ADD TO CART</button>
                            <div class="review-prod-details">
                                <h3>DESCRIPTION</h3>
                                <span>
                                        Match the falling Autumnal leaves in the Louche Cassien dandelion print top. Featuring a gathered neckline, 
                                        statement balloon sleeves and a button fastening to the cuffs, the Cassien blouse would look amazing tucked 
                                        into a mini skirt or flared trousers.
                                </span>
                            </div>
                        </div>
                </div>
                

            <div class="bestseller-container">
                <h1>BEST SELLER</h1>
                <hr>
            </div>

            <div class="newproduct-container">
                    <h1>NEW ITEMS</h1>
                    <hr>  

                    <button class="button_carousel--leftp">
                    <i class="fas fa-angle-left"></i>
                </button>

                <div class="product-container">
                    <ul class="item carousel__track-containerp">
                        <?php foreach ($view as $prodItem):?>
                        <li class="product carousel-slidep current-slidep">
                        <?php 
                            $data = json_encode($view, true);     
                                echo 
                                "
                                <div class='image-container'>
                                <img class='imgProd' src='data:image; base64,".base64_encode($prodItem['imgOne'])  . " ' alt=''>
                                </div>

                                <div class='hover-option'>
                                    <a href='javascript:revView($data)' title='Add to Cart' class='addCartBt'><i class='fas fa-shopping-cart' onclick='revMdalopen()'></i></a>   
                                    <a href='#' title='Add to Wishlist'><i class='fas fa-heart'></i></a>
                                </div>
                                " 
                        ?>
                            <div class="item-info">
                                <h2 class="prodTitle"><?=$prodItem['proditem_name']?></h2> 
                                <div class="priceBox">
                                    <span class="price"> &#8369; <?=$prodItem['proditem_price']?></span>
                                </div>
                                <span class="revCode" id="revCode"><?=$prodItem['proditem_code']?></span>
                            </div>
                        </li>  
                        <?php endforeach ?>                 
                    </ul>
                </div>

                <button class="button_carousel--rightp">
                    <i class="fas fa-angle-right"></i>
                </button>
            </div>

            <div class="collection-container">
                    <h1>HOT COLLECTION</h1>
                    <hr>
            </div>

            <div class="recommended-container">
                    <h1>RECOMMENDED ITEMS</h1>
                    <hr>
            </div>
        </div>