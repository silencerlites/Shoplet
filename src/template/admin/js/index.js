var sid = document.getElementById('content');
var hea = document.getElementById('titleheader');
var bod = document.getElementById('bodyCon')
function toggleSlidebar()
{
    if (sid.style.marginLeft === '-280px')
    {
        sid.style.marginLeft = '280px';
        bod.style.marginLeft = '0px';
        hea.style.marginLeft = '220px';
    } 
    if(sid.style.marginLeft === '0px')
    {
        sid.style.marginLeft = '-280px';
        hea.style.marginLeft = '0px';
        bod.style.marginLeft = '-210px';
    }
    else
    {
        sid.style.marginLeft = '0px';
    }
}
// checkbox

function checkAll(checkname, bx) {
    for (i = checkname.length; i--; )
        checkname[i].checked = bx.checked;
}

function checkPage(bx)
{                    
    for (var tbls = document.getElementsByTagName("table"),i=tbls.length; i--; )
        for (var bxs=tbls[i].getElementsByTagName("input"),j=bxs.length; j--; )
           if (bxs[j].type=="checkbox")
               bxs[j].checked = bx.checked;
}

// ###################### PRODUCT LINE ###############################

// ***MODALS FOR EDIT***

// Get the modal
const edit_modal = document.getElementById("editmodal");
// Get the button that opens the modal
const edit_btn = document.getElementById("edit");
// Get the <span> element that closes the modal
const edit_span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 

window.addEventListener('click', editclickOutslide);

function editopenModal()
{
    edit_modal.style.display = "block";
    edit_modal.style.pointerEvents = "auto";
}
// When the user clicks on <span> (x), close the modal
function editcloseModal() 
{
    edit_modal.style.display = "none";
}

function editclickOutslide(e){
    if(e.target == edit_modal)
    {
        edit_modal.style.display = 'none';
    }
}

// ***MODALS FOR ADD***

const add_modal = document.getElementById("addmodal");
// Get the button that opens the modal
const add_btn = document.getElementById("add");
// Get the <span> element that closes the modal
const add_span = document.getElementsByClassName("addclose")[0];
// When the user clicks the button, open the modal 

add_span.addEventListener('click', addcloseModal);

window.addEventListener('click', addclickOutslide);

function addopenModal()
{
    add_modal.style.display = "block";
    add_modal.style.pointerEvents = "auto";
}
// When the user clicks on <span> (x), close the modal
function addcloseModal() 
{
    add_modal.style.display = "none";
}

function addclickOutslide(e){
    if(e.target == add_modal)
    {
        add_modal.style.display = 'none';
    }
}

// ***MODALS FOR DELETE***

const del_modal = document.getElementById("deletemodal");
// Get the button that opens the modal
const del_btn = document.getElementById("delete");
// Get the <span> element that closes the modal
const del_span = document.getElementsByClassName("delclose")[0];
// When the user clicks the button, open the modal 

del_span.addEventListener('click', delcloseModal);

window.addEventListener('click', delclickOutslide);

function delopenModal()
{
    del_modal.style.display = "block";
    del_modal.style.pointerEvents = "auto";
}
// When the user clicks on <span> (x), close the modal
function delcloseModal() 
{
    del_modal.style.display = "none";
}

function delclickOutslide(e){
    if(e.target == del_modal)
    {
        del_modal.style.display = 'none';
    }
}

// ################### GET DATA PRODUCT LINE ###########################

function updatepl(productl){
    document.getElementById('ProdLCode').value = productl.prodL_Code;
    document.getElementById('ProdLName').value = productl.prodL_Name;
 }

function removepl(productl){
    document.getElementById('prodLCode').value = productl.prodL_Code;
}

// ################### GET DATA CATEGORY ###########################
function updatec(categ){
    document.getElementById('categCode').value = categ.categ_Code;
    document.getElementById('CategName').value = categ.categ_Name;
    document.getElementById('Combodata').value = categ.prodL_Code;
 }

 function removec(categ){
    document.getElementById('CategCodes').value = categ.categ_Code;
}


// ################### GET DATA SUB CATEGORY ###########################
function updatesc(subcateg){
    document.getElementById('subCategCode').value = subcateg.subcateg_Code;
    document.getElementById('Combodata').value = subcateg.prodL_Code;
    document.getElementById('combodatac').value = subcateg.categ_Code;
    document.getElementById('subcategName').value = subcateg.subcateg_Name;
 }

 function removesc(subcateg){
    document.getElementById('SubcategCode').value = subcateg.subcateg_Code;
}

// ########################## COMBO BOX POPULATE ########################
function populate(){

    var xhttp = new XMLHttpRequest();
    if (pcat.selectedIndex === 0) { 
        document.getElementById("ccat").innerHTML = "";
        return;
      }

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ccat").innerHTML = this.responseText;
       }
    };

    xhttp.open("GET", 'subcategory.php?pcat=' + pcat.options[pcat.selectedIndex].value, true);
    xhttp.send();

    with (window.document.forms) {
        /**
         * We have if and else block where we check the selected index for parent category(pcat) and * accordingly we change the URL in the browser.
         */

        if (pcat.selectedIndex === 0) {
            window.location.href = 'subcategory.php';
            
        } else {
            window.location.href = 'subcategory.php?pcat=' + pcat.options[pcat.selectedIndex].value;
           
        }
    } 
}

function populates(){

    var xhttp = new XMLHttpRequest();
    if (pcat.selectedIndex === 0) { 
        document.getElementById("ccat").innerHTML = "";
        return;
      }

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ccat").innerHTML = this.responseText;
       }
    };

    xhttp.open("GET", 'productitem.php?pcat=' + pcat.options[pcat.selectedIndex].value, true);
    xhttp.send();

//    with (window.document.forms) {
//         /**
//          * We have if and else block where we check the selected index for parent category(pcat) and * accordingly we change the URL in the browser.
//          */

//         if (pcat.selectedIndex === 0) {
//             window.location.href = 'productitem.php';
            
//         } else {
//             window.location.href = 'productitem.php?pcat=' + pcat.options[pcat.selectedIndex].value;
           
//         }
//     } 
}

function populatess(){

    var xhttp = new XMLHttpRequest();
    if (pcat.selectedIndex === 0) { 
        document.getElementById("sccat").innerHTML = "";
        return;
      }

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("sccat").innerHTML = this.responseText;
       }
    };

    xhttp.open("GET", 'productitem.php?ccat=' + ccat.options[ccat.selectedIndex].value, true);
    xhttp.send();

//    with (window.document.forms) {
//         /**
//          * We have if and else block where we check the selected index for parent category(pcat) and * accordingly we change the URL in the browser.
//          */

//         if (pcat.selectedIndex === 0) {
//             window.location.href = 'productitem.php';
            
//         } else {
//             window.location.href = 'productitem.php?ccat=' + ccat.options[ccat.selectedIndex].value;
           
//         }
//     } 
}


// ########################## image show ########################
function showImageMain(){
    if(this.files && this.files[0]){
        var obj = new FileReader();
        obj.onload = function(data){
            var image = document.getElementById("prdimgmain");
            image.src = data.target.result;
        }
        obj.readAsDataURL(this.files[0]);
    }
}

function showImagesubOne(){
    if(this.files && this.files[0]){
        var obj = new FileReader();
        obj.onload = function(data){
            var image = document.getElementById("prdimgitmsubone");
            image.src = data.target.result;
        }
        obj.readAsDataURL(this.files[0]);
    }
}


function showImagesubTwo(){
    if(this.files && this.files[0]){
        var obj = new FileReader();
        obj.onload = function(data){
            var image = document.getElementById("prdimgitmsubtwo");
            image.src = data.target.result;
        }
        obj.readAsDataURL(this.files[0]);
    }
}



