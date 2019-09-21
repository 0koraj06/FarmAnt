function confirm_order(order_id)
{
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.addEventListener("load", orderCallback);
    xmlHttpRequest.open("GET", "./ajax/order.php?order=" + order_id);
    xmlHttpRequest.send();
}

function orderCallback(e)
{
    var status = e.target.status;
    if(status == 200)
    {
        location.reload();
    }
}