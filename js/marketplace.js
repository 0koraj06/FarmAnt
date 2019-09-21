function search_items()
{
    var search = document.getElementById('product_search').value;
    var product_list = document.getElementsByClassName('product_list')[0];
    var children = product_list.getElementsByTagName('li');
    var error_message = document.getElementById('product_error');
    for (var index = 0; index < children.length; index++)
    {
        children[index].style.display = "inline-block";
    }
    error_message.style.display = "none";
    if(search)
    {
        var count = children.length;
        for (var index = 0; index < children.length; index++)
        {
            if(children[index].id)
            {
                var product_name = children[index].id.toLowerCase();
                var product_search = search.toLowerCase();
                if(product_name.indexOf(product_search) < 0)
                {
                    children[index].style.display = "none";
                    count--;
                }
            }
        }
        if(count < 1)
        {
            error_message.innerHTML = "No products found containing: " + search;
            error_message.style.display = "block";
        }
    }
}

function buy_product(product_id)
{
    var buy_quantity = document.getElementById('user_quantity');
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.addEventListener("load", buyCallback);
    xmlHttpRequest.open("GET", "./ajax/buy.php?product_id=" + product_id + "&product_quantity=" + buy_quantity.value);
    xmlHttpRequest.send();
}

function buyCallback(e)
{
    var status = e.target.status;
    var error = document.getElementById('modal_error_message');
    var buy_button = document.getElementById('modal_buy');
    switch(status)
    {
        
        case 200:
        {
            error.innerHTML = "Your purchase is being processed.<br/>Our admin team will verify it soon.";
            error.style.color = "green";
            error.style.display = "block";
            break;
        }
        
        case 400:
        {
            error.innerHTML = "Not enough available stock.";
            error.style.display = "block";
            buy_button.disabled = false;
            break;
        }
        
        case 401:
        {
            error.innerHTML = "You must be logged in to purchase.";
            error.style.display = "block";
            break;
        }
        
        case 403:
        {
            error.innerHTML = "There is a server error.<br/>Please try again later.";
            error.style.display = "block";
            break;
        }
 
    }
}


