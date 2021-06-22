<?php 
    include('./includes/header.php');  
?>

<?php 
    include('./includes/sidemenu.php');
?>

<div class="bodycontainer">

    <?php
        require_once('admin.php');
        $objAdmin = new admin();
        $admin = $objAdmin->fetchData_sbc();
        $admin_c = $objAdmin->fetchDataCombobox_c();

        $pmenu = $cmenu = $scmenu = null;
        if (isset($_GET["pcat"]) && is_numeric($_GET["pcat"])) {
            $pmenu = $_GET["pcat"];
        }
        if (isset($_POST['ccat'])) {
            $pmenu = $_POST['pcat'];
        }
        if (isset($_POST['ccat']) && is_numeric($_POST['ccat'])) {
            $cmenu = $_POST['ccat'];
        }
        if (isset($_POST['ccat']) && is_numeric($_POST['ccat'])) {
            echo 'Parent Cat Id: ' . $pmenu . ' -> ' . 'Subcategory Id: ' . $cmenu;
        } else if (isset($_POST['ccat'])) {
            echo 'Parent Cat Id: ' . $pmenu;
        }

        if (isset($_GET["ccat"]) && is_numeric($_GET["ccat"])) {
            $pmenu = $_GET["ccat"];
        }
        if (isset($_POST['sccat'])) {
            $pmenu = $_POST['ccat'];
        }
        if (isset($_POST['sccat']) && is_numeric($_POST['sccat'])) {
            $cmenu = $_POST['sccat'];
        }
        if (isset($_POST['sccat']) && is_numeric($_POST['sccat'])) {
            echo 'Parent Cat Id: ' . $cmenu . ' -> ' . 'Subcategory Id: ' . $scmenu;
        } else if (isset($_POST['sccat'])) {
            echo 'Parent Cat Id: ' . $cmenu;
        }
    ?>

    <div class="productpanel" id="bodyCon">
        <div class="categLine">
            <table id="tableProdL"class="table table-striped">
                <div class="cateLhead">
                    <h1> <i class="fas fa-store"></i>Product Items</h1> 
                    <button class="add" onclick="addopenModal()"><i class="fas fa-plus-circle"></i> Add</button>
                    <button class="delete"><i class="fas fa-minus-circle"></i> Delete</button>
                </div>
            
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll" onclick="checkPage(this)">
                                <label for="selectAll"></label>
                            </span>
                        </th>

                        <th>Item Code.</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Qty</th>
                        <th>Color</th>
                        <th>Option</th>
                        
                    </tr>
                </thead>
                                        
                <tbody>  
                    <?php foreach ($admin as $prodItem):?> 
    
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" class="user_checkbox" data-user-id="">
                                <label for="checkbox2"></label>
                            </span>
                        </td>

                        <td><?=$prodItem['proditem_code']?></td>
                        <td><?=$prodItem['proditem_name']?></td>
                        <td><?=$prodItem['proditemReq_size']?></td>
                        <td><?=$prodItem['proditemReq_qty']?></td>
                        <td><?=$prodItem['proditemReq_color']?></td>
                                                         
                        <td>
                        <?php 
                        $data = json_encode($prodItem, true); 
                        echo
                        "
                        <a href='javascript:updatesc($data)' class='edit'><button id='edit' onclick='editopenModal()'><i class='fas fa-edit'></i></button></a>
                        <a href='#' class='view'><i class='fas fa-eye'></i></a>
                        <a href='javascript:removesc($data)' class='delete'><button id='delete' onclick='delopenModal()'><i class='fas fa-trash-alt'></i></button></a>
                        "
                        ?>   
                        </td>
                    </tr>
                                                
                    <?php endforeach ?>
                        
                </tbody>
            </table>
        </div>
    </div> 
</div>  

<!-- MODALS FOR ADD -->

<div class="modal-container" id="addmodal">
    <div class="modal-content modalproductitem">
    <span  style= "padding-right:110px;"class="addclose close" onclick="addcloseModal()">&times;</span>
    <div class="colorVariation">               
    </div>
        <span class="modal-header"> 
            ADD PRODUCT ITEMS
        </span>
        <form enctype="multipart/form-data" method="post" action="action.php">
        <div class="itemcateg">
        <span style="font-weight:bold;">ITEM DESCRIPTION</span><br>
       
            <div class="product-info"><br/>

            <span>Product Line </span>      
            <select class='txtproduct' id='pcat' name='pcat' onchange='populates()'>
            <option value="">-- Select Parent Category --</option>

                <?php foreach ($admin_c as $combos) {
                    echo ("<option value=\"{$combos['prodL_Code']}\" " . ($pmenu == $combos['prodL_Code'] ? " selected" : "") . ">{$combos['prodL_Name']}</option>");
                 } ?>
            </select ><br>

            <span>Category </span>
            <select class="txtproduct" name="combodatac" id='ccat' onchange='populatess()'>
            <option value="">-- Select Product Category --</option>
            <?php
                $admin_sc = $objAdmin->fetchDataCombobox_sc($pmenu);
                    if ($pmenu != '' && is_numeric($pmenu)) {
                        foreach ($admin_sc as $combo) {
                            echo ("<option value=\"{$combo['categ_Code']}\" " . ($pmenu == $combo['prodL_Code'] ? " selected" : "") . ">{$combo['categ_Name']}</option>");
                        }
                    }
            ?>
            </select><br>

            <span>Sub Category</span>
            <select class="txtproduct" id='sccat'name="combodatasc">
            <option value="">-- Select Product Sub Category --</option>
            <?php
                $admin_psc = $objAdmin->fetchDataCombobox_sbc($scmenu);
                    
                        foreach ($admin_psc as $comboss) {
                            echo ("value=\"{$comboss['subCateg_Code']}\" " . ($scmenu == $comboss['categ_Code'] ? " selected" : "") . ">{$comboss['subCateg_Name']}</option>");
                        }
                    
                ?>
            </select>
            <input type="text" id="proditmCode" name="proditmCode" value="<?php echo uniqid(true)?>" class="txtproduct" style="display:none;"> <br>
            <span>Item Name</span>
            <input type="text" id="proditmName" name="proditmName" value="" class="txtproduct"> <br>
            <span>Description</span>
            <textarea name="proditmDesc" id="proditmDesc" class="txtproduct" style="resize:vertical; height:132px; font-family:'Open Sans', sans-serif"></textarea>
            <span>Price</span> <span style="font-size:15pt; position:absolute; bottom:22px; left:13px;">&#8369;</span>
            <input type="text" id="proditmPrc" name="proditmPrc" value="" class="txtproduct" style="padding-left:35px;"> <br>
            </div>   

        </div>   

        <div class="prodrequi">
        <span style="font-weight:bold;">ITEM REQUISITION</span><br><br>
            <span>Product Image</span>
            <div class="prodimage">
            <input type="file" id="mainfile" accept="image/*" name= "mainfile" onchange="showImageMain.call(this)"/>
            <label class = prdimgitm for="mainfile"><i class="fas fa-plus-circle"></i></label>
            <img class="prdimgmain"src="./images/insertImg.jpg" alt="" id="prdimgmain"> 

            <input type="file" id="subfileOne" accept="image/jpeg" name= "subfileOne"onchange="showImagesubOne.call(this)"/>
            <label class = prdimgitmsub for="subfileOne"><i class="fas fa-plus-circle"></i></label>
            <img style="margin-bottom: 5px;"class="prdimgsub" src="./images/insertImg.jpg" alt="" id="prdimgitmsubone">
            
            <input type="file" id="subfileTwo" accept="image/jpeg" name="subfileTwo" onchange="showImagesubTwo.call(this)"/>
            <label style="top: 235px;left: 325px;" class = prdimgitmsub for="subfileTwo"><i class="fas fa-plus-circle"></i></label>
            <img class="prdimgsub"src="./images/insertImg.jpg" alt="" id="prdimgitmsubtwo">
            </div>

            <div class="prodreqOther">
                <span>Size</span><br>
                <input style="width:50px"type="text" id="proditmSize" name="proditmSize" value="" class="txtproduct"><br>

                <span>Color</span><br>
                <input type="color" name="proitmcolorpallet" value=""> <br>

                
                <span>Quantity</span><br>
                <input style="width:50px"type="text" id="proitmqty" name="proitmqty" value="" class="txtproduct">
                
            </div>

        </div><br>
        <button id="insert_pItem" name="submit"  type="submit"  class="btn-modal" value="insert_pItem" style="position:relative; bottom:240px; left:330px; width: 45%;">SEND</button>   
        </form>                       
    </div>
</div>

<!-- MODALS FOR EDIT -->

<div class="modal-container" id="editmodal">
    <div class="modal-content l">
        <span class="close" onclick="editcloseModal()">&times;</span>
        <span class="modal-header"> 
            EDIT SUB CATEGORY
        </span>
        <form method="post" action="action.php">
            <div class="product-info">
            <span>Category Code</span>
            <input type="text" id="subCategCode" name="subCategCode" value="" class="txtproduct"> <br>
            <span>Product Line </span>
                <select class="txtproduct" name="Combodata" id="Combodata">
                <?php foreach ($admin_c as $combos) {
                    $comids=1;
                    if($comids==$combos['prodL_Code']){
                        echo"<option value='".$combos['prodL_Code']."' selected='selected'> $combos[prodL_Name]</option>";
                    }else{
                        echo"<option value='".$combos['prodL_Code']."' selected='selected'> $combos[prodL_Name]</option>";
                    }
                 } ?>
                </select ><br>

                <span>Category Name</span>
                <input type="text" id="CategName" name="CategName" value="" class="txtproduct"> <br>
                <button id="update_c"name="submit" type="submit"  class="btn-modal" value="update_c">SEND</button>
            </div>                
        </form>                          
    </div>
</div>



<!-- MODALS FOR DELETE -->

<div class="modal-container" id="deletemodal">
    <div class="modal-content s">
        <span class="delclose close" onclick="delcloseModal()">&times;</span>
        <span class="modal-header"> 
            DELETE SUB CATEGORY
        </span>
        <form method="post" action="action.php">
            <div class="product-info">
                <input type="text" class="txtproduct" id="SubcategCode" name="SubcategCode"> <br>
                <span>Are you sure you want to delete these Records?</span><br>
                <span>This action cannot be undone.</span>
                <button  id="delete_sc" name = "submit" type="submit" class="btn-modal" value="delete_sc">SEND</button>
            </div>                
        </form>                             
    </div>
</div>


<?php 
    include('./includes/footer.php');
?>
       