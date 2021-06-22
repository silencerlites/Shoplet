<?php

require_once('./include/session.php');

class Action
{
    function __construct()
    {
        switch ($_POST['submit']){

            // ######## PRODUCT LINE ########
            case 'login_btn':
            $objsess = new loginState();
            
            
                $objsess->setlogEmail($_POST['login-email']);
                $objsess->setlogPass($_POST['login-pass']);

                if($objsess->login())
                {
                    header('location: login.php?insert=1');
                } 
                else
                { 
                   header('location: index.php?insert=0');
                }
            

            break;

            default:
                header('index.php');
            break;
        }
    }
  
}

if(isset($_POST['submit']))
{
    $objAction = new Action;
}
else 
{
    header('index.php');
}


?>