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
        $admin = $objAdmin->fetchData_sc();
        $admin_c = $objAdmin->fetchDataCombobox_c();

        $pmenu = $cmenu = null;
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
        
    ?>

    <div class="productpanel" id="bodyCon">
        <div class="categLine">
            <table id="tableProdL"class="table table-striped">
                <div class="cateLhead">
                    <h1> <i class="fab fa-buffer"></i> Sub Category</h1> 
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
                    
                        <th>Code No.</th>
                        <th>Name</th>
                        <th>Product Line</th>
                        <th>Option</th>
                    </tr>
                </thead>
                                        
                <tbody>  
                    <?php foreach ($admin as $subcateg):?> 
    
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" class="user_checkbox" data-user-id="">
                                <label for="checkbox2"></label>
                            </span>
                        </td>

                        <td><?=$subcateg['subcateg_Code']?></td>
                        <td><?=$subcateg['subcateg_Name']?></td>
                        <td><?=$subcateg['categ_Name']?></td>
                                                         
                        <td>
                        <?php 
                        $data = json_encode($subcateg, true); 
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
    <div class="modal-content l">
        <span class="addclose close" onclick="addcloseModal()">&times;</span>
        <span class="modal-header"> 
            ADD SUB CATEGORY
        </span>
        <form method="post" action="action.php">
            <div class="product-info">
            <span>Product Line </span>
            
                        
            <select class='txtproduct' id='pcat' name='pcat' onchange='populate()'>
            <option value="">-- Select Parent Category --</option>

                <?php foreach ($admin_c as $combos) {
                            echo ("<option value=\"{$combos['prodL_Code']}\" " . ($pmenu == $combos['prodL_Code'] ? " selected" : "") . ">{$combos['prodL_Name']}</option>");
                 } ?>
            </select ><br>
                <span>Category </span>
                <select class="txtproduct" name="combodatac" id='ccat'>
                <option value="">-- Select Product Sub Category --</option>
                <?php
                $admin_sc = $objAdmin->fetchDataCombobox_sc($pmenu);
                    if ($pmenu != '' && is_numeric($pmenu)) {
                        foreach ($admin_sc as $combo) {
                            echo ("<option value=\"{$combo['categ_Code']}\" " . ($cmenu == $combo['prodL_Code'] ? " selected" : "") . ">{$combo['categ_Name']}</option>");
                        }
                    }

                     ?>
                </select ><br>
                <span>Category Name</span>
                <input type="text" id="categName" name="categName" value="" class="txtproduct"> <br>
                <button id="insert_sc"name="submit" type="submit"  class="btn-modal" value="insert_sc">SEND</button>
            </div>                
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
       