<?php

require_once('admin.php');

class Action
{
    function __construct()
    {
        switch ($_POST['submit']){

            // ######## PRODUCT LINE ########
            case 'insert_pl':
            $objAdmin = new admin();
            $objAdmin->setName($_POST['prodLName']);
            if($objAdmin->insert_pl())
            {
                header('location: productline.php?insert=1');
            } 
            else
            { 
               header('location: productline.php?insert=0');
            }
            break;

            case 'update_pl':
            $objAdmin = new admin();
            $objAdmin->setId($_POST['ProdLCode']);
            $objAdmin->setName($_POST['ProdLName']);
            if($objAdmin->update_pl())
            {
                header('location:productline.php?update=1');
            } 
            else
            { 
               header(' location:productline.php?update=0');
            }
            break;

            case 'delete_pl':
            $objAdmin = new admin();
            $objAdmin->setId($_POST['prodLCode']);
            if($objAdmin->delete_pl())
            {
                header('location:productline.php?delete=1');
            } 
            else
            { 
               header('location:productline.php?delete=0');
            }
            break;

            // ####################### CATEGORY #######################

            case 'insert_c':
            $objAdmin = new admin();
            $objAdmin->setc_name($_POST['categName']);
            $objAdmin->setId($_POST['combodata']);
            if($objAdmin->insert_c())
            {
                header('location:category.php?insert=1');
            } 
            else
            { 
               header('location:category.php?insert=0');
            }
            break;

            case 'update_c':
            $objAdmin = new admin();
            $objAdmin->setc_id($_POST['CategCode']);
            $objAdmin->setc_name($_POST['CategName']);
            $objAdmin->setId($_POST['Combodata']);
            if($objAdmin->update_c())
            {
                header('location:category.php?update=1');
            } 
            else
            { 
               header('location:category.php?update=0');
            }
            break;

            case 'delete_c':
            $objAdmin = new admin();
            $objAdmin->setc_id($_POST['categCode']);
            if($objAdmin->delete_c())
            {
                header('location:category.php?delete=1');
            } 
            else
            { 
               header('location:category.php?delete=0');
            }
            break;

           // ####################### SUB CATEGORY #######################

           case 'insert_sc':
           $objAdmin = new admin();
           $objAdmin->setscName($_POST['categName']);
           $objAdmin->setc_id($_POST['combodatac']);
           if($objAdmin->insert_sc())
           {
               header('location:subcategory.php?insert=1');
           } 
           else
           { 
              header('location:subcategory.php?insert=0');
           }
           break;

           case 'update_sc':
           $objAdmin = new admin();
           $objAdmin->setc_id($_POST['CategCode']);
           $objAdmin->setc_name($_POST['CategName']);
           $objAdmin->setId($_POST['Combodata']);
           if($objAdmin->update_c())
           {
               header('location:subcategory.php?update=1');
           } 
           else
           { 
              header('location:subcategory.php?update=0');
           }
           break;

           case 'delete_sc':
           $objAdmin = new admin();
           $objAdmin->setscId($_POST['SubcategCode']);
           if($objAdmin->delete_sc())
           {
               header('location:subcategory.php?delete=1');
           } 
           else
           { 
              header('location:subcategory.php?delete=0');
           }
           break;

           // ####################### ITEM PRODUCT #######################

           case 'insert_pItem':
           $objAdmin = new admin();
           $objAdmin->setpitmCode($_POST['proditmCode']);
           $objAdmin->setpitmName($_POST['proditmName']);
           $objAdmin->setpitmDesc($_POST['proditmDesc']);
           $objAdmin->setpitmPric($_POST['proditmPrc']);
           $objAdmin->setId($_POST['pcat']);
           $objAdmin->setc_id($_POST['combodatac']);
           $objAdmin->setimgOne(file_get_contents($_FILES['mainfile']['tmp_name']));
           $objAdmin->setimgTwo(file_get_contents($_FILES['subfileOne']['tmp_name']));
           $objAdmin->setimgThree(file_get_contents($_FILES['subfileTwo']['tmp_name']));
           $objAdmin->setproditmReqSize($_POST['proditmSize']);
           $objAdmin->setproditmReqQty($_POST['proitmcolorpallet']);
           $objAdmin->setproditmReqColor($_POST['proitmqty']);

           if($objAdmin->insert_pdItem())
           {
               header('location:productitem.php?insert=1');
           } 
           else
           { 
              header('location:productitem.php?insert=0');
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
    header('productline.php');
}

?>