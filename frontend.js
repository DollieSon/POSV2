$(document).ready(function(){
	ReloadList();
    console.log(some)
    $(`#Custombtn`).click(function(){
    	console.log("Set Custom");
    	CustomChange = $('#Customin').val();
    	if(CustomChange < TotalCost){
    		alert("CustomChange is Smaller than Toal Cost");
    		return;
    	}
    	PostOrder(CustomChange);
    });
})
itemlist = {}

// id,count,subtotal

function AddItem(Item_ID){
	console.log("Updating with "+some[Item_ID]["Item Name"]);
	if(Object.keys(itemlist).includes(`${Item_ID}`)){
		itemlist[Item_ID]["count"]++;
		itemlist[Item_ID]["subtotal"]+=parseInt(some[Item_ID]["Price"]);
	}else{
		itemlist[Item_ID] = {
			count:1,
			subtotal:parseInt(some[Item_ID]["Price"])
		}
	}
	console.log(itemlist);
	ReloadList();
}

function RemoveItem(Item_ID){

}
let TotalCost = 0;
function CountTotal(){
	TotalCost = 0;
	for(item in itemlist){
		TotalCost+=itemlist[item]["subtotal"];
	}
	$(`#Total`).text("Total: "+ TotalCost);
	caps = [20,50,100,200,500,1000];
	for(mon of caps){
		//console.log(mon);
		if(TotalCost > mon){
			//console.log("Hiding " + mon + `#C${mon}`);
			
			$(`#C${mon}`).css({"display":"none"});
		}else{
			//console.log("Showing " + `#C${mon}`);
			$(`#C${mon}`).css({"display":"block"});
		}
	}
}

function ClearOrders(){
	itemlist = {};
	TotalCost=0;
	ReloadList();
}

function ReloadList(){
	$(`#ItemContainer`).remove();
	$(`#OrderBox`).append(`<div id="ItemContainer"></div>`);
	$(`#ItemContainer`).append(`
		<div class="OrderClass" id="ItemHeader">
			<p class="OrderName"  >Name</p>
			<p class="OrderCount" >Count</p>
			<p class="OrderIPrice">Price</p>
			<p class="OrderTotal" >Total</p>
		</div>
	`);
	for(item in itemlist){
		//name, count , 
		$(`#ItemContainer`).append(`
		<div class="OrderClass" id="Item${item}">
			<p class="OrderName"  >${some[item]["Item Name"]}</p>
			<p class="OrderCount" >${itemlist[item]["count"]}</p>
			<p class="OrderIPrice">${some[item]["Price"]}</p>
			<p class="OrderTotal" >${itemlist[item]["subtotal"]}</p>
		</div>
		`);
	}
	CountTotal();
}

function PostOrder(Change){
	if(Object.keys(itemlist) == ""){
		console.log("No Orders Found");
		return;
	}
	$.ajax({
		url:'http://localhost:430/POSV2/post_order.php',
		type:'POST',
		data:{
			Total:TotalCost,
			Given:Change,
			List:JSON.stringify(itemlist)
		},
		success:function(data){
			console.log(data);
			if(data == ""){
				console.log("successfully sent");
			}
			location.reload();
		},
		error:function(data){

		}
	});
}