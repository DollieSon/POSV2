<?php 

	//htmlspecialchars
	

	$conn = new mysqli('localhost','PcResting','tonidoll123','wildcat lounge');

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}	
	$size = 0;
	$querry = "SELECT * FROM `item menu`";
	$result = $conn->query($querry); 
	//print_r($result);
	$items = array();
	if($result){
		while($items[] = $result->fetch_assoc()){
			$size++;
		}
		//ofset by 1
		unset($items["$size"]);
		/*foreach ($items as $key => $value) {
			echo "$key :";
			print_r($value);
			echo "<br>";
		}
		echo "Sucess";*/
	}else{
		echo "Something went wrong";
	}

 ?>

<!DOCTYPE html>
<html>

<?php include('Templates/header.php') ?>

	<h1>Item List</h1>
	<div>
	<?php foreach ($items as $orderkey => $item) { ?>
		<div>
			<?php foreach ($item as $key => $value) { ?>
				<p><?php echo htmlspecialchars($key).":".htmlspecialchars($value); ?></p>
				
			<?php } ?>
		</div>
	<?php } ?>
	</div>
<?php include('Templates/footer.php') ?>

</html>