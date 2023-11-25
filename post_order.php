<?php 

	if (isset($_POST['Given'])) {
		
		$conn = new mysqli('localhost','PcResting','tonidoll123','wildcat lounge');

		if ($conn->connect_error) {
	    	die("Connection failed: " . $conn->connect_error);
		}

		$res = $conn->query("SELECT * FROM `item menu`");
		$items = array();
		if($res){
			while($items[] = $res->fetch_assoc());
			unset($items[count($items)-1]);
			print_r($items);
		}
/*
		echo "Detected";
		echo ",$_POST[Total]";
		echo ",$_POST[Given]";
		$list = json_decode($_POST["List"]);
		$Total = json_decode($_POST["Total"]);
		$Given = json_decode($_POST["Given"]);
		$Change = $Total - $Given;
		foreach ($list as $key => $value) {
			print_r($value);
			echo "<br>";
		}
		*/
	}
 ?>