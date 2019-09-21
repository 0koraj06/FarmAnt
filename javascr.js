function openModal() {
	document.getElementById("myModal").style.display = "block";
	
}

function closeModal() {
	
	document.getElementById("myModal").style.display = "none";
}

var p = document.getElementById("product_box");

function ajaxrequest() 
{
	var xhr2 = new XMLHttpRequest();
	//document.getElementById("pr").style.display = "block";
	xhr2.addEventListener ("load", (e)=>
	{
				var output = "";
				output = output + "<div id='product_box'> ";
				var data = JSON.parse(e.target.responseText);
				
				for(var i=0; i<data.length; i++) {
				
			output = output + '<div id="product">' + 'Item Name:' + data[i].prod_name + '<br />' + 'Price (KG): ' + data[i].price + '<br />' + 'Category:' + data[i].category + '<br />' +  'Stock:' + data[i].stock + '<br />' + 'Seller:' + data[i].seller + '<br />' + 'Description:' + data[i].description + '<br />' + 'Location:' + data[i].location + '<br />'   + " <button  onClick='buy("+ data[i].prodID + ")'> Buy </button>" + '<br />' + '<img class="images"; src="/~korantengj/diss/farmant/product_images/' + data[i].product_image  +  '"/>'  + '</div>' ;
				
																								
				
	
				
			var prodid = data[i].prodID;	
				}
				
			output = output + "</div>" ;	
			
			document.getElementById('product_box').innerHTML = output;	
			
} );	
 xhr2.open("GET" , "/~korantengj/diss/farmant/searchprod.php");
    xhr2.send();

}

function buy(prodid) 

{
	//sending the accID from the book button on the search results to the accomodations booking form
	document.getElementById("buy").innerHTML = "<form method='POST'><input type='text' placeholder='Quantity' id='quantity'/>  <input type='text' value='"+ prodid +"' id='prodid'/><input type='button' onclick='buyitem()' value='Buy'/> </form>";
	
	
		
		
}
function buyitem()
{
 



		var prodid = document.getElementById("prodid").value;
		var quantity = document.getElementById("quantity").value;
		
		console.log(quantity);
		
		console.log(prodid);
// console log checks to ensure the right information is being transfered 		
        var xhr1 = new XMLHttpRequest();
		var data = new FormData();

		data.append("prodID", prodid);
		data.append("stock", quantity);
		
		
		xhr1.addEventListener ("load", (e)=>{
		
		});
	
		xhr1.open("POST" , "/~korantengj/diss/farmant/buy.php");
		xhr1.send(data);
		xhr1.addEventListener ("load", bookerrors);
}



function getmessage() 
{
	var xhr3 = new XMLHttpRequest();
	
	xhr3.addEventListener ("load", (e)=>
	{
				var output = "";
				
				output = output  + "<table> <tr> <th>Subject:</th><th>Sender:</th><th>Message:</th></tr>";
				var data = JSON.parse(e.target.responseText);
				
				for(var i=0; i<data.length; i++) {
				
			output = output + '<tr><td>' + data[i].subject + ' </td><td> ' + data[i].sender +' </td><td> ' + " <button  onClick='openmessage("+ data[i].messageID + ")'>Open Message" + '<br />';
				
		
				

				
			var messageid = data[i].messageID	
				}
				
			output = output + "" ;	
			
			document.getElementById('message').innerHTML = output;	
			
} );	
 xhr3.open("GET" , "/~korantengj/diss/farmant/getmessage.php");
    xhr3.send();

}
function bookerrors(e) {
// error messeges linked to status codes
if(e.target.status==401)
 {
	
	alert('Not enough availability for this request please try a smaller number!');
 }
 
else if(e.target.status==402) {


	alert('This Accomodation has sold out!');

} 
else if(e.target.status==403) {

	alert("There is no existing accommodation on this date!");


} 
else if(e.target.status==200) {

	alert('Booking Successful!');
}
 
}