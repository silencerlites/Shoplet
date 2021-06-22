<?php 
include_once("./function/config.php");
include_once("session.php");
?>


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
            <div class="menu">
                <a href=""><i class="fas fa-user"></i></a>
                <div class="submenu">
                    <a href="#modal" id="btnlog"><span>LOGIN</span></a>
                    <a href="#modals" id="btnsign"><span>SIGNUP</span></a>
                </div>
            </div>

            <!-- *** login form *** -->
            <div class="modal-container-login" id="modal">
                <div class="modal-login">
                    <span class="close">&times;</span>
                    <span class="modal-header">
                        LOGIN
                    </span>

                    <span style="margin-bottom: 20px; margin-top: 3px; display: block;">If you have an account, sign in with your username.</span>

                    <?php
            

                    if(!loginState::checkLoginState($dbh)){
                        if (isset($_POST['login-email']) && isset($_POST['login-pass'])){

                            $logEmail = $_POST['login-email'];
                            $logPass = $_POST['login-pass'];
                            
                            $stmt = $dbh->prepare("SELECT * FROM tbl_users WHERE usr_email = :logEmail AND usr_pass = :logPass");
                            $stmt->execute(array(':logEmail' => $logEmail, ':logPass' => $logPass));

                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

                           
                               // loginState::createRecord($dbh, $row['usr_email'], $row['usr_acctNo']);
                                header("location:index.php");
                                                       
                           
                        }
                        else
                        {
                            echo '
                            <form method="post" action="index.php">
                        <span>Email or Phone</span>      
                        <input type="text"  name="login-email" class="login-input" required> <br>
                        <span>Password</span>
                        <input type="password"  name="login-pass" class="login-input" required> <br>
                        <a href="#" class="forgot"> Forgot Password?</a>
                        <div class="remember_me">
                            <input type="checkbox" tabindex="3" value="remember-me" id="remember_me">Remember Me
                        </div>
                            <!-- <button id="login-btn" name= "submit" type="submit"  class="login-btn" value="login-btn">LOGIN</button> -->
                            <input type="submit" value="LOGIN" class="login-btn">

                        <div class="other-login">
                            <span style="text-align:center; display: block; font-size: 10pt; margin-bottom: 20px; ">Or, login with</span>
                            <a href="#" class="colorf"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="colorg"><i class="fab fa-google-plus-g"></i></a>
                        </div>
                    </form>   
                            ';
                        }
                    }

                    else 
                    {
                        header("location:index.php");
                    }
                    ?>
                   
                    
                    <a href="#modals" class="reg-log">Haven't an account already?</a>
                </div>
            </div>

            <!-- *** signup form *** -->
            <div class="modal-container-signup" id="modals">
                <div class="modal-signup">
                    <span class="closes">&times;</span> 
                    <span class="modal-header">
                        CREATE NEW ACCOUNT
                    </span>
                        
                    <form action="#">
                        
                        <div class="personal-info">
                            <h2>Personal Information</h2>
                            <span>First Name</span>
                            <input type="text"  class="signup-input" required> <br>
                            <span>Last Name</span>
                            <input type="text"  class="signup-input" required> <br>
                            <div class="remember_mes">
                                <input type="checkbox" tabindex="3" value="remember-me" id="remember_me">I accept the Privacy policy
                            </div>
                        </div>
                       
                        <div class="signup-info" id="using-email">
                            <h2>Signup Information</h2>
                            <span>Email</span>
                            <input type="text" class="signup-input" required>
                            <span>Password</span>
                            <input type="password" class="signup-input" required>
                            <span>Confirm Password</span>
                            <input type="password" class="signup-input" required>
                        </div>

                        <div class="signup-info" id="using-phone">
                                <h2>Signup Information</h2>
                                <span>Phone No.</span>
                                <input type="text" class="signup-input" required>
                                <span>Password</span>
                                <input type="password" class="signup-input" required>
                                <span>Confirm Password</span>
                                <input type="password" class="signup-input" required>
                            </div>

                            <input type="submit" value="CREATE AN ACCOUNT" class="signup-btn">
                            <span style="text-align:center; display: block; font-size: 10pt;">Or, sign up with</span>
                            <input type="button" value="SIGNUP WITH PHONE" class="signup-btn" id="btn-sign" onclick="changeValue(this);">

                        <div class="other-signup">
                            <a href="#" class="colorf"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="colorg"><i class="fab fa-google-plus-g"></i></a>
                        </div>
                    </form>   
                    <a href="#modal" class="reg-sign">Already member? Login here</a>
                </div>
            </div>

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
    