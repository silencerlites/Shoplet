if (document.readyState == 'loading'){
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    var removeCartItemBut = document.getElementsByClassName('deletebtn')
    console.log(removeCartItemBut)
    updateCartTotal();
    
    for (var i = 0; i < removeCartItemBut.length; i++){
        var delButton = removeCartItemBut[i]
        delButton.addEventListener('click', removeCartItem)
        
    }

    var quantityInput = document.getElementsByClassName('cart-quantity')
    for (var i = 0; i < quantityInput.length; i++){
        var input = quantityInput[i]
        input.addEventListener('change', quantityChanged)
    }

    var addToCartButton = document.getElementsByClassName('addCartBt')
    for (var i = 0; i < addToCartButton.length; i++){
        var addCartBT = addToCartButton[i]
        addCartBT.addEventListener('click', addCartClick) 
    }

    document.getElementsByClassName('checkoutbtn')[0].addEventListener('click', checkoutClick)
}

function addCartClick(event){
    var addBT = event.target
    var prodItem = addBT.parentElement.parentElement.parentElement
    var prodTitle = prodItem.getElementsByClassName('prodTitle')[0].innerText
    var prodPrice = prodItem.getElementsByClassName('price')[0].innerText
    var prodImageSrc = prodItem.getElementsByClassName('imgProd')[0].src
    console.log(prodTitle, prodPrice, prodImageSrc)
    addItemToCart(prodTitle, prodPrice, prodImageSrc)
    updateCartTotal()
}

function addItemToCart(prodTitle, prodPrice, prodImageSrc){
    var cartli = document.createElement('li')
    cartli.classList.add('productlistcart')
    var cartul = document.getElementsByClassName('proditemcart')[0]
    var cartProdNames = cartul.getElementsByClassName('nameprodcart')
    for(var i = 0;  i < cartProdNames.length; i++){
        if (cartProdNames[i].innerText == prodTitle){
            alert('This item is already added to cart')
            return
        }
    }
    var cartliContents = `
                                    <div class="imagecart">
                                        <img src="${prodImageSrc}" alt="">
                                    </div>
                                        
                                    <div class="detailsprocart">
                                        <div class="nameprodcart">
                                            <span>${prodTitle}</span>
                                        </div>

                                        <div class="seeDetails">
                                            <span class="seedetails" >See Details <i class="fas fa-angle-down"></i></span> 
                                            <div class="seesub">
                                                <span>Size</span> <br>
                                                <span style="font-weight: bold">M</span>
                                            </div>
                                        </div>
                                        
                                        <span class="amount">${prodPrice}</span>
                                        <div class="qty">
                                            <span>QTY:</span>
                                            <input type="number" value="1" style="font-weight: bold; left: 40px; position: relative;" class="cart-quantity" disabled>
                                        </div>
                                        <div class="actionicon">
                                            <a href="#" class="editbtn"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#" class="deletebtn"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                        <div style="border-bottom: 1px solid rgb(199, 199, 199); width: 159%; position: relative; top: 20px; right: 85px;"></div>
                                    </div>`
    cartli.innerHTML = cartliContents
    cartul.append(cartli)
    cartli.getElementsByClassName('deletebtn')[0].addEventListener('click', removeCartItem)
    cartli.getElementsByClassName('cart-quantity')[0].addEventListener('change', quantityChanged)
}

function removeCartItem(event){
    var delButClicked = event.target
    delButClicked.parentElement.parentElement.parentElement.parentElement.remove()
    updateCartTotal();
}

function quantityChanged(event){
    var input = event.target
    if(isNaN(input.value) || input.value <= 0){
        input.value = 1
    }
    updateCartTotal()
}

function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('proditemcart')[0]
    var cartRows = cartItemContainer.getElementsByClassName('productlistcart')
    var total = 0
    
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('amount')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity')
        [0]
        var price = parseFloat(priceElement.innerText.replace('₱', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
    }
    document.getElementsByClassName('amountcart')[0].innerText = '₱' + ' ' + total

    
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('amountcart')[0].innerText = '₱' + ' ' + total
    
}

function checkoutClick(){
    alert('Thank you')
    var cartItem = document.getElementsByClassName('proditemcart')[0]
    while (cartItem.hasChildNodes()){
        cartItem.removeChild(cartItem.firstChild)
    }
    updateCartTotal()
}
