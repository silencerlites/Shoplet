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
        $admin = $objAdmin->fetchData_c();
        $admin_c = $objAdmin->fetchDataCombobox_c();
    ?>

    <div class="productpanel" id="bodyCon">
        <div class="categLine">
            <table id="tableProdL"class="table table-striped">
                <div class="cateLhead">
                    <h1> <i class="fab fa-buffer"></i> Category</h1> 
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
                    <?php foreach ($admin as $categ):?> 
    
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" class="user_checkbox" data-user-id="">
                                <label for="checkbox2"></label>
                            </span>
                        </td>

                        <td><?=$categ['categ_Code']?></td>
                        <td><?=$categ['categ_Name']?></td>
                        <td><?=$categ['prodL_Name']?></td>
                                                         
                        <td>
                        <?php 
                        $data = json_encode($categ, true); 
                        echo
                        "
                        <a href='javascript:updatec($data)' class='edit'><button id='edit' onclick='editopenModal()'><i class='fas fa-edit'></i></button></a>
                        <a href='#' class='view'><i class='fas fa-eye'></i></a>
                        <a href='javascript:removec($data)' class='delete'><button id='delete' onclick='delopenModal()'><i class='fas fa-trash-alt'></i></button></a>
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
    <div class="modal-content">
        <span class="addclose close" onclick="addcloseModal()">&times;</span>
        <span class="modal-header"> 
            ADD PRODUCT LINE
        </span>
        <form method="post" action="action.php">
            <div class="product-info">
            <span>Product Line </span>
                <select class="txtproduct" name="combodata">
                <?php foreach ($admin_c as $combo) {
                    $comid=1;
                    if($comid==$combo['prodL_Code']){
                        echo"<option value='".$combo['prodL_Code']."' selected='selected'> $combo[prodL_Name]</option>";
                    }else{
                        echo"<option value='".$combo['prodL_Code']."' selected='selected'> $combo[prodL_Name]</option>";
                    }
               
                 } ?>
                </select ><br>
                <span>Category Name</span>
                <input type="text" id="categName" name="categName" value="" class="txtproduct"> <br>
                <button id="insert_c"name="submit" type="submit"  class="btn-modal" value="insert_c">SEND</button>
            </div>                
        </form>                             
    </div>
</div>

<!-- MODALS FOR EDIT -->

<div class="modal-container" id="editmodal">
    <div class="modal-content l">
        <span class="close" onclick="editcloseModal()">&times;</span>
        <span class="modal-header"> 
            EDIT CATEGORY
        </span>
        <form method="post" action="action.php">
            <div class="product-info">
            <span>Category Code</span>
            <input type="text" id="categCode" name="CategCode" value="" class="txtproduct" style="pointer-events: none;"> <br>
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
            DELETE PRODUCT LINE
        </span>
        <form method="post" action="action.php">
            <div class="product-info">
                <input type="hidden" class="txtproduct" id="CategCodes" name="categCode"> <br>
                <span>Are you sure you want to delete these Records?</span><br>
                <span>This action cannot be undone.</span>
                <button  id="delete_c" name = "submit" type="submit" class="btn-modal" value="delete_c">SEND</button>
            </div>                
        </form>                             
    </div>
</div>


<?php 
    include('./includes/footer.php');
?>
       