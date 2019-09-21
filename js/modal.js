var modal = document.getElementById('modal_popup');
var modal_title = document.getElementById('modal_title');
var span = document.getElementsByClassName('purchase_modal_close')[0];
var error = document.getElementById('modal_error_message');

var buy_button = document.getElementById('modal_buy');

function open_modal(product_id, product_name)
{
    
    modal.style.display = "block";
    modal_title.innerHTML = "Product: " + product_name;
    error.style.display = "none";
    buy_button.disabled = false;
    buy_button.onclick = function() {
        buy_button.disabled = true;
        buy_product(product_id);
    };
}

span.onclick = function() {
    
    modal.style.display = "none";
    
}

window.onclick = function(event) {
    
    if(event.target == modal)
    {
        modal.style.display = "none";
    }
    
}

