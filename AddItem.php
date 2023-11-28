<?php 

	//htmlspecialchars
	
	function giveAlert($message){
		echo '<script>alert(\'Error in '.$message.'\') </script>';
	}

	$conn = mysqli_connect('localhost','PcResting','tonidoll123','wildcat lounge');

	if(!$conn){
		echo 'Connection Error'. mysqli_connection_error();
	}


	if (isset($_POST['submit'])) {
		$Vname = mysqli_real_escape_string($conn,$_POST['name']);		
		$Vprice = mysqli_real_escape_string($conn,$_POST['price']);
		$Vtags = mysqli_real_escape_string($conn,$_POST['tags']);
		$Vcat = mysqli_real_escape_string($conn,$_POST['category']);
		$querry = "INSERT INTO `item menu` (`Item_ID`, `Item Name`, `Price`, `Tags`,`Category`) VALUES (NULL, '$Vname', '$Vprice', '$Vtags','$Vcat');";
		echo $querry.'<br>';

		if(mysqli_query($conn,$querry)){
			echo 'Success!';
		}else{
			echo 'Something Went Wrong';
		}
	}

	$query = "SELECT * FROM `item menu`";
	$res = mysqli_query($conn,$query);
	$items = array();
	while($item = mysqli_fetch_assoc($res)){
		$items[] = $item;
	}
    // Redundant - 1
	$allitem = array(
	    "Coffee"=>array(),
	    "Beverage"=>array(),
	    "Snack"=>array(),
	    "Add-on"=>array()
  	);

	foreach ($allitem as $key => $value) {
	$querry = "SELECT * FROM `item menu` WHERE Category = '$key'";
	$res = $conn->query($querry);
	if($res){
	  $size = 0;
	  while($allitems["$key"][]=$res->fetch_assoc()){
	    $size++;
	  }
	  unset($allitems["$key"]["$size"]);
	  
	}else{
	  echo "Semething went wrong with $key";
	}
	}
	//Redundant -1
 ?>

<!DOCTYPE html>
<html>

<?php include('Templates/header.php') ?>
	<div class="centercont">
		<div class="getitem">
			<p>Add New Item</p>
			<form action="AddItem.php" method="POST" class="InputBox">
				<label>Name:</label>
				<input type="text" name="name">
				<label>Price:</label>
				<input type="number" name="price">
				<label>Tags:</label>
				<input type="text" name="tags">
				<label>Category:</label>
				<input type="text" name="category">
				<div>
					<input type="submit" name="submit" value="submit">
				</div>
			</form>	
		</div>	
	</div>
	<div class="MenuBox">
		<!-- Redundant -->
		<?php foreach ($allitems as $key => $value) { ?> 
		    <div class="<?php echo "$key"; ?>Header">
		    	<p class="MenuHeader"><?php echo $key ?></p>		    	
			    <div class="Category">
			        <?php foreach ($value as $ikey => $val) { ?>
			          <div class="menuitem">
			          	<?php foreach ($val as $k => $v) {
			          		echo "<p>$v</p>";
			          	} ?>
			          </div>
			        <?php } ?>
			    </div>
		    </div>
		  
		<?php } ?>

	</div>

<?php include('Templates/footer.php') ?>

</html>