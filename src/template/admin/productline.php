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
        $admin = $objAdmin->fetchData_pl();
    ?>

    <div class="productpanel" id="bodyCon">
        <div class="categLine">
            <table id="tableProdL"class="table table-striped">
                <div class="cateLhead">
                    <h1> <i class="fab fa-buffer"></i> Product Line</h1> 
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
                        <th>Icon</th>
                        <th>Option</th>
                    </tr>
                </thead>
                                        
                <tbody>  
                    <?php foreach ($admin as $productl):?> 
                    
                    
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" class="user_checkbox" data-user-id="">
                                <label for="checkbox2"></label>
                            </span>
                        </td>

                        <td><?=$productl['prodL_Code']?></td>
                        <td><?=$productl['prodL_Name']?></td>
                        <td><?=$productl['prodL_Icon']?></td>
                                                        
                        <td>
                        <?php 
                        $data = json_encode($productl, true); 
                        echo
                        "
                        <a href='javascript:updatepl($data)' class='edit'><button id='edit' onclick='editopenModal()'><i class='fas fa-edit'></i></button></a>
                        <a href='#' class='view'><i class='fas fa-eye'></i></a>
                        <a href='javascript:removepl($data)' class='delete'><button id='delete' onclick='delopenModal()'><i class='fas fa-trash-alt'></i></button></a>
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
    <div class="modal-content s">
        <span class="addclose close" onclick="addcloseModal()">&times;</span>
        <span class="modal-header"> 
            ADD PRODUCT LINE
        </span>
        <form method="post" action="action.php">
            <div class="product-info">
                <span>Product Line Name</span>
                <input type="text" id="prodLName" name="prodLName" value="" class="txtproduct"> <br>
                <button id="insert_pl"name = "submit" type="submit"  class="btn-modal" value="login-btn">SEND</button>
            </div>                
        </form>                             
    </div>
</div>

<!-- MODALS FOR EDIT -->

<div class="modal-container" id="editmodal">
    <div class="modal-content">
        <span class="close" onclick="editcloseModal()">&times;</span>
        <span class="modal-header"> 
            EDIT PRODUCT LINE
        </span>
        <form method="post" action="action.php">
            <div class="product-info">
                <span>Code No.</span>
                <input type="text" class="txtproduct" id="ProdLCode" name="ProdLCode"> <br>
                <span>Product Line Name</span>
                <input type="text" class="txtproduct" id="ProdLName" name="ProdLName"> <br>
                <button  id="update_pl" name = "submit" type="submit" class="btn-modal" value="update_pl">SEND</button>
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
                <input type="hidden" class="txtproduct" id="prodLCode" name="prodLCode"> <br>
                <span>Are you sure you want to delete these Records?</span><br>
                <span>This action cannot be undone.</span>
                <button  id="delete_pl" name = "submit" type="submit" class="btn-modal" value="delete_pl">SEND</button>
            </div>                
        </form>                             
    </div>
</div>


<?php 
    include('./includes/footer.php');
?>
       