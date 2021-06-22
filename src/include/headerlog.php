<?php include_once("session.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoplet Philippines</title>
    <link rel="icon" type="image" href="./image/favicon.png">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9b4c502cfc.js"></script>
</head> 



<body>
    <div class="container">
        <img src="./image/svg/logo.svg" alt="Shoplet" style="width:150px; text-align:center; cursor: pointer;"> 
        
        <div class="header">  
                
            <div class="menu">
                <a href=""><i class="fas fa-shopping-basket"></i></a>

                <!-- shopping cart -->
                        <div class="cart">
                            <div class="cartdetails">
                                <div class="itemNocart"><span class="noItem">0</span> <span>Items in Bag</span></div>
                                <div class="totalamount">
                                        <span> Total Amount:</span> <br>
                                        <span class="amountcart">PHP 0</span>
                                </div>
                                
                                <button class="checkoutbtn">CHECKOUT</button>
                            </div>

                            <ul class="proditemcart">
                                
                            </ul>

                                <button class="optioncart">VIEW AND EDIT BAG</button>
                        </div>
            </div>

            <!-- account menu -->
            <?php
                if(loginState::checkLoginState($logDbh))
                {
                    echo 
                    "
                    <div class='menu'>
                    <a href=''><i class='fas fa-user'></i></a>
                    <div class='accmenu'>
                    <div class='user'>
                        <img src='./image/svg/logo.svg' alt=''>
                        <span style='top: 10px; position:relative;'>Welcome!</span> <br>
                        <span style='top: 5px; position:relative; font-size:20pt; font-weight:bold;'> ".$_SESSION['username']." </span>
                        <a href='#one'><i class='fas fa-cog' style='top:0px;font-size:25pt; left:100px; position:relative;'></i></a>
                    </div>
                        <ul>
                            <li><a href='#'><i class='fas fa-shopping-bag'></i><span>My Order</span></a><br></li>
                            <li><a href='#'><i class='fas fa-heart'></i><span>My Wishlist</span></a><br></li>
                            <li><a href='#'><i class='fas fa-star'></i><span>Rewards</span></a><br></li>
                            <li><a href='#'><i class='fas fa-ban'></i><span>My Return & Cancellation</span></a><br></li>
                            <li><a href='#'><i class='fas fa-sign-out-alt'></i><span>Logout</span></a><br></li>
                        </ul>
                    </div>
    
                </div>
                    ";
                } else
                {
                    header("location:login.php");
                }
            ?>
           
           
            <!-- search bar -->
            <div class="search">
                <form action="" class="form-search">
                        <input type="search" class="search-input">
                        <i class="fa fa-search"></i>
                </form> 
            </div>

            <a href="javascript:void(0);" class="icon" onclick="navBar()">
                    <i class="fa fa-bars"></i>
            </a>
                
        </div>   

        <!-- category menu list -->
        <div class="main-container">
                
            <ul class="category-container" id="category-con">      
                <li>
                    <a href='#' class="text">NEW HOT ITEMS<i class="fas fa-angle-down"></i></a>
                    <ul class="dropdown">
                        <li><a href=""><span>ELECTRONIC DEVICES</span></a></li>
                        <li><a href=""><span>HOME AND LIFESTYLE</span></a></li>
                        <li><a href=""><span>WARDROBE FASHION</span></a></li>
                        <li><a href=""><span>HEALTH AND BEAUTY</span></a></li>  
                    </ul>           
                </li>
                
                <li>
                    <a href='#' class="text">ELECTRONIC DEVICES<i class="fas fa-angle-down"></i></a>
                    <ul class="dropdown">
                            <li><a href=""><span>MOBILES</span></a></li>
                            <li><a href=""><span>GAMING CONSOLE</span></a></li>
                            <li><a href=""><span>CAMERA</span></a></li>
                            <li><a href=""><span>LAPTOPS</span></a></li>
                            <li><a href=""><span>DESKTOP</span></a></li>
                            <li><a href=""><span>PORTABLE AUDIO</span></a></li>
                    </ul>    
                 </li>

                <li>
                    <a href='#' class="text">HOME AND LIFESTYLE<i class="fas fa-angle-down"></i></a> 
                    <ul class="dropdown">
                            <li><a href=""><span>TV AND VIDEO DEVICES</span></a></li>
                            <li><a href=""><span>HOME AUDIO</span></a></li>
                            <li><a href=""><span>COOLING & AIR TREATMENT</span></a></li>
                            <li><a href=""><span>KITCHEN APPLIANCES</span></a></li>
                            <li><a href=""><span>IRON & SEWING MACHINES</span></a></li>
                    </ul> 
                </li>

                <li>
                    <a href='#' class="text">FASHION AND STYLES<i class="fas fa-angle-down"></i></a>
                    <ul class="dropdown">
                            <li><a href=""><span>MEN'S FASHION</span></a></li>
                            <li><a href=""><span>WOMEN'S FASHION</span></a></li>
                            <li><a href=""><span>ACCESSORIES</span></a></li>
                    </ul> 
                </li>

                <li>
                    <a href='#' class="text">HEALTH AND BEAUTY<i class="fas fa-angle-down"></i></a>
                    <ul class="dropdown">
                            <li><a href=""><span>BEAUTY TOOLS</span></a></li>
                            <li><a href=""><span>FRAGRANCES</span></a></li>
                            <li><a href=""><span>HAIR CARE</span></a></li>
                            <li><a href=""><span>MEN'S CARE</span></a></li>
                            <li><a href=""><span>FOOD SUPPLEMENTS</span></a></li>
                            <li><a href=""><span>SKIN CARE</span></a></li>
                    </ul> 
                </li>    
            </ul>
        </div>
    