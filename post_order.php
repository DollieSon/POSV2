<?php 

	if (isset($_POST['Given'])) {
		
		$conn = new mysqli('localhost','PcResting','tonidoll123','wildcat lounge');

		if ($conn->connect_error) {
	    	die("Connection failed: " . $conn->connect_error);
		}

		$res = $conn->query("SELECT * FROM `item menu`");
		$items = array();
		//TO implent O(1) access time
		if($res){
			//echo "Res Type:".gettype($res);
			$IndivItem;
			while($IndivItem = $res->fetch_assoc()){
				$items[$IndivItem["Item_ID"]] = $IndivItem;
				unset($items[$IndivItem["Item_ID"]]["Item_ID"]);
			}
			//print_r($items);
			//while($items[] = $res->fetch_assoc());
			//unset($items[count($items)-1]);
			//print_r($items);
		}

		//echo "Detected";
		//echo ",$_POST[Total]";
		//echo ",$_POST[Given]";
		$list = json_decode($_POST["List"]);
		$Total = json_decode($_POST["Total"]);
		$Given = json_decode($_POST["Given"]);
		$Change =  $Given - $Total;
		foreach ($list as $key => $value) {
			//echo "key: $key";
			//print_r($value);
			//echo "<br/>";
		}

		$query = "INSERT INTO `order-history-unique` (`Order_ID`, `Total`, `Amount_Given`, `Change_Given`) VALUES (NULL, '$Total', '$Given', '$Change')";
		$res = $conn->query($query);

		$query = "SELECT `Order_ID` FROM `order-history-unique` ORDER BY `Order_ID` DESC LIMIT 1";
		$res = $conn->query($query);
		$Latest_ID = array();
		if($res){
			while($Latest_ID[] = $res->fetch_assoc()){
				//print_r($Latest_ID);
			}
		}

		//Passing to indiv order
		unset($Latest_ID[1]);
		$query = "INSERT INTO `order_history_single` (`Order_ID`, `Item_ID`, `Amount`, `Total Price`) VALUES ";
		$Oid = $Latest_ID[0]['Order_ID'];
		foreach ($list as $key => $value) {
			$query.="('$Oid','".$key."','".strval($value->count)."','".strval($value->subtotal)."'),";
		}
		//echo "$query";
		$query = substr($query, 0,-1);
		$res = $conn->query($query);



	}
 ?>